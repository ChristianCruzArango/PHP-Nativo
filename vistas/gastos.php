<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';

if ($_SESSION['fact']==1)
{
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Añadir Gasto <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <div class="alert alert-danger alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <strong>¡Nota!</strong> <br>
                      Para crear un nuevo gasto por favor digitar el código de la cuenta que se encuentra en el sistema. Lo puede buscar con un clic en el botón cuentas contables que se encuentra en la parte inferior de la caja de texto
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Fecha</th>
                            <th>Descripción</th>
                            <th>Cuenta</th>
                            <th>Descripción Cuenta</th>
                            <th>Naturaleza</th>
                            <th>Total</th>    
                            <th>Estado</th>                         
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Fecha</th>
                            <th>Descripción</th>
                            <th>Cuenta</th>
                            <th>Descripción Cuenta</th>
                            <th>Naturaleza</th>
                            <th>Total</th>    
                            <th>Estado</th>   
                          </tfoot>
                        </table>
                    </div>
                      <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <label>Cuenta Contable(*):</label>
                            <input type="hidden" name="idgasto" id="idgasto">
                            <input type="text" class="form-control" name="cuenta" id="cuenta" maxlength="256" placeholder="Código de la cuenta ">
                            <a data-toggle="modal" href="#myModal">           
                              <button id="btnAgregarArt" type="button" class="btn btn-success"> <i class="fa fa-book"></i> Cuentas Contable</button>
                            </a>
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">                           
                          </div>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Fecha(*):</label>
                            <input type="date" class="form-control" name="fecha_hora" id="fecha_hora" required="" >
                          </div>    
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Descripción:</label>
                            <textarea class="form-control" rows="5" name="descripcion" id="descripcion"></textarea>                           
                          </div> 
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Total:</label>
                            <input type="number" class="form-control" name="total" id="total" maxlength="256" placeholder="Total del Gasto" onkeypress="return valida(event)">
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div>
                        </form>
                      </div>
                    <!--Fin centro -->
                    </div><!-- /.box -->
                  </div><!-- /.col -->
                </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog" style="width: 50% !important;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">LIstado de las Cuentas</h4>
        </div>
        <div class="modal-body">
          <table id="listarCuentas" class="table table-striped table-bordered table-condensed table-hover" style="width: 84%;">
            <thead> 
              <th style="width: 1%;">Código de la cuenta </th>             
              <th>Nombre Cuenta</th>
              <th>Cuenta</th>
              <th>Nivel</th>
              <th style="width: 1%;">Naturaleza</th>              
            </thead>
            <tbody>              
            </tbody>
            <tfoot>     
              <th>Código de la cuenta </th>          
              <th>Nombre Cuenta</th>
              <th>Cuenta</th>
              <th>Nivel</th>
              <th style="width: 1%;">Naturaleza</th>              
            </tfoot>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>        
      </div>
    </div>
  </div>  
  <!-- Fin modal -->
  
<?php
}
else
{
  require 'noacceso.php';
}

require 'footer.php';
?>
<script type="text/javascript" src="scripts/gasto.js"></script>
<?php 
}
ob_end_flush();
?>


