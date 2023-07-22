<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace RestApi\SignupTutorial\Api;

/**
 * Customer CRUD interface.
 * @api
 * @since 100.0.2
 */
interface UserRepositoryInterface
{
    /**
     * Create or update a customer.
     *
     * @param \RestApi\SignupTutorial\Api\Data\UserInterface $user
     * 
     * @return \RestApi\SignupTutorial\Api\Data\UserInterface
     * @throws \Magento\Framework\Exception\InputException If bad input is provided
     * @throws \Magento\Framework\Exception\State\InputMismatchException If the provided email is already used
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\RestApi\SignupTutorial\Api\Data\UserInterface $user);

    /**
     * Retrieve user.
     *
     * @param string $email
     * @return \RestApi\SignupTutorial\Api\Data\UserInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException If customer with the specified email does not exist.
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($email);

    // /**
    //  * Get user by User ID.
    //  *
    //  * @param int $userId
    //  * @return \RestApi\SignupTutorial\Api\Data\UserInterface
    //  * @throws \Magento\Framework\Exception\NoSuchEntityException If customer with the specified ID does not exist.
    //  * @throws \Magento\Framework\Exception\LocalizedException
    //  */
    // public function getById($userId);
}
