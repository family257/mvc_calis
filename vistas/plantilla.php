<?php
// Crear una instancia del controlador y manejar la página
$controlador = new Controlador();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MVC IDGS81</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ae1b5f3a79.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <link href="vistas/css/menu.css" rel="stylesheet">
    <script src="vistas/js/url_ocultarr.js"></script>
    <script src="vistas/js/validacionPersona.js"></script>
    <script src="vistas/js/mostrar_tabla_persona.js"></script>
    
</head>
<body>
<?php
  include 'modulos/menu.php'; 
 
 
// Mostrar contenido dinámico de enlacespagina
$controlador->enlacesPaginasControlador();



?>
</body>
</html>


