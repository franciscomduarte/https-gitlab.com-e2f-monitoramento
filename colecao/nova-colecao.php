<?php 
include 'conexao/conn.php';

	$id 	= isset($_REQUEST['id']) ? $_REQUEST['id'] : "";
	$acao   = isset($_REQUEST['acao']) ?  $_REQUEST['acao'] : "";

if ($acao == "a"){
	$sql = "select * from agrupador where id = $id";
	$rs = mysqli_query($conexao, $sql);

	if ($linha = mysqli_fetch_array($rs)) {
		#dados agrupador
		$usuario_id 	= $linha['usuario_id'];
		$data_criacao	= $linha['data_criacao'];
		$categoria_id   = $linha['categoria_id'];
		$verificado		= $linha['verificado'];

		#dados questao de Portugues
		$sqlPortugues = "select * from colecao where agrupador_id = $id and idioma_id = 1";
		$rsPortugues = mysqli_query($conexao, $sqlPortugues);
		if ($linhaPortugues = mysqli_fetch_array($rsPortugues)){
			$colecao_portugues = $linhaPortugues['nome'];
			$contido		   = $linhaPortugues['contido'];
			$resposta_correta  = $linhaPortugues['elemento_correto'];

		}
		
		#dados questao de Ingles
		$sqlIngles = "select * from colecao where agrupador_id = $id and idioma_id = 2";
		$rsIngles = mysqli_query($conexao, $sqlIngles);
		if ($linhaIngles = mysqli_fetch_array($rsIngles)){
			$colecao_ingles    = $linhaIngles['nome'];
		}
		
		#dados questao de Espanha
		$sqlEspanha = "select * from colecao where agrupador_id = $id and idioma_id = 3";
		$rsEspanha  = mysqli_query($conexao, $sqlEspanha);
		if ($linhaEspanha = mysqli_fetch_array($rsEspanha)){
			$colecao_espanha   = $linhaEspanha['nome'];
		}		
		
		#colocar os dados de cada colecao
	}
}else{
	$acao = "n";
}
#exit();
?>
<style>
.btn-primary:active, .btn-primary.active, .open .dropdown-toggle.btn-primary {
	background-image: none;
	background-color: #83BE26 !important;
}
</style>

