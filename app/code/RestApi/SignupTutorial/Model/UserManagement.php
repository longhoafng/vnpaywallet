<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace RestApi\SignupTutorial\Model;

use Magento\Framework\Encryption\EncryptorInterface as Encryptor;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\State\InputMismatchException;
use Magento\Framework\Stdlib\StringUtils as StringHelper;
use RestApi\SignupTutorial\Api\Data\UserInterface;
use RestApi\SignupTutorial\Api\UserManagementInterface;
use RestApi\SignupTutorial\Model\ResourceModel\UserRepository;

/**
 * Handle various customer account actions
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.TooManyFields)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 * @SuppressWarnings(PHPMD.CookieAndSessionMisuse)
 */
class UserManagement implements UserManagementInterface
{
    public const MIN_PASS_LENGTH = 8;

    public const REQUIRED_CHARACTER_NUMBER = 2;

    /**
     * @var StringHelper
     */
    protected StringHelper $stringHelper;

    /**
     * @var Encryptor
     */
    private Encryptor $encryptor;

    protected UserRepository $userRepository;

    public function __construct(
        UserRepository $userRepository,
        StringHelper $stringHelper,
        Encryptor $encryptor,
    ) {
        $this->userRepository = $userRepository;
        $this->stringHelper = $stringHelper;
        $this->encryptor = $encryptor;
    }

    /**
     * @inheritdoc
     *
     * @throws LocalizedException
     */
    public function createUser(UserInterface $user)
    {
        if ($user->getPassword() !== null) {
            $this->checkPasswordStrength($user->getPassword());
            $user->setPassword($this->createPasswordHash($user->getPassword()));
        } else {
            $hash = null;
        }
        return $this->createUserWithPasswordHash($user);
    }

    /**
     * Make sure that password complies with minimum security requirements.
     *
     * @param string $password
     * @return void
     * @throws InputException
     */
    protected function checkPasswordStrength(string $password): void
    {
        $length = $this->stringHelper->strlen($password);
        if ($length > self::MAX_PASSWORD_LENGTH) {
            throw new InputException(
                __(
                    'Please enter a password with at most %1 characters.',
                    self::MAX_PASSWORD_LENGTH
                )
            );
        }
        $configMinPasswordLength = self::MIN_PASS_LENGTH;
        if ($length < $configMinPasswordLength) {
            throw new InputException(
                __(
                    'The password needs at least %1 characters. Create a new password and try again.',
                    $configMinPasswordLength
                )
            );
        }
        $trimmedPassLength = $this->stringHelper->strlen($password === null ? '' : trim($password));
        if ($trimmedPassLength != $length) {
            throw new InputException(
                __("The password can't begin or end with a space. Verify the password and try again.")
            );
        }

        $requiredCharactersCheck = $this->makeRequiredCharactersCheck($password);
        if ($requiredCharactersCheck !== 0) {
            throw new InputException(
                __(
                    'Minimum of different classes of characters in password is %1.' .
                    ' Classes of characters: Lower Case, Upper Case, Digits, Special Characters.',
                    $requiredCharactersCheck
                )
            );
        }
    }

    /**
     * Check password for presence of required character sets
     *
     * @param string $password
     * @return int
     */
    protected function makeRequiredCharactersCheck(string $password): int
    {
        $counter = 0;
        $requiredNumber = self::REQUIRED_CHARACTER_NUMBER;
        $return = 0;

        if ($password !== null) {
            if (preg_match('/[0-9]+/', $password)) {
                $counter++;
            }
            if (preg_match('/[A-Z]+/', $password)) {
                $counter++;
            }
            if (preg_match('/[a-z]+/', $password)) {
                $counter++;
            }
            if (preg_match('/[^a-zA-Z0-9]+/', $password)) {
                $counter++;
            }
        }

        if ($counter < $requiredNumber) {
            $return = $requiredNumber;
        }

        return $return;
    }

    /**
     * Create a hash for the given password
     *
     * @param string $password
     * @return string
     */
    protected function createPasswordHash($password)
    {
        return $this->encryptor->getHash($password, true);
    }

    /**
     * @inheritdoc
     *
     * @throws InputMismatchException
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function createUserWithPasswordHash(UserInterface $user)
    {
        if ($user->getEmail()) {
            $userData = $this->userRepository->get($user->getEmail());
            if ($userData) {
                throw new InputException(__('This customer already exists in this store.'));
            }
        }

        try {
            // If customer exists existing hash will be used by Repository
            $customer = $this->userRepository->save($user);
        } catch (AlreadyExistsException $e) {
            throw new InputMismatchException(
                __('A customer with the same email address already exists in an associated website.')
            );
        } catch (LocalizedException $e) {
            throw $e;
        }

        return $user;
    }
}
