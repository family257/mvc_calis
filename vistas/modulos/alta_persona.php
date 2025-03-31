<div class="container">
    <div class="alert alert-primary  text-center" role="alert">
        <h1 style="font-size: 2rem;">ALTA DE PERSONA</h1>

    </div>
</div>

<br>
<h1 style="font-size: 2rem;">ALTA DE PERSONA</h1>


<div class="container" style="max-width: 1000px;">

    <form id="form_persona" method="POST" autocomplete="off" enctype="multipart/form-data"
        class="border p-4 rounded shadow-sm">
        <!-- Nombre -->
        <div class="mb-3">
            <label class="form-label">Nombre:</label>
            <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
        </div>

        <!-- Apellido -->
        <div class="mb-3">
            <label class="form-label">Apellido:</label>
            <input type="text" class="form-control" name="apellido" placeholder="Apellido" required>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" class="form-control" name="email" placeholder="correo@gmail.com" required>
        </div>

        <!-- Foto -->
        <div class="mb-3">
            <label class="form-label">Foto:</label>
            <input type="file" class="form-control" name="foto" id="foto" required accept="image/*">
        </div>


        <div class="d-grid gap-2 col-6 mx-auto">
            <button class="btn btn-primary " type="submit" name="opcion" value="alta_persona" style="font-size: 1rem;">
                Guardar Persona
            </button>
        </div>
    </form>
</div>

<?php
$registro = new Controlador();
$registro->registroPersonaControlador();
?>