<?php

  //llamar a la conexion de la base de datos

  require_once("../config/conexion.php");


  //llamar a el modelo Usuarios 
  require_once("../modelos/Usuarios.php");
  //Declaro el objeto usuario
  $usuarios = new Usuarios();

  //declaramos las variables de los valores que se envian por el formulario y que recibimos por ajax y decimos que si existe el parametro que estamos recibiendo

  $id_usuario = isset($_POST["id_usuario"]);
  $nombre=isset($_POST["nombre"]);
  $apellido=isset($_POST["apellido"]);
  $cedula=isset($_POST["cedula"]);
  $telefono=isset($_POST["telefono"]);
  $email=isset($_POST["email"]);
  $direccion=isset($_POST["direccion"]); 
  $cargo=isset($_POST["cargo"]);
  $usuario=isset($_POST["usuario"]);
  $password1=isset($_POST["password1"]);
  $password2=isset($_POST["password2"]);
  //este es el que se envia del formulario
  $estado=isset($_POST["estado"]);


  switch($_GET["op"]){
    case "guardaryeditar":
      /*verificamos si existe la cedula y correo en la base de datos, si ya existe un registro con la cedula o correo entonces no se registra el usuario*/
      $datos = $usuarios->get_cedula_correo_del_usuario($_POST["cedula"],$_POST["email"]);
                 
        //validacion de password
        if($password1 == $password2){
          /*si el id no existe entonces lo registra importante: se debe poner el $_POST sino no funciona*/
	        if(empty($_POST["id_usuario"])){
            /*si coincide password1 y password2 entonces verificamos si existe la cedula y correo en la base de datos, si ya existe un registro con la cedula o correo entonces no se registra el usuario*/
            if(is_array($datos)==true and count($datos)==0){                                
              //no existe el usuario por lo tanto hacemos el registros
              $usuarios->registrar_usuario($nombre,$apellido,$cedula,$telefono,$email,$direccion,$cargo,$usuario,$password1,$password2,$estado);
              $messages[]="El usuario se registró correctamente";
              /*si ya exista el correo y la cedula entonces aparece el mensaje*/
	          } else {

               $messages[]="La cédula o el correo ya existe";
	          }                     
	        } else {
            /*si ya existe entonces editamos el usuario*/
            $usuarios->editar_usuario($id_usuario,$nombre,$apellido,$cedula,$telefono,$email,$direccion,$cargo,$usuario,$password1,$password2,$estado);
            $messages[]="El usuario se editó correctamente";
	        }                     
        } else {
          /*si el password no conincide, entonces se muestra el mensaje de error*/
          $errors[]="El password no coincide";
        }
        //mensaje success
      if(isset($messages)){
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			} //fin success

        //mensaje error
      if(isset($errors)){
  			?>
  				<div class="alert alert-danger" role="alert">
  					<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Error!</strong> 
  						<?php
  							foreach($errors as $error) {
  									echo $error;
  								}
  							?>
  				</div>
  			<?php
			} //fin mensaje error
      break;
    case "mostrar":
      //selecciona el id del usuario
    
        //el parametro id_usuario se envia por AJAX cuando se edita el usuario
      $datos = $usuarios->get_usuario_por_id($_POST["id_usuario"]);
        //validacion del id del usuario  
        if(is_array($datos)==true and count($datos)>0){
        	foreach($datos as $row){  
            $output["cedula"] = $row["cedula"];
            $output["nombre"] = $row["nombres"];
            $output["apellido"] = $row["apellidos"];
            $output["cargo"] = $row["cargo"];
            $output["usuario"] = $row["usuario"];
            $output["password1"] = $row["password"];
            $output["password2"] = $row["password2"];
            $output["telefono"] = $row["telefono"];
            $output["correo"] = $row["correo"];
            $output["direccion"] = $row["direccion"];
            $output["estado"] = $row["estado"];
          }
             	 echo json_encode($output);

        } else {
            //si no existe el registro entonces no recorre el array
          $errors[]="El usuario no existe";
        }

	     //inicio de mensaje de error
				if(isset($errors)){
					?>
					<div class="alert alert-danger" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Error!</strong> 
							<?php
								foreach($errors as $error) {
									echo $error;
								}
							?>
					</div>
					<?php
			  }

	        //fin de mensaje de error

      break;
    case "activarydesactivar":
      //los parametros id_usuario y est vienen por via ajax
      $datos = $usuarios->get_usuario_por_id($_POST["id_usuario"]);
                
        //valida el id del usuario
        if(is_array($datos)==true and count($datos)>0){
          //edita el estado del usuario 
          $usuarios->editar_estado($_POST["id_usuario"],$_POST["est"]);
        }
      break;
    case "listar":
          
      $datos = $usuarios->get_usuarios();

      //declaramos el array

      $data = Array();
      
      foreach($datos as $row){
            
        $sub_array= array();

          //ESTADO
	      $est = '';
	       
	      $atrib = "btn btn-success btn-md estado";
	      if($row["estado"] == 0){
	        $est = 'INACTIVO';
	        $atrib = "btn btn-warning btn-md estado";
	      } else {
	        if($row["estado"] == 1){
	          $est = 'ACTIVO';	            
	        } 
	      }

          //cargo
        if($row["cargo"]==1){
          $cargo="ADMINISTRADOR";
        } else {
          if($row["cargo"]==0){
            $cargo="EMPLEADO";
          }
        }

	      $sub_array[]= $row["cedula"];
	      $sub_array[] = $row["nombres"];
        $sub_array[] = $row["apellidos"];
        $sub_array[] = $row["usuario"];
        $sub_array[] = $cargo;
        $sub_array[] = $row["telefono"];
        $sub_array[] = $row["correo"];
        $sub_array[] = $row["direccion"];
        $sub_array[] = date("d-m-Y",strtotime($row["fecha_ingreso"]));

        $sub_array[] = '<button type="button" onClick="cambiarEstado('.$row["id_usuario"].','.$row["estado"].');" name="estado" id="'.$row["id_usuario"].'" class="'.$atrib.'">'.$est.'</button>';
        $sub_array[] = '<button type="button" onClick="mostrar('.$row["id_usuario"].');"  id="'.$row["id_usuario"].'" class="btn btn-warning btn-md update"><i class="glyphicon glyphicon-edit"></i> Editar</button>';
        $sub_array[] = '<button type="button" onClick="eliminar('.$row["id_usuario"].');"  id="'.$row["id_usuario"].'" class="btn btn-danger btn-md"><i class="glyphicon glyphicon-edit"></i> Eliminar</button>';             
        
	      $data[]=$sub_array;    
      }

      $results= array(	

      "sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
         echo json_encode($results);
      break;
    }
?>