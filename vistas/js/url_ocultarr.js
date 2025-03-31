function postToExternalSite(url, params) {
    // Crear un elemento <form> dinámicamente.
    const form = document.createElement('form');
    form.method = 'POST'; // Establecer el método del formulario como POST.
    form.action = url;    // Establecer la URL a la que se enviará el formulario.

    // Recorrer las claves y valores del objeto 'params'.
    for (const key in params) {
        if (params.hasOwnProperty(key)) {
            // Crear un campo <input> oculto para cada clave-valor en 'params'.
            const hiddenField = document.createElement('input');
            hiddenField.type = 'hidden';  // El campo será invisible para el usuario.
            hiddenField.name = key;       // Establecer el nombre del campo como la clave.
            hiddenField.value = params[key]; // Establecer el valor del campo.
            form.appendChild(hiddenField);   // Añadir el campo al formulario.
        }
    }

    // Agregar el formulario al cuerpo del documento.
    document.body.appendChild(form);

    // Enviar el formulario al sitio externo.
    form.submit();
}