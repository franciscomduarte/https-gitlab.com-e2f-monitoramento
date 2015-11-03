<?php
session_start();
include_once 'valida.php';
include_once 'header.php';
include_once 'menu.php';

function redirecionaPaginaPerfil(){
	if ($_SESSION['perfil'] == 0)
		return 'convidado/listar-convidado-evento.php';
	elseif($_SESSION['perfil'] == 1)
		return 'convidado/listar-convidado-evento.php';
	elseif($_SESSION['perfil'] == 2)
		return 'recepcao/listar-recepcao-evento.php';
	else 
		return 'sair.php';
}

if(isset($_REQUEST['pg'])) {
	switch ($_REQUEST['pg']) {
		case 1:
			include 'usuario/listar-usuario.php';
			break;
		case 2:
			include 'funcao/listar-funcao.php';
			break;
		case 4:
			include 'funcao/nova-funcao.php';
			break;
		case 5:
			include 'usuario/novo-usuario.php';
			break;
		case 6:
			include 'usuario/?????.php';
			break;
		case 7:
			include 'local/listar-local.php';
			break;
		case 10:
			include 'pessoa/listar-pessoa.php';
			break;
		case 11:
			include 'pessoa/nova-pessoa.php';
			break;
		case 12:
			include 'local/novo-local.php';
			break;
		case 13:
			include 'evento/listar-evento.php';
			break;
		case 14:
			include 'evento/novo-evento.php';
			break;
		case 15:
			include 'convidado/listar-convidado-evento.php';
			break;
		case 16:
			include 'convidado/listar-convidado.php';
			break;
		case 17:
			include 'evento/pre-nominata.php';
			break;
		case 18:
			include 'evento/nominata.php';
			break;
		case 19:
			include 'evento/convidados.php';
			break;
		case 20:
			include 'recepcao/listar-recepcao-evento.php';
			break;
		case 21:
			include 'recepcao/listar-recepcao.php';
			break;
		case 22:
			include 'poder/listar-poder.php';
			break;
		case 23:
			include 'poder/novo-poder.php';
			break;
		case 30:
			include 'relatorios/principal.php';
			break;
		case 31:
			include 'relatorios/lista-de-funcoes.php';
			break;
		case 80:
			include 'colecao/sucesso.php';
			break;
			
		default:
			include redirecionaPaginaPerfil();
			break;
	}
} else {
	include redirecionaPaginaPerfil();
}

?>

<?php include_once 'footer.php'; 
?>
