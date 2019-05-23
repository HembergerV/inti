<?php

  //llamar a la conexion de la base de datos
  require_once("../config/conexion.php");
  //llamar a el modelo Usuarios 
  require_once("../modelos/Usuarios.php");

  $usuarios = new Usuario();

  //declaramos las variables de los valores que se envian por el formulario y que recibimos por ajax y decimos que si existe el parametro que estamos recibiendo

  $idusuario = isset($_POST["idusuario"]);
  $nombre=isset($_POST["nombre"]);
  $apellido=isset($_POST["apellido"]);
  $nacionalidad=isset($_POST["nacionalidad"]);
  $cedula=isset($_POST["cedula"]);
  $fechanacimiento=isset($_POST["fechanacimiento"]);
  $telefono=isset($_POST["telefono"]);
  $email=isset($_POST["email"]);
  $direccion=isset($_POST["direccion"]);
  $fechaingreso=isset($_POST["fechaingreso"]);
  $coddpto=isset($_POST["coddpto"]);
  $cargo=isset($_POST["cargo"]);
  $usuario=isset($_POST["usuario"]);
  $password=isset($_POST["password"]);
  $password2=isset($_POST["password2"]);
  //este es el que se envia del formulario
  $estatus=isset($_POST["estatus"]);

  switch($_GET["op"]){
    case "guardaryeditar":
      /*verificamos si existe la cedula y correo en la base de datos, si ya existe un registro con la cedula o correo entonces no se registra el usuario*/
      $datos = $usuarios->get_cedula_correo_del_usuario($_POST["cedula"],$_POST["email"]);             
      //validacion de password
      if($password == $password2){
        //si el id no existe entonces lo registra importante: se debe poner el $_POST sino no funciona
        if(empty($_POST["idusuario"])){
          /*si coincide password y password2 entonces verificamos si existe la cedula y correo en la base de datos, si ya existe un registro con la cedula o correo entonces no se registra el usuario*/
          if(is_array($datos)==true and count($datos)==0){
            //no existe el usuario por lo tanto hacemos el registros
            $usuarios->registrar_usuario($nombre,$apellido,$nacionalidad,$cedula,$fechanacimiento,$telefono,$email,$direccion,$fechaingreso,$coddpto,$cargo,$usuario,$password,$password2,$estatus);
            $messages[]="El usuario se registró correctamente";
              /*si ya exista el correo y la cedula entonces aparece el mensaje*/

	        } else {
            $messages[]="La cédula o el correo ya existe";
	        }                     
	      } //cierre de la validacion empty
	        else {

            /*si ya existe entonces editamos el usuario*/
            $usuarios->editar_usuario($idusuario,$nombre,$apellido,$nacionalidad,$cedula,$fechanacimiento,$telefono,$email,$direccion,$fechaingreso,$coddpto,$cargo,$usuario,$password,$password2,$estatus);
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
  		}//fin success

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
  			}//fin mensaje error
          break;

    case "mostrar":
      //selecciona el id del usuario
      //el parametro idusuario se envia por AJAX cuando se edita el usuario
      $datos = $usuarios->get_usuario_por_id($_POST["idusuario"]);
        //validacion del id del usuario  
      if(is_array($datos)==true and count($datos)>0){
        foreach($datos as $row){
          $output["nacionalidad"] = $row["nacionalidad"];
          $output["cedula"] = $row["cedula"];
          $output["nombre"] = $row["nombre"];
          $output["apellido"] = $row["apellido"];
          $output["telefono"] = $row["telefono"];
          $output["correo"] = $row["correo"];
          $output["direccion"] = $row["direccion"];
          $output["fechaingreso"] = $row["fechaingreso"];
          $output["coddpto"] = $row["coddpto"];
          $output["cargo"] = $row["cargo"];
          $output["usuario"] = $row["usuario"];
          $output["password"] = $row["password"];
          $output["password2"] = $row["password2"];
          $output["estatus"] = $row["estatus"];
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
			}//fin de mensaje de error

      break;

    case "activarydesactivar":
      //los parametros idusuario y est vienen por via ajax
      $datos = $usuarios->get_usuario_por_id($_POST["idusuario"]);          
        //valida el id del usuario
      if(is_array($datos)==true and count($datos)>0){              
        //edita el estatus del usuario 
        $usuarios->editar_estatus($_POST["idusuario"],$_POST["est"]);
      }
      break;

    case "listar":
      $datos = $usuarios->get_usuarios();
      //declaramos el array
      $data = Array();
      foreach($datos as $row){
        $sub_array= array();
        //estatus
        $est = '';
        $atrib = "btn btn-success btn-md estatus";
        if($row["estatus"] == 0){
          $est = 'Inactivo';
          $atrib = "btn btn-warning btn-md estatus";
        } else{
          if($row["estatus"] == 1){
            $est = 'Activo';
          } 
        }
        //cargo
        if($row["cargo"]==1){
          $cargo="Administrador";
        } else{
          if($row["cargo"]==0){ 
            $cargo="Empleado";
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
        // $sub_array[] = date("d-m-Y",strtotime($row["fecha_ingreso"]));
   
        $sub_array[] = '<button type="button" onClick="cambiarEstatus('.$row["idusuario"].','.$row["estatus"].');" name="estatus" id="'.$row["idusuario"].'" class="btn-sm '.$atrib.'">'.$est.'</button>';

        $sub_array[] = '<button type="button" onClick="mostrar('.$row["idusuario"].');"  id="'.$row["idusuario"].'" class="btn btn-warning btn-sm update">.  <i class="fas fa-user-edit"></i> .</button>';

        $sub_array[] = '<button type="button" onClick="eliminar('.$row["idusuario"].');"  id="'.$row["idusuario"].'" class="btn btn-danger btn-sm">. <i class="fas fa-user-times"></i> .</button>';
        
        $data[]=$sub_array;    
      }

      $results= array( 

        "sEcho"=>1, //Información para el datatables
        "iTotalRecords"=>count($data), //enviamos el total registros al datatable
        "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
        "aaData"=>$data);
        echo json_encode($results);
      break;

    case "eliminar_usuario":

      $datos = $usuarios->get_usuario_por_id($_POST["idusuario"]);
        
      if(is_array($datos)==true and count($datos)>0){
        $usuarios->eliminar_usuario($_POST["idusuario"]);
        $messages[]="El usuario se eliminó exitosamente";
      }   
      
      //prueba mensaje de success
      if (isset($messages)){
        ?>
        <div class="alert alert-success" role="alert">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>¡Bien hecho!</strong>
          <?php
            foreach ($messages as $message) {
                echo $message;
              }
            ?>
        </div>
        <?php
      }//fin mensaje success

      //inicio de mensaje de error

      if(isset($errors)){
        ?>
        <div class="alert alert-danger" role="alert">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Error!</strong> 
            <?php
              foreach ($errors as $error) {
                  echo $error;
                }
              ?>
        </div>
        <?php
      }//fin de mensaje de error

      break;
  }
?>