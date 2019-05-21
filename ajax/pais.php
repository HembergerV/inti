<?php

  //llamar a la conexion de la base de datos
  require_once("../config/conexion.php");
  //llamar a el modelo Usuarios 
  require_once("../modelos/Pais.php");

  $pais = new Pais();

  //declaramos las variables de los valores que se envian por el formulario y que recibimos por ajax y decimos que si existe el parametro que estamos recibiendo

  $codpais = isset($_POST["codpais"]);
  $nombre=isset($_POST["nombre"]);
  $estado=isset($_POST["estatus"]);

  switch($_GET["op"]){
    case "guardaryeditar":
      $datos = $usuarios->get_pais($_POST["cedula"],$_POST["email"]);
      if(empty($_POST["codpais"])){
        if(is_array($datos)==true and count($datos)==0){
          $pais->registrar_pais($nombre,$estatus);
          $messages[]="El pais se registró correctamente";

        } else {
          $messages[]="El Pais ya existe";
        }                     
      } //cierre de la validacion empty
        else {
          $pais->editar_pais($codpais,$nombre,$estatus);
          $messages[]="El Pais se editó correctamente";
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
      $datos = $pais->get_pais_por_id($_POST["codpais"]);
        //validacion del id del usuario  
      if(is_array($datos)==true and count($datos)>0){
        foreach($datos as $row){  
          $output["nombre"] = $row["nombres"];
          $output["estatus"] = $row["estatus"];
          }

          echo json_encode($output);

      } else {
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
      //los parametros id_usuario y est vienen por via ajax
      $datos = $pais->get_pais_por_id($_POST["codpais"]);          
        //valida el id del usuario
      if(is_array($datos)==true and count($datos)>0){              
        $usuarios->editar_estatus($_POST["codpais"],$_POST["est"]);
      }
      break;

    case "listar":
      $datos = $pais->get_pais();
      //declaramos el array
      $data = Array();
      foreach($datos as $row){
        $sub_array= array();
        //ESTADO
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

        $sub_array[] = $row["nombres"];

        $sub_array[] = '<button type="button" onClick="cambiarEstado('.$row["codpais"].','.$row["estado"].');" name="estado" id="'.$row["codpais"].'" class="btn-sm '.$atrib.'">'.$est.'</button>';

        $sub_array[] = '<button type="button" onClick="mostrar('.$row["codpais"].');"  id="'.$row["codpais"].'" class="btn btn-warning btn-sm update">.  <i class="fas fa-user-edit"></i> .</button>';

        $sub_array[] = '<button type="button" onClick="eliminar('.$row["codpais"].');"  id="'.$row["codpais"].'" class="btn btn-danger btn-sm">. <i class="fas fa-user-times"></i> .</button>';
        
        $data[]=$sub_array;    
      }

      $results= array( 

        "sEcho"=>1, //Información para el datatables
        "iTotalRecords"=>count($data), //enviamos el total registros al datatable
        "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
        "aaData"=>$data);
        echo json_encode($results);
      break;

    case "eliminar_pais":

      $datos = $usuarios->get_pais_por_id($_POST["codpais"]);
        
      if(is_array($datos)==true and count($datos)>0){
        $usuarios->eliminar_pais($_POST["codpais"]);
        $messages[]="El pais se eliminó exitosamente";
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