<?php
/**
 * This file is part of Paytrail.
 *
 * (c) 2013 Nord Software
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Paytrail\Object;

use Paytrail\Common\DataObject;

/**
 * Class Contact.
 *
 * @package Paytrail\Object
 */
class Contact extends DataObject
{

    /**
     * @var string $firstName
     */
    protected $firstName;

    /**
     * @var string $lastName
     */
    protected $lastName;

    /**
     * @var string $email
     */
    protected $email;

    /**
     * @var string $phoneNumber
     */
    protected $phoneNumber;

    /**
     * @var string $mobileNumber
     */
    protected $mobileNumber;

    /**
     * @var string $companyName
     */
    protected $companyName;

    /**
     * @var \Paytrail\Object\Address $address
     */
    protected $address;

    /**
     * Convert properties to array.
     *
     * @return array The
     */
    public function toArray()
    {
        $array = array(
            'firstName'   => $this->firstName,
            'lastName'    => $this->lastName,
            'email'       => $this->email,
            'telephone'   => $this->phoneNumber,
            'mobile'      => $this->mobileNumber,
            'companyName' => $this->companyName,
        );
        if ($this->address !== null) {
            $array['address'] = $this->address->toArray();
        }

        return $array;
    }

    /**
     * Get first name.
     *
     * @return string The first name.
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Get last name.
     *
     * @return string The last name.
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Get email.
     *
     * @return string The email.
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get phone number.
     *
     * @return string The phone number.
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Get mobile number.
     *
     * @return string The mobile number.
     */
    public function getMobileNumber()
    {
        return $this->mobileNumber;
    }

    /**
     * Get company name.
     *
     * @return string The company name.
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Get address.
     *
     * @return \Paytrail\Object\Address The address object.
     */
    public function getAddress()
    {
        return $this->address;
    }
}
