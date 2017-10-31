<?php

	// include Database connection file 
	include("../db_connection.php");

	// Design initial table header 
	$data = '<table class="table table-bordered table-striped">
						<tr>
							<th>CNPJ</th>
							<th>Razão Social</th>
							<th>Alterar</th>
							<th>Excluir</th>
						</tr>';

	$query = "select * from sdp_fornecedores";

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
				<td>'.$row['CNPJ'].'</td>
				<td>'.utf8_encode($row['RAZAO_SOCIAL']).'</td>
				<td>
					<button onclick="GetDetails('.$row['CNPJ'].')" class="btn btn-warning">Alterar</button>
				</td>
				<td>
					<button onclick="Delete('.$row['CNPJ'].')" class="btn btn-danger">Excluir</button>
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