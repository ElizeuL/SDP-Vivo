<?php
	if(isset($_POST['razao_social']) && isset($_POST['cnpj']))
	{
		// include Database connection file 
		include("../db_connection.php");

		// get values 
		$razao_social = $_POST['razao_social'];
		$cnpj = $_POST['cnpj'];

		$query = "INSERT INTO sdp_fornecedores(razao_social, cnpj) VALUES('$razao_social', '$cnpj')";

		$stid = oci_parse($db, $query);
		if(oci_execute($stid)){
			echo "1 Registro Adicionado!";
		}
	}
?>