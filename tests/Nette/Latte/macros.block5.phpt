<?php

/**
 * Test: Nette\Latte\Engine and blocks.
 */

use Nette\Latte,
	Tester\Assert;


require __DIR__ . '/../bootstrap.php';


$template = new Nette\Templating\Template;
$template->registerFilter(new Latte\Engine);

$template->setSource('{define foobar}Hello{/define}');
Assert::match('', (string) $template);


$template->setSource('{define foo-bar}Hello{/define}');
Assert::match('', (string) $template);


$template->foo = 'bar';
$template->setSource('{define $foo}Hello{/define}');
Assert::match('', (string) $template);
