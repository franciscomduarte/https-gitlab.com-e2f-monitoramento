<?php 
	include 'conexao/conn.php';
	
	function montarEmail($senha,$email,$link){
		
		//1 – Definimos Para quem vai ser enviado o email 
		$para = $email; 
		//2 - resgatar o nome digitado no formulário e grava na variavel $nome 
		$nome = $email; 
		// 3 - resgatar o assunto digitado no formulário e grava na variavel 
		//$assunto 
		$assunto = "Trocar Senha APP Collections"; 
		//4 – Agora definimos a mensagem que vai ser enviado no e-mail 
		$mensagem .="Aqui está a solução sem que houvesse a necessidade da geração de conflito interno. Use com moderação!<br>
			      Here is the solution without any need of generating internal conflict. Use with care!<br>
			      Aquí está la solución sin necesidad de generar conflictos internos. Utilice con moderación!<br>";
		$mensagem .= "<strong>Nome: </strong>".$nome; 
		$mensagem .= "<br> <strong>Mensagem: </strong>Solicitação de alteração de senha. <br>
					Acesse o link <a href='http://www.lenderbook.com/scc/trocar-senha.php?url=$link'>http://www.lenderbook.com/senha.php?url=$link</a><br>"; 
		//5 – agora inserimos as codificações corretas e tudo mais. 
		$headers = "Content-Type:text/html; charset=UTF-8\n"; 
		$headers .= "From: Contato LenderBook<contato@lenderbook.com>\n"; 
		//Vai ser mostrado que o email partiu deste email e seguido do nome 
		$headers .= "X-Sender: <sistema@dominio.com.br>\n"; 
		//email do servidor que enviou 
		$headers .= "X-Mailer: PHP v".phpversion()."\n"; 
		$headers .= "X-IP: ".$_SERVER['REMOTE_ADDR']."\n"; 
		$headers .= "Return-Path: <sistema@dominio.com.br>\n"; 
		//caso a msg seja respondida vai para este email. 
		$headers .= "MIME-Version: 1.0\n"; 
		#echo "<br>".$mensagem."<br>";
		mail($para, $assunto, $mensagem, $headers); //função que faz o envio do email.		
		
	}
		
	$email = $_REQUEST['email'];
	
	$sql = "select id, nome, email from cliente where email = '$email'";
	#echo $sql."<br>";
	$rs = mysqli_query($conexao, $sql);
	if ($linha = mysqli_fetch_array($rs)){
		$id = $linha['id'];
		$nome = $linha['nome'];
	}
		
	if ($id){
		//mudar a senha e enviar o email
		$link = md5(date("Ymdhis").$id);
	#	var_dump($senha);
		$sql = "INSERT INTO troca_senha 
				VALUES(null, '$link', 
				sysdate(), addtime(sysdate(),'0 0:59:59.50'), $id)";
						
		#echo $sql;
		mysqli_query($conexao, $sql);
		//enviar email
		
		montarEmail($senha,$email,$link);
		header("Location: esqueci-senha.php?erro=3");
	}else{
		header("Location: esqueci-senha.php?erro=4");
	}
	

?>
