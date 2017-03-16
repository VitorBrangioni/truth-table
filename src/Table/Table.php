<?php

namespace Table;

abstract class Table
{
	private $nLines;
	private $nColumns;
	private $structure;
	

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

    public function setStructure($nLines, $nColumn)
    {
        $this->structure = $structure;
        return $this;
    }

}