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

use NordSoftware\Paytrail\Exception\PropertyDoesNotExist;

abstract class Object
{
    /**
     * @param $name
     * @return mixed
     */
    function __get($name)
    {
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            return $this->$getter();
        }
    }

    /**
     * @param $name
     * @param $value
     */
    function __set($name, $value)
    {
        $setter = 'set' . $name;
        if (method_exists($this, $setter)) {
            $this->$setter($value);
        }
    }

    /**
     * @param array $properties
     */
    function configure($properties = array())
    {
        foreach ($properties as $name => $value) {
            if (!property_exists($this, $name)) {
                throw new PropertyDoesNotExist(
                    sprintf('Trying to set property "%s"."%s" that does not exist.', __CLASS__, $name)
                );
            }
            $this->$name = $value;
        }
    }
}