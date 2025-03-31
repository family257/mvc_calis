<?php
// views/listado.php
require_once 'controlador/controlador.php';
?>
<div class="container">
<div class="alert alert-primary text-center" role="alert">
    <h2 id="tituloTabla">DATOS PERSONAS ACTIVAS</h2>
</div>
</div>

<br><br>

<!-- Botones para cambiar entre activos e inactivos -->
<div class="text-center mb-3">
    <button class="btn btn-success" onclick="mostrarTabla('activos')">Mostrar Activos</button>
    <button class="btn btn-danger" onclick="mostrarTabla('inactivos')">Mostrar Inactivos</button>
</div>

<!-- Tablas para mostrar los datos -->
<div id="tablaPersonas" class="table-responsive" style="max-width: 80%; margin: 0 auto;">
    <table class="table table-hover table-bordered text-center" style="font-size: 1rem; background-color: #f8f9fa;">
        <thead class="thead-dark" >
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Foto</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="tablaActivos">
            <?php
            // Mostrar los registros de la tabla 'persona' con estado '1' (activos)
            mostrarTablaPersonas(1);
            ?>
        </tbody>
        <tbody id="tablaInactivos" style="display: none;">
            <?php
            // Mostrar los registros de la tabla 'persona' con estado '0' (inactivos)
            mostrarTablaPersonas(0);
            ?>
        </tbody>
    </table>
</div>

<script>
  
</script>

<?php
// Función para mostrar la tabla de personas según el estado
function mostrarTablaPersonas($estado) {
    // Crear una instancia del controlador que manejará la lógica de mostrar los registros
    $controlador = new Controlador();
     // Llamar al método del controlador para obtener y mostrar los registros de la tabla 'persona'
    // Solo se muestran los campos 'nombre', 'apellido', 'email', 'foto' de las personas en el estado especificado
    $controlador->listadoGenericoControlador('persona', $estado, 'nombre, apellido, email, foto');
}
?>
