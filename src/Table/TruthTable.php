<?php

namespace Table;

use Proposition\CompleteProposition;
use Proposition\Proposition;
use Enum\TypePropositionEnum;
use Enum\ConnectiveEnum;

class TruthTable extends Table
{
	private $motherProposition;
	private $propositions;
	
	const TRUE = "verdadeiro";
	const FALSE = "falso";
	
	public function __construct(CompleteProposition $motherProposition)
	{
		$this->setNColumns($motherProposition->countAllPropositions());
		$this->setNLines($this->defineNumberLines(count($motherProposition->getSimplePropositionsNotDenied())));
		$this->motherProposition = $motherProposition;
		$this->propositions = $motherProposition->getAllPropositions();
		
		$this->addColumns();
		$this->generateValueSimplePropositionsNotDenied();
		$this->generateBoolValueDeniedPropositions();
		$this->generateBoolValueOtherPropositions();
	}
	
	public function defineNumberLines(int $nSimplePropositions) : int
	{
		return pow(2, $nSimplePropositions);
	}
	
	public function addColumns()
	{
		$this->structure[] = $this->motherProposition->getAllSimplePropositions();
		$numCoumpoundProp = count($this->motherProposition->getAllCompoundPropositions());
		$compoundPropositions = $this->motherProposition->getAllCompoundPropositions();
		
		for ($i = $numCoumpoundProp -1; $i >=0; $i--) {
			$this->structure[0][] = $compoundPropositions[$i];
		}
		$this->structure[0][] = $this->motherProposition->getMotherProposition();
	}
	/**
	 *  @DONE
	 * Verifica o numero de alternacao de diferentess valores boolean
	 * 
	 * @param int $posSimplePro
	 * @return int
	 */
	public function defineAlternationBooleanValue(int $posSimplePro) : int
	{
		$posSimplePro++;
		$div = $posSimplePro * 2;
		return $this->getNLines() / $div;
	}
	
	public function generateValueSimplePropositionsNotDenied()
	{
			if ($this->structure[0] != null) {
			 
			for ($column = 0; $column < count($this->motherProposition->getAllSimplePropositions()); $column++) {
				
				$prop = $this->structure[0][$column];
				$alternationBool = $this->defineAlternationBooleanValue($column);
				
				$setValue = "true";
				$nAlternation = 1;
				for ($line = 1; $line <= $this->getNLines(); $line++) {
					
					if ($nAlternation > $alternationBool) {
						$setValue = ($setValue === "true") ? "false" : "true";
						$nAlternation = 1;
					}
					$this->structure[$line][$column] = $setValue;
					// percorrendo cada linha de uma coluna(prop)
					// metodo: verifica se a posicao da proposicao simples q nao e negada, e a partir de posicao dela
					// vai returnar um numero q sera a quantidade vezes q o valor bool sera trocado, com isso chamara
					// o segundo metodo ou entrada em loop para adicionar todo valor de uma proposicao simples,
					// dentro do metodo ou loop ira alterar os valor e ir setando para cada linha
					$nAlternation++;
				}
			}
		}
	}
	
	public function generateBoolValueDeniedPropositions()
	{
		for ($column = 0; $column < count($this->structure[0]); $column++) {
			$prop = $this->structure[0][$column];
			
			if ($prop->getIsDenied()) {
				$valueNotDenied = $prop->removeSignalOfDenied($prop->getPropositionValue());
				// percorrendo novamente colunas para achar o valor q preciso comparar
				for ($c = 0; $c < count($this->structure[0]); $c++) {
					$p = $this->structure[0][$c];
					
					if ($p->getPropositionValue() == $valueNotDenied) {
						for ($i = 1; $i <= $this->getNLines(); $i++) {
							//percorrendo os valores bool do coluna q preciso verificar
							$valorBoolRef = $this->structure[$i][$c];
							// valor bool da q preciso definir (negativa)
							$this->structure[$i][$column] = ($valorBoolRef == "true") ? "false": "true";
						}
					}
				}
			}
		}
		
	}
	
