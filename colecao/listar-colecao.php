<?php require_once 'conexao/conn.php'; ?>
<div class="row row-offcanvas row-offcanvas-right">
	<div class="row">
		<div class="table-responsive">

			<button type="button" class="btn btn-default btn-lg"
				onclick="location.href='index.php?pg=4'">Nova Cole&ccedil;&atilde;o
			</button>
			Trazer Registros de: <select name="limit"
				onchange="mudarPagina(this)" class="btn-lg">

				<?php 
				$sqlTotal = "select count(*) from agrupador";
				$rsTotal = mysqli_query($conexao, $sqlTotal);
				if($row = mysqli_fetch_array($rsTotal))
					$total = $row[0];
					
				$y=100;
				for ($x=0,$p=1;$x<$total;$x+=$y,$p++){
					if ($x==0)
						echo "<option value='0'>".($x+1).",100</option>";
					else{
							$limit_teste = ($x+1);
							if ($_REQUEST['limit'] == $limit_teste)
								echo "<option value='".($x+1)."' selected>".($x+1).",".($p*$y)."</option>";
							else
								echo "<option value='".($x+1)."'>".($x+1).",".($p*$y)."</option>";
						}
					}
					?>
			</select>
			<?php echo "Total [$total]"?>
			<table class="table table-hover" style="font-size: 11px">
				<thead>
					<tr>
						<th>#</th>
						<th>C&oacute;digo</th>
						<th>Data Cadastro</th>
						<th>Usu&aacute;rio</th>
						<td align="center"><img src="img/brasil.png" width="50">
						
						</th>
						<td align="center"><img src="img/usa.png" width="50">
						
						</th>
						<td align="center"><img src="img/espanha.png" width="50">
						
						</th>
						<th>Op&ccedil;&otilde;es</th>
					</tr>
				</thead>
				<tbody id="myTable">
					<?php 
					$limit = $_REQUEST['limit'];
					if ($limit == "")
						$limit = "0";
					$sql = "SELECT a.id, date_format(a.data_cadastro,'%d/%m/%Y %T') as data_cadastro,
					u.email as usuario, a.verificado, date_format(a.data_verificacao,'%d/%m/%Y %T') as data_verificacao,
					c.categoria_portugues, c.categoria_ingles,
					c.categoria_espanha
					FROM agrupador a, usuario u, categoria c
					WHERE u.id = a.usuario_id
					AND   a.categoria_id = c.id
					ORDER BY u.id, a.data_cadastro limit $limit, 100";

					#echo $sql;
					$rs = mysqli_query($conexao, $sql);
					$num = 0;

					while ($linha = mysqli_fetch_array($rs)) {
			           	 $num++;
			           	 ?>
					<tr>
						<td><?php echo $num?>
						</td>
						<td
						<?php if ($linha['verificado']) echo 'class="linha-verificada"'?>><?php echo $linha['id']?>
						</td>
						<td align="center"><?php 
						echo $linha['data_cadastro'];
						if ($linha['verificado'])
							echo "<br><br><strong>Data de verifica&ccedil;&atilde;o</strong><br>".$linha['data_verificacao'];
						?>
						</td>
						<td><?php echo $linha['usuario'] ?>
						</td>

						<td><?php 
						$sqlColecao = "select * from colecao c
						where c.idioma_id = 1
						and agrupador_id = ".$linha['id'];

						$rsColecao = mysqli_query($conexao, $sqlColecao);
						if ($linha_colecao = mysqli_fetch_array($rsColecao)){
								echo "<ul>";
								echo "<li><b>Categoria: </b>".$linha['categoria_portugues']."</li>";
								echo "<li><b>Nome: </b>".$linha_colecao['nome']."</li>";
								
								if ($linha_colecao['contido']=="1"){
									echo "<li><b>O elemento não está contido na seleção</b></li>";
								}else{
									echo "<li><b>O elemento está contido na seleção</b></li>";
								}
								echo "</ul><ul>";
								for($z=1;$z<=8;$z++){
									if ($z==$linha_colecao['elemento_correto'])
										echo "<li class='btn-success'><b><i>".$linha_colecao['elemento_'.$z]."</i></b></li>";
									else
										echo "<li>".$linha_colecao['elemento_'.$z]."</li>";
								}

								echo "</ul>";
						}

						?>
						</td>


						<td><?php 
						$sqlColecao = "select * from colecao c
										where c.idioma_id = 2
										and agrupador_id = ".$linha['id'];

						$rsColecao = mysqli_query($conexao, $sqlColecao);
						if ($linha_colecao = mysqli_fetch_array($rsColecao)){

								echo "<ul>";
								echo "<li><b>Categoria: </b>".$linha['categoria_ingles']."</li>";
								echo "<li><b>Nome: </b>".$linha_colecao['nome']."</li>";
								if ($linha_colecao['contido']=="1"){
									echo "<li><b>O elemento não está contido na seleção</b></li>";
								}else{
									echo "<li><b>O elemento está contido na seleção</b></li>";
								}
								echo "</ul><ul>";
								for($z=1;$z<=8;$z++){
									if ($z==$linha_colecao['elemento_correto'])
										echo "<li class='btn-success'><b><i>".$linha_colecao['elemento_'.$z]."</i></b></li>";
									else
										echo "<li>".$linha_colecao['elemento_'.$z]."</li>";
								}

								echo "</ul>";
						}

						?></td>


						<td><?php 
						$sqlColecao = "select * from colecao c
									where c.idioma_id = 3
									and agrupador_id = ".$linha['id'];

						$rsColecao = mysqli_query($conexao, $sqlColecao);
						if ($linha_colecao = mysqli_fetch_array($rsColecao)){
								echo "<ul>";
								echo "<li><b>Categoria: </b>".$linha['categoria_espanha']."</li>";
								echo "<li><b>Nome: </b>".$linha_colecao['nome']."</li>";
								
								if ($linha_colecao['contido']=="1"){
									echo "<li><b>O elemento não está contido na seleção</b></li>";
								}else{
									echo "<li><b>O elemento está contido na seleção</b></li>";
								}
								echo "</ul><ul>";
								for($z=1;$z<=8;$z++){
									if ($z==$linha_colecao['elemento_correto'])
										echo "<li class='btn-success'><b><i>".$linha_colecao['elemento_'.$z]."</i></b></li>";
									else
										echo "<li>".$linha_colecao['elemento_'.$z]."</li>";
								}

								echo "</ul>";
						}

						?></td>

						<td>
							<button style="margin: 5px; cursor: pointer" class="btn btn-info"
								type="button"
								onclick="location.href='index.php?pg=4&acao=a&id=<?php echo $linha['id']?>'">Alterar</button>
							<br>
							<button style="margin: 5px; cursor: pointer"
								class="btn btn-danger" type="button"
								onclick="excluir(<?php echo $linha['id']?>)">Excluir</button> <br>
							<button style="margin: 5px; cursor: pointer"
								class="btn btn-warning" type="button"
								onclick="verificar(<?php echo $linha['id']?>)">Validar</button>
							<br>
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
		var pag = "colecao/gravar-colecao.php?acao=e&id="+id;
		if (confirm("Tem certeza que deseja excluir esse item?")){
			location.href = pag;
		}
	}

	function verificar(id){
		var pag = "colecao/gravar-colecao.php?acao=v&id="+id;
			location.href = pag;
	}

	function mudarPagina(obj){
		var pag = "index.php?pg=2&limit="+obj.value;
		location.href = pag;
	}

	$(document).ready(function(){
		
		  $('#myTable').pageMe(
		    {
			  pagerSelector:'#myPager',
			  showPrevNext:true,
			  hidePageNumbers:false,
			  perPage:<?php echo $y?>,
			  totalPages:10
			 }); 
		  
		  });
</script>
