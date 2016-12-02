<?php

namespace MarcW\Silex\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

use Buzz\Browser;
use Buzz\Client;

class BuzzServiceProvider implements ServiceProviderInterface
{
    protected $options = array(
        'client'  => 'Buzz\Client\Curl',
        'browser' => 'Buzz\Browser',
    );

    public function register(Container $app)
    {
        $options = isset($app['buzz.options']) ? array_merge($this->options, $app['buzz.options']) : $this->options;

        $app['buzz'] = function() use($options) {
            $client = null;
            if ($options['client'] instanceof Closure) {
                $callable = $options['client'];
                $client = $callable();
            } else {
                $class = $options['client'];
                $client = new $class();
            }

            $browser = null;
            if ($options['browser'] instanceof Closure) {
                $callable = $options['browser'];
                $browser = $callable($client);
            } else {
                $class = $options['browser'];
                $browser = new $class($client);
            }

            return $browser;
        };


        if (isset($app['buzz.class_path'])) {
            $app['autoloader']->registerNamespace('Buzz', $app['buzz.class_path']);
        }
        if (isset($app['buzz.client.timeout'])) {
            $app['buzz']->getClient()->setTimeout($app['buzz.client.timeout']);
        }
        if (isset($app['buzz.client.max_redirects'])) {
            $app['buzz']->getClient()->setMaxRedirects($app['buzz.client.max_redirects']);
        }
        if (isset($app['buzz.client.ignore_errors'])) {
            $app['buzz']->getClient()->setIgnoreErrors($app['buzz.client.ignore_errors']);
        }
    }

    public function boot(Application $app)
    {
    }
}
