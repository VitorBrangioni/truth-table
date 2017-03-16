<?php

namespace Proposition;

class CompleteProposition
{
	private $motherProposition;
	private $allPropositions;
	
	public function __construct(Proposition $motherProposition)
	{
		$this->completeProposition = $motherProposition;
		$this->populateAllPropositions($motherProposition);
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
	public function populateAllPropositions(Proposition $completeProposition)
	{
		$propositions = $completeProposition->getPropositions();
		
		if ($propositions != null) {
			foreach ($propositions as $prop) {
				$this->allPropositions[] = $prop;
				$this->populateAllPropositions($prop);
			}
		}
	}
	
	public function toString() : String
	{
		
	}

    public function getMotherProposition(){
        return $this->motherProposition;
    }

    public function setMotherProposition($motherProposition){
        $this->motherProposition = $motherProposition;
        return $this;
    }

    public function getAllPropositions(){
        return $this->allPropositions;
    }

    public function setAllPropositions($allPropositions){
        $this->allPropositions = $allPropositions;
        return $this;
    }

}