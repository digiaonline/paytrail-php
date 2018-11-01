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

use Paytrail\Exception\PropertyDoesNotExist;

/**
 * Class Object.
 *
 * @package Paytrail\Common
 */
abstract class BaseObject
{

    /**
     * Magic getter for the object property.
     *
     * @param string $name Name of the property to get.
     *
     * @return mixed
     *
     * @throws PropertyDoesNotExist
     */
    public function __get($name)
    {
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            return $this->$getter();
        } else if (property_exists($this, $name)) {
            return $this->{$name};
        }
        throw new PropertyDoesNotExist(sprintf('Property "%s" does not exist in %s.', $name, get_called_class()));
    }

    /**
     * Magic setter for the object property.
     *
     * @param string $name  The property name to set.
     * @param mixed  $value The value to set.
     *
     * @throws PropertyDoesNotExist
     */
    public function __set($name, $value)
    {
        $setter = 'set' . $name;
        if (method_exists($this, $setter)) {
            $this->$setter($value);
        } else if (property_exists($this, $name)) {
            $this->{$name} = $value;
        }
        throw new PropertyDoesNotExist(sprintf('Property "%s" does not exist in %s.', $name, get_called_class()));
    }

    /**
     * Configure the object.
     *
     * @param array $properties List of properties to set.
     *
     * @throws PropertyDoesNotExist
     */
    public function configure($properties = array())
    {
        foreach ($properties as $name => $value) {
            if ( ! property_exists($this, $name)) {
                throw new PropertyDoesNotExist(sprintf('Property "%s" does not exist in %s', $name,
                    get_called_class()));
            }
            $this->{$name} = $value;
        }
    }
}