<div class="row row-offcanvas row-offcanvas-right">
	<div class="row">
		<div class="table-responsive">

			<fieldset legend="Pesquisar">
				<form method="post" action="index.php?pg=2">
					<div class="row">
						<div class="col-lg-6">

							<span class="input-group-btn">
								<button class="btn btn-info" type="button" onclick="history.go(-1);" style="margin-right: 5px">Voltar</button>
							</span>
							
						</div>
					</div>
					<!-- /.row -->
				</form>
			</fieldset>
		</div>

		<div class="bs-example" style="margin-top: 10px">
			<form name="formColecao" method="post" action="colecao/gravar-colecao.php"> 
				<input type="hidden" name="id" value="<?php echo $id?>">
				<input type="hidden" name="acao" value="<?php echo $acao?>">
				<div class="row" style="margin-left: 2px;margin-bottom: 5px;">
					<span class="input-group-btn"> 
							<div class="input-group">
                               <span class="input-group-addon">Categoria do Item:</span>
                               <select name="categoria" class="form-control" style="width:400px">
                                  	<?php 
                                  		if ($categoria_id == "")
                                  			$categoria_id = 1;
                                  		
                                  		$sqlCategoria = "select * from categoria order by id";
                                  		$rsCategoria = mysqli_query($conexao, $sqlCategoria);
                                  		while($linha=mysqli_fetch_array($rsCategoria)){
                                  			if ($linha['id'] == $categoria_id){
                                  				$escolhido = "selected";
                                  			}else{
                                  				$escolhido = "";
                                  			}
											$opcao = "<option value='".$linha['id']."' ".$escolhido.">".$linha['categoria_portugues']." | <i>".$linha['categoria_ingles']." | ".$linha['categoria_espanha']."</i></option>";
                                  			echo $opcao;
                                  		}	
                                  	
                                  	?>
                                 </select>
								<?php if ($acao == 'a') {?>
                                 <div class="btn-group" data-toggle="buttons" style="margin-left: 5px">
						  
						  <label class="btn btn-primary <?php if ($verificado) echo "active"?>">
						    <input type="radio" name="situacao" id="option1" value="1" autocomplete="off" <?php if ($verificado) echo "checked"?>> Verificado
						  </label>
						  
						  <label class="btn btn-primary <?php if (!$verificado) echo "active"?>">
						    <input type="radio" name="situacao" id="option2" value="0" autocomplete="off" <?php if (!$verificado) echo "checked"?>> N&atilde;o Verificado
						  </label>
						</div>
						<?php }?>
                      </div>
					</span> 
				</div>
				<div class="row">
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="img/brasil.png" data-holder-rendered="true"
								style="height: 82px; width: 82px; display: block;">
							<div class="caption">

								<div class="input-group">
                                  <span class="input-group-addon" style="width:50px">Nome da coleção:</span>
                                  <input type="text" class="form-control" value="<?php echo $colecao_portugues?>" name="colecao_portugues" required placeholder="Coleção">
                                </div>
                               	Tipo de questão:<br /> 
                                  <input type="radio" name="contido" value="0" <?php if ($contido == 0) echo "checked"?> />
                                     O elemento está contido na seleção<br />
                                     <input type="radio" name="contido" value="1"  <?php if ($contido == 1) echo "checked"?>/>
                                     O elemento não está contido na seleção
                               
                               	<?php 
                               	if (!$resposta_correta)
                               		$resposta_correta = 1;
                               		
								$idioma = "portugues";
								for($x=1; $x<=8; $x++){ ?>
									<div class="input-group">
									<span class="input-group-addon" style="width:50px">
                                    <input type="radio" name="resposta_correta" 
                                    value="<?php echo $x?>" 
                                    <?php if ($resposta_correta == $x) echo "checked"?>>
                                    Item <?php echo $x?>:
                                    </span>
										<input type="text" class="form-control" 
										name="<?php echo 'elemento'.$x.'_'.$idioma?>" value="<?php echo $linhaPortugues["elemento_$x"]?>" required 
										placeholder="digite o item..." size="40">
									</div>	
								<?php }   ?>
                               
                              </div>
						</div>
					</div>


					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="img/usa.png" data-holder-rendered="true"
								style="height: 82px; width: 82px; display: block;">
							<div class="caption">
								<div class="input-group">
                                  <span class="input-group-addon" style="width:50px">Nome da coleção:</span>
                                  <input type="text" class="form-control" name="colecao_ingles" value="<?php echo $colecao_ingles?>" required placeholder="Coleção">
                                </div>
                               	Tipo de questão:<br /> 
                                  
                                     O elemento está contido na seleção<br />
                                     
                                     O elemento não está contido na seleção
                               
                               	<?php 
								$idioma = "ingles";
								for($x=1; $x<=8; $x++){ ?>
									<div class="input-group">
									<span class="input-group-addon" style="width:50px">Item <?php echo $x?>:</span>
										<input type="text" class="form-control" value="<?php echo $linhaIngles["elemento_$x"]?>"  
										name="<?php echo 'elemento'.$x.'_'.$idioma?>" required 
										placeholder="digite o item..." size="40">
									</div>	
								<?php }   ?>
 
							</div>
						</div>
					</div>


					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="img/espanha.png" data-holder-rendered="true"
								style="height: 82px; width: 82px; display: block;">
							<div class="caption">
								<div class="input-group">
                                  <span class="input-group-addon" style="width:50px">Nome da coleção:</span>
                                  <input type="text" class="form-control" value="<?php echo $colecao_espanha?>" name="colecao_espanha" required placeholder="Coleção">
                                </div>
                               	Tipo de questão:<br /> 
                                  
                                     O elemento está contido na seleção<br />
                                     
                                     O elemento não está contido na seleção
                               
                               	<?php 
								$idioma = "espanha";
								for($x=1; $x<=8; $x++){ ?>
									<div class="input-group">
									<span class="input-group-addon" style="width:50px">
                                    Item <?php echo $x?>:
                                    </span>
										<input type="text" class="form-control"  value="<?php echo $linhaEspanha["elemento_$x"]?>" 
										name="<?php echo 'elemento'.$x.'_'.$idioma?>" required 
										placeholder="digite o item..." size="40">
									</div>	
								<?php }   ?>
 
							</div>
						
                        </div>
                        
					</div>
				</div>

                <p align="center" style="padding-top:10px">
                   <button type="submit" class="btn btn-default"><?php echo $acao == "a" ? "Alterar" : "Salvar"?> Coleção</button>
                    
                </p>
				
            </form>
		</div>
	</div>
</div>
