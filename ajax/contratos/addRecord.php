<?php
	if(isset($_POST['num_contrato_sap']) && isset($_POST['bloco']) && isset($_POST['vigencia_inicial']) && isset($_POST['vigencia_final']) && isset($_POST['cnpj']))
	{
		// include Database connection file 
		include("../db_connection.php");

		// get values 
		$num_contrato_sap = $_POST['num_contrato_sap'];
		$bloco = $_POST['bloco'];
		$vigencia_inicial = $_POST['vigencia_inicial'];
		$vigencia_final = $_POST['vigencia_final'];
		$cnpj = $_POST['cnpj'];

		$query = "INSERT INTO sdp_contratos(num_contrato_sap, bloco, vigencia_inicial, vigencia_final, cnpj) VALUES('$num_contrato_sap', '$bloco', '$vigencia_inicial', '$vigencia_final', '$cnpj')";

		$stid = oci_parse($db, $query);
		if(oci_execute($stid)){
			echo "1 Registro Adicionado!";
		}
	}
?>