<?php

/**
 * Test: Nette\Templating\Helpers::date()
 */

use Nette\Templating\Helpers,
	Tester\Assert;


require __DIR__ . '/../bootstrap.php';


setlocale(LC_TIME, 'C');


Assert::null( Helpers::date(NULL), "TemplateHelpers::date(NULL)" );


Assert::same( "01/23/78", Helpers::date(254400000), "TemplateHelpers::date(timestamp)" );


Assert::same( "05/05/78", Helpers::date('1978-05-05'), "TemplateHelpers::date(string)" );


Assert::same( "05/05/78", Helpers::date(new DateTime('1978-05-05')), "TemplateHelpers::date(DateTime)" );


Assert::same( "1978-01-23", Helpers::date(254400000, 'Y-m-d'), "TemplateHelpers::date(timestamp, format)" );


Assert::same( "1212-09-26", Helpers::date('1212-09-26', 'Y-m-d'), "TemplateHelpers::date(string, format)" );


Assert::same( "1212-09-26", Helpers::date(new DateTime('1212-09-26'), 'Y-m-d'), "TemplateHelpers::date(DateTime, format)" );


Assert::same( "30:10:10", Helpers::date(new DateInterval('PT30H10M10S'), '%H:%I:%S'), "TemplateHelpers::date(DateInterval, format)" );
