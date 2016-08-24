<?php 
	include 'conexao/conn.php';
	
	$id 	= isset($_REQUEST['id']) ? $_REQUEST['id'] : "";
	$acao   = isset($_REQUEST['acao']) ?  $_REQUEST['acao'] : "";
	$foto                = "";
	$ordem               = "";
	$nome                = "";
	$email        		 = "";
	$telefone_1   		 = "";
	$telefone_2   		 = "";
	$data_criacao 		 = "";
	$posto_graduacao_id  = "";
	$funcao_id           = "";
	$usuario_cadastro_id = "";
	$cargo = "";
	
	if ($acao == "a"){
		
		$sql = "select * from pessoa where id = $id";		
		$rs = mysqli_query($conexao, $sql);
		
		while ($linha = mysqli_fetch_array($rs)) {
			
			$foto                = $linha['foto'];
			$ordem               = $linha['ordem'];
			$nome                = $linha['nome'];
			$email        		 = $linha['email'];
			$telefone_1   		 = $linha['telefone_1'];
			$telefone_2   		 = $linha['telefone_2'];
			$data_criacao 		 = $linha['data_criacao'];
			$posto_graduacao_id  = $linha['posto_graduacao_id'];
			$funcao_id           = $linha['funcao_id'];
			$usuario_cadastro_id = $linha['usuario_cadastro_id'];
			$cargo = $linha['cargo'];
		}
	}else{
		$acao = "n";
	}
	
?>
<div class="row row-offcanvas row-offcanvas-right">
	<div class="row">
		<div>

			<fieldset legend="Pesquisar">
				<form method="post" action="index.php?pg=2">
					<div class="row">
						<div class="col-lg-6" style="margin-left: 10px">

								<button class="btn btn-info" type="button"
									onclick="history.go(-1);">Voltar</button>

						</div>
					</div>
					<!-- /.row -->
				</form>
			</fieldset>
		</div>
		<p>
		
		<form action="pessoa/gravar-pessoa.php?acao=<?php echo $acao?>" method="post" enctype="multipart/form-data" name="exemplo">
			<input type="hidden" name="id" value="<?php echo $id?>">
			<div class="col-lg-6">
			
				<div class="row" style="margin:5px;">
					<span class="input-group-btn"> 
							<div class="input-group">
                               <span class="input-group-addon">&nbsp;&nbsp;&nbsp;Posto / Função&nbsp;&nbsp; </span>
                               <select id="funcao_id" name="funcao_id" onchange="javascript:mudarOrdem()" class="form-control" style="width:100%" required>
                                  	<option value='' selected>-- Escolha uma função --</option>
                                  	<?php 
                                  		
                                  		$sqlFuncao = " select * from funcao ";
                                  		$rsFuncao = mysqli_query($conexao, $sqlFuncao);
                                  		while($linha=mysqli_fetch_array($rsFuncao)){
                                  			if ($linha['id'] == $funcao_id){
                                  				$escolhido = "selected";
                                  			}else{
                                  				$escolhido = "";
                                  			}
											$opcao = "<option value='".$linha['id']."' ".$escolhido.">".$linha['nome']."</option>";
                                  			echo $opcao;
                                  		}	
                                  	
                                  	?>
                                </select>
                            </div>
					</span>
				</div>
				
				<div class="input-group" style="margin: 5px">
					<span class="input-group-addon">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ordem&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 
					<input type="text" name="ordem" value="<?php echo $ordem ?>" class="form-control" placeholder="Digite a Ordem" required>
				</div>
			
				<div class="input-group" style="margin: 5px">
					<span class="input-group-addon">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Função&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 
					<input type="text" name="cargo" value="<?php echo $cargo?>" class="form-control" placeholder="Digite a Função" required>
				</div>
			
				<div class="input-group" style="margin: 5px">
					<span class="input-group-addon">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nome&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 
					<input type="text" name="nome" value="<?php echo $nome?>" class="form-control" placeholder="Digite o Nome" required>
				</div>
				
				<div class="input-group" style="margin: 5px">
					<span class="input-group-addon">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 
					<input type="text" name="email" value="<?php echo $email ?>" class="form-control" placeholder="Digite o Email">
				</div>
				
				<div class="input-group" style="margin: 5px">
					<span class="input-group-addon">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Telefone 1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 
					<input type="text" name="telefone_1" value="<?php echo $telefone_1?>" class="form-control" placeholder="Digite o Telefone 1" required>
				</div>
				
				<div class="input-group" style="margin: 5px;">
					<span class="input-group-addon">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Telefone 2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 
					<input type="text" name="telefone_2" value="<?php echo $telefone_2?>" class="form-control" placeholder="Digite o Telefone 2">
				</div>
								

				
				<div class="form-group">
				    <?php 
				    if ($foto){
						echo "<img src='fotos/".$foto."' width='100' height='100'>";
					}else{
						echo "<img src='img/icone_perfil.fw.png' width='100' height='100'>";	
					}
					?>
				    
				    <label for="inputFile">Incluir/Alterar Arquivo</label>
				    <input type="hidden" name="nome_foto_alterar" value="<?php echo $foto?>">
				    <input type="file" id="inputFile" name="foto">
				    <p class="help-block">Escolha um arquivo do tipo imagem. </p>
				 </div>
				
					<button class="btn btn-info" type="submit">Cadastrar</button>
			</div>
		</form>
		</p>

	</div>
</div>

<script type="text/javascript">

	function mudarOrdem(){
		var id = document.getElementById('funcao_id').value;		
		Exemplo1(id);		
	}

	function Exemplo1(id) {
		   var ajaxObj;

		   try {
		      // Firefox, Opera 8.0+, Safari...
		      ajaxObj=new XMLHttpRequest();
		   } catch (e) {
		      // Internet Explorer
		      try {
		         ajaxObj=new ActiveXObject("Msxml2.XMLHTTP");
		      } catch (e) {
		         try {
		            ajaxObj=new ActiveXObject("Microsoft.XMLHTTP");
		         } catch (e) {
		            alert("Seu navegador não possui suporte ao AJAX!");
		            return false;
		         }
		      }
		   }
		   ajaxObj.onreadystatechange=function() {
		      if(ajaxObj.readyState==4) {
		         document.exemplo.ordem.value=ajaxObj.responseText;
		      }
		   }
		   ajaxObj.open("GET","pessoa/consultaOrdem.php?id="+id,true);
		   ajaxObj.send(null);
		}

					
</script>
