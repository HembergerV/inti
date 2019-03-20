<?php 
	require_once("../config/conexion.php");

	if(isset($_POST["enviar"]) and $_POST["enviar"]=="si"){

       require_once("../modelos/Usuarios.php");
       $usuario = new Usuarios();
       $usuario->login();
    }
?>


<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>inTi</title>
	<!-- Viewport para el Responsive design (Adaptable a Dispositivos moviles y tables) -->
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<!-- Normalize funciona como un reset para que se vea igual en cualquier navegador -->
	<link rel="stylesheet" href="../public/login/normalize.css" />
	<!-- Normalize funciona como un reset para que se vea igual en cualquier navegador -->
	<link rel="stylesheet" href="../public/login/fondo.css" />
	<link rel="stylesheet" href="../public/login/css/estilos.css" />
	<!---------------- Estas Son Las Fuentes ------------------>
	<link rel="stylesheet" href="../public/login/css/fontawesome-all.css">
	<link href="https://fonts.googleapis.com/css?family=Lobster+Two" rel="stylesheet"> <!-- font-family: 'Lobster Two', cursive; -->
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">  <!-- font-family: 'Oswald', sans-serif; -->
	<link href="https://fonts.googleapis.com/css?family=Cormorant" rel="stylesheet">  <!-- font-family: 'Cormorant', serif; -->
	<link href="https://fonts.googleapis.com/css?family=KoHo" rel="stylesheet">   <!-- font-family: 'KoHo', sans-serif; -->
	<!-- bootstrap 4.3.1 -->
	<link rel="stylesheet" href="../public/plugins/bootstrap/css/bootstrap.min.css">
	<!-- Fon-Awesome -->
	<!-- <link rel="stylesheet" href="./public/plugins/font-awesome/css/all.css"> -->
	<!---------------------- Favicon -------------------------->
	<link rel="icon" type="text/css" href="../public/login/img/logointi.png">
	<!--------------------- JavaScrip ------------------------->
	<script src="../public/login/js/pantallas.js"></script>
	<!-- <script src="../public/login/js/validacion.js"></script> -->
	<!-- <script src="js/formulario.js"></script> -->

</head>
<body>
<!---------------------------- Aqui Inicia El Fondo Slide ---------------------------->
	<div class="Principal">
		<div class="fondo">

			<ul class="slider">
				<li class="img1"></li>
				<li class="img2"></li>
				<li class="img3"></li>
			</ul>
		</div>
	 
<!------------------------------ Aqui Inicia El Banner ------------------------------>
		<div class="banner">
			<img src="../public/login/img/cintillo.jpg"> 
		</div>

		<?php
            if(isset($_GET["m"])) {
           		switch($_GET["m"]){
               		case "1";
	               		?>
	               		<div class="alert alert-danger alert-dismissible">
	                      	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                      	<h4><i class="icon fa fa-ban"></i> El correo y/o password es incorrecto o no tienes permiso!</h4>
	                	</div>
	                	<?php
	                	break;
                	case "2";
                		?>
                    	<div class="alert alert-danger alert-dismissible">
                      		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      		<h4><i class="icon fa fa-ban"></i> Los campos estan vacios</h4>         
		                </div>
		                <?php
		                break;
				}
         	}
        ?>

<!------------------------------------ Login ---------------------------------------->
		<div class="logo">
			<img src="../public/login/img/logointi.png" alt="" id="logooo">
		</div>
		<div class="login" id="login">

			<form action="" method="POST" id="formulario">
				<div class="usuario">
					<label>Correo: </label>
					<div class="group">
						<i class="fas fa-user"></i>
        				<input type="email" name="correo" id="correo" class="form-control" placeholder="Email" >
					</div>
				</div>
				<div class="usuario">
					<label>Contraseña: </label>
					<div class="group">
						<i class="fas fa-unlock"></i>
						<input type="password" name="password" id="password" class="form-control" placeholder="Password">
					</div>
				</div>
				<div class="usuario">
					<ul class="error" id="error"></ul>
				</div>
				<input type="hidden" name="enviar" class="form-control" value="si">

				<div class="forgot">
					<!-- <p><input type="checkbox" checked="checked" class="css-checkbox" id="check">Guardar Contraseña</p>
					<!-- <ul class="error" id="error"></ul>-->					
					<button type="submit" id="enviar"><i class="fas fa-sign-in-alt"></i>Entrar</button>
					<!-- <a href="iforget.html"><i class="fas fa-lock">Olvido Contraseña?</i></a><a href="recover.html"><i class="fas fa-unlock">Cambiar Contraseña</i></a> -->
				</div>
			</form>
		</div>
	</div>

	<!-- bootstrap 4.3.1 -->
	<script src="../public/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="../public/dist/js/plugins/bootstrap/js/bootstrap.min.js"></script>

	<!-- Font-Awesome -->
	<!-- <script src="../public/plugins/font-awesome/js/all.js"></script> -->
</body>
</html>