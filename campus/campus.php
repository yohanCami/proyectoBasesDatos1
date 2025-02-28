<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Campus</h1>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <form action="campus_insert.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="cod_campus" class="form-label">Codigo Campus</label>
            <input type="number" class="form-control" id="cod_campus" name="cod_campus" required>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <button type="submit" class="btn btn-primary">Agregar</button>

    </form>

</div>

<?php
// Importar el código del otro archivo
require("campus_select.php");

// Verificar si llegan datos
if ($resultadoCliente and $resultadoCliente->num_rows > 0):
    ?>

    <!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
    <div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

        <table class="table table-striped table-bordered">

            <!-- Títulos de la tabla, cambiarlos -->
            <thead class="table-dark">
                <tr>
                    <th scope="col" class="text-center">Codigo Campus</th>
                    <th scope="col" class="text-center">Nombre</th>
                    <th scope="col" class="text-center">Acciones</th>
                </tr>
            </thead>

            <tbody>

                <?php
                // Iterar sobre los registros que llegaron
                foreach ($resultadoCliente as $fila):
                    ?>

                    <!-- Fila que se generará -->
                    <tr>
                        <!-- Cada una de las columnas, con su valor correspondiente -->
                        <td class="text-center"><?= $fila["codigo_campus"]; ?></td>
                        <td class="text-center"><?= $fila["nombre"]; ?></td>



                        <!-- Botón de eliminar. Debe de incluir la CP de la entidad para identificarla -->
                        <td class="text-center">
                            <form action="campus_delete.php" method="post">
                                <input hidden type="text" name="codigo_campus" value="<?= $fila["codigo_campus"]; ?>">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>

                    </tr>

                    <?php
                    // Cerrar los estructuras de control
                endforeach;
                ?>

            </tbody>

        </table>
    </div>

    <?php
endif;

include "../includes/footer.php";
?>