	public function generateBoolValueOtherPropositions()
	{
		for ($column = 0; $column < count($this->structure[0]); $column++) {
			$prop = $this->structure[0][$column];
			
			if(!$prop->getIsDenied() && $prop->getType()->equals(TypePropositionEnum::COMPOUND())) {
				$conn = $prop->getConnective();
				
				$boolValuePropRefs = null;
				
					foreach ($prop->getPropositions() as $propChild) {
						for ($c = 0; $c < count($this->structure[0]); $c++) {
							$p = $this->structure[0][$c];
							if ($p->getPropositionValue() == $propChild->getPropositionValue()) {
								$boolValuePropRef = null;
								for ($row = 1; $row <= $this->getNLines(); $row++) {
									$boolValuePropRef[] = $this->structure[$row][$c];
								}
								$boolValuePropRefs[] = $boolValuePropRef;
							}
							
						}
						
					}
				if ($conn->equals(ConnectiveEnum::AND())) {
					$this->defineBooleanValue($boolValuePropRefs, ConnectiveEnum::AND(), $column);
				} else if ($conn->equals(ConnectiveEnum::OR())) {
					$this->defineBooleanValue($boolValuePropRefs, ConnectiveEnum::OR(), $column);
				} else if ($conn->equals(ConnectiveEnum::IMPLY())) {
					$this->defineBooleanValue($boolValuePropRefs, ConnectiveEnum::IMPLY(), $column);
				} else if ($conn->equals(ConnectiveEnum::EQUIVALENT())) {
					$this->defineBooleanValue($boolValuePropRefs, ConnectiveEnum::EQUIVALENT(), $column);
				} else if ($conn->equals(ConnectiveEnum::OR_OR())) {
					$this->defineBooleanValue($boolValuePropRefs, ConnectiveEnum::OR_OR(), $column);
				}
			}
		}
	}
	
	private function defineBooleanValue(array $boolValuePropRefs, ConnectiveEnum $connective, int $column)
	{
		if(count($boolValuePropRefs) > 1 && count($boolValuePropRefs[0]) == count($boolValuePropRefs[1])) {
			for ($i = 0; $i < count($boolValuePropRefs[0]); $i++) {
				$value1 = $boolValuePropRefs[0][$i];
				$value2 = $boolValuePropRefs[1][$i];

				if ($connective->equals(ConnectiveEnum::AND())) {
					if ($value1 == "true" && $value2 == "true") {
						$arrayBooleanResults[] = "true";
					} else {
						$arrayBooleanResults[] = "false";
					}
				} else if($connective->equals(ConnectiveEnum::OR())) {
					if ($value1 == "true" || $value2 == "true") {
						$arrayBooleanResults[] = "true";
					} else {
						$arrayBooleanResults[] = "false";
					}
				} else if ($connective->equals(ConnectiveEnum::IMPLY())) {
					if ($value1 == "true" && $value2 == "false") {
						$arrayBooleanResults[] = "false";
					} else {
						$arrayBooleanResults[] = "true";
					}
				}else if ($connective->equals(ConnectiveEnum::EQUIVALENT())) {
					if ($value1 == $value2) {
						$arrayBooleanResults[] = "true";
					} else {
						$arrayBooleanResults[] = "false";
					}
				} else if ($connective->equals(ConnectiveEnum::OR_OR())) {
					if ($value1 == "true" && $value2 == "true" || $value1 == "false" && $value2 == "false") {
						$arrayBooleanResults[] = "false";
					} else {
						$arrayBooleanResults[] = "true";
					}
				}
			}
		}
		
		if ($arrayBooleanResults != null) {
			$i = 0;
			for ($row = 1; $row <= $this->getNLines(); $row++) {
				$this->structure[$row][$column] = $arrayBooleanResults[$i];
				$i++;
			}
		}
	}
	
	private function deniedPropositionValue(Proposition $proposition) {
		
		if ($proposition->getIsDenied() == true) {
			$valueNotDenied = $proposition->removeSignalOfDenied($proposition->getPropositionValue());
			
			for ($column = 0; $column < count($this->motherProposition->getAllPropositions()); $column++) {
				$prop = $this->structure[0][$column];
				
				if ($prop->getPropositionValue() == $valueNotDenied) {
					
				}
			}
		} else {
			throw new Exception("proposition not denied!");
		}
	}
	
		
}
	
