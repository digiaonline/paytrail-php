<?php
/*
 * This file is part of Paytrail.
 *
 * (c) 2013 Nord Software
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Codeception\Util\Stub;
use NordSoftware\Paytrail\Common\Object;

class Dummy extends Object
{
    protected $foo;

    public function setFoo($foo)
    {
        $this->foo = $foo;
    }

    public function getFoo()
    {
        return $this->foo;
    }
}

class ObjectTest extends \Codeception\TestCase\Test
{
   /**
    * @var \CodeGuy
    */
    protected $codeGuy;

    public function testConfigure()
    {
        $object = new Dummy;
        $object->configure(array(
            'foo' => 'foo',
        ));
        $this->assertEquals('foo', $object->foo);
        try {
            $object->configure(array(
                'bar' => 'bar',
            ));
            $this->assertNull($object->bar);
        } catch (\NordSoftware\Paytrail\Exception\PropertyDoesNotExist $e) {
            // this is the expected outcome.
        }
    }
}