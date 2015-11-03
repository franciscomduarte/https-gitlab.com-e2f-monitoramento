<div class="row row-offcanvas row-offcanvas-right">
	<div class="row">
		<div class="table-responsive">

			<button type="button" class="btn btn-info" onclick="chamaRelatorio();">
				Lista de Funções
			</button>
		</div>
	</div>
</div>	
<script>
	function chamaRelatorio(){
		pagina = '/scc_cerimonial/relatorios/encaminha.php';
		window.open(pagina,'_blank');
	}
</script>