<?php

  //conexion a la base de datos

  require_once("../config/conexion.php");
    class Usuario extends Conectar {
      
      public function login(){
        $conectar=parent::conexion();
        parent::set_names();
        if(isset($_POST["enviar"])){
          //INICIO DE VALIDACIONES
          $password = $_POST["password"];
          $email = $_POST["email"];
          $estatus = "1";
          if(empty($email) and empty($password)){
            header("Location:".Conectar::ruta()."views/index.php?m=2");
            exit();
          // } else if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){12,15}$/", $password)) {
          //   header("Location:".Conectar::ruta()."views/index.php?m=1");
          //   exit();
          } else {
            
            $sql= "select * from usuario where email=? and password=? and estatus=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $email);
            $sql->bindValue(2, $password);
            $sql->bindValue(3, $estatus);
            $sql->execute();
            $resultado = $sql->fetch();
            //si existe el registro entonces se conecta en session
            if(is_array($resultado) and count($resultado)>0){
              /*IMPORTANTE: la session guarda los valores de los campos de la tabla de la bd*/
              $_SESSION["idusuario"] = $resultado["idusuario"];
              $_SESSION["email"] = $resultado["email"];
              $_SESSION["cedula"] = $resultado["cedula"];
              $_SESSION["nombre"] = $resultado["nombre"];
              header("Location:".Conectar::ruta()."views/home.php");
              exit();
            } else {                          
              //si no existe el registro entonces le aparece un mensaje
              header("Location:".Conectar::ruta()."views/index.php?m=1");
              exit();
            } 
          }//cierre del else
        }//condicion enviar
        print_r($_POST);
      }

      //listar los usuario
   	  public function get_usuario(){

 	    	$conectar=parent::conexion();
 	    	parent::set_names();

 	    	$sql="select * from usuario";

 	    	$sql=$conectar->prepare($sql);
 	    	$sql->execute();

 	    	return $resultado=$sql->fetchAll();
   	  }

      //metodo para registrar usuario
   	  public function registrar_usuario($nombre,$apellido,$nacionalidad,$cedula,$fechanacimiento,$telefono,$email,$direccion,$fechaingreso,$coddpto,$cargo,$usuario,$password,$password2,$estatus){

        $conectar=parent::conexion();
        parent::set_names();

        $sql="insert into usuario 
        values(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";

        $sql=$conectar->prepare($sql);

        $sql->bindValue(1, $_POST["nombre"]);
        $sql->bindValue(2, $_POST["apellido"]);
        $sql->bindValue(3, $_POST["nacionalidad"]);
        $sql->bindValue(4, $_POST["cedula"]);
        $sql->bindValue(5, $_POST["fechanacimiento"]);
        $sql->bindValue(6, $_POST["telefono"]);
        $sql->bindValue(7, $_POST["email"]);
        $sql->bindValue(8, $_POST["direccion"]);
        $sql->bindValue(9, $_POST["fechaingreso"]);
        $sql->bindValue(10, $_POST["coddpto"]);
        $sql->bindValue(11, $_POST["cargo"]);
        $sql->bindValue(12, $_POST["usuario"]);
        $sql->bindValue(13, $_POST["password"]);
        $sql->bindValue(14, $_POST["password2"]);
        $sql->bindValue(15, $_POST["estatus"]);
        $sql->execute();
   	  }

      //metodo para editar usuario
   	  public function editar_usuario($idusuario,$nombre,$apellido,$nacionalidad,$cedula,$fechanacimiento,$telefono,$email,$direccion,$fechaingreso,$coddpto,$cargo,$usuario,$password,$password2,$estatus){

        $conectar=parent::conexion();
        parent::set_names();

        $sql="update usuario set 

        nombre=?,
        apellido=?,
        nacionalidad=?,
        cedula=?,
        fechanacimiento=?,
        telefono=?,
        email=?,
        direccion=?,
        fechaingreso=?,
        coddpto=?,
        cargo=?,
        usuario=?,
        password=?,
        password2=?,
        estatus = ?

        where 
        idusuario=?

       ";
        //echo $sql;
        $sql=$conectar->prepare($sql);

         $sql->bindValue(1, $_POST["nombre"]);
        $sql->bindValue(2, $_POST["apellido"]);
        $sql->bindValue(3, $_POST["nacionalidad"]);
        $sql->bindValue(4, $_POST["cedula"]);
        $sql->bindValue(5, $_POST["fechanacimiento"]);
        $sql->bindValue(6, $_POST["telefono"]);
        $sql->bindValue(7, $_POST["email"]);
        $sql->bindValue(8, $_POST["direccion"]);
        $sql->bindValue(9, $_POST["fechaingreso"]);
        $sql->bindValue(10, $_POST["coddpto"]);
        $sql->bindValue(11, $_POST["cargo"]);
        $sql->bindValue(12, $_POST["usuario"]);
        $sql->bindValue(13, $_POST["password"]);
        $sql->bindValue(14, $_POST["password2"]);
        $sql->bindValue(15, $_POST["estatus"]);
        $sql->bindValue(16,$_POST["idusuario"]);
        $sql->execute();

        //print_r($_POST);
   	  }

      //mostrar los datos del usuario por el id
	    public function get_usuario_por_id($idusuario){
          
        $conectar=parent::conexion();
        parent::set_names();

        $sql="select * from usuario where idusuario=?";

        $sql=$conectar->prepare($sql);

        $sql->bindValue(1, $idusuario);
        $sql->execute();

        return $resultado=$sql->fetchAll();
 	    }

 	    //editar el estatus del usuario, activar y desactiva el estatus
	    public function editar_estatus($idusuario,$estatus){

 	    	$conectar=parent::conexion();
 	    	parent::set_names();

          //el parametro est se envia por via ajax
 	    	if($_POST["est"]=="0"){

 	    		$estatus=1;

 	    	} else {

 	    		$estatus=0;
 	    	}

 	    	$sql="update usuario set 
          
          estatus=?

          where 
          idusuario=?
 	    	";

 	    	$sql=$conectar->prepare($sql);

 	    	$sql->bindValue(1,$estatus);
 	    	$sql->bindValue(2,$idusuario);
 	    	$sql->execute();
 	    }

   	  //valida email y cedula del usuario
   	  public function get_cedula_email_del_usuario($cedula,$email){
          
        $conectar=parent::conexion();
        parent::set_names();

        $sql="select * from usuario where cedula=? or email=?";

        $sql=$conectar->prepare($sql);

        $sql->bindValue(1, $cedula);
        $sql->bindValue(2, $email);
        $sql->execute();

        return $resultado=$sql->fetchAll();
   	  }

      //método para eliminar un registro
      public function eliminar_usuario($idusuario){
        $conectar=parent::conexion();
         
        $sql="delete from usuario where idusuario=?";

        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$idusuario);
        $sql->execute();

        return $resultado=$sql->fetch();
      }
   }



?>