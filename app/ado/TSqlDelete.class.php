<?php
final class TSqlDelete extends TSqlInstruction
{
	public function getInstruction() {
		$this->sql="DELETE FROM {$this->entity}";
		
		if($this->criteria)
		{
			$exppression=$this->criteria->dump();
			if($exppression)
			{
				$this->sql.=' WHERE '.$exppression;
			}
		}
		return $this->sql;
	}
}
?>
