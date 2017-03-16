<?php

namespace Proposition;
use Enum\ConnectiveEnum;
use Enum\TypePropositionEnum;
require_once '../vendor/autoload.php';

class Proposition
{
	private $propositionValue;
	private $type;
	private $propositions;
	private $isDenied;
	private $connective;
	
	const AND = "^";
	const OR = "v";
	const EQUIVALENT = "=";
	const IMPLY = ">";
	const DENIED = "~";
	
	public function __construct(String $propositionValue, TypePropositionEnum $type)
	{
		$this->propositionValue = $propositionValue;
		$this->type = $type;
		$this->isDenied = $this->verifyIsDenied($propositionValue, $type);
		if ($type->equals(TypePropositionEnum::COMPOUND())) {
			$newProposition = $propositionValue;
			if ($this->isDenied === true) {
				$newProposition = $this->removeSignalOfDenied($propositionValue);
			}
			if($newProposition != null) {
				$propositions = $this->separatePropositions($newProposition);
			}
			
			foreach ($propositions as $prop) {
			 	echo "prop: ".$prop. " | ";
			 	echo $this->verifyTypeProposition($prop) . "<br>";
				$this->propositions[] = new Proposition($prop, $this->verifyTypeProposition($prop));
			} 
		
		}
	}
	
	public function verifyIsDenied(String $proposition, TypePropositionEnum $type) : bool
	{
		$isDenied = false;
		
		if (strlen($proposition) > 0) {
			$firtChar = $proposition{0};
			$secondChar = strlen($proposition) > 1 ? $proposition{1} : null;
			

			
			if ($type->equals(TypePropositionEnum::SIMPLE())) {
				if ($firtChar === Proposition::DENIED) {
					$isDenied = true;
				}
			} else if ($type->equals(TypePropositionEnum::COMPOUND())) {
				if ($firtChar === Proposition::DENIED && $secondChar == "(") {
					$isDenied = true;
				}
			}
		}
		return $isDenied;
	}
	
	public function verifyConnective(String $conn) : ConnectiveEnum
	{
		$connective = ConnectiveEnum::NOT_CONTAINS();
		
		switch ($conn) {
			case Proposition::AND:
				$connective = ConnectiveEnum::AND();
				break;
			case Proposition::OR:
				$connective = ConnectiveEnum::OR();
				break;
			case Proposition::IMPLY:
				$connective = ConnectiveEnum::IMPLY();
				break;
			case Proposition::EQUIVALENT:
				$connective = ConnectiveEnum::EQUIVALENT();
				break;
		}
		return $connective;
	}
	
	public function verifyTypeProposition($value) : TypePropositionEnum
	{
		if (strlen($value) === 1 || strlen($value) === 2 && $value{0} == Proposition::DENIED) {
			return 	TypePropositionEnum::SIMPLE();
		}
		return TypePropositionEnum::COMPOUND();
 	}
	
	

	
	private function isConnective($char) : bool
	{
		$connectives = array(Proposition::AND, Proposition::OR, Proposition::IMPLY, Proposition::EQUIVALENT);
		$isConnective = false;
		
		foreach ($connectives as $connective) {
			if ($char == $connective) {
				$isConnective = true;
			}
		}
		return $isConnective;
	}
	
	private function removeSignalOfDenied(String $proposition)
	{
		$newProposition = $proposition;
		if ($proposition != "" && $proposition{0} == "~") {
			$newProposition = substr($proposition, 1, strlen($proposition) - 1);
		}
		return $newProposition;
	}
	
	private function removeParentheses(String $proposition) : String
	{
		$newProposition = $proposition;
		if ($proposition{0} === "(" && $proposition{strlen($proposition) - 1} === ")") {
			$newProposition = substr($proposition, 1, strlen($proposition) - 2);
		}
		
		return $newProposition;
	}
	
	public function separatePropositions(String $propositionValue) : array
	{
		$propositionsReturned = null;
		$pos = null;
		$prop1 = null;
		$prop2 = null;
		$simbol = "";
		$connective = null;
		$parentheses = 0;
		for ($i = 0; $i < strlen($propositionValue); $i++) {
			$char = $propositionValue{$i};
			//Verificando se parenteses estão fechados
			if ($char === "(") {
				$parentheses++;
			} else if ($char === ")") {
				$parentheses--;
			}
			// capturando o simbola de mais alto nivel, ou seja um q nao esta dentro de parentese
			if ($parentheses === 0) {
				if ($this->isConnective($char) === true) {
					$simbol = $char;
					$pos = $i;
				}
			}
		}
		if ($simbol === "") {
			$newProsposition = $this->removeParentheses($propositionValue);
			return $this->separatePropositions($newProsposition);
		}
		// divido a proposicao composta em duas
	    if ($parentheses === 0) {
			$prop1 = substr($propositionValue, 0, $pos - strlen($simbol) +1);
			$prop2 = substr($propositionValue, strrpos($propositionValue, $simbol) + strlen($simbol), strlen($propositionValue));
			$propositionsReturned = array($prop1, $prop2);
		}
		$this->setConnective($this->verifyConnective($simbol));
		return $propositionsReturned;  
	}
	
	public function findProposition(String $proposition)
	{
		$find = null;
		
		foreach ($this->propositions as $proposition) {
			if ($proposition->getPropositionValue() === $proposition) {
				$find = $proposition;
			}
		}
		return $find;
	}
	
	public function getPropositionValue() : String
	{
		return $this->propositionValue;
	}
	
	public function setPropositionValue(String $propositionValue)
	{
		$this->propositionValue = $propositionValue;
		return $this;
	}
	
	public function getType() : TypePropositionEnum
	{
		return $this->type;
	}
	
	public function setType(TypePropositionEnum $type)
	{
		$this->type = $type;
		return $this;
	}
	
	public function getPropositions()
	{
		return $this->propositions;
	}
	
	public function setPropositions(array $propositions)
	{
		$this->propositions = $propositions;
		return $this;
	}
	
	public function getIsDenied() : bool
	{
		return $this->isDenied;
	}
	
	public function setIsDenied(bool $isDenied)
	{
		$this->isDenied = $isDenied;
		return $this;
	}
	
	public function getConnective() : ConnectiveEnum
	{
		if ($this->connective === null) {
			return ConnectiveEnum::NOT_CONTAINS();
		}
		return $this->connective;
	}
	
	public function setConnective(ConnectiveEnum $connective)
	{
		$this->connective = $connective;
		return $this;
	}

}