<?php
//faz a conexão
$conn = mysql_connect('localhost',"root","Ab123456");
mysql_select_db('livros',$conn);

for($i=1; $i<10;$i++){
	mysql_query("insert into famosos values({$i},'famoso {$i}')",$conn);
		echo "insert into famosos values({$i},'famoso {$i}')<br>";
}

?>