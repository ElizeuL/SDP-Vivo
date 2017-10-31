<?php

	// include Database connection file 
	include("../db_connection.php");

	// Design initial table header 
	$data = '<table class="table table-bordered table-striped">
						<tr>
							<th>ID</th>						
							<th>Bloco</th>
							<th>Sistema</th>
							<th>Descrição Sistema</th>
							<th>Alterar</th>
							<th>Excluir</th>
						</tr>';

	$query = "select * from sdp_bloco";

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
				<td>'.$row['ID'].'</td>
				<td>'.utf8_encode($row['BLOCO']).'</td>
				<td>'.utf8_encode($row['SISTEMA']).'</td>
				<td>'.utf8_encode($row['DESCRICAO_SISTEMA']).'</td>
				<td>
					<button onclick="GetDetails('.$row['ID'].')" class="btn btn-warning">Alterar</button>
				</td>
				<td>
					<button onclick="Delete('.$row['ID'].')" class="btn btn-danger">Excluir</button>
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