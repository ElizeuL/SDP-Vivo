<?php

	// include Database connection file 
	include("../db_connection.php");

	$month= @$_GET['month'];
	$reportType= @$_GET['reportType'];

	if($month==""){
	   $month = intval(date('m'));
	}

	// Design initial table header 
	if ($reportType=="orcamento_insuficiente"){

			$data = '<table class="table table-bordered table-striped">
								<tr>
									<th>Id</th>
									<th>Sistema</th>
									<th>Tipo Atividade</th>
									<th>Cod Projeto</th>
									<th>Num Linha Cap</th>
									<th>Bloco</th>
									<th>Esforço</th>
									<th>Esteira</th>
									<th>Valor Total</th>
									<th>Orçamento Disponivel</th>
								</tr>';

	}

	else {

		$data = '<table class="table table-bordered table-striped">
								<tr>
									<th>Id</th>
									<th>Sistema</th>
									<th>Tipo Atividade</th>
									<th>Cod Projeto</th>
									<th>Num Linha Cap</th>
									<th>Bloco</th>
									<th>Esforço</th>
									<th>Esteira</th>
								</tr>';
	}

	if($reportType=="orcamento_inexistente"){
		$query = "select * from SDP_ATIVIDADE s
				where NUM_LINHA_CAP not in (select NUM_LINHA_CAP from SDP_ORCAMENTO_REAL)
			and s.MES_REFERENCIA ='".$month."'";
	}
	else if ($reportType=="sistema"){
		$query = "select * from SDP_ATIVIDADE s 
			where (SISTEMA is null OR SISTEMA = '')
			and s.MES_REFERENCIA ='".$month."'";		
	}
	else if ($reportType=="orcamento_insuficiente"){

		$query = "select S.SISTEMA, S.TIPO_ATIVIDADE, S.CODIGO_PROJETO, S.NUM_LINHA_CAP, S.BLOCO, S. ESFORCO, S.ESTEIRA,
			      to_char(to_char(s.ESFORCO,'99999.9999') * to_char(v.VALOR_UNITARIO, '999999.9999'),'9999,999.99') as Valor_Total, 
			      o.ORCAMENTO_DISPONIVEL				  
			from  SDP_ATIVIDADE s,  sdp_valores v, SDP_ORCAMENTO_REAL o
			where s.TIPO_ATIVIDADE = v.TIPO_ATIVIDADE
			and   v.BLOCO = s.BLOCO
			and   s.NUM_LINHA_CAP = o.NUM_LINHA_CAP
			and   (s.ESFORCO * v.VALOR_UNITARIO) > o.ORCAMENTO_DISPONIVEL
			and   s.mes_referencia = '".$month."'";
		
	}
	else if ($reportType=="bloco"){
		$query = "select * from SDP_ATIVIDADE s
				where (BLOCO = 'N/A' OR BLOCO = '') 
			and s.MES_REFERENCIA ='".$month."'";		
	}
	else if ($reportType=="esforco"){
		$query = "select * from SDP_ATIVIDADE s
				where ESFORCO = 0
			and s.MES_REFERENCIA ='".$month."'";
	}
    else if ($reportType=="ativ_desconhecida"){
		$query = "select  *
				  FROM	  sdp_atividade a
				  WHERE	  0 =  ( SELECT count(1) 
				  	         	 FROM   sdp_valores V 
				  	         	 WHERE  v.TIPO_ATIVIDADE = a.TIPO_ATIVIDADE
				  	         	)
				  and     a.MES_REFERENCIA ='".$month."'";
	}
   




	else{
		$query = "select * from SDP_ATIVIDADE s 
				where (s.NUM_LINHA_CAP = 'N/A' OR S.NUM_LINHA_CAP = '')
				and s.MES_REFERENCIA ='".$month."'";
	}

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
				<td>'.utf8_encode ($row['TIPO_ATIVIDADE']).'</td>
				<td>'.$row['CODIGO_PROJETO'].'</td>
				<td>'.$row['NUM_LINHA_CAP'].'</td>
				<td>'.$row['BLOCO'].'</td>
				<td>'.$row['ESFORCO'].'</td>
				<td>'.$row['ESTEIRA'].'</td>';

				 if($reportType=="orcamento_insuficiente"){
					$data .= '<td>'.$row['VALOR_TOTAL'].'</td>
					 		  <td>'.$row['ORCAMENTO_DISPONIVEL'].'</td>';
				 }
    		$data .= '</tr>';
    		$number++;
    	}
    /*}
    else
    {
    	// records now found 
    	if($reportType=="orcamento_insuficiente"){ $data .= '<tr><td colspan="8">Nenhum Registro Encontrado!</td></tr>';}
    	else {$data .= '<tr><td colspan="6">Nenhum Registro Encontrado!</td></tr>';}
    }*/

    $data .= '</table>';

    echo $data;
?>