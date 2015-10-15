<?php 
include_once 'header2.php';
include 'conexao/conn.php';

if ($_REQUEST['erro']){
	echo "<center>";
	if ($_REQUEST['erro'] == 1){
		echo '<div class="alert alert-danger" align="center" style="width: 40%">Link expirou, tente novamente. Colocar Link</div>';
	}elseif ($_REQUEST['erro'] == 2){
		echo '<div class="alert alert-warning"  align="center" style="width: 40%">Senha alterado com sucesso.</div>';
	}

	echo "</center>";
	break;
}

$url = $_REQUEST['url'];
#echo $url;

if ($url){
	$sql = "select cliente_id, timediff(data_expiracao,sysdate()) as diferenca
			from troca_senha
			where link = '$url' 
			and timediff(data_expiracao,sysdate()) > 0";

	#echo "<br>sql=$sql<br>";
	$rs = mysqli_query($conexao, $sql);
	if ($linha = mysqli_fetch_array($rs)){
		$id = $linha['cliente_id'];
		$sqlCliente = "select * from cliente c where id = $id";
		$rsCliente = mysqli_query($conexao, $sqlCliente);
		if ($row = mysqli_fetch_array($rsCliente)){
			$nomeCliente  = $row['nome'];
			$emailCliente = $row['email'];
		}else{
			echo "<script>alert('Cliente nço encontrado.');</script>";
		}
	}else{
		echo "<script>alert('Esse link expirou, faça uma nova solicitação');location.href='esqueci-senha.php';</script>";
	}
	#echo "<br>Nome Cliente = $nomeCliente<br>Email = $emailCliente";
}else{
	header("Location: esqueci-senha.php?erro=3");
}


?>

<div class="container">
	<h4 class="form-signin-heading" style="text-align: center"><?php echo $nomeCliente?></h4>
	<h5 class="form-signin-heading" style="text-align: center"><?php echo $emailCliente?></h5>
	
	<form class="form-signin" role="form" name="formEsqueci" action="gravar-senha.php" method="post">
		<h2 class="form-signin-heading" style="text-align: center">Esqueci
			Senha</h2>
		<input type="hidden" name="cliente_id" id="cliente_id" value="<?php echo $id ?>">
		<input type="password" name="senha" id="senha" class="form-control"
			placeholder="Senha" required autofocus>

		<input type="password" name="confirmar" id="confirmar" class="form-control"
			placeholder="Confirmar Senha" required autofocus>
			
		<button class="btn btn-lg btn-primary btn-block"
			style="margin-top: 10px" type="button" onclick="esqueci();">Enviar</button>
	</form>



</div>
<!-- /container -->


<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
</body>
</html>
<script>
	function esqueci(){
		var senha = document.getElementById("senha").value;
		var confirmar = document.getElementById("confirmar").value;
		var formulario = document.formEsqueci;
		if (senha != "" && confirmar != ""){
			if (senha == confirmar){
				formulario.action = "gravar-senha.php";
				formulario.submit();
			}else{
				alert("As senhas devem ser iguais.\nDigite novamente.");
			}
		}else{
			alert("Os campos devem ser preenchidos.");
		}
	}
</script>
<?php include_once 'footer.php'; ?>