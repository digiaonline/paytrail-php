<?php
/*
 * This file is part of Paytrail.
 *
 * (c) 2013 Nord Software
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NordSoftware\Paytrail\Object;

use NordSoftware\Paytrail\Common\DataObject;

class Contact extends DataObject
{
    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $phoneNumber;

    /**
     * @var string
     */
    protected $mobileNumber;

    /**
     * @var string
     */
    protected $companyName;

    /**
     * @var \NordSoftware\Paytrail\Object\Address
     */
    protected $address;

    /**
     * @return array
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
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @return string
     */
    public function getMobileNumber()
    {
        return $this->mobileNumber;
    }

    /**
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @return \NordSoftware\Paytrail\Object\Address
     */
    public function getAddress()
    {
        return $this->address;
    }
}