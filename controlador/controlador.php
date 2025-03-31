<?php
require_once 'modelo/modelo.php';
class Controlador
{
    // Método para cargar la plantilla principal
    static public function pagina()
    {
        include "vistas/plantilla.php";
    }

    // Método para manejar los enlaces de páginas
    public static function enlacesPaginasControlador()
    {
        // Determinar la opción solicitada (prioridad: POST > GET > 'principal')
        $enlace = $_POST["opcion"] ?? $_GET["opcion"] ?? 'principal';

        // Consultar la base de datos para obtener la ruta correspondiente
        $respuesta = Modelo::obtenerRutaPorNombre($enlace);

        // Verificar si se encontró una ruta válida
        if ($respuesta && !empty($respuesta['ruta']) && file_exists($respuesta['ruta'])) {
            include $respuesta['ruta']; // Incluir la ruta encontrada
        } else {
            // Si no se encuentra la página, mostrar un mensaje genérico
            echo "<h2>Error: La página solicitada no está disponible.</h2>";
        }
    }

    //******************************************************************** */
                     #Breadcrumb

public function generateBreadcrumb($opcion) {
    // Si estamos en la página de inicio, no mostrar breadcrumb
    if ($opcion === 'principal') {
        return ''; // No mostrar el breadcrumb
    }

    // Obtener el mapa de breadcrumbs
    $breadcrumbMap = Modelo::getBreadcrumbMap();

    // Si la opción existe en el mapa, devolver el breadcrumb
    if (array_key_exists($opcion, $breadcrumbMap)) {
        return $breadcrumbMap[$opcion];
    }

    // Si no existe, devolver el breadcrumb por defecto (Inicio)
    return $breadcrumbMap["principal"];
}

//********************************************************************* */
                 #PERSONA

//******************************************************************** */
 #Registro del video 
 public function registroPersonaControlador() {
    // Verifica que la solicitud sea de tipo POST y que se haya enviado el campo 'nombre'
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["email"])) {

        // Verificar si se ha subido un archivo de imagen
        if (!empty($_FILES['foto']['name'])) {
            // Obtener los datos del formulario
            $nombre = trim($_POST['nombre']);
            $apellido = trim($_POST['apellido']);
            $email = trim($_POST['email']);

            // Generar un nombre único para la imagen
            $fotoNombre = time() . "_" . $_FILES['foto']['name']; 
            $fotoTemp = $_FILES['foto']['tmp_name']; // Ruta temporal del archivo subido
            $ruta = "vistas/fotos/" . $fotoNombre; // Ruta donde se guardará la imagen en el servidor

            // Obtener la fecha y hora actual
            $fecha = date("Y-m-d"); // Fecha actual
            $hora = date("H:i:s");  // Hora actual

            // Mover el archivo del directorio temporal al destino final
            if (move_uploaded_file($fotoTemp, $ruta)) {
                // Preparar los datos para enviarlos al modelo y guardarlos en la base de datos
                $datosControlador = array(
                    "nombre" => $nombre,
                    "apellido" => $apellido,
                    "email" => $email,
                    "foto" => $ruta, // Ruta de la imagen guardada
                 
                );

                // Llamar al modelo para registrar la persona en la base de datos
                $respuesta = Modelo::registroPersonaModelo($datosControlador, "persona");

                // Verificar si el registro en la base de datos fue exitoso
                if ($respuesta == 'ok') {
                    echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: '¡Registro exitoso!',
                            text: 'La persona ha sido registrada correctamente.',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            postToExternalSite('index.php', { opcion: 'alta_persona' });
                        });
                    </script>";
                } else {
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Hubo un problema al guardar la persona en la base de datos.',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    </script>";
                }
            } else {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se pudo mover la imagen al destino.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>";
            }
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se subió ninguna imagen.',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>";
        }
    }
}

//****************************************************** */
#                   Codigo reziclado para mostrar y desactivar y activar los datos
//******************************************** */

    //Listado de registros con acciones 

public function listadoGenericoControlador($tabla, $estado, $campos = '*') {
    // Obtener los datos desde el modelo
    $datos = Modelo::listadoGenericoModelo($tabla, $estado, $campos);

    // Verificamos que haya datos
    if (empty($datos)) {
        echo "<tr><td colspan='100%' class='text-center'>No se encontraron registros</td></tr>";
        return;
    }

    // Dividir los campos solicitados en un array
    $camposArray = explode(', ', $campos);

    // Recorrer los datos y mostrar solo los campos que fueron especificados
    foreach ($datos as $dato) {
        echo "<tr>";

        foreach ($camposArray as $campo) {
            $campo = trim($campo); // Limpiar espacios adicionales

            // Verificar si el campo existe en los datos antes de intentar mostrarlo
            if (isset($dato[$campo])) {
                // Si el campo es 'foto', mostrar la imagen en lugar del texto
                if ($campo === 'foto') {
                    if (!empty($dato[$campo]) && file_exists($dato[$campo])) {
                        echo "<td><img src='{$dato[$campo]}' alt='Foto' width='100' height='100' '></td>";
                    } else {
                        echo "<td>Sin foto</td>"; // Mostrar un mensaje si no hay imagen disponible
                    }
                } else {
                     // Si el campo no es 'foto', mostramos el valor del campo de forma segura
                    echo "<td>" . htmlspecialchars($dato[$campo]) . "</td>";
                }
            } else {
                echo "<td>-</td>"; // Si no existe, mostrar un guion o mensaje de error
            }
        }

        // Agregar el botón de eliminación/restauración de forma genérica
        $pkField = 'pk_' . $tabla; // Definir el nombre del campo de la clave primaria (pk)
    
// Verificar el estado para determinar qué botón mostrar (Activar o Desactivar)
        if ($estado == 0) {
            echo "<td>
                <button class='btn btn-success' 
                        onclick='postToExternalSite(\"index.php\", { opcion: \"restaurar\", tabla: \"{$tabla}\", pk: {$dato[$pkField]} });' 
                        style='color: white; text-decoration: none;'>
                    <i class='fa-solid fa-undo'></i> Activar
                </button>
            </td>";
        } else {
            echo "<td>
                <button class='btn btn-danger' 
                        onclick='postToExternalSite(\"index.php\", { opcion: \"borrar\", tabla: \"{$tabla}\", pk: {$dato[$pkField]} });' 
                        style='color: white; text-decoration: none;'>
                   <i class='fa-solid fa-trash'></i> Desactivar
                </button>
            </td>";
        }

        echo "</tr>";
    }
}

}