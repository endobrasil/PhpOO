<?php
//faz a conexão

	$conn = new PDO('mysql:host=localhost;port=3306;dbname=livros','root','Ab123456');


/*
for($i=18; $i<30;$i++){
	$conn->exec("insert into famosos values({$i},'famoso {$i}')");
		echo "insert into famosos values({$i},'famoso {$i}')<br>";
}
*/
	
	if($result)
	{
		$row=$result->fetch(PDO::FETCH_ASSOC);
		echo $row['codigo'].' - '.$row['nome']."<br>\n";
	}else
	{
		echo "cunhou";
	}
	
	
	
$conn=null;

?>