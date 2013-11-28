<?php
/*
 * This file is part of Paytrail.
 *
 * (c) 2013 Nord Software
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NordSoftware\Paytrail\Common;

abstract class DataObject extends Object
{
    /**
     * @return array
     */
    abstract public function toArray();

    /**
     * @param array $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }
}