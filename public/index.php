<?php

use Proposition\Proposition;
use Enum\TypePropositionEnum;

require_once '../vendor/autoload.php';

$proposition = new Proposition("(a^b)", TypePropositionEnum::COMPOUND(), false);

//$proposition->separatePropositions("(a^c)^b");


$frui = TypePropositionEnum::COMPOUND();

if ($frui->is(TypePropositionEnum::COMPOUND)) {
	echo "Eating an apple.\n";
} else if ($frui->is(TypePropositionEnum::SIMPLE)) {
	echo "Eating an orange.\n";
}