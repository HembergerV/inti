
var tabla;
 
 	//Función que se ejecuta al inicio
  	function init(){
	    listar();
	    //cuando se da click al boton submit entonces se ejecuta la funcion guardaryeditar(e);
		$("#usuario_form").on("submit",function(e){
			guardaryeditar(e);	
		})
		//cambia el titulo de la ventana modal cuando se da click al boton
		$("#add_button").click(function(){	
			$(".modal-title").text("Agregar Usuarios");
		});
	}
	//funcion que limpia los campos del formulario
    function limpiar(){
   		$("#cedula").val("");
   		$('#nombre').val("");
		$('#apellido').val("");
		$('#nacionalidad').val("");
		$('#fechanacimiento').val("");
		$('#fechaingreso').val("");
		$('#coddpto').val("");
		$('#cargo').val("");
		$('#usuario').val("");
		$('#password').val("");
		$('#password2').val("");
		$('#telefono').val("");
		$('#email').val("");
		$('#direccion').val("");
		$('#estado').val("");
		$('#idusuario').val("");
   	}
    //function listar 
    function listar(){

    	tabla=$('#usuario_data').dataTable({

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
					url: '../ajax/usuario.php?op=listar',
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
    function mostrar(idusuario){
     	$.post("../ajax/usuario.php?op=mostrar",{idusuario : idusuario}, function(data, status){ 
         	data = JSON.parse(data);
            $("#usuarioModal").modal("show");
            $("#cedula").val(data.cedula);
            $('#nombre').val(data.nombre);
			$('#apellido').val(data.apellido);
			$('#nacionalidad').val(data.nacionalidad);
			$('#fechanacimiento').val(data.fechanacimiento);
			$('#fechaingreso').val(data.fechaingreso);
			$('#coddpto').val(data.coddpto);
			$('#cargo').val(data.cargo);
			$('#usuario').val(data.usuario);
			$('#password').val(data.password);
			$('#password2').val(data.password2);
			$('#telefono').val(data.telefono);
			$('#email').val(data.correo);
			$('#direccion').val(data.direccion);
			$('#estado').val(data.estado);
			$('.modal-title').text("Editar Usuario");
			$('#idusuario').val(idusuario);
			$('#action').val("Edit");
		});
	}
    //la funcion guardaryeditar(e); se llama cuando se da click al boton submit  
    function guardaryeditar(e){

      	e.preventDefault(); //No se activará la acción predeterminada del evento
      	var formData = new FormData($("#usuario_form")[0]);

      	var password= $("#password").val();
	    var password2= $("#password2").val();
            
            //si el password conincide entonces se envia el formulario
	    if(password == password2){
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

	    } //cierre de la validacion


	        else {

                bootbox.alert("No coincide el password");
	    }
    }     
    //EDITAR ESTADO DEL USUARIO
    //importante:idusuario, est se envia por post via ajax
    function cambiarEstado(idusuario,est){
        bootbox.confirm("¿Está Seguro de cambiar de estado?", function(result){
			if(result){
	           	$.ajax({
					url:"../ajax/usuario.php?op=activarydesactivar",
					method:"POST",
					//toma el valor del id y del estado
					data:{idusuario:idusuario, est:est},
					
					success: function(data){
	                  	$('#usuario_data').DataTable().ajax.reload();
					}
				});
			}
		});//bootbox
    }
    //ELIMINAR USUARIO
	function eliminar(idusuario){
	    bootbox.confirm("¿Está Seguro de eliminar el usuario?", function(result){
			if(result) {
				$.ajax({
					url:"../ajax/usuario.php?op=eliminar_usuario",
					method:"POST",
					data:{idusuario:idusuario},

					success:function(data){
						//alert(data);
						$("#resultados_ajax").html(data);
						$("#usuario_data").DataTable().ajax.reload();
					}
				});
			}
		});//bootbox
    }

init();