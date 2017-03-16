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
		$this->motherProposition = $motherProposition;
	}
	
	public function defineNumberLines(int $nSimplePropositions) : int
	{
		return pow(2, $nSimplePropositions);
	}
	
}