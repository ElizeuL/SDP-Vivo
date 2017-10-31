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
							<th>Contrato</th>
							<th>Bloco</th>
							<th>Projeto</th>
							<th>CAP</th>
							<th>Sistema</th>
							<th>Tipo Atividade</th>
							<th>Mês</th>
							<th>Esforço</th>
							<th>Jornadas</th>
							<th>Valor Total</th>
							<th>Esteira</th>
							<th>Disponível</th>
						</tr>';


   $query = "select 1 as Id,
				  f.RAZAO_SOCIAL, 
				  f.CNPJ, 
				  c.NUM_CONTRATO_SAP, 
				  bl.BLOCO,
				  s.ID_DEMANDA AS CODIGO_PROJETO,
				  s.NUM_LINHA_CAP,
				  s.SISTEMA,
				  s.TIPO_ATIVIDADE,
				  s.MES_REFERENCIA,
				  s.ESFORCO as HORAS,
				  s.ESFORCO / 8 as Jornadas,
                  to_char(to_char(s.ESFORCO,'99999.9999') * to_char(v.VALOR_UNITARIO, '999999.9999'),'9999,999.99') as Valor_Total,
				  s.ESTEIRA,
				  o.ORCAMENTO_DISPONIVEL			  
			from  SDP_ATIVIDADE s, SDP_CONTRATOS c, SDP_FORNECEDORES f, sdp_valores v, SDP_ORCAMENTO_REAL o, sdp_bloco bl
			where s.BLOCO = c.BLOCO
			and   f.CNPJ = c.CNPJ
			and   v.BLOCO = s.BLOCO
			and   bl.sistema = s.sistema
			and   s.TIPO_ATIVIDADE = v.TIPO_ATIVIDADE
			and   s.mes_referencia = '".$month."'
			and   s.NUM_LINHA_CAP = o.NUM_LINHA_CAP";
	
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
				<td>'.$row['NUM_CONTRATO_SAP'].'</td>
				<td>'.$row['BLOCO'].'</td>
				<td>'.$row['CODIGO_PROJETO'].'</td>
				<td>'.$row['NUM_LINHA_CAP'].'</td>
				<td>'.$row['SISTEMA'].'</td>
				<td>'.$row['TIPO_ATIVIDADE'].'</td>
				<td>'.$row['MES_REFERENCIA'].'</td>
				<td>'.$row['HORAS'].'</td>
				<td>'.$row['JORNADAS'].'</td>
				<td>'.$row['VALOR_TOTAL'].'</td>
				<td>'.$row['ESTEIRA'].'</td>
				<td>'.$row['ORCAMENTO_DISPONIVEL'].'</td>
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