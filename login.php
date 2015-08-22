<?php 
include_once 'header.php';
?>

<div align="center">
	<img src="img/logo_maior.fw.png" alt="SCC" align="middle">
</div>
<div class="container">
	<div class="col-lg-6" style="width: 50%; align:center">
		<form class="form-signin" role="form" action="acessar.php"
			method="post">
			<h2 class="form-signin-heading" style="text-align: center">Acesso ao
				Sistema</h2>
			<input type="email" name="email" class="form-control"
				placeholder="Email" required autofocus> 
			<input type="password"
				name="senha" class="form-control" placeholder="Senha" required> 
<!-- 				<label -->
<!-- 				class="checkbox"> <input type="checkbox" value="remember-me"> -->
<!-- 				Lembre-me -->
<!-- 			</label> -->
			<button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
		</form>
	</div>
	<?php 

	if (isset($_REQUEST['erro'])){
		  echo "<center>";
		  if ($_REQUEST['erro'] == 1){
					echo '<div class="alert alert-danger" align="center" style="width: 40%">Usu&aacute;rio os senha inv&aacute;lido, tente novamente.</div>';
			}elseif ($_REQUEST['erro'] == 2){
					echo '<div class="alert alert-warning"  align="center" style="width: 40%">Sua sess&atilde;o expirou, acesse novamente.</div>';
			}

			echo "</center>";
      	}

      	?>

</div>
<!-- /container -->


<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
</body>
</html>
<?php include_once 'footer.php'; ?>
