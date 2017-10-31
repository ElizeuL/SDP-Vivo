<?php
// include Database connection file
include("../db_connection.php");

// check request
if(isset($_POST))
{
    // get values
    $id = $_POST['id'];
    $bloco = $_POST['bloco'];
    $tipo_atividade = $_POST['tipo_atividade'];
    $unidade_esforco = $_POST['unidade_esforco'];
    $valor_unitario = $_POST['valor_unitario'];
    
    // Updaste details
    $query = "UPDATE sdp_valores SET bloco = '$bloco', tipo_atividade = '$tipo_atividade', unidade_esforco = '$unidade_esforco', valor_unitario = '$valor_unitario' WHERE id = '$id'";
	
	//executeOracle
	$stid = oci_parse($db, $query);
	oci_execute($stid);
}