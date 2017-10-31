<?php
// include Database connection file
include("../db_connection.php");

// check request
if(isset($_POST))
{
    // get values
    $id = $_POST['cnpj'];
    $razao_social = $_POST['razao_social'];
    
    // Updaste details
    $query = "UPDATE sdp_fornecedores SET razao_social = '$razao_social' WHERE cnpj = '$id'";
	
	//executeOracle
	$stid = oci_parse($db, $query);
	oci_execute($stid);
}