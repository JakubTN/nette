<?php

/**
 * Test: Nette\Reflection\Method tests.
 */

use Nette\Reflection,
	Tester\Assert;


require __DIR__ . '/../bootstrap.php';


class A {
	static function foo($a, $b) {
		return $a + $b;
	}
}

class B extends A {
	function bar() {}
}

$method = new Reflection\Method('B', 'foo');
Assert::equal( new Reflection\ClassType('A'), $method->getDeclaringClass() );


Assert::null( $method->getExtension() );


Assert::same( 23, $method->toCallback()->invoke(20, 3) );
