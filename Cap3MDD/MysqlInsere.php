<?php
//faz a conexão
$conn = mysql_connect('localhost',"root",'');
mysql_select_db('livro',$conn);

for($i=1; $i<10;$i++){
	mysql_query("insert into famoso(codigo, nome) values({$i},'famoso {$i}')",$conn);
		echo "insert into famoso(codigo, nome) values({$i},'famoso {$i}')<br>\n";
}

?>