<?php
// include Database connection file
include("../db_connection.php");

// check request
if(isset($_POST))
{
    // get values
    $id = $_POST['id'];
    $bloco = $_POST['bloco'];
    $sistema = $_POST['sistema'];
    $descricao_sistema = $_POST['descricao_sistema'];
    
    // Updaste details
    $query = "UPDATE sdp_bloco SET bloco = '$bloco', sistema = '$sistema', descricao_sistema = '$descricao_sistema' WHERE id = '$id'";
	
	//executeOracle
	$stid = oci_parse($db, $query);
	oci_execute($stid);
}