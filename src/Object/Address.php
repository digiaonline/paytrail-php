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
 * Class Address.
 *
 * @package Paytrail\Object
 */
class Address extends DataObject
{

    /**
     * @var string $streetAddress
     */
    protected $streetAddress;

    /**
     * @var string $postalCode
     */
    protected $postalCode;

    /**
     * @var string $postOffice
     */
    protected $postOffice;

    /**
     * @var string $countryCode
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
     * Get street address.
     *
     * @return string The street address.
     */
    public function getStreetAddress()
    {
        return $this->streetAddress;
    }

    /**
     * Get postal code.
     *
     * @return string The postal code.
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Get post office.
     *
     * @return string The post office.
     */
    public function getPostOffice()
    {
        return $this->postOffice;
    }

    /**
     * Get country code.
     *
     * @return string The country code.
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }
}
