<?php 
require_once 'conexao/conn.php';
$id	   = $_REQUEST['id'];

?>

<div class="row row-offcanvas row-offcanvas-right">

	<div class="row" style="margin-top: 10px">

			<?php
					
				$sql = "select e.descricao, e.data_fim, e.data_inicio, e.nome, l.nome as local
						from evento e, local l
		                where 1=1 and 
		                      l.id = e.local_id 
		                      and e.id = '".$id."'";
				$rs = mysqli_query($conexao, $sql);
				
				while ($linha = mysqli_fetch_array($rs)) {
					
					$data_inicio  = $linha['data_inicio'];
					$data_fim     = $linha['data_fim'];
					$nome         = $linha['nome'];
					$descricao  = $linha['descricao'];
					$local  = $linha['local'];
					
				}
			?>
	
		<div class="panel panel-default">
		  <div class="panel-heading"><b>Evento: <?php echo $nome ?></b></div>
		  <div class="panel-body">
		  	Local: <?php echo $local ?><br>
		 	Descrição: <?php echo $descricao ?><br>
		    Data Inicio: <?php echo $data_inicio ?><br>
		    Data Fim: <?php echo $data_fim ?>
		  </div>
		</div>
	
	</div>

	<div class="row">
		<div class="table-responsive">

			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Pessoa</th>
						<th>Email</th>
						<th>Telefone 1</th>
						<th>Função</th>
					</tr>
				</thead>
				<tbody id="myTable">
					<?php 

					
                    
					$sql = "select  p.nome, p.email, p.telefone_1, f.nome as funcao
							from convidado c, pessoa p, funcao f
							where 1=1 and
							c.pessoa_id = p.id and
							p.funcao_id = f.id and
		                    c.evento_id = '".$id."'";
					$rs = mysqli_query($conexao, $sql);
					$num = 0;

					while ($linha = mysqli_fetch_array($rs)) {
			           	 $num++;
			           	 ?>
					<tr>
						<td><?php echo $num?></td>
						<td><?php echo $linha['nome']?></td>
						<td><?php echo $linha['email']?></td>
						<td><?php echo $linha['telefone_1']?></td>
						<td><?php echo $linha['funcao']?></td>
					</tr>

					<?php 
			          	}
			          	?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	function excluir(id){
		var pag = "evento/gravar-evento.php?acao=e&id="+id;
		if (confirm("Tem certeza que deseja excluir este evento?")){
			location.href = pag;
		}
	}
</script>

