<?php

namespace RestApi\SignupTutorial\Api\Data;

/**
 * User entity interface for API handling.
 *
 * @api
 * @since 100.0.2
 */
interface UserInterface
{

    const ID = 'id';
    const DOB = 'dob';
    const EMAIL = 'email';
    const FIRSTNAME = 'firstname';
    const GENDER = 'gender';
    const LASTNAME = 'lastname';
    const ADDRESS = 'address';

    const PASSWORD = 'password';

     /**
     * Get user id
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set user id
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);
    
     
    /**
     * Get date of birth
     *
     * @return string|null In keeping with current security and privacy best practices, be sure you are aware of any
     * potential legal and security risks associated with the storage of customers’ full date of birth
     * (month, day, year) along with other personal identifiers (e.g., full name) before collecting or processing
     * such data.
     */
    public function getDob();

    /**
     * Set date of birth
     *
     * @param string $dob
     * @return $this
     */
    public function setDob($dob);

    /**
     * Get email address
     *
     * @return string
     */
    public function getEmail();

    /**
     * Set email address
     *
     * @param string $email
     * @return $this
     */
    public function setEmail($email);

    /**
     * 
     *
     * @return string
     */
    public function getPassword();

    /**
     * Set email address
     *
     * @param string $password
     * @return $this
     */
    public function setPassword($password);

    /**
     * Get first name
     *
     * @return string
     */
    public function getFirstname();

    /**
     * Set first name
     *
     * @param string $firstname
     * @return $this
     */
    public function setFirstname($firstname);

    /**
     * Get last name
     *
     * @return string
     */
    public function getLastname();

    /**
     * Set last name
     *
     * @param string $lastname
     * @return $this
     */
    public function setLastname($lastname);

    /**
     * Get gender
     *
     * @return int|null
     */
    public function getGender();

    /**
     * Set gender
     *
     * @param int $gender
     * @return $this
     */
    public function setGender($gender);

    /**
     * Get user address.
     *
     * @return string|null
     */
    public function getAddress();

    /**
     * Set user address.
     *
     * @param string $address
     * @return $this
     */
    public function setAddress($address = null);
}