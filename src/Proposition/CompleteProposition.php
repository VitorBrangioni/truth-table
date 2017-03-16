<?php

namespace Proposition;

use Enum\TypePropositionEnum;

class CompleteProposition
{
	private $motherProposition;
	private $allPropositions;
	private $allSimplePropositions;
	
	public function __construct(Proposition $motherProposition)
	{
		$this->completeProposition = $motherProposition;
		$this->populateAllPropositions($motherProposition);
		$this->populateAllSimplePropositions();
	}
	
	public function seperePropositions() : void
	{
		
	}
	
	public function findProposition(String $proposition) : Proposition
	{
		
	}
	
	public function countSimplePropositions() : int
	{
		$size = 0;
		
		if ($this->allSimplePropositions != null) {
			foreach ($this->allSimplePropositions as $prop) {
				$size++;
			}
		}
		return $size;
	}
	
	public function countAllPropositions() : int
	{
		$size = 1;
	
		if ($this->allPropositions != null) {
			foreach ($this->allPropositions as $prop) {
				$size++;
			}
		}
		return $size;
	}
	
	private function populateAllSimplePropositions()
	{
		if ($this->allPropositions != null) {
			foreach ($this->allPropositions as $prop) {
				if ($prop->getType()->equals(TypePropositionEnum::SIMPLE())) {
					$this->allSimplePropositions[] = $prop;
				}
			}
		}
	}
	
	public function findAllCompoundPropositions() : array
	{
		
	}
	
	private function populateAllPropositions(Proposition $completeProposition)
	{
		$propositions = $completeProposition->getPropositions();
		
		if ($propositions != null) {
			foreach ($propositions as $prop) {
				if (!$this->verifyExistProposition($prop->getPropositionValue())) {
					$this->allPropositions[] = $prop;
					$this->populateAllPropositions($prop);
				}
			}
		}
	}
	
	public function verifyExistProposition(String $proposition) : bool
	{
		$exist = false;
		
		if ($this->allPropositions != null) {
			foreach ($this->allPropositions as $prop) {
				if ($prop->getPropositionValue() == $proposition) {
					$exist = true;
					break;
				}
			}
		}
		return $exist;
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


    public function getAllSimplePropositions()
    {
        return $this->allSimplePropositions;
    }

    public function setAllSimplePropositions($allSimplePropositions)
    {
        $this->allSimplePropositions = $allSimplePropositions;
        return $this;
    }

}