<?php

/**
 * @copyright 2020 Anthon Pang
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace ScssPhp\Tests;

use PHPUnit\Framework\TestCase;

/**
 * SingletonTrait test
 *
 * @author Anthon Pang <apang@softwaredevelopment.ca>
 */
class SingletonTraitTest extends TestCase
{
    /**
     * getInstance
     */
    public function testGetInstance()
    {
        eval('namespace ScssPhp\Tests\SingletonTraitTest_testGetInstance { class Foo { use \ScssPhp\SingletonTrait; }}');
        $instance = SingletonTraitTest_testGetInstance\Foo::getInstance();

        $this->assertTrue(is_object($instance));

        // we can't catch the failure to clone an object
        $reflection = new \ReflectionMethod($instance, '__clone');

        $this->assertTrue($reflection->isPrivate());
    }

    /**
     * __construct
     */
    public function testConstruct()
    {
        $instance = null;

        try {
            eval('namespace ScssPhp\Tests\SingletonTraitTest_testConstruct { class Foo { use \ScssPhp\SingletonTrait; }}');

            $instance = new SingletonTraitTest_testConstruct\Foo();

            $this->assertFalse(\is_null($instance));
        } catch (\Exception $e) {
            $this->assertTrue(\is_null($instance));
        }
    }
}
