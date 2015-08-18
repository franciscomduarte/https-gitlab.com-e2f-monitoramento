<div class="row row-offcanvas row-offcanvas-right">
	<div class="row">
		<div class="table-responsive">

			<fieldset legend="Pesquisar">
				<form method="post" action="index.php?pg=10">
					<div class="row">
						<div class="col-lg-6">

							<span class="input-group-btn">
								<button class="btn btn-info" type="button"
									onclick="location.href='index.php?pg=3'">Criar Novo</button>
							</span>

						</div>
						<!-- /.col-lg-6 -->
						<div class="col-lg-6">
							<div class="input-group">
								<input type="text" class="form-control" name="busca"> <span
									class="input-group-btn">
									<button class="btn btn-default" type="button">Procurar</button>
								</span>
							</div>
							<!-- /input-group -->
						</div>
						<!-- /.col-lg-6 -->
					</div>
					<!-- /.row -->
				</form>

			</fieldset>


		</div>
	</div>
</div>


<table class="table table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th>Foto</th>
			<th>Ordem</th>
			<th>Nome</th>
			<th>Inclus&atilde;o</th>
			<th>E-mail</th>
			<th>Telefone(s)</th>
		</tr>
	</thead>
	<tbody id="myTable">
		<?php
		require_once 'conexao/conn.php';
	
		$sql = "select p.id, p.nome as nome_pessoa, p.foto, p.ordem, p.email, p.telefone_1, p.telefone_2,
					date_format(data_criacao,'%d/%m/%Y %T') as data_cadastro_formatada,
					f.nome as nome_funcao, pp.nome as nome_poder
					from pessoa p, funcao f, poder pp
					where p.funcao_id = f.id
					and pp.id = f.poder_id ";

		if ($_REQUEST['busca'])
			$sql .= "and p.nome like '%".$_REQUEST['busca']."%' ";
		
		$sql.= "order by p.ordem";
		
		$rs = mysqli_query($conexao, $sql);
		$num = 0;

		while ($linha = mysqli_fetch_array($rs)) {
                        $num++;
                        ?>
		<tr>
			<td><?php echo $num ?></td>
			<td>
				<?php 
					if ($linha['foto']){
						echo "<img src='fotos/".$linha['foto']."' width='40' height='40'>";
					}else{
						echo "<img src='img/icone_perfil.fw.png' width='40' height='40'>";	
					}

				?>
			</td>
			<td><?php echo $linha['ordem'] ?></td>
			<td><?php 
					
					
					echo $linha['nome_pessoa'] 
				?>
			</td>
			<td><?php echo $linha['data_cadastro_formatada']?></td>
			<td><?php echo $linha['email'] ?></td>
			<td><?php 
					echo $linha['telefone_1'];
					if ($linha['telefone_2'])
						echo  "<br/>".$linha['telefone_2'];
				?>
			</td>

		</tr>

		<?php
           }
        ?>
	</tbody>
</table>

<div class="col-md-12 text-center">
	<ul class="pagination" id="myPager"></ul>
</div>
