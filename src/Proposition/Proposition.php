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
	
	public function __construct(String $propositionValue, TypePropositionEnum $type)
	{
		$this->propositionValue = $propositionValue;
		$this->type = $type;
		$this->isDenied = $this->verifyIsDenied($propositionValue);
		if ($type->equals(TypePropositionEnum::COMPOUND())) {
			$newProposition = $propositionValue;
			if ($this->isDenied === true) {
				$newProposition = $this->removeSignalOfDenied($propositionValue);
			}
			if($newProposition != null) {
				$propositions = $this->separatePropositions($newProposition);
			}
			
			 foreach ($propositions as $prop) {
			 	echo $value. " | ";
				$this->propositions[] = new Proposition($prop, $this->verifyTypeProposition($prop));
			} 
		
		}
		
		
		
		/* $this->propositionValue = $propositionValue;
		$this->type = $type;
		$this->isDenied = $isDenied;
		
		if ($type->equals(new TypePropositionEnum(TypePropositionEnum::COMPOUND))) {
			$isDenied = $this->verifyIsDenied($propositionValue);
			
			if ($isDenied === true) {
				$propositionValue = $this->removeSignalOfDenied($propositionValue);
			}
			$array = $this->separatePropositions($propositionValue);
			foreach($array as $value) {
				echo "value====".$value."<br>";
				$this->propositions[] = new Proposition($value, $this->verifyTypeProposition($value), $this->verifyIsDenied($value));
			}
		}  */
	}
	
	public function verifyIsDenied(String $proposition) : bool
	{
		$isDenied = false;
		
		if (strlen($proposition) > 0) {
			$firtChar = $proposition{0};
			if ($firtChar == "~") {
				$isDenied = true;
			}
		}
		return $isDenied;
	}
	
	public function verifyConnective(String $conn) : ConnectiveEnum
	{
		$connective = ConnectiveEnum::NOT_CONTAINS();
		
		switch ($conn) {
			case "^":
				$connective = ConnectiveEnum::AND();
				break;
			case "v":
				$connective = ConnectiveEnum::OR();
				break;
			case "->":
				$connective = ConnectiveEnum::IMPLY();
				break;
			case "<->":
				$connective = ConnectiveEnum::EQUIVALENT();
				break;
		}
		
		return $connective;
	}
	
	public function verifyTypeProposition($value) : TypePropositionEnum
	{
		if (strlen($value) === 1) {
			return 	TypePropositionEnum::SIMPLE();
		}
		return TypePropositionEnum::COMPOUND();
 	}
	
	

	
	private function isConnective($char) : bool
	{
		$connectives = array("^", "v", "->", "<->");
		$isConnective = false;
		
		foreach ($connectives as $connective) {
			if ($char == $connective) {
				$isConnective = true;
			}
		}
		return $isConnective;
	}
	
	private function isSimbol($char) : bool
	{
		$simbols = array("-", "<", ">", "~");
		$isSimbol = false;
		
		foreach ($simbols as $simbol) {
			if ($char == $simbol) {
				$isSimbol = true;
			}
		}
		return $isSimbol;
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
		/* $propositionsReturned = null;
		$simpleProposition = 0;
		$conn = 0;
		
		$propositionMod = $this->removeParentheses($propositionValue);
		
		for ($i = 0; $i < strlen($propositionMod); $i++) {
			$char = $propositionValue{$i};
			
			if ()
			
			
		} */
		
		
		
		
		
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
				if ($this->isSimbol($char) === true) {
					$simbol .= $char;
					$pos = $i;
				} else if($char === "v" || $char === "^") {
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
	
	public function getPropositions() : array
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