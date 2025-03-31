document.addEventListener("DOMContentLoaded", function () {
    // Función para formatear el texto en los campos de entrada
    function formatText(input, allowHyphen = false) {
        let regex = allowHyphen 
            ? /[^A-Za-zÁÉÍÓÚáéíóúÑñ\s-]/g 
            : /[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g;
        input.value = input.value.replace(regex, ' ') // Elimina caracteres no permitidos
            .replace(/\s{2,}/g, ' ')  // Reemplaza múltiples espacios por uno solo
            .replace(/-{2,}/g, '-') // Evita múltiples guiones seguidos
            .replace(/(^|\s|-)[a-záéíóúñ]/g, c => c.toUpperCase()); // Capitaliza las palabras
    }

     // Función para validar la longitud máxima del campo
    function validateMaxLength(input, maxLength) {
        if (input.value.length > maxLength) {
            input.value = input.value.substring(0, maxLength);
        }
    }

    // Función para validar si el campo está vacío
    function validateField(input) {
        let errorMessage = input.nextElementSibling;
        if (!input.value.trim()) {
            input.classList.add("error");
            errorMessage.style.display = "block";
        } else {
            input.classList.remove("error");
            errorMessage.style.display = "none";
        }
    }

    // Validación de nombre y apellido (reutilizando las validaciones de formato de texto)
    document.querySelectorAll("input[name='nombre'], input[name='apellido']").forEach(input => {
        input.addEventListener("input", function () {
            formatText(this);  // Formatear el texto (capitalización y eliminación de caracteres no permitidos)
            validateMaxLength(this, 50);  // Longitud máxima
            validateField(this);  // Validación de campo vacío
        });
    });

 

    // Validación de foto (asegurarse de que se haya seleccionado una imagen)
    document.getElementById("foto").addEventListener("change", function () {
        let errorMessage = this.nextElementSibling;
        if (this.files.length === 0) {
            this.classList.add("error");
            errorMessage.style.display = "block";
            errorMessage.textContent = "Por favor, sube una foto.";
        } else {
            this.classList.remove("error");
            errorMessage.style.display = "none";
        }
    });
});