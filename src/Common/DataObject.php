<?php
/**
 * This file is part of Paytrail.
 *
 * (c) 2013 Nord Software
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Paytrail\Common;

/**
 * Class DataObject.
 *
 * @package Paytrail\Common
 */
abstract class DataObject extends BaseObject
{

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    abstract public function toArray();

    /**
     * JSON encode the object.
     *
     * @param int $options Bitmask for JSON encode.
     *
     * @return string The JSON encoded string.
     */
    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }
}
