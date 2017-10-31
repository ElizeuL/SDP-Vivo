<?php

	// include Database connection file 
	include("../db_connection.php");

	// Design initial table header 
	$data = '<table class="table table-bordered table-striped">
						<tr>
							<th>Num Contrato Sap</th>
							<th>Bloco</th>
							<th>Vig Inicial</th>
							<th>Vig Final</th>
							<th>CNPJ</th>
							<th>Alterar</th>
							<th>Excluir</th>
						</tr>';

	$query = "select * from sdp_contratos";

	$stid = oci_parse($db, $query);
	oci_execute($stid);

    // if query results contains rows then featch those rows 
    // oci_fetch_all($stid, $numrows);
    // if($numrows > 0)
    // {
    	$number = 1;
    	while (($row = oci_fetch_assoc($stid)) != false)
    	{
    		$data .= '<tr>
				<td>'.$row['NUM_CONTRATO_SAP'].'</td>
				<td>'.$row['BLOCO'].'</td>
				<td>'.$row['VIGENCIA_INICIAL'].'</td>
				<td>'.$row['VIGENCIA_FINAL'].'</td>
				<td>'.$row['CNPJ'].'</td>
				<td>
					<button onclick="GetDetails('.$row['NUM_CONTRATO_SAP'].')" class="btn btn-warning">Alterar</button>
				</td>
				<td>
					<button onclick="Delete('.$row['NUM_CONTRATO_SAP'].')" class="btn btn-danger">Excluir</button>
				</td>
    		</tr>';
    		$number++;
    	}
    /*}
    else
    {
    	// records now found 
    	$data .= '<tr><td colspan="6">Nenhum Registro Encontrado!</td></tr>';
    }*/

    $data .= '</table>';

    echo $data;
?>