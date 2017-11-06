<?php
/*
* Classe TLoggerHTML
* implementa o algorítimo de log em HTML
*/
class TLoggerHTML extends TLogger{
	/*
	* método write()
	* escreve uma mensagem no arquivo de LOG
	* @param $message = mensagem a ser escrita
	*/
	public function write($message){
		date_default_timezone_set('America/Sao_Paulo');
		$time=date("Y-m-d H:i:s");
		//monta string
		$text = "<p>\n";
		$text .="	<b>$time</b> : \n";
		$text .="	<i>$message</i> <br>\n";
		$text .="<p>\n";
		//adiciona ao final do arquivo
		$handler = fopen($this->filename, 'a');
		fwrite($handler, $text);
		fclose($handler);
	}
}
?>