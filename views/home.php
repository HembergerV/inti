
<?php
  require_once("../config/conexion.php");
  if(isset($_SESSION["correo"])){
?>

  <?php 
    require_once("header.php");
  ?>
      <!--___________________________CONTENIDO______________________________-->
      <!-- Content Wrapper. Contains page content -->
      
      <!-- /.content-wrapper -->
      <!--___________________________CONTENIDO______________________________-->

  <?php 
    require_once("footer.php");
  ?>

<?php
  } else {
    header("Location:".Conectar::ruta()."views/index.php");
    exit();
  }
?>
