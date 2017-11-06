<?php
//faz a conexão
$conn = mysql_connect('localhost',"root","");
mysql_select_db('livro',$conn);
$lista = mysql_query("select * from famoso",$conn);
while ($linha = mysql_fetch_assoc($lista)) {
	echo "<li> {$linha['codigo']} {$linha['nome']}";
}
?>