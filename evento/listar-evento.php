<div class="row row-offcanvas row-offcanvas-right">
	<div class="row">
		<div class="table-responsive">

			<button type="button" class="btn btn-default btn-lg" onclick="location.href='index.php?pg=14'">
				Novo Evento
			</button>

			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>C&oacute;digo</th>
						<th>Nome</th>
						<th>Início</th>
						<th>Fim</th>
						<th>Descrição</th>
						<th>Local</th>
						<th>Usuário</th>
						<th>Op&ccedil;&otilde;es</th>
					</tr>
				</thead>
				<tbody id="myTable">
					<?php 

					require_once 'conexao/conn.php';
                    
					$sql = "select e.id, e.nome, e.data_inicio, e.data_fim, e.descricao,
					        concat(l.nome,'<br>' ,l.endereco,' - ',c.nome,' - ',u.sigla) as nome_local,
					        us.nome as nome_usuario
							from evento e, local l, cidade c, uf u, usuario us
							where e.local_id = l.id
							and   l.cidade_id = c.id
							and   u.id = c.uf_id
							and   us.id = e.usuario_cadastro_id
							order by nome";
					$rs = mysqli_query($conexao, $sql);
					$num = 0;

					while ($linha = mysqli_fetch_array($rs)) {
			           	 $num++;
			           	 ?>
					<tr>
						<td><?php echo $num?></td>
						<td><?php echo $linha['id']?></td>
						<td><?php echo $linha['nome']?></td>
						<td><?php echo $linha['data_inicio']?></td>
						<td><?php echo $linha['data_fim']?></td>
						<td><?php echo $linha['descricao']?></td>
						<td><?php echo $linha['nome_local']?></td>
						<td><?php echo $linha['nome_usuario']?></td>
						<td>
							<button onclick="excluir(<?php echo $linha['id']?>)">Excluir</button>
							<button onclick="location.href='index.php?pg=13&acao=a&id=<?php echo $linha['id']?>'">Alterar</button>
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
	function excluir(id){
		var pag = "local/gravar-local.php?acao=e&id="+id;
		if (confirm("Tem certeza que deseja excluir este local?")){
			location.href = pag;
		}
	}

	$(document).ready(function(){
	    		
	  $('#myTable').pageMe(
	    {
		  pagerSelector:'#myPager',
		  showPrevNext:true,
		  hidePageNumbers:false,
		  perPage:5,
		  totalPages:5
		 }); 
	  
	  });
</script>

