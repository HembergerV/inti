
var tabla;
 
 	//Función que se ejecuta al inicio
  	function init(){
	    listar();
	    //cuando se da click al boton submit entonces se ejecuta la funcion guardaryeditar(e);
		$("#pais_form").on("submit",function(e){
			guardaryeditar(e);	
		})
		
	}
	//funcion que limpia los campos del formulario
    function limpiar(){
   		$('#nombre').val("");
		$('#estatus').val("");
		$('#codpais').val("");
   	}
    //function listar 
    function listar(){

    	tabla=$('#pais_data').dataTable({

    	"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],

		"ajax":

		   {
					url: '../ajax/pais.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},

	    "bDestroy": true,
		"responsive": true,
		"bInfo":true,
		"iDisplayLength": 10,//Por cada 10 registros hace una paginación
	    "order": [[ 0, "asc" ]],//Ordenar (columna,orden)

	    "language": {
			    "sProcessing":     "Procesando...",
			    "sLengthMenu":     "Mostrar _MENU_ registros",			 
			    "sZeroRecords":    "No se encontraron resultados",			 
			    "sEmptyTable":     "Ningún dato disponible en esta tabla",			 
			    "sInfo":           "Mostrando un total de _TOTAL_ registros",			 
			    "sInfoEmpty":      "Mostrando un total de 0 registros",			 
			    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",			 
			    "sInfoPostFix":    "",			 
			    "sSearch":         "Buscar:",			 
			    "sUrl":            "",			 
			    "sInfoThousands":  ",",			 
			    "sLoadingRecords": "Cargando...",			 
			    "oPaginate": {			 
			        "sFirst":    "Primero",			 
			        "sLast":     "Último",			 
			        "sNext":     "Siguiente",			 
			        "sPrevious": "Anterior"			 
			    },

			    "oAria": {			 
			        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",			 
			        "sSortDescending": ": Activar para ordenar la columna de manera descendente"			 
			    }
			   }//cerrando language
    	}).DataTable();
    }  
    //Mostrar datos del usuario en la ventana modal del formulario 
    function mostrar(codpais){
     	$.post("../ajax/pais.php?op=mostrar",{codpais : codpais}, function(data, estatus){ 
         	data = JSON.parse(data);
            $("#usuarioModal").modal("show");
            $('#nombre').val(data.nombre);
			$('#estatus').val(data.estatus);
			$('.modal-title').text("Editar Usuario");
			$('#codpais').val(codpais);
			$('#action').val("Edit");
		});
	}
    function guardaryeditar(e){

      	e.preventDefault(); 
      	var formData = new FormData($("#pais_form")[0]);
            $.ajax({
           	    url: "../ajax/usuario.php?op=guardaryeditar",
			    type: "POST",
			    data: formData,
			    contentType: false,
			    processData: false,

			    success: function(datos){

			    	console.log(datos);

			    	$('#usuario_form')[0].reset();
					$('#usuarioModal').modal('hide');

					$('#resultados_ajax').html(datos);
					$('#usuario_data').DataTable().ajax.reload();
			
                    limpiar();

			    }
            });

	        else {

                bootbox.alert("No coincide el password");
	    }
    }     
    function cambiarEstado(codpais,est){
        bootbox.confirm("¿Está Seguro de cambiar de estatus?", function(result){
			if(result){
	           	$.ajax({
					url:"../ajax/pais.php?op=activarydesactivar",
					method:"POST",
					//toma el valor del id y del estado
					data:{codpais:codpais, est:est},
					
					success: function(data){
	                  	$('#pais_data').DataTable().ajax.reload();
					}
				});
			}
		});//bootbox
    }
    //ELIMINAR USUARIO
	function eliminar(codpais){
	    bootbox.confirm("¿Está Seguro de eliminar el pais?", function(result){
			if(result) {
				$.ajax({
					url:"../ajax/pais.php?op=eliminar_pais",
					method:"POST",
					data:{codpais:codpais},

					success:function(data){
						//alert(data);
						$("#resultados_ajax").html(data);
						$("#pais_data").DataTable().ajax.reload();
					}
				});
			}
		});//bootbox
    }

init();