<?php 

if (isset($_SESSION["id_usuario"]) && !$_SESSION["id_usuario"]){
	echo "<script>location.href='login.php?erro=2';</script>";
}else{
    //Verificar se o usuario tem permissao de acesso a pagina
    
}


?>