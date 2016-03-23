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
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            return $this->$getter();
        }
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        $setter = 'set' . $name;
        if (method_exists($this, $setter)) {
            $this->$setter($value);
        }
    }

    /**
     * @param array $properties
     * @throws \NordSoftware\Paytrail\Exception\PropertyDoesNotExist
     */
    public function configure($properties = array())
    {
        foreach ($properties as $name => $value) {
            $this->$name = $value;
        }
    }
}