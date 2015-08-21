<div class="row row-offcanvas row-offcanvas-right">
	<div class="row">
		<div class="table-responsive">

			<button type="button" class="btn btn-info" onclick="location.href='index.php?pg=5'">
				Novo Usu&aacute;rio
			</button>

			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>C&oacute;digo</th>
						<th>Nome</th>
						<th>E-mail</th>
						<th>Situa&ccedil;&atilde;o</th>
						<th>Cadastro</th>
						<th>Último acesso</th>
						<th>Perfil</th>
						<th>Op&ccedil;&otilde;es</th>
					</tr>
				</thead>
				<tbody id="myTable">
					<?php 

					require_once 'conexao/conn.php';

					$sql = "select u.id, u.nome, u.email, u.ativo, u.perfil, 
					        date_format(u.data_cadastro,'%d/%m/%Y %T') as data_cadastro, 
					        IFNULL((select date_format(max(h.data),'%d/%m/%Y %T') 
					                from historico_acesso h 
					                where usuario_id = u.id),'Sem acesso') as data_ultimo_acesso 
					        from usuario u";
					$rs = mysqli_query($conexao, $sql);
					$num = 0;

					while ($linha = mysqli_fetch_array($rs)) {
			           	 $num++;
			           	 ?>
					<tr>
						<td><?php echo $num?>
						</td>
						<td><?php echo $linha['id']?>
						</td>
						<td><?php echo $linha['nome']?></td>
						<td><?php echo $linha['email']?></td>
						<td><?php 
						if ($linha['ativo']==1){
			              		echo 'Ativo';
	      					   }else{
								echo 'Inativo';
							   }
							   ?>
						</td>
						<td>
						    <?php echo $linha['data_cadastro']?>
						</td>
						<td>
						    <?php echo $linha['data_ultimo_acesso']?>
						</td>
						<td>
						    <?php echo $linha['perfil'] == 0 ? 'Administrador' : 'Usuário'?>
						</td>
						<td>
							<button onclick="excluir(<?php echo $linha['id']?>)">
								<span class="glyphicon glyphicon-trash" title="Excluir"></span>
							</button>
							<button onclick="location.href='index.php?pg=5&acao=a&id=<?php echo $linha['id']?>'">
								<span class="glyphicon glyphicon-edit" title="Editar"></span>
							</button>
							<button onclick="location.href='usuario/gravar-usuario.php?&acao=as&id=<?php echo $linha['id']?>'">
								<span class="glyphicon glyphicon-wrench" title="Resetar Senha"></span>
							</button>
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
		var pag = "usuario/gravar-usuario.php?acao=e&id="+id;
		if (confirm("Tem certeza que deseja excluir esse item?")){
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

