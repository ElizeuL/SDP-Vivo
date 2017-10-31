<?php

	// include Database connection file 
	include("../db_connection.php");

	$month= @$_GET['month'];

	if($month==""){
	   $month = intval(date('m'));
	}

	// Design initial table header 
	$data = '<table class="table table-bordered table-striped">
						<tr>
							<th>Id</th>
							<th>Razão Social</th>
							<th>CNPJ</th>
							<th>Bloco</th>
							<th>Tipo Atividade</th>
							<th>Valor</th>
						</tr>';

	$query = "Select f.RAZAO_SOCIAL, f.CNPJ, s.BLOCO, s.TIPO_ATIVIDADE,
	          to_char(to_char(s.ESFORCO,'99999.9999') * to_char(v.VALOR_UNITARIO, '999999.9999'),'9999,999.99') as VALOR 
		From SDP_ATIVIDADE s, SDP_CONTRATOS c, SDP_FORNECEDORES f, SDP_VALORES v, SDP_ORCAMENTO_REAL o
		where s.NUM_LINHA_CAP = o.NUM_LINHA_CAP
			  and s.BLOCO = c.BLOCO
			  and v.BLOCO = s.BLOCO
			  and s.TIPO_ATIVIDADE = v.TIPO_ATIVIDADE
			  and c.CNPJ = f.CNPJ
			  and s.NUM_LINHA_CAP is not null
			  and s.MES_REFERENCIA = '".$month."'";
			  //group by f.RAZAO_SOCIAL, f.CNPJ, s.BLOCO, s.TIPO_ATIVIDADE";

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
				<td>'.$row['TIPO_ATIVIDADE'].'</td>
				<td>'.$row['VALOR'].'</td>
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