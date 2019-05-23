<?php
  require_once("../config/conexion.php");
  if(isset($_SESSION["correo"])){
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
              <h1>Listado de Usuarios</h1>
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
                  <button class="btn btn-success" id="add_button" onclick="limpiar()" data-toggle="modal" data-target="#usuarioModal"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo Usuario</button></h1>
                  <div class="box-tools pull-right">
                  </div>
                </div>
                <!-- /.box-header -->
                <!-- centro -->
                <div class="card-body table-responsive">
                  <table id="usuario_data" class="table table-sm table-bordered table-striped">
                    <thead>                              
                      <tr>                           
                        <th>Cédula</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Usuario</th>
                        <th>Cargo</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Dirección</th>
                        <!-- <th>Fecha Ingreso</th> -->
                        <th>Estado</th>
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
              <h4 class="modal-title">Agregar Usuario</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>           
            </div>
            <div class="modal-body">
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label>Nombres</label>
                  <input type="text" maxlength="25" minlength=2 name="nombre" onkeypress="return cadenaText(event)" autocomplete="off" id="nombre" class="form-control" placeholder="Ingrese valores alfabéticos" required pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$"/>
                </div>
                <div class="col-md-6 mb-3">
                  <label>Apellidos</label>
                  <input type="text" autocomplete="off" maxlength="25" minlength=2 onkeypress="return cadenaText(event)" name="apellido" id="apellido" class="form-control" placeholder="Ingrese valores alfabéticos" required pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$"/>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label>Cédula</label>
                  <input type="text" maxlength="10" minlength="8" autocomplete="off" name="cedula" id="cedula" class="form-control" placeholder="Inicia con V o E"/>
                </div>
                <div class="col-md-6 mb-3">
                  <label>Cargo</label>
                  <select class="form-control" id="cargo" name="cargo" required>
                    <option value=""> Selecciona cargo </option>
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
                    <input  type="text" maxlength="15" name="usuario" id="usuario" class="form-control" placeholder="Usuario" required />
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label>Estado</label>
                  <select class="form-control" id="estado" name="estado" required>
                    <option value=""> Selecciona estado </option>
                    <option value="1" selected>Activo</option>
                    <option value="0">Inactivo</option>
                  </select>    
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label>Clave</label>
                  <input type="password" name="password1" id="password1" class="form-control" placeholder="Ingrese clave" required/>
                </div>
                <div class="col-md-6 mb-3">
                  <label>Repita Clave</label>
                  <input type="password" name="password2" id="password2" class="form-control" placeholder="Repita Clave" required/>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label>Teléfono</label>
                  <input autocomplete="off" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" maxlength="12" type="tel" name="telefono" id="telefono" class="form-control" placeholder="Ingrese solo números" required />
                </div>
                 <div class="col-md-6 mb-3">
                  <label>Correo</label>
                  <input type="email" name="email" id="email" class="form-control" placeholder="Correo electrónico" required="required"/>
                </div>
              </div>       
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label>Dirección</label>
                  <textarea style="resize:none; padding:5px 13px" maxlength=100 minlength=5 cols="90" rows="2" id="direccion" name="direccion"  placeholder="Ingrese dirección" required pattern="^[a-zA-Z0-9_áéíóúñ°\s]{0,200}$"></textarea> 
                </div>
              </div>                     
            </div>
            <div class="modal-footer">
              <input type="hidden" name="id_usuario" id="id_usuario"/>
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
<script type="text/javascript" src="js/validaciones.js"></script>

<?php
  } else {
    header("Location:".Conectar::ruta()."views/index.php");
    exit();
  }
?>