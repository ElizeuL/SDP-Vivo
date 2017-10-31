<?php
	if(isset($_POST['bloco']) && isset($_POST['tipo_atividade']) && isset($_POST['unidade_esforco']) && isset($_POST['valor_unitario']) )
	{
		// include Database connection file 
		include("../db_connection.php");

		// get values 
		$bloco = $_POST['bloco'];
		$tipo_atividade = $_POST['tipo_atividade'];
		$unidade_esforco = $_POST['unidade_esforco'];
		$valor_unitario = $_POST['valor_unitario'];

		$query = "INSERT INTO sdp_valores(bloco, tipo_atividade, unidade_esforco, valor_unitario) VALUES('$bloco', '$tipo_atividade', '$unidade_esforco', '$valor_unitario')";

		$stid = oci_parse($db, $query);
		if(oci_execute($stid)){
			echo "1 Registro Adicionado!";
		}
	}
?>