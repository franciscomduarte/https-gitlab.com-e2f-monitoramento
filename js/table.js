$(document).ready(function() {
    
	var table = $('#example').DataTable({
    	responsive: true,
    	
    	paging: false,
    	//scrollY: 400,
    	
    	language : {
    	    "sEmptyTable": "Nenhum registro encontrado",
    	    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
    	    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
    	    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
    	    "sInfoPostFix": "",
    	    "sInfoThousands": ".",
    	    "sLengthMenu": "_MENU_ resultados por página",
    	    "sLoadingRecords": "Carregando...",
    	    "sProcessing": "Processando...",
    	    "sZeroRecords": "Nenhum registro encontrado",
    	    "sSearch": "Pesquisar",
    	    "oPaginate": {
    	        "sNext": "Próximo",
    	        "sPrevious": "Anterior",
    	        "sFirst": "Primeiro",
    	        "sLast": "Último"
    	    },
    	    "oAria": {
    	        "sSortAscending": ": Ordenar colunas de forma ascendente",
    	        "sSortDescending": ": Ordenar colunas de forma descendente"
    	    }
    	}
    	
    	
    });
	
//    //var table = $('#example').DataTable();
//    // Event listener to the two range filtering inputs to redraw on input
//    $('#poderSelecionado').change( function() {
//    	var poderSelecionado = $('#poderSelecionado').val();
//    	var dataPoder = $('#dataPoder').val();
//    	// Se remover alguma coluna da tabela, verificar o indice abaixo
//        var poder = data[4]; // use data for the age column
//        //console.log(poder);
//        if ( poderSelecionado == poder ) {
//            return true;
//        }
//        table.draw();
//        return false;
//    	
//    } );
    
    
    
    
});


