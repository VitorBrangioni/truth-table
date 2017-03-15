<?php

namespace Enum;

use MyCLabs\Enum\Enum;

class ConnectiveEnum extends Enum
{
	const AND = "and";
	const OR = "or";
	const EQUIVALENT = "equivalent";
	const IMPLY = "imply";
	const NOT_CONTAINS = "notContains";
}