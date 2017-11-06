<?php
try{
	$conn = new PDO('mysql:host=localhost;port=3306;dbname=livro','root','');

	$result=$conn->query("SELECT codigo, nome FROM famoso");
	if($result){
		foreach ($result as $row) {
			echo $row['codigo'].' - '.$row['nome']."<br>\n";
		}
	}
	$conn=null;
}catch(PDOException $e){
	print "Erro!: ".$e->getMessage()."<br>\n";
	die();
}
?>