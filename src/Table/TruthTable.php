<?php

namespace Table;

require_once '../../vendor/autoload.php';

class TruthTable
{
	
	public function __construct(int $nSimplePropositions)
	{
		echo $this->defineNumberLines($nSimplePropositions);
	}
	
	public function defineNumberLines(int $nSimplePropositions) : int
	{
		return pow(2, $nSimplePropositions);
	}
}