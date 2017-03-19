<?php

namespace Proposition;

use Enum\TypePropositionEnum;
use Proposition\Proposition;

class CompleteProposition
{
	private $motherProposition;
	private $allPropositions;
	private $allSimplePropositions;
	private $allCompoundPropositions;
	
	public function __construct(Proposition $motherProposition)
	{
		$this->motherProposition = $motherProposition;
		$this->populateAllPropositions($motherProposition);
		$this->populateAllSimplePropositions();
		$this->populateAllCompoundPropositions();
	}
	
	public function seperePropositions() : void
	{
		
	}
	
	public function findProposition(String $proposition)
	{
		$find = null;
		
		foreach ($this->allPropositions as $prop) {
			if ($prop->getPropositionValue() == $proposition) {
				$find = $prop;
				break;
			}
		}
		return $find;
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
	
	public function getSimplePropositionsNotDenied()
	{
		$propositions = null;
		foreach ($this->allSimplePropositions as $prop) {
			if ($prop->getIsDenied() === false) {
				$propositions[] = $prop;
			}
		}
		return $propositions;
	}
	
	public function countSimplePropositionsNotDenied(): int
	{
		$count = 0;
		foreach ($this->allSimplePropositions as $prop) {
			if ($prop->getIsDenied() === false) {
				$count++;
			}
		}
		return $count;
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
	
	public function existSimpleProposition(Proposition $proposition) : bool
	{
		$exist = false;
		
		for ($i = 0; $i < count($this->allSimplePropositions); $i++) {
			$prop = $this->allSimplePropositions[$i];
			
			if ($prop->getPropositionValue() === $proposition->getPropositionValue()) {
				$exist = true;
			}
		}
		return $exist;
	}
	
	private function populateAllSimplePropositions()
	{
		
		if ($this->allPropositions != null) {
			$denieds = null;
			$thisPropNotDenied = null;
			foreach ($this->allPropositions as $prop) {
				if ($prop->getType()->equals(TypePropositionEnum::SIMPLE())) {
					$isDenied = $prop->verifyIsDenied($prop->getPropositionValue(), TypePropositionEnum::SIMPLE());
					
					if ($isDenied == true) {
 
						/*$denieds[] = new Proposition($prop->getPropositionValue(), TypePropositionEnum::SIMPLE());
						$prop->removeMySignalOfDenied();
						$prop->setIsDenied(false);*/
						
						$denieds[] = $prop;
						$thisPropNotDenied = new Proposition($prop->removeSignalOfDenied($prop->getPropositionValue()), TypePropositionEnum::SIMPLE());
						
					}
					if (!$prop->getIsDenied() && !$this->existSimpleProposition($prop)) {
						$this->allSimplePropositions[] = $prop;
					}
					if ($thisPropNotDenied != null && !$this->existSimpleProposition($thisPropNotDenied)) {
						$this->allSimplePropositions[] = $thisPropNotDenied;
					}
				}
			}
			if ($denieds != null) {
				foreach ($denieds as $denied) {
					$this->allSimplePropositions[] = $denied;
				}
			}
			
			
		}
	}
	
	private function populateAllCompoundPropositions()
	{
		if ($this->allPropositions != null) {
			$denieds = null;
			foreach ($this->allPropositions as $prop) {
				if ($prop->getType()->equals(TypePropositionEnum::COMPOUND())) {
					if ($prop->getIsDenied() === true) {
						$denieds[] = $prop;
					} else {
						$this->allCompoundPropositions[] = $prop;
					}
					
				}
			}

			if ($denieds != null) {
				foreach ($denieds as $denied) {
					$this->allCompoundPropositions[] = $prop;
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
    
    public function getAllCompoundPropositions()
    {
    	return $this->allCompoundPropositions;
    }
    
    public function setAllCompoundPropositions($allCompoundPropositions)
    {
    	$this->allCompoundPropositions = $allCompoundPropositions;
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