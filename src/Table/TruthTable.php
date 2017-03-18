<?php

namespace Table;

use Proposition\CompleteProposition;

class TruthTable extends Table
{
	private $motherProposition;
	private $propositions;
	
	public function __construct(CompleteProposition $motherProposition)
	{
		$this->setNColumns($motherProposition->countAllPropositions());
		$this->setNLines($this->defineNumberLines(count($motherProposition->getSimplePropositionsNotDenied())));
		$this->motherProposition = $motherProposition;
		$this->propositions = $motherProposition->getAllPropositions();
		
		$this->addColumns();
		$this->generateValueSimplePropositionsNotDenied();
	}
	
	public function defineNumberLines(int $nSimplePropositions) : int
	{
		return pow(2, $nSimplePropositions);
	}
	
	public function addColumns()
	{
		$this->structure[] = $this->motherProposition->getAllSimplePropositions();
		
		foreach ($this->motherProposition->getAllCompoundPropositions() as $compound) {
			$this->structure[0][]= $compound;
		}
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
			
			
			
			
			
			
			/* for ($column = 0; $column < count($this->structure[0]); $column++) {
				$prop = $this->structure[$column];
			
				for ($line = 1; $line < $this->getNLines(); $line++) {
					$tabela = $this->getStructure();
				}
			} */
		}
		
	}
	
