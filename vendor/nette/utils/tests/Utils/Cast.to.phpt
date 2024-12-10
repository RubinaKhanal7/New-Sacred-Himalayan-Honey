<?php

declare(strict_types=1);

use Nette\Utils\Cast;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';


// to
Assert::same(false, Cast::to(null, 'bool'));
Assert::same(0, Cast::to(null, 'int'));
Assert::same(0.0, Cast::to(null, 'float'));
Assert::same('', Cast::to(null, 'string'));
Assert::same([], Cast::to(null, 'array'));
Assert::exception(
	fn() => Cast::to(null, 'unknown'),
	TypeError::class,
	"Unsupported type 'unknown'.",
);


// toOrNull
Assert::null(Cast::toOrNull(null, 'bool'));
Assert::null(Cast::toOrNull(null, 'int'));
Assert::null(Cast::toOrNull(null, 'float'));
Assert::null(Cast::toOrNull(null, 'string'));
Assert::null(Cast::toOrNull(null, 'array'));
Assert::null(Cast::toOrNull(null, 'unknown')); // implementation imperfection
