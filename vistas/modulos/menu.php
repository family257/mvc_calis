<?php
// views/breadcrumbs.php
require_once 'controlador/controlador.php';

// Obtener la opción desde POST o un valor por defecto
$opcion = $_POST['opcion'] ?? 'principal';

// Crear una instancia del controlador
$breadcrumbController = new controlador();

// Generar el breadcrumb
$breadcrumb = $breadcrumbController->generateBreadcrumb($opcion);
?>

<!-- Menú Navegación -->
<nav class="navbar navbar-expand-lg" style="background-color: #0597F2;">
    <div class="container-fluid">
        <a class="navbar-brand text-white fw-bold" href="#" style="font-size: 1.25rem;"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white fw-bold" href="#" onclick="postToExternalSite('index.php', { opcion: 'principal' });" style="font-size: 1.1rem;">
                        <i class="fas fa-home"></i> Explora Web
                    </a>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white fw-bold" href="#" id="opcionesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 1.1rem;">
                        <i class="bi bi-gear" style="color: #05AFF2;"></i> Altas
                    </a>
                    <ul class="dropdown-menu" style="background-color: #0597F2;">
                        <li>
                            <a class="dropdown-item text-white fw-bold" href="#" onclick="postToExternalSite('index.php', { opcion: 'alta_persona' });" style="font-size: 1rem;">
                                <i class="bi bi-book" style="color: #F2F2F0;"></i> Persona
                            </a>
                        </li>
                       
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white fw-bold" href="#" id="mostrarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 1.1rem;">
                        <i class="bi bi-gear" style="color: #05AFF2;"></i> Mostrar
                    </a>
                    <ul class="dropdown-menu" style="background-color: #0597F2;">
                        <li>
                            <a class="dropdown-item text-white fw-bold" href="#" onclick="postToExternalSite('index.php', { opcion: 'datos_persona' });" style="font-size: 1rem;">
                                <i class="bi bi-book" style="color: #F2F2F0;"></i> Persona
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Breadcrumbs -->
<div id="breadcrumbs" class="my-3" style="margin-left: 40px;">
    <?php echo $breadcrumb; ?>
</div>


<script>

    // Verificar si la opción es 'principal' y ocultar el breadcrumb
const breadcrumbDiv = document.getElementById('breadcrumbs');
const opcion = "<?php echo $opcion; ?>"; // Asumimos que la opción es 'principal'

if (opcion === 'principal') {
    breadcrumbDiv.classList.add('d-none');  // Ocultar el breadcrumb
} else {
    breadcrumbDiv.classList.remove('d-none');  // Mostrar el breadcrumb
}
</script>




