<?php

namespace Proposition;
use Enum\TypePropositionEnum;
require_once '../vendor/autoload.php';

class Proposition
{
	private $propositionValue;
	private $type;
	private $propositions;
	private $isDenied;
	private $connective;
	
	public function __construct(String $propositionValue, $type, bool $isDenied)
	{
		$this->propositionValue = $propositionValue;
		$this->type = $type;
		$this->isDenied = $isDenied;
		/* if ($type->is(TypePropositionEnum::COMPOUND)) {
			$array = $this->separatePropositions($propositionValue);
			echo 'haha';
			foreach($array as $value) {
				echo $value ."<br>";
			}
		} else {
			echo 'tnb;';
		} */
	}
	
	private function countParenthese($char) {
		
	}
	
	private function isConnective($char) : bool
	{
		$connectives = array("^", "v", "->", "<->");
		
		$isConnective = false;

		
		foreach ($connectives as $connective) {
			/*echo "{";
			echo $connective. ", ";
			echo $char;
			echo "}";
			echo "<br>"0;*/
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
	
	private function removeParentheses(String $proposition) : String
	{
		$newProposition = null;
		if ($proposition{0} === "(" && $proposition{strlen($proposition) - 1} === ")") {
			$newProposition = substr($proposition, 1, strlen($proposition) - 2);
		}
		return $newProposition;
	}
	
	public function separatePropositions(String $propositionValue) : array
	{
		$pos = null;
		$prop1 = null;
		$prop2 = null;
		$simbol = "";
		
		$connective = null;
		$parentheses = 0;
		//
		for ($i = 0; $i < strlen($propositionValue); $i++) {
			$char = $propositionValue{$i};
			//Verificando se parenteses estão fechados
			if ($char === "(") {
				$parentheses++;
			} else if ($char === ")") {
				$parentheses--;
			}

			// capturando o simbola de mais alto nivel
			if ($parentheses === 0) {
				if ($this->isSimbol($char) === true) {
					$simbol .= $char;
					$pos = $i;
				} else if($char == "v" || $char == "^") {
					$simbol = $char;
					$pos = $i;
				}
			}
			
		}
		
		if ($simbol === "") {
			$newProsposition = $this->removeParentheses($propositionValue);
			return $this->separatePropositions($newProsposition);
		}
			  if ($parentheses === 0) {
				//$connective = $char;
				//echo strlen($simbol) +1;
					$prop1 = substr($propositionValue, 0, $pos);
					$prop2 = substr($propositionValue, strrpos($propositionValue, $simbol) + strlen($simbol), strlen($propositionValue));
				
			}
		
		return array($prop1, $prop2);
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
	
	public function toString()
	{
		return;
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
		return $this->connective;
	}
	
	public function setConnective(ConnectiveEnum $connective)
	{
		$this->connective = $connective;
		return $this;
	}
	
	

    

}