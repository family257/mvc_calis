<?php
    require_once"conexion.php";
    #clase modelo hereda todo lo que tiene la clase coleccion, gracias a la linea anterior
    class Modelo extends Conexion
    {
        
   public static function obtenerRutaPorNombre($nombre)
    {
        $stmt = Conexion::conectar()->prepare("SELECT ruta FROM enlaces WHERE nombre = :nombre AND estado = 1");
        $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $stmt->execute();

        // Comprobamos si encontramos la ruta
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }

        //****************************************************+++ */
        public static function getBreadcrumbMap() {
            return [
                "principal" => "<a href='#' onclick='postToExternalSite(\"index.php\", { opcion: \"principal\" });'><i class='fas fa-home'></i> Inicio</a>",
                "alta_persona" => "<a href='#' onclick='postToExternalSite(\"index.php\", { opcion: \"principal\" });'><i class='fas fa-home'></i> Inicio</a> &gt; Altas &gt; Persona",
                "datos_persona" => "<a href='#' onclick='postToExternalSite(\"index.php\", { opcion: \"principal\" });'><i class='fas fa-home'></i> Inicio</a> &gt; Mostrar &gt; Persona",
               
            ];
        }
 //************************************************************ */
                 #PERSONA
           
//********************************************************** */
static public function registroPersonaModelo($datosModelo, $tabla)
{
    date_default_timezone_set("America/Mazatlan");
    $hora = date('H:i:s');
    $fecha = date('Y-m-d');

    // Query para insertar la información en la tabla
    $consulta = Conexion::conectar()->prepare("
        INSERT INTO $tabla (nombre, apellido, email, foto, hora, fecha) 
        VALUES (:nombre, :apellido, :email, :foto, :hora, :fecha)
    ");

    // Obtener los valores del arreglo y asignarlos a los parámetros
    $consulta->bindParam(":nombre", $datosModelo["nombre"], PDO::PARAM_STR);
    $consulta->bindParam(":apellido", $datosModelo["apellido"], PDO::PARAM_STR);
    $consulta->bindParam(":email", $datosModelo["email"], PDO::PARAM_STR);
    $consulta->bindParam(":foto", $datosModelo["foto"], PDO::PARAM_STR);

    $consulta->bindParam(":hora", $hora, PDO::PARAM_STR);
    $consulta->bindParam(":fecha", $fecha, PDO::PARAM_STR);

    // Ejecutar la consulta y retornar la respuesta
    if ($consulta->execute()) {
        return 'ok';
    } else {
        return 'error';
    }
}

//****************************************************** */
# Codigo reziclado para mostrar y desactivar y activar los datos
//******************************************** */

public static function obtenerClavePrimaria($tabla)
{
    // Consulta para obtener el nombre de la clave primaria
    $consulta = Conexion::conectar()->prepare("SHOW KEYS FROM $tabla WHERE Key_name = 'PRIMARY'");
    $consulta->execute();
    $resultado = $consulta->fetch();

    // Verificar y depurar el valor de la clave primaria
    echo "Clave primaria encontrada: " . $resultado['Column_name'] . "<br>";

    // Retornar el nombre del campo de la clave primaria
    return $resultado ? $resultado['Column_name'] : null;
}

public static function listadoGenericoModelo($tabla, $estado, $campos = '*')
{
 // Si no se especifican campos, se seleccionan todos (*)
    if ($campos == '*') {
       // Agregar la clave primaria (pk_tabla) a la consulta para asegurarnos de que siempre esté presente
        $consulta = Conexion::conectar()->prepare("SELECT *, pk_{$tabla} FROM {$tabla} WHERE estado = :estado");
    } else {
         // Si se especifican campos, agregar la clave primaria (pk_tabla) a la lista de campos seleccionados
        $campos .= ', pk_' . $tabla;
        $consulta = Conexion::conectar()->prepare("SELECT $campos FROM {$tabla} WHERE estado = :estado");
    }
    // Vinculamos el parámetro de estado para evitar inyecciones SQL
    $consulta->bindParam(":estado", $estado, PDO::PARAM_INT);
       // Ejecutamos la consulta
    $consulta->execute();
    // Devolvemos todos los registros encontrados como un array
    return $consulta->fetchAll(); 
}


public static function desactivarRegistroModelo($pk, $tabla) {
    try {
        // Verificar que la tabla y pk sean válidos
        $conexion = Conexion::conectar();
        $sql = "UPDATE $tabla SET estado = 0 WHERE pk_$tabla = :pk"; // o puedes usar DELETE si deseas eliminarlo
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':pk', $pk, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return 'ok'; // Si la eliminación fue exitosa
        } else {
            return 'error'; // Si hubo un problema con la ejecución de la consulta
        }
    } catch (Exception $e) {
        return 'error'; // En caso de error
    }
}


public static function restaurarRegistroModelo($pk, $tabla) {
    try {
        // Verificar que la tabla y pk sean válidos
        $conexion = Conexion::conectar();
        $sql = "UPDATE $tabla SET estado = 1 WHERE pk_$tabla = :pk"; // Restaurar el registro (estado = 1)
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':pk', $pk, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return 'ok'; // Si la restauración fue exitosa
        } else {
            return 'error'; // Si hubo un problema con la ejecución de la consulta
        }
    } catch (Exception $e) {
        return 'error'; // En caso de error
    }
}
}
