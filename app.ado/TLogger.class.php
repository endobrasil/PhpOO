<?php
/*
* class TLogger
* esta classe provê uma interface abstrata 
* para a definição de algoritmos de LOG
*/
abstract class TLogger{
	protected $filename;

	/*
	* método __construct()
	* instancia um logger
	* @param $filename = local de arquivo de log
	*/
	public function __construct($filename){
		$this->filename=$filename;
		//reseta o conteudo do arquivo, mas pra que???
		//file_put_contents($filename, '');
	}

	//define o método write como obrigatório
	abstract function write($message);
}
?>