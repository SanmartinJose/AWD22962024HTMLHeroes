<?php include_once './includes/header.php'; ?>
<?php 
$seccion_actual = 'inventario'; 
$accesos_usuario = explode(',', $_SESSION['accesos_usuario']);
if (!in_array($seccion_actual, $accesos_usuario)) {
    header('Location: ./indexAdmin.php');
}
?>


<div class="container form-container">
	<br>
    <h1 class="mb-0">REGISTRO DE CLIENTES</h1>

	<br>
	<br>
    <div class="container form-container">
    <form id="frm" method="post">
        <div class="row">
            <!-- Primera columna -->
            <div class="col-md-4">
              <div class="form-group">
    <label for="nombre">Nombre del Cliente:</label>
    <input type="hidden" name="idp" id="idp" value="">
    <input type="text" name="nombre" id="nombre" class="form-control" required placeholder="Nombre del cliente" oninput="validarNombre()">
    <span id="nombreError" style="color: red;"></span>
</div>

               <div class="form-group">
    <label for="cedula">Cédula:</label>
    <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Cédula" required onblur="verificarCedulaUnica()">
    <span id="cedulaError" style="color: red;"></span>
</div>


                <div class="form-group mt-4">
                    <input type="submit" class="btn btn-dark" name="registrar" id="registrar" value="Enviar datos">
                </div>
            </div>

            <!-- Segunda columna -->
            <div class="col-md-4">
                <div class="form-group">
    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Teléfono" required oninput="validarTelefono()">
    <span id="telefonoError" style="color: red;"></span>
</div>
<div class="form-group">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" class="form-control" placeholder="Email" required oninput="validarEmail()">
    <span id="emailError" style="color: red;"></span>
</div>
</div>
               

            <!-- Tercera columna -->
            <div class="col-md-4">
                <div class="form-group">
    <label for="direccion">Dirección:</label>
    <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Dirección" required oninput="validarDireccion()">
    <span id="direccionError" style="color: red;"></span>
</div>

                <div class="form-group">
    <label for="estado">Estado:</label>
    <select class="form-select" id="estado" name="estado" required>
        <option value="activo">Activo</option>
        <option value="inactivo">Inactivo</option>
    </select>
</div>

            </div>
        </div>
    </form>
</div>

<!-- Nueva fila para la tabla -->
<br>
	<br>
            <table class="table table-striped" >
                <thead>
                    
                </thead>
                <tbody id="datos_productos">
                   
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal de Registro de Usuario -->


<script src="funcionesCliente.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php include_once './includes/footer.php'; ?>