<?php
final class TSqlSelect extends TSqlInstruction{
	private $columns;
	
	public function addColumn($column)	{
		$this->columns[]=$column;
	}
	
	public function getInstruction(){
		$this->sql='SELECT ';
		$this->sql.=implode(', ', $this->columns);
		$this->sql.=' FROM '.$this->entity;
		
		if($this->criteria)
		{
			$expression = $this->criteria->dump();
			
			if($expression)
			{
				$this->sql.=" WHERE ".$expression;
			}
			
			$order = $this->criteria->getProperty('order');
			$limit = $this->criteria->getProperty('limite');
			$offset=$this->criteria->getProperty('offset');
			
			if($order)
			{
				$this->sql.=' ORDER BY '.$order;
			}
			if($limit)
			{
				$this->sql.=' LIMITE '.$limit;
			}
			if($offset)
			{
				$this->sql.=' OFFSET '.$offset;
			}
		}
		return $this->sql;
	}
}
?>