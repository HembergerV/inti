
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
              <h1>Registro Visita</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">Inicio</li>
                <li class="breadcrumb-item active">Citas</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content center">
        <div id="esultados_ajax2"></div>
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8 offset-md-2">
              <div class="card card-success card-outline p-2">
                <div class="card-header with-border">
                  <h1 class="box-title">
                  <button class="btn btn-success" id="add_button" onclick="limpiar()" data-toggle="modal" data-target="#ciudadanoModal1"><i class="fas fa-search"></i>Seleccionar Ciudadano</button></h1>
                  <div class="box-tools pull-right">
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="card-body table-responsive">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <h6>Departamento</h6>
                        <select class="form-control select2" style="width: 100%;">
                          <option selected="selected">Selecciona...</option>
                          <option>Registro agrario</option>
                          <option>Recursos Naturales</option>
                          <option>Area Tecnica</option>
                          <option>Area Legal</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <h6>Tipo de Visita</h6>
                        <select class="form-control select2" style="width: 100%;">
                          <option selected="selected">Selecciona...</option>
                          <option>... </option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <h6>Estatus</h6>
                        <select class="form-control select2" style="width: 100%;">
                          <option selected="selected">Selecciona...</option>
                          <option>...</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-8 offset-md-2">
                      <div class="form-group">
                        <h6>Motivo</h6>
                        <textarea class="form-control" rows="3" placeholder="“Ingrese breve descripción”"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div id="ciudadanoModal" class="modal fade">
                      <div class="modal-dialog modal-dialog-scrollable">
                        <form method="post" id="ciudadano_form">
                          <div class="modal-content card-success card-outline">
                            <div class="modal-header">
                              <h4 class="modal-title">Agregar Ciudadano</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <table id="ciudadano_data" class=" left table table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                      <th></th>
                                      <th>Cédula</th>
                                      <th>Rif</th>
                                      <th>Primer Nombre</th>
                                      <th>Segundo Nombre</th>
                                      <th>Primer Apellido</th>
                                      <th>Segundo Apellido</th>
                                      <th>Dirección</th>
                                      <th>Teléfono</th>
                                      <th>Email</th>
                                      <th></th>
                                      <th>Estatus</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                              </table>
                            </div>
                            
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="button" onClick="registrarCompra()" class="btn btn-success float-sm-right" id="btn"><i class="fas fa-save" aria-hidden="true"></i>  Guardar Visita</button>
                </div>
              </div>
            </div>
        </div>
      </section><!-- /.content -->

      <!--  -->
    </div><!-- /.content-wrapper -->
    <!--Fin-Contenido-->

    <div class="content-wrapper">
      <section class="content">
        <div id="resultados_ajax2"></div>
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-success card-outline p-2">
                <div class="card-header with-border">
                  <h3 class="box-title">Lista de visitas</h3>
                  <div class="box-tools pull-right">
                  </div>
                </div>
                <div class="card-body table-responsive">
                  <table id="ciudadano_data" class="table table-sm table-bordered table-striped">
                    <thead>                              
                      <tr>                           
                        <th>Cédula</th>
                        <th>Departamento</th>
                        <th>Tipo visita</th>
                        <th>Motivo</th>
                        <th>Fecha</th>
                        <th>Estatus</th>
                        <th width="10%">Editar</th>
                        <th width="10%">Borrar</th>
                      </tr>
                    </thead>
                    <tbody>
                            
                    </tbody>
                  </table>
                </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <div id="ciudadanoModal1" class="modal fade">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Buscar Ciudadano</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <table id="usuario_data" class="table table-sm table-bordered table-striped">
              <thead>                              
                <tr>                           
                  <th>Cédula</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Teléfono</th>
                  <th>Correo</th>
                </tr>
              </thead>
              <tbody>
                      
              </tbody>
            </table>
          </div><!--modal body-->

          <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cerrar</button>
          </div><!--modal-footer-->
        </div><!-- /.modal-content -->
      </div> <!-- /.modal-dialog -->
    </div><!-- /.modal -->
      <!-- /.content-wrapper -->
      <!--___________________________CONTENIDO______________________________-->

  <?php 
    require_once("footer.php");
  ?>

<script type="text/javascript" src="js/ciudadano.js"></script>


<?php
  } else {
    header("Location:".Conectar::ruta()."views/index.php");
    exit();
  }
?>
