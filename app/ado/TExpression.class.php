<?php
//Classe responsável por gerenciar expressões

abstract class TExpression{
	const AND_OPERADOR = 'AND ';
	const OR_OPERADOR = 'OR ';
	
	//O método dump é origatório
	abstract public function dump();
}
?>
