<?php
// include Database connection file
include("../db_connection.php");

// check request
if(isset($_POST))
{
    // get values
    $id = $_POST['num_contrato_sap'];
    $bloco = $_POST['bloco'];
    $vigencia_inicial = $_POST['vigencia_inicial'];
    $vigencia_final = $_POST['vigencia_final'];
    $cnpj = $_POST['cnpj'];
    
    // Updaste details
    $query = "UPDATE sdp_contratos SET bloco = '$bloco', vigencia_inicial = '$vigencia_inicial', vigencia_final = '$vigencia_final', cnpj = '$cnpj' WHERE num_contrato_sap = '$id'";
	
	//executeOracle
	$stid = oci_parse($db, $query);
	oci_execute($stid);
}