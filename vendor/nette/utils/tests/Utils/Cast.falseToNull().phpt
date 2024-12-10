<?php

declare(strict_types=1);

use Nette\Utils\Cast;
use Tester\Assert;


require __DIR__ . '/../bootstrap.php';


Assert::same(1, Cast::falseToNull(1));
Assert::same(0, Cast::falseToNull(0));
Assert::same(null, Cast::falseToNull(null));
Assert::same(true, Cast::falseToNull(true));
Assert::same(null, Cast::falseToNull(false));
Assert::same([], Cast::falseToNull([]));
