<?php
class Paginas
{
    static public function enlacesPaginas($enlaces)
    {
        $conexion = Conexion::conectar();
        try {
            $consulta = $conexion->prepare("SELECT * FROM enlaces WHERE nombre = :enlaces AND estado = 1");
            $consulta->bindParam(":enlaces", $enlaces, PDO::PARAM_STR);
            $consulta->execute();
            $data = $consulta->fetch(PDO::FETCH_ASSOC);
    
            // Verificar si $data es false antes de acceder a los índices
            if ($data) {
                return $data['ruta'];  // Retorna la ruta si hay datos
            } else {
                return "vistas/modulos/error.php";  // Retorna la ruta de error si no hay datos
            }
        } catch (PDOException $e) {
            // En caso de error, regresamos la vista de error
            echo "Error: " . $e->getMessage();
            return "vistas/modulos/error.php";
        }
    }
}
