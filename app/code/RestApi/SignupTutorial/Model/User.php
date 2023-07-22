<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace RestApi\SignupTutorial\Model;

use Magento\Framework\DataObject;

class User extends \Magento\Framework\Model\AbstractModel implements \RestApi\SignupTutorial\Api\Data\UserInterface
{

    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
        )
        {
            parent::__construct($context, $registry, $resource, $resourceCollection, $data);
        }

    public function _construct(
        // \Magento\Framework\Model\Context $context,
        // \Magento\Framework\Registry $registry,
        // \Magento\Customer\Model\ResourceModel\Customer $resource,
        // \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        // array $data = [],
    ){
		$this->_init("RestApi\SignupTutorial\Model\ResourceModel\User");
        // return parent::__construct(
        //     $data
        // );
	}

 /**
     * Get user id
     *
     * @return int|null
     */
    public function getId() : int | null
    {
        return $this->_getData(self::ID);
    }

    /**
     * Set user id
     *
     * @param int $id
     * @return $this
     */
    public function setId($id) : mixed
    {
        return $this->setData(self::ID, $id);
    }
    
     
    /**
     * Get date of birth
     *
     * @return string|null In keeping with current security and privacy best practices, be sure you are aware of any
     * potential legal and security risks associated with the storage of customers’ full date of birth
     * (month, day, year) along with other personal identifiers (e.g., full name) before collecting or processing
     * such data.
     */
    public function getDob() : string | null
    {
        return $this->_getData(self::DOB);
    }

    /**
     * Set date of birth
     *
     * @param string $dob
     * @return $this
     */
    public function setDob($dob) : mixed
    {
        return $this->setData(self::DOB, $dob);
    }

    /**
     * Get email address
     *
     * @return string
     */
    public function getEmail() : string | null 
    {
        return $this->_getData(self::EMAIL);
    }

    /**
     * Set email address
     *
     * @param string $email
     * @return $this
     */
    public function setEmail($email) : mixed
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * 
     *
     * @return string
     */
    public function getPassword() : string | null
    {
        return $this->_getData(self::PASSWORD);
    }

    /**
     * Set email address
     *
     * @param string $password
     * @return $this
     */
    public function setPassword($password) : mixed
    {
        return $this->setData(self::PASSWORD, $password);
    }

    /**
     * Get first name
     *
     * @return string
     */
    public function getFirstname() : string | null
    {
        return $this->_getData(self::FIRSTNAME);
    }

    /**
     * Set first name
     *
     * @param string $firstname
     * @return $this
     */
    public function setFirstname($firstname) : mixed
    {
        return $this->setData(self::FIRSTNAME, $firstname);
    }

    /**
     * Get last name
     *
     * @return string
     */
    public function getLastname() : string | null
    {
        return $this->_getData(self::LASTNAME);
    }

    /**
     * Set last name
     *
     * @param string $lastname
     * @return $this
     */
    public function setLastname($lastname) : mixed
    {
        return $this->setData(self::LASTNAME, $lastname);
    }

    /**
     * Get gender
     *
     * @return int|null
     */
    public function getGender() : int | null
    {
        return $this->_getData(self::GENDER);
    }

    /**
     * Set gender
     *
     * @param int $gender
     * @return $this
     */
    public function setGender($gender) : mixed
    {
        return $this->setData(self::GENDER, $gender);
    }

    /**
     * Get user address.
     *
     * @return string|null
     */
    public function getAddress()  : string | null
    {
        return $this->_getData(self::ADDRESS);
    }

    /**
     * Set user address.
     *
     * @param string $address
     * @return $this
     */
    public function setAddress($address = null) : mixed
    {
        return $this->setData(self::ADDRESS, $address);
    }
}