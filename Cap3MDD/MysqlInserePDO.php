<?php
//faz a conexão

	$conn = new PDO('mysql:host=localhost;port=3306;dbname=livro','root','');



for($i=18; $i<30;$i++){
	$conn->exec("insert into famoso values({$i},'famoso {$i}')");
		echo "insert into famoso values({$i},'famoso {$i}')<br>\n";
}



$conn=null;

?>