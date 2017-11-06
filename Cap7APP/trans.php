<?php
	include_once '../app/ado/TTranslation.class.php';

	TTranslation::setLanguagem('pt');
	echo "Em português";

	echo _t('Function')."<br>\n";
	echo _t('Table')."<br>\n";
	echo _t('Tool')."<br>\n";

	TTranslation::setLanguagem('it');
	echo "Em Italiano";

	echo _t('Function')."<br>\n";
	echo _t('Table')."<br>\n";
	echo _t('Tool')."<br>\n";
?>