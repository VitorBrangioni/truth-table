<?php

use Proposition\Proposition;
use Enum\TypePropositionEnum;
use Proposition\CompleteProposition;
use Table\TruthTable;

require_once '../vendor/autoload.php';
// pos = 7
// size = 3

$proposition = new Proposition("~(~a^b>p)>c=~p", TypePropositionEnum::COMPOUND());

$motherPro = new CompleteProposition($proposition);

$table = new TruthTable(3);


/* $allPropositions = $motherPro->getAllPropositions();


foreach ($allPropositions as $a) {
	echo $a->getPropositionValue(). "<br>";
} */

/*$motherDenied = $proposition->getIsDenied() === true ? "true" : "false";
echo "MAE: ".$proposition->getPropositionValue(). " | TYPE: ".$proposition->getType(). " | isDenied = ".$motherDenied. "<br>";
$i = 0;
foreach ($proposition->getPropositions() as $proposition) {
	$isDenied = $proposition->getIsDenied() === true ? "true" : "false";
	echo "prop".$i ."=". $proposition->getPropositionValue(). " | ";
	echo "con = ".$proposition->getConnective() . " | ";
	echo "type = ". $proposition->getType()	. " | ";
	echo "isDenied = ". $isDenied. "<br>";
	if ($proposition->getType()->equals(TypePropositionEnum::COMPOUND())) {
		foreach ($proposition->getPropositions() as $value) {
			echo "subprop   = ".$value->getPropositionValue(). " | ";
			echo " type   = ".$value->getType(). " | ";
			if ($value->getConnective() != null) {
				$isDen = $value->getIsDenied() === true ? "true" : "false";
				echo "  conn  =  ".$value->getConnective()->getValue();
				echo " | isDenied = ".$isDen;
			}
			if($value->getPropositions() != null) {
				echo '<br>-------------------------<br>';
				foreach ($value->getPropositions() as $v) {
					$en = $v->getIsDenied() === true ? "true" : "false";
					echo "subSUBprop   = ".$v->getPropositionValue(). " | ";
					echo " type   = ".$v->getType(). " | ";
					echo "  conn  =  ".$v->getConnective()->getValue();
					echo " | isDenied = ".$en;
					
					if($v->getPropositions() != null) {
						echo '<br>-------------------------<br>';
						foreach ($v->getPropositions() as $s) {
							$en = $s->getIsDenied() === true ? "true" : "false";
							echo "subSUBprop   = ".$s->getPropositionValue(). " | ";
							echo " type   = ".$s->getType(). " | ";
							echo "  conn  =  ".$s->getConnective()->getValue();
							echo " | isDenied = ".$en;
						}
					}
				}
			}
			echo '<br>';
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
