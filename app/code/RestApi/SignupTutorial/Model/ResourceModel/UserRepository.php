<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace RestApi\SignupTutorial\Model\ResourceModel;

use Exception;
use Magento\Framework\Exception\InputException;
use RestApi\SignupTutorial\Api\Data\UserInterface;
use RestApi\SignupTutorial\Api\UserRepositoryInterface;
use RestApi\SignupTutorial\Model\UserFactory;
use RestApi\SignupTutorial\Model\ResourceModel\User as UserResource;
class UserRepository implements UserRepositoryInterface
{

    protected $userFactory;

    protected $userResource;
    public function __construct(
        UserFactory $userFactory,
        UserResource $userResource
    )
    {
        $this->userFactory = $userFactory;
        $this->userResource = $userResource;
    }

     /**
     * Create or update a customer.
     *
     * @param \RestApi\SignupTutorial\Api\Data\UserInterface $user
     * 
     * @return \RestApi\SignupTutorial\Api\Data\UserInterface
     * @throws \Magento\Framework\Exception\InputException If bad input is provided
     * @throws \Magento\Framework\Exception\State\InputMismatchException If the provided email is already used
     * @throws \Magento\Framework\Exception\LocalizedException
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function save(UserInterface $user)
    {
        $userData = $this->userFactory->create();

        $userData->addData([
            "dob"       => $user->getDob(),
            "email"     => $user->getEmail(),
            "password"  => $user->getPassword(),
            "firstname" => $user->getFirstname(),
            "lastname"  => $user->getLastname(),
            "gender"    => $user->getGender(),
            "address"   => $user->getAddress(),
        ]);

        try{
            $savedUser = $userData->save();
        }
        catch (Exception $e){
            throw new InputException(
                __(
                    'Cannot save user.',
                    $e
                )
            );
        }
        return $savedUser;
    }

    /**
     * Retrieve customer.
     *
     * @param string $email
     * @return object | null
     * @throws \Magento\Framework\Exception\NoSuchEntityException If customer with the specified email does not exist.
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($email)
    {
        $connection = $this->userResource->getConnection();
        $select = $connection->select()->where('email=?', $email);
        return $select;
    }

}