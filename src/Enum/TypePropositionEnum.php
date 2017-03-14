<?php

namespace Enum;

use Garoevans\PhpEnum\Enum;

class TypePropositionEnum extends Enum
{
	const __default = self::SIMPLE;
	const SIMPLE = 1;
	const COMPOUND = 2;
}