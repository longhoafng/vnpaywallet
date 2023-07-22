<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace RestApi\SignupTutorial\Api;

use Magento\Framework\Exception\InputException;

/**
 * Interface for managing users accounts.
 * @api
 * @since 100.0.2
 */
interface UserManagementInterface
{
    public const ACCOUNT_CONFIRMED = 'account_confirmed';

    public const MAX_PASSWORD_LENGTH = 256;


    /**
     * @param \RestApi\SignupTutorial\Api\Data\UserInterface $user
     * 
     * @return \RestApi\SignupTutorial\Api\Data\UserInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function createUser(
        \RestApi\SignupTutorial\Api\Data\UserInterface $user
    );

    /**
     * Create customer account using provided hashed password. Should not be exposed as a webapi.
     *
     * @param \RestApi\SignupTutorial\Api\Data\UserInterface $user
     * 
     * @return \RestApi\SignupTutorial\Api\Data\UserInterface
     * @throws \Magento\Framework\Exception\InputException If bad input is provided
     * @throws \Magento\Framework\Exception\State\InputMismatchException If the provided email is already used
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function createUserWithPasswordHash(
        \RestApi\SignupTutorial\Api\Data\UserInterface $user
    );
    
}