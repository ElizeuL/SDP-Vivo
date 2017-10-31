<?php

	// include Database connection file 
	include("db_connection.php");

	// Design initial table header 
	$data = '<table class="table table-bordered table-striped">
						<tr>
							<th>Id</th>
							<th>Razão Social</th>
							<th>CNPJ</th>
							<th>Bloco</th>
							<th>Num Contrato Sap</th>
							<th>Vig Inicial</th>
							<th>Editar</th>
							<th>Excluir</th>
						</tr>';

	$query = "select * from SDP_ATIVIDADE limit 10";

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
				<td>'.$number.'</td>
				<td>'.utf8_encode ( $row['SISTEMA'] ).'</td>
				<td>'.$row['TIPO_ATIVIDADE'].'</td>
				<td>'.$row['MES_REFERENCIA'].'</td>
				<td>'.$row['CODIGO_PROJETO'].'</td>
				<td>'.$row['NUM_LINHA_CAP'].'</td>
				<td>
					<button onclick="GetUserDetails('.$row['id'].')" class="btn btn-warning">Update</button>
				</td>
				<td>
					<button onclick="DeleteUser('.$row['id'].')" class="btn btn-danger">Delete</button>
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