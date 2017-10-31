<?php
// include Database connection file
include("../db_connection.php");

// check request
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // get ID
    $id = $_POST['id'];

    // Get Details
    $query = "SELECT * FROM sdp_valores WHERE id = '$id'";

	
	//executeOracle
	$stid = oci_parse($db, $query);
	oci_execute($stid);
    $response = array();
    oci_fetch_all($stid, $numrows);
    if($numrows > 0) {
        while (($row = oci_fetch_assoc($stid)) != false) {
            $response = $row;
        }
    }
    else
    {
        $response['status'] = 200;
        $response['message'] = "Dados não encontrados!";
    }
    // display JSON data
    echo json_encode($response);
}
else
{
    $response['status'] = 200;
    $response['message'] = "Requisição Inválida!";
}