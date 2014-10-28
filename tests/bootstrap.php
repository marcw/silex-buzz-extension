<?php

/*
 * This file is part of the BuzzServiceProvider package.
 *
 * (c) Rodrigo Prado de Jesus <royopa@gmail.com>
 *
 */

$loader = require __DIR__.'/../../../../vendor/autoload.php';
$loader->add('MarcW\Silex\Provider', __DIR__);
require_once __DIR__.'/../lib/MarcW/Silex/Provider/BuzzServiceProvider.php';
