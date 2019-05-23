<?php
  require_once("../config/conexion.php");
  if(isset($_SESSION["email"])){
?>

<?php
  require_once("header.php");
?>
    <!--___________________________CONTENIDO______________________________-->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Lista Usuario</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">Inicio</li>
                <li class="breadcrumb-item active">Usuarios</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
        <div id="resultados_ajax"></div>
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-success card-outline p-2">
                <div class="card-header with-border">
                  <h1 class="box-title">
                  <button class="btn btn-success" id="add_button" onclick="limpiar()" data-toggle="modal" data-target="#usuarioModal"> Agregar </button></h1>
                  <div class="box-tools pull-right">
                  </div>
                </div>
                <!-- /.box-header -->
                <!-- centro -->
                <div class="card-body table-responsive">
                  <table id="usuario_data" class="table table-sm table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>N</th>
                        <th>Cédula</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Fecha Nacimiento</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Dirección</th>
                        <th>Fecha Ingreso</th>
                        <th>Dpto</th>
                        <th>Cargo</th>
                        <th>Usuario</th>
                        <!-- <th>Fecha Ingreso</th> -->
                        <th>Estatus</th>
                        <th width="10%">Editar</th>
                        <th width="10%">Borrar</th>
                      </tr>
                    </thead>
                    <tbody>
                            
                    </tbody>
                  </table>
                </div><!--Fin centro -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div>
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <!--Fin-Contenido-->
    
    <!--FORMULARIO VENTANA MODAL-->
    <div id="usuarioModal" class="modal fade">
      <div class="modal-dialog modal-dialog-scrollable">
        <form method="post" id="usuario_form">
          <div class="modal-content card-success card-outline">
            <div class="modal-header">
              <h4 class="modal-title">Agregar Usuarios</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>           
            </div>
            <div class="modal-body">
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="nombre">Nombre</label>
                  <div class="input-group ">
                    <input type="text" class="form-control" id="nombre" placeholder="Nombre" autofocus>
                  </div>
                </div>
                <div class="form-group col-md-4">
                  <label for="apellido">Apellido</label>
                  <input type="text" class="form-control" id="apellido" placeholder="Apellido">
                </div>
                <div class="form-group col-md-4">
                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <label for="nacionalidad">&nbsp;</label>
                      <select id="nacionalidad" class="form-control"  >
                        <option selected >V</option>
                        <option>E</option>
                      </select>
                    </div>
                    <div class="form-group col-md-9">
                      <label for="cedula">Cédula</label>
                      <input type="number" class="form-control" id="cedula" placeholder="Cédula">
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="fechaNac">Fecha Nacimiento</label>
                  <input type="date" class="form-control" id="fechaNac" placeholder="Fecha">
                </div>
                <div class="form-group col-md-4">
                  <label>Teléfono</label>
                  <input type="text" name="telefono" id="telefono" class="form-control" placeholder="04xx - xxxxxxx" required/>
                </div>
                <div class="form-group col-md-4">
                  <label>Email</label>
                  <input type="email" name="email" id="email" class="form-control" placeholder="nombre@ejemplo.com" required pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$"/>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="fechaNac">Fecha Ingreso</label>
                  <input type="date" class="form-control" id="fechaNac" placeholder="Fecha">
                </div>
                <div class="form-group col-md-4">
                  <div class="form-row">
                    <div class="form-group col-md-12">
                      <label for="">Departamento</label>
                      <select id="" class="form-control"  >
                        <option selected >...</option>
                        <option>...</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group col-md-4">
                  <div class="form-row">
                    <div class="form-group col-md-12">
                      <label for="">Cargo</label>
                      <select id="" class="form-control"  >
                        <option selected >...</option>
                        <option>...</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label>Cédula</label>
                  <input type="text" name="cedula" id="cedula" class="form-control" placeholder="Cédula" required pattern="[0-9]{0,15}"/>
                </div>
                <div class="col-md-6 mb-3">
                  <label>Cargo</label>
                  <select class="form-control" id="cargo" name="cargo" required>
                    <option value="">-- Selecciona cargo --</option>
                    <option value="1" selected>Administrador</option>
                    <option value="0">Empleado</option>
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label>Usuario</label>
                  <div class="input-group ">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-user"></i></span>
                    </div>
                    <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario" required pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$"/>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label>Clave</label>
                  <input type="password" name="password1" id="password1" class="form-control" placeholder="Clave" required/>
                </div>
                <div class="col-md-6 mb-3">
                  <label>Repita Clave</label>
                  <input type="password" name="password2" id="password2" class="form-control" placeholder="Repita Clave" required/>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label>Teléfono</label>
                  <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Teléfono" required pattern="[0-9]{0,15}"/>
                </div>
                 <div class="col-md-6 mb-3">
                  <label>Correo</label>
                  <input type="email" name="email" id="email" class="form-control" placeholder="Correo" required="required"/>
                </div>
              </div>       
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label>Dirección</label>
                  <textarea cols="90" rows="2" id="direccion" name="direccion"  placeholder="Direccion ..." required pattern="^[a-zA-Z0-9_áéíóúñ°\s]{0,200}$"></textarea> 
                </div>
              </div>                     
            </div>
            <div class="modal-footer">
              <input type="hidden" name="idusuario" id="idusuario"/>
              <button type="submit" name="action" id="btnGuardar" class="btn btn-success pull-left" value="Add">Guardar <i class="fas fa-user-check"></i></button>         
              <button type="button" onclick="limpiar()" class="btn btn-danger" data-dismiss="modal">Cerrar <i class="fa fa-times" aria-hidden="true"></i></button>  
            </div>
          </div>
        </form>
      </div>
    </div>
<?php
  require_once("footer.php");
?>
<script type="text/javascript" src="js/usuarios.js"></script>

<?php
  } else {
    header("Location:".Conectar::ruta()."views/index.php");
    exit();
  }
?>