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

class Address extends DataObject
{
    /**
     * @var string
     */
    protected $streetAddress;

    /**
     * @var string
     */
    protected $postalCode;

    /**
     * @var string
     */
    protected $postOffice;

    /**
     * @var string
     */
    protected $countryCode;

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            'street'       => $this->streetAddress,
            'postalCode'   => $this->postalCode,
            'postalOffice' => $this->postOffice,
            'country'      => $this->countryCode,
        );
    }

    /**
     * @return string
     */
    public function getStreetAddress()
    {
        return $this->streetAddress;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @return string
     */
    public function getPostOffice()
    {
        return $this->postOffice;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }
}