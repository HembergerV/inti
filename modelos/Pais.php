<?php

  //conexion a la base de datos

  require_once("../config/conexion.php");
    class Usuarios extends Conectar {
      
      public function login(){
        $conectar=parent::conexion();
        parent::set_names();
        if(isset($_POST["enviar"])){
          //INICIO DE VALIDACIONES
          $password = $_POST["password"];
          $correo = $_POST["correo"];
          $estado = "1";
          if(empty($correo) and empty($password)){
            header("Location:".Conectar::ruta()."views/index.php?m=2");
            exit();
          // } else if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){12,15}$/", $password)) {
          //   header("Location:".Conectar::ruta()."views/index.php?m=1");
          //   exit();
          } else {
            
            $sql= "select * from usuarios where correo=? and password=? and estado=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $correo);
            $sql->bindValue(2, $password);
            $sql->bindValue(3, $estado);
            $sql->execute();
            $resultado = $sql->fetch();
            //si existe el registro entonces se conecta en session
            if(is_array($resultado) and count($resultado)>0){
              /*IMPORTANTE: la session guarda los valores de los campos de la tabla de la bd*/
              $_SESSION["id_usuario"] = $resultado["id_usuario"];
              $_SESSION["correo"] = $resultado["correo"];
              $_SESSION["cedula"] = $resultado["cedula"];
              $_SESSION["nombre"] = $resultado["nombres"];
              header("Location:".Conectar::ruta()."views/home.php");
              exit();
            } else {                          
              //si no existe el registro entonces le aparece un mensaje
              header("Location:".Conectar::ruta()."views/index.php?m=1");
              exit();
            } 
          }//cierre del else
        }//condicion enviar
      }

      //listar los usuarios
   	  public function get_pais(){

 	    	$conectar=parent::conexion();
 	    	parent::set_names();

 	    	$sql="select * from pais";

 	    	$sql=$conectar->prepare($sql);
 	    	$sql->execute();

 	    	return $resultado=$sql->fetchAll();
   	  }

   	  public function registrar_pais($nombre,$estatus){

        $conectar=parent::conexion();
        parent::set_names();

        $sql="insert into pais 
        values(null,?,?);";

        $sql=$conectar->prepare($sql);

        $sql->bindValue(1, $_POST["nombre"]);
        $sql->bindValue(2, $_POST["estatus"]);
        $sql->execute();
   	  }

   	  public function editar_pais($codpais,$nombre,$estatus){

        $conectar=parent::conexion();
        parent::set_names();

        $sql="update pais set 

        nombre=?,
        estatus = ?

        where 
        codpais=? ";
        //echo $sql;
        $sql=$conectar->prepare($sql);

        $sql->bindValue(1,$_POST["nombre"]);
        $sql->bindValue(2,$_POST["estatus"]);
        $sql->bindValue(3,$_POST["codpais"]);
        $sql->execute();

        //print_r($_POST);
   	  }

	    public function get_pais_por_id($codpais){
          
        $conectar=parent::conexion();
        parent::set_names();

        $sql="select * from pais where codpais=?";

        $sql=$conectar->prepare($sql);

        $sql->bindValue(1, $codpais);
        $sql->execute();

        return $resultado=$sql->fetchAll();
 	    }

	    public function editar_estatus($codpais,$estatus){

 	    	$conectar=parent::conexion();
 	    	parent::set_names();

          //el parametro est se envia por via ajax
 	    	if($_POST["est"]=="0"){

 	    		$estado=1;

 	    	} else {

 	    		$estado=0;
 	    	}

 	    	$sql="update pais set 
          
          estatus=?

          where 
          codpais=?
 	    	";

 	    	$sql=$conectar->prepare($sql);

 	    	$sql->bindValue(1,$estatus);
 	    	$sql->bindValue(2,$codpais);
 	    	$sql->execute();
 	    }

      public function eliminar_pais($codpais){
        $conectar=parent::conexion();
         
        $sql="delete from pais where codpais=?";

        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$codpais);
        $sql->execute();

        return $resultado=$sql->fetch();
      }
   }



?>