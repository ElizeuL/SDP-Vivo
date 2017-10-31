<?php
	if(isset($_POST['bloco']) && isset($_POST['sistema']) && isset($_POST['descricao_sistema']))
	{
		// include Database connection file 
		include("../db_connection.php");

		// get values 
		$bloco = $_POST['bloco'];
		$sistema = $_POST['sistema'];
		$descricao_sistema = $_POST['descricao_sistema'];

		$query = "INSERT INTO sdp_bloco(bloco, sistema, descricao_sistema) VALUES('$bloco', '$sistema', '$descricao_sistema')";

		$stid = oci_parse($db, $query);
		if(oci_execute($stid)){
			echo "1 Registro Adicionado!";
		}
	}
?>