<?php
// check request
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // include Database connection file
    include("../db_connection.php");

    // get id
    $id = $_POST['id'];

    // delete User
    $query = "DELETE FROM sdp_contratos WHERE num_contrato_sap = '$id'";
    
	
	//executeOracle
	$stid = oci_parse($db, $query);
	oci_execute($stid);
}
?>