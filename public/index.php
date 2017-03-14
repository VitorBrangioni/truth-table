<?php

use Proposition\Proposition;
use Enum\TypePropositionEnum;

require_once '../vendor/autoload.php';

$proposition = new Proposition("(a^b)", TypePropositionEnum::COMPOUND(), false);

$proposition->separatePropositions("(a^c)^b");


$test = new TypePropositionEnum(TypePropositionEnum::COMPOUND);
/* 
if ($test->equals(new TypePropositionEnum(TypePropositionEnum::COMPOUND))) {
	echo 'is equals';
} else {
	echo 'not equals';
}
 */
