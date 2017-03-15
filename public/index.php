<?php

use Proposition\Proposition;
use Enum\TypePropositionEnum;

require_once '../vendor/autoload.php';
// pos = 7
// size = 3

$proposition = new Proposition("(c^(c^(b<->c))<->c^d)", TypePropositionEnum::COMPOUND());

/* echo "MAE: ".$proposition->getPropositionValue(). " | TYPE: ".$proposition->getType(). " <br>";
$i = 0;
foreach ($proposition->getPropositions() as $proposition) {
	$isDenied = $proposition->getIsDenied() === true ? "true" : "false";
	echo "prop = ".$i ."-". $proposition->getPropositionValue(). " | ";
	echo "con = ".$proposition->getConnective() . " | ";
	echo "type = ". $proposition->getType()	. " | ";
	echo "isDenied = ". $isDenied. "<br>";
	if ($proposition->getType()->equals(TypePropositionEnum::COMPOUND())) {
		foreach ($proposition->getPropositions() as $value) {
			echo "subprop   = ".$value->getPropositionValue(). " | ";
			echo " type   = ".$value->getType(). " | ";
			if ($value->getConnective() != null) {
				echo "  conn  =  ".$value->getConnective()->getValue();
			}
			echo '<br ';
		}
	}
	$i++;
	echo "<br>";
} */

//$proposition->separatePropositions("(a^c)^b");


$test = new TypePropositionEnum(TypePropositionEnum::COMPOUND);
/* 
if ($test->equals(new TypePropositionEnum(TypePropositionEnum::COMPOUND))) {
	echo 'is equals';
} else {
	echo 'not equals';
}
 */
