<?php

// Verificar si se ha enviado el parámetro 'pk' (clave primaria) y 'tabla' (nombre de la tabla)
if (isset($_POST['pk']) && isset($_POST['tabla'])) {
    // Obtener el valor del parámetro 'pk' y 'tabla'
    $pk = $_POST['pk'];
    $tabla = $_POST['tabla'];

    // Llamar al método para borrar el registro desde el modelo, pasando la tabla y pk
    $respuesta = Modelo::desactivarRegistroModelo($pk, $tabla);

    // Verificar si la respuesta es 'ok'
    if ($respuesta == 'ok') {
        ?>
        <script>
            // Mostrar un mensaje de éxito utilizando SweetAlert
            Swal.fire({
                position: 'center', // Centra el alert
                icon: 'success',
                title: 'Registro desactivado correctamente',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                  // Construir dinámicamente la URL con base en la tabla
                  var opcion = 'datos_' + '<?php echo $_POST['tabla']; ?>';
                
                // Redirigir usando postToExternalSite
                postToExternalSite('index.php', { opcion: opcion });
            });
        </script>
        <?php
    } else {
        ?>
        <script>
            // Mostrar un mensaje de error utilizando SweetAlert
            Swal.fire({
                position: 'center', // Centra el alert
                icon: 'error',
                title: 'Oops...',
                text: 'Ocurrió un error al intentar desactivar el registro'
            });
        </script>
        <?php
    }
} else {
    // Si no se han enviado los parámetros 'pk' o 'tabla', mostrar un mensaje de error
    ?>
    <script>
        Swal.fire({
            position: 'center', // Centra el alert
            icon: 'error',
            title: 'Oops...',
            text: 'Los parámetros "pk" o "tabla" no se han recibido correctamente'
        });
    </script>
    <?php
}
?>
