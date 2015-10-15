
<div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
		<a class="navbar-brand" href="index.php">
			<img src="img/icone_scc.fw.png" alt="Sistema de Controle de Cerimonial" align="top">
		</a>
		</div>
		
		
		<?php 
			//session_start();
			$perfil = $_SESSION['perfil'];
			switch ($perfil) {
				case 0:
		?>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
			<li><a href="#">Home</a></li>
			<li><a href="index.php?pg=2">Posto ou Fun&ccedil;&atilde;o</a></li>
			<li><a href="index.php?pg=7">Local</a></li>
			<li><a href="index.php?pg=22">Poder</a></li>
			<li><a href="index.php?pg=13">Eventos</a></li>
			<li><a href="index.php?pg=10">Pessoas</a></li>
			<li><a href="index.php?pg=15">Convidados</a></li>
			<li><a href="index.php?pg=20">Recep&ccedil;&atilde;o</a></li>
			<li><a href="sair.php">Sair</a></li>
			</ul>
		</div><!-- /.nav-collapse -->
		<?php   break;
		
				case 1:		?>
				<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
				<li><a href="#">Home</a></li>
				<li><a href="index.php?pg=10">Pessoas</a></li>
				<li><a href="index.php?pg=15">Convidados</a></li>
				<li><a href="index.php?pg=20">Recep&ccedil;&atilde;o</a></li>
				<li><a href="sair.php">Sair</a></li>
				</ul>
				</div><!-- /.nav-collapse -->
		<?php   break;
				
				case 2: ?>		
				<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
				<li class="active"><a href="#">Home</a></li>
				<li><a href="index.php?pg=20">Recep&ccedil;&atilde;o</a></li>
				<li><a href="sair.php">Sair</a></li>
				</ul>
				</div><!-- /.nav-collapse -->
		
		<?php 
				break;				
			}
		
		?>
		
		
	</div><!-- /.container -->
</div><!-- /.navbar -->
<div class="container">