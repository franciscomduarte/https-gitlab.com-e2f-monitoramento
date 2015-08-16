<?php 
	include_once 'header2.php';
?>

    <div class="container">

      <form class="form-signin" role="form" name="formEsqueci" action="esqueci.php" method="post">
        <h2 class="form-signin-heading" style="text-align: center">Esqueci Senha</h2>
        <input type="email" name="email" id="email" class="form-control" placeholder="Email" required autofocus>
        
        <button class="btn btn-lg btn-primary btn-block" style="margin-top: 10px" type="button" onclick="javascript:esqueci();">Enviar</button>
      </form>

      <?php 
      	
      	if ($_REQUEST['erro']){
		  echo "<center>";
			if ($_REQUEST['erro'] == 1){
					echo '<div class="alert alert-danger" align="center" style="width: 40%">Usu&aacute;rio os senha inv&aacute;lido, tente novamente.</div>';		
			}elseif ($_REQUEST['erro'] == 3){
					echo '<div class="alert alert-warning"  align="center" style="width: 40%">Foi enviado um email com sua nova senha.</div>';
			}elseif ($_REQUEST['erro'] == 4){
					echo '<div class="alert alert-warning"  align="center" style="width: 40%">Email n&atilde;o cadastrado.</div>';
			}elseif ($_REQUEST['erro'] == 5){
					echo '<div class="alert alert-warning"  align="center" style="width: 40%">Senha alterada com sucesso, Faça o Login no APP.</div>';
			}         		

		  echo "</center>";
      	}
      
      ?>
      
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
<script>
	function esqueci(){
		var email = document.getElementById("email").value;
		var formulario = document.formEsqueci;
		if (email != ""){
			formulario.submit();
		}else{
			alert("Digite um email.");
		}
	}
</script>
<?php include_once 'footer.php'; ?>
