<?php

	// include Database connection file 
	include("../db_connection.php");

	// Design initial table header 
	$data = '<table class="table table-bordered table-striped">
						<tr>
							<th>Id</th>
							<th>Valor Atividade</th>
							<th>Orçamento SAP</th>
							<th>Orçto Disponível</th>
							<th>Diferença</th>
							<th>Bloco</th>
							<th>Cod Projeto</th>
							<th>Esteira</th>
							<th>Num Linha CAP</th>
							<th>Tipo Atividade</th>
							<th>Sistema</th>
						</tr>';

	$query = "select s.ESFORCO * v.VALOR_UNITARIO as VALOR_ATIVIDADE,
		replace(o.ORCAMENTO_CARREGADO_CAP, ',','.') as ORCAMENTO_SAP,
		replace(o.ORCAMENTO_DISPONIVEL, ',','.') as ORCAMENTO_DISPONIVEL,
		s.ESFORCO * v.VALOR_UNITARIO - replace(ORCAMENTO_CARREGADO_CAP, ',','.') as DIFERENCA,
		s.BLOCO, 
		s.CODIGO_PROJETO,
		s.ESTEIRA,
		s.NUM_LINHA_CAP,
		s.TIPO_ATIVIDADE,
		s.SISTEMA
		from SDP_ATIVIDADE s, SDP_ORCAMENTO_REAL o, SDP_VALORES v
		where
		s.NUM_LINHA_CAP = o.NUM_LINHA_CAP
		and s.BLOCO = v.BLOCO
		and s.TIPO_ATIVIDADE = v.TIPO_ATIVIDADE
		and 
		s.ESFORCO * v.VALOR_UNITARIO >
		replace(ORCAMENTO_CARREGADO_CAP, ',','.')";

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
				<td>'.utf8_encode ( $row['VALOR_UNITARIO'] ).'</td>
				<td>'.$row['VALOR_ATIVIDADE'].'</td>
				<td>'.$row['ORCAMENTO_SAP'].'</td>
				<td>'.$row['ORCAMENTO_DISPONIVEL'].'</td>
				<td>'.$row['DIFERENCA'].'</td>
				<td>'.$row['BLOCO'].'</td>
				<td>'.$row['CODIGO_PROJETO'].'</td>
				<td>'.$row['ESTEIRA'].'</td>
				<td>'.$row['NUM_LINHA_CAP'].'</td>
				<td>'.$row['TIPO_ATIVIDADE'].'</td>
				<td>'.$row['SISTEMA'].'</td>				
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