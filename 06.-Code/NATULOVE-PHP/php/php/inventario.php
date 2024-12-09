<?php include_once './includes/header.php'; ?>
<?php 
$seccion_actual = 'inventario'; 
$accesos_usuario = explode(',', $_SESSION['accesos_usuario']);
if (!in_array($seccion_actual, $accesos_usuario)) {
    header('Location: ./indexAdmin.php');
}
?>


<div class="container form-container">
	 <h1 class="mb-0">INVENTARIO</h1>
 
    <form id="frm" method="post">
        <div class="row">
       
            <div class="col-md-3">
                <div class="form-group">
                    <label for="nombre">Nombre del Producto:</label>
					<input type="hidden" name="idp" id="idp" value="">
                    <input type="text" name="nombre" id="nombre" class="form-control" required placeholder="Nombre del producto">
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea class="form-control" rows="1" id="descripcion" name="descripcion" placeholder="Descripción" required></textarea>
                </div>
                <div class="form-group">
    <label for="precio_unitario">Precio Unitario:</label>
    <input type="text" name="precio_unitario" id="precio_unitario" class="form-control" placeholder="Precio unitario" required>
    <span id="precioError" style="color: red;"></span> <!-- Mensaje de error -->
</div>

                <div class="form-group">
                    <p>&nbsp;</p>
                    <p>
                        <input type="submit" class="btn btn-dark" name="registrar" id="registrar" value="Enviar datos">
                    </p>
                </div>
            </div>
            <!-- Segunda columna -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="categoria">Categoría del Producto:</label>
                    <select class="form-select" id="categoria" placeholder="Categoría" name="categoria" required>
                        <option value="" disabled selected>Seleccione una categoría</option>
                        <option value="cuidaoP">Chocolates</option>
                        <option value="cuidadoC">Productos Secos</option>
                       
                    </select>
                </div>
                <div class="form-group">
    <label for="stock">Stock:</label>
    <input type="text" name="stock" placeholder="Stock" id="stock" class="form-control" required>
    <span id="stockError" style="color: red;"></span> <!-- Mensaje de error -->
</div>


                <div class="form-group">
                    <label for="estado">Estado:</label>
                    <select class="form-select" id="estado" placeholder="Estado" name="estado" required>
                        <option value="" disabled selected>Seleccione un estado</option>
                        <option value="activo">Activo</option>
                        <option value="inactivo">Inactivo</option>
                    </select>
                </div>
            </div>
            <!-- Tercera columna -->
           <div class="col-md-5">
    <div class="form-group">
        <label for="tipo_impuesto">Tipo de Impuesto:</label>
        <select class="form-select" id="tipo_impuesto" placeholder="Tipo de impuesto" name="tipo_impuesto" required>
            <option value="" disabled selected>Seleccione un tipo de impuesto</option>
            <option value="sinImpuesto">Sin Impuesto</option>
            <option value="iva">IVA</option>
            <option value="ice">ICE</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="valor_impuesto">Valor del IVA/RISE:</label>
        <input type="text" name="valor_impuesto" placeholder="Valor del impuesto" id="valor_impuesto" class="form-control" >
        <span id="precioError2" style="color: red; display: block; margin-top: 5px;"></span>
    </div>
</div>

        </div>
    </form>
</div>

<!-- Nueva fila para la tabla -->
<div class="container table-responsive">
    <div class="row">
        <div class="col-md-12">
			<nav class="navbar navbar-expand-lg navbar-light ">
                <div class="container-fluid">
                    <form class="d-flex ms-auto" role="search">
                        <input class="form-control me-2" id="buscar" type="search" placeholder="Buscar..." aria-label="Buscar">

                        <!-- Dropdown Button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Más...
                            </button>
                            <ul class="dropdown-menu">
                                 <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#userRegistrerModal">Reporte Inventario</a></li>
    
    <!-- Botón para abrir el modal de Añadir Roles -->


                            </ul>
                        </div>
						
                    </form>
					<h1>&nbsp &nbsp &nbsp </h1>
                </div>
            </nav>


            <table class="table table-striped" >
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio Unitario</th>
                        <th>Stock</th>
                        <th>Estado</th>
                        <th>Categoría</th>
                        <th>Tipo de Impuesto</th>
                        <th>Valor del Impuesto</th>
						<th>PVP</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="datos_productos">
                   
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal de Registro de Usuario -->
<div class="modal fade" id="userRegistrerModal" tabindex="-1" aria-labelledby="userRegistrerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="userRegistrerModalLabel">Reporte</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive"> <!-- Añade esta clase para hacer la tabla responsiva dentro del modal -->
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Id</th>
                <th>Id_USUARIO</th>
                <th>Fecha de Registro</th>
                <th>Id_Producto Añadido</th>
                
              </tr>
            </thead>
            <tbody id="datos_inventario">
</tbody>

          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
       
      </div>
    </div>
  </div>
</div>


<!-- Modal de creación de roles -->
<!-- Modal -->
<div class="modal fade" id="rolRegistrerModal" tabindex="-1" aria-labelledby="rolRegistrerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="rolRegistrerModalLabel">Gestionar Categorías</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Formulario -->
    <form id="frmC" method="post">
		 <div class="mb-3">
        <label for="id_cate" class="col-form-label">Id de la Categoría:</label>
        <input type="text" class="form-control" id="id_cate" name="id_cate" required>
    </div>
    <div class="mb-3">
        <label for="nombre-cate" class="col-form-label">Nombre de la Categoría:</label>
        <input type="text" class="form-control" id="nombre-cate" name="nombre_cate" required>
    </div>
    
    <div class="mb-3">
        <label for="descripcion_cate" class="col-form-label">Descripción:</label>
        <textarea class="form-control" id="descripcion_cate" name="descripcion_cate" required></textarea>
    </div>

    <div class="text-end">
       
        <button type="submit" class="btn btn-dark" name="registrarC" id="registrarC">Guardar</button>
    </div>
</form>



        
        <!-- Tabla -->
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>ID_USUARIO</th>
                <th>FECHA</th>
                <th>NOMBRE DE LA CATEGORÍA</th>
                <th>DESCRIPCIÓN</th>
                <th>ACCIONES</th>
              </tr>
            </thead>
            <tbody id="datos_productos">
              <!-- Aquí irán los datos -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


<script src="funciones.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php include_once './includes/footer.php'; ?>
	
