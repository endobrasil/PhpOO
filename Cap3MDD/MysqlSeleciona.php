<?php
//faz a conexão
$conn = mysql_connect('localhost',"root","Ab123456");
mysql_select_db('livros',$conn);
$lista = mysql_query("select * from famosos",$conn);
while ($linha = mysql_fetch_assoc($lista)) {
	echo "<li> {$linha['codigo']} {$linha['nome']}";
}
?>