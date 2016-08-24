<div class="row row-offcanvas row-offcanvas-right">
	<div class="row">
		<div class="table-responsive">
			
			<!-- <button type="button" class="btn btn-default btn-lg" onclick="location.href='index.php?pg=5'">
				Novo Usu&aacute;rio
			</button> -->

			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Ranking</th>
						<th>Nome / Email</th>
						<th>Assinatura</th>
						<th>Acesso</th>
						<th>Compra</th>
						<th>Op&ccedil;&otilde;es</th>
					</tr>
				</thead>
				<tbody id="myTable">
					<?php 

					require_once 'conexao/conn.php';
					
					$sql = "SELECT f_posicao_ranking(c.id) as posicao_ranking, c.id, c.nome, c.email, date_format(c.data_assinatura,'%d/%m/%Y %T') as data_assinatura,
       						ifnull((select datediff(curdate(),max(data_acesso))
        					from historico_cliente where cliente_id = c.id),-1) as dias,
        					ifnull((select datediff(curdate(), max(data)) from conta_corrente cc where cc.cliente_id = c.id and tipo_id = 1),-1) as ultima_compra
							FROM cliente c
							order by data_assinatura desc";
					
					$rs = mysqli_query($conexao, $sql);
					$num = 0;

					while ($linha = mysqli_fetch_array($rs)) {
			           	 $num++;
			           	 ?>
					<tr>
						<td><?php echo $num?></td>
						<td><?php echo $linha['posicao_ranking']?></td>
						<td><?php echo "<b><i>".$linha['nome']."</i></b><br><span style='font-size:9px'>(".$linha['email'].")</span>"?></td>
						<td><?php echo $linha['data_assinatura']?></td>
						<td><?php echo ($linha['dias'] < 0 ? "Nunca acessou" : $linha["dias"]." dia(s)");?></td>
						<td><?php echo ($linha['ultima_compra'] < 0 ? "Nunca comprou" : $linha["ultima_compra"]." dia(s)");?></td>
						<td>
							<button onclick="location.href='index.php?pg=11&acao=v&id=<?php echo $linha['id']?>'">Detalhar</button>
						</td>
					</tr>

					<?php 
			          	}
			          	?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="col-md-12 text-center">
	<ul class="pagination" id="myPager"></ul>
</div>
<script src="js/paginacao.js"></script>
<script>
	$(document).ready(function(){
	    		
	  $('#myTable').pageMe(
	    {
		  pagerSelector:'#myPager',
		  showPrevNext:true,
		  hidePageNumbers:false,
		  perPage:50,
		  totalPages:5
		 }); 
	  
	  });
</script>

