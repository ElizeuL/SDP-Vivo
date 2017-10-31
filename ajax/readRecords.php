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
							<th>Vig Final</th>
							<th>Valor Total</th>
						</tr>';

	$query = "select f.RAZAO_SOCIAL, f.CNPJ, c.BLOCO, c.NUM_CONTRATO_SAP, c.VIGENCIA_INICIAL, c.VIGENCIA_FINAL,sum(s.ESFORCO * v.VALOR_UNITARIO) as Valor_Total
from SDP_ATIVIDADE s, SDP_CONTRATOS c, SDP_FORNECEDORES f, SDP_VALORES v
where s.BLOCO = c.BLOCO
and s.TIPO_ATIVIDADE = v.TIPO_ATIVIDADE
and f.CNPJ = c.CNPJ
and v.BLOCO = s.BLOCO
and s.mes_referencia = '8'
group by f.RAZAO_SOCIAL, f.CNPJ, c.BLOCO, c.NUM_CONTRATO_SAP, c.VIGENCIA_INICIAL, c.VIGENCIA_FINAL";

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
				<td>'.utf8_encode ( $row['RAZAO_SOCIAL'] ).'</td>
				<td>'.$row['CNPJ'].'</td>
				<td>'.$row['BLOCO'].'</td>
				<td>'.$row['NUM_CONTRATO_SAP'].'</td>
				<td>'.$row['VIGENCIA_INICIAL'].'</td>
				<td>'.$row['VIGENCIA_FINAL'].'</td>
				<td>'.$row['VALOR_TOTAL'].'</td>
    		</tr>';
    		$number++;
    	}
    /*}
    else
    {
    	// records now found 
    	$data .= '<tr><td colspan="6">Records not found!</td></tr>';
    }*/

    $data .= '</table>';

    echo $data;
?>