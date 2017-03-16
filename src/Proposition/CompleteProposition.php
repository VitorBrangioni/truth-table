<?php

namespace Proposition;

class CompleteProposition
{
	private $completeProposition;
	private $allPropositions;
	
	public function __construct(Proposition $completeProposition)
	{
		$this->completeProposition = $completeProposition;
		$this->allPropositions = $this->findAllPropositions($completeProposition);
	}
	
	public function seperePropositions() : void
	{
		
	}
	
	public function findProposition(String $proposition) : Proposition
	{
		
	}
	
	public function findAllSimplePropositions() : array
	{
		
	}
	
	public function findAllCompoundPropositions() : array
	{
		
	}
	
	// @TODO
	public function  findAllPropositions(Proposition $completeProposition) : array
	{
		
	}
	
	public function toString() : String
	{
		
	}
}