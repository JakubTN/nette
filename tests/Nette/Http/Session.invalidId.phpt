<?php

/**
 * Test: Nette\Http\Session error in session_start.
 *
 * @author     David Grudl
 */

use Nette\Http\Session,
	Nette\Http\SessionSection,
	Tester\Assert;


require __DIR__ . '/../bootstrap.php';


$_COOKIE['PHPSESSID'] = '#';


$container = id(new Nette\Config\Configurator)->setTempDirectory(TEMP_DIR)->createContainer();
$session = $container->getService('session');

$session->start();

Assert::match('%[\w]+%', $session->getId());
