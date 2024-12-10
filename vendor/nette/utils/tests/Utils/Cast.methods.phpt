<?php

declare(strict_types=1);

use Nette\Utils\Cast;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';


// bool
Assert::false(Cast::toBool(null));
Assert::true(Cast::toBool(true));
Assert::true(Cast::toBool(1));
Assert::true(Cast::toBool(2));
Assert::true(Cast::toBool(0.1));
Assert::true(Cast::toBool('1'));
Assert::true(Cast::toBool('0.0'));
Assert::false(Cast::toBool(false));
Assert::false(Cast::toBool(0));
Assert::false(Cast::toBool(0.0));
Assert::false(Cast::toBool(''));
Assert::false(Cast::toBool('0'));
Assert::exception(
	fn() => Cast::toBool([]),
	TypeError::class,
	'Cannot cast array to bool.',
);


// int
Assert::same(0, Cast::toInt(null));
Assert::same(0, Cast::toInt(false));
Assert::same(1, Cast::toInt(true));
Assert::same(0, Cast::toInt(0));
Assert::same(1, Cast::toInt(1));
Assert::exception(
	fn() => Cast::toInt(PHP_INT_MAX + 1),
	TypeError::class,
	'Cannot cast 9.2233720368548E+18 to int.',
);
Assert::same(0, Cast::toInt(0.0));
Assert::same(1, Cast::toInt(1.0));
Assert::exception(
	fn() => Cast::toInt(0.1),
	TypeError::class,
	'Cannot cast 0.1 to int.',
);
Assert::exception(
	fn() => Cast::toInt(''),
	TypeError::class,
	"Cannot cast '' to int.",
);
Assert::same(0, Cast::toInt('0'));
Assert::same(1, Cast::toInt('1'));
Assert::same(-1, Cast::toInt('-1.'));
Assert::same(1, Cast::toInt('1.0000'));
Assert::exception(
	fn() => Cast::toInt('0.1'),
	TypeError::class,
	"Cannot cast '0.1' to int.",
);
Assert::exception(
	fn() => Cast::toInt([]),
	TypeError::class,
	'Cannot cast array to int.',
);


// float
Assert::same(0.0, Cast::toFloat(null));
Assert::same(0.0, Cast::toFloat(false));
Assert::same(1.0, Cast::toFloat(true));
Assert::same(0.0, Cast::toFloat(0));
Assert::same(1.0, Cast::toFloat(1));
Assert::same(0.0, Cast::toFloat(0.0));
Assert::same(1.0, Cast::toFloat(1.0));
Assert::same(0.1, Cast::toFloat(0.1));
Assert::exception(
	fn() => Cast::toFloat(''),
	TypeError::class,
	"Cannot cast '' to float.",
);
Assert::same(0.0, Cast::toFloat('0'));
Assert::same(1.0, Cast::toFloat('1'));
Assert::same(-1.0, Cast::toFloat('-1.'));
Assert::same(1.0, Cast::toFloat('1.0'));
Assert::same(0.1, Cast::toFloat('0.1'));
Assert::exception(
	fn() => Cast::toFloat([]),
	TypeError::class,
	'Cannot cast array to float.',
);


// string
Assert::same('', Cast::toString(null));
Assert::same('0', Cast::toString(false)); // differs from PHP strict casting
Assert::same('1', Cast::toString(true));
Assert::same('0', Cast::toString(0));
Assert::same('1', Cast::toString(1));
Assert::same('0.0', Cast::toString(0.0)); // differs from PHP strict casting
Assert::same('1.0', Cast::toString(1.0)); // differs from PHP strict casting
Assert::same('-0.1', Cast::toString(-0.1));
Assert::same('9.2233720368548E+18', Cast::toString(PHP_INT_MAX + 1));
Assert::same('', Cast::toString(''));
Assert::same('x', Cast::toString('x'));
Assert::exception(
	fn() => Cast::toString([]),
	TypeError::class,
	'Cannot cast array to string.',
);


// array
Assert::same([], Cast::toArray(null));
Assert::same([false], Cast::toArray(false));
Assert::same([true], Cast::toArray(true));
Assert::same([0], Cast::toArray(0));
Assert::same([0.0], Cast::toArray(0.0));
Assert::same([1], Cast::toArray([1]));
Assert::equal([new stdClass], Cast::toArray(new stdClass)); // differs from PHP strict casting


// OrNull
Assert::true(Cast::toBoolOrNull(true));
Assert::null(Cast::toBoolOrNull(null));
Assert::same(0, Cast::toIntOrNull(0));
Assert::null(Cast::toIntOrNull(null));
Assert::same(0.0, Cast::toFloatOrNull(0));
Assert::null(Cast::toFloatOrNull(null));
Assert::same('0', Cast::toStringOrNull(0));
Assert::null(Cast::toStringOrNull(null));
Assert::same([], Cast::toArrayOrNull([]));
Assert::null(Cast::toArrayOrNull(null));
