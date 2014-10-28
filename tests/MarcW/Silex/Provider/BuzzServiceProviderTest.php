<?php

namespace MarcW\Silex\Provider;

use Silex\Application;

/**
 * BuzzServiceProvider test cases.
 *
 * @author Rodrigo Prado de Jesus <royopa@gmail.com>
 */
class BuzzServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testRegister()
    {
        $app = new Application();

        $app->register(new BuzzServiceProvider());

        $this->assertInstanceOf('Buzz\Browser', $app['buzz']);
    }

    public function testResponse()
    {
        $app = new Application();

        $app->register(new BuzzServiceProvider());

        $response = $app['buzz']->get('http://www.google.com');
        $this->assertInstanceOf('Buzz\Message\Response', $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertTrue($response->isOk());
    }
}

