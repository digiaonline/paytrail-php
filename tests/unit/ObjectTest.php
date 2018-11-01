<?php
/**
 * This file is part of Paytrail.
 *
 * (c) 2013 Nord Software
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Paytrail\Common\BaseObject;

/**
 * Class Dummy.
 */
class Dummy extends BaseObject
{

    /**
     * @var mixed $foo
     */
    protected $foo;

    /**
     * @param mixed $foo
     */
    public function setFoo($foo)
    {
        $this->foo = $foo;
    }

    /**
     * @return mixed
     */
    public function getFoo()
    {
        return $this->foo;
    }
}

/**
 * Class ObjectTest.
 */
class ObjectTest extends \Codeception\TestCase\Test
{
   /**
    * @var \CodeGuy
    */
    protected $codeGuy;

    /**
     * Test configuration.
     */
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
        } catch (\Paytrail\Exception\PropertyDoesNotExist $e) {
            // this is the expected outcome.
        }
    }
}
