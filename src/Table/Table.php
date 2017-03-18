<?php

namespace Table;

abstract class Table
{
	private $nLines;
	private $nColumns;
	protected $structure;
	

    public function getNLines() : int
    {
        return $this->nLines;
    }

    public function setNLines(int $nLines)
    {
        $this->nLines = $nLines;
        return $this;
    }

    public function getNColumns(){
        return $this->nColumns;
    }

    public function setNColumns($nColumns){
        $this->nColumns = $nColumns;
        return $this;
    }


    public function getStructure()
    {
        return $this->structure;
    }

    public function setStructure($structure)
    {
        $this->structure = $structure;
        return $this;
    }
    
    public abstract function addColumns();
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

}