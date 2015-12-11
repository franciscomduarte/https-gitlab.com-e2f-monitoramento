<?php 
require_once 'conexao/conn.php';
?>
<div class="row row-offcanvas row-offcanvas-right">

	<div class="input-group" style="margin: 5px">
		<div class="input-group">
        <span class="input-group-addon">Poder:</span>
        <select id="poderSelecionado" name="idPoder" class="form-control" style="width:400px">
        	<option value='' id=''>-- Escolha um poder --</option>
	            <?php 
		            $sqlPoder = "select * from poder order by id";
		            $rsPoder = mysqli_query($conexao, $sqlPoder);
		            while($linha=mysqli_fetch_array($rsPoder)){
						echo "<option value='".$linha['id']."' id='".$linha['id']."'>".$linha['nome']."</option>";
		            }	
	            ?>
            </select>
    	</div>
	</div>

	<div class="row">
		<div class="table-responsive">
			<button type="button" class="btn btn-info" onclick="chamaRelatorio();">
				Lista de Funções
			</button>
		</div>
	</div>
</div>	
<script>
	function chamaRelatorio() {
		var idPoder = document.getElementById("poderSelecionado").value;
		if(idPoder) {
			pagina = '/scc_cerimonial/relatorios/encaminha.php?idPoder='+idPoder;
		} else {
			pagina = '/scc_cerimonial/relatorios/encaminha.php';
		}
		window.open(pagina,'_blank');
	}
</script>