  // Función para mostrar u ocultar las tablas según el estado
  function mostrarTabla(tabla) {
    // Obtener las referencias a las tablas y al título
   var activos = document.getElementById("tablaActivos");
   var inactivos = document.getElementById("tablaInactivos");
   var titulo = document.getElementById("tituloTabla");

    // Ocultar ambas tablas al principio
   activos.style.display = "none";
   inactivos.style.display = "none";

// Mostrar la tabla correspondiente dependiendo del parámetro 'tabla'
   if (tabla === 'activos') {
       // Mostrar la tabla de personas activas y cambiar el título
       activos.style.display = "table-row-group";
       titulo.textContent = "DATOS PERSONAS ACTIVAS";  // Cambiar título a activos
   } else if (tabla === 'inactivos') {
        // Mostrar la tabla de personas inactivas y cambiar el título
       inactivos.style.display = "table-row-group";
       titulo.textContent = "DATOS PERSONAS INACTIVAS";  // Cambiar título a inactivos
   }
}

// Mostrar los activos por defecto al cargar la página
mostrarTabla('activos');