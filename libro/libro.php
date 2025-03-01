<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Libro</h1>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <form action="libro_insert.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="codigo_isbn" class="form-label">Código ISBN*</label>
            <input type="number" class="form-control" id="codigo_isbn" name="codigo_isbn" required min="1">
        </div>

        <div class="mb-3">
            <label for="titulo" class="form-label">Titulo*</label>
            <input type="text" class="form-control" id="titulo" name="titulo" required>
        </div>


        <div class="mb-3">
            <label for="fechapublicacion" class="form-label">Fecha de publicacion*</label>
            <input type="date" class="form-control" id="fechapublicacion" name="fechapublicacion" required>
        </div>

        <div class="mb-3">
            <label for="paginas" class="form-label">Paginas*</label>
            <input type="number" class="form-control" id="paginas" name="paginas" required min="1">
        </div>

        <div class="mb-3">
            <label for="idioma" class="form-label">Idioma*</label>
            <input type="text" class="form-control" id="idioma" name="idioma" required>
        </div>

        <div class="mb-3">
            <label for="volumen" class="form-label">Volumen*</label>
            <input type="number" class="form-control" id="volumen" name="volumen" required min="1">
        </div>

        <div class="mb-3">
            <label for="editorial" class="form-label">Editorial*</label>
            <input type="text" class="form-control" id="editorial" name="editorial" required>
        </div>

        <div class="mb-3">
            <label for="valor" class="form-label">Valor*</label>
            <input type="number" class="form-control" id="valor" name="valor" required min="1">
        </div>

        <!-- Consultar la lista de clientes y desplegarlos -->
        <div class="mb-3">
            <label for="biblioteca" class="form-label">Biblioteca*</label>
            <select name="biblioteca" id="biblioteca" class="form-select">

                <!-- Option por defecto -->
                <option value="" selected disabled hidden></option>

                <?php
                // Importar el código del otro archivo
                require("../biblioteca/biblioteca_select.php");

                // Verificar si llegan datos
                if ($resultadoBiblioteca):

                    // Iterar sobre los registros que llegaron
                    foreach ($resultadoBiblioteca as $fila):
                        ?>

                        <!-- Opción que se genera -->
                        <option value="<?= $fila["codigo_biblio"]; ?>"><?= $fila["nombre_biblio"]; ?> - Código Biblioteca
                            <?= $fila["codigo_biblio"]; ?>
                        </option>

                        <?php
                        // Cerrar los estructuras de control
                    endforeach;
                endif;
                ?>
            </select>
        </div>

        <!-- Consultar la lista de empresas y desplegarlos -->
        <div class="mb-3">
            <label for="libro" class="form-label">Libro del volumen Anterior</label>
            <select name="libro" id="libro" class="form-select">

                <!-- Option por defecto -->
                <option value="" selected disabled hidden></option>

                <?php
                // Importar el código del otro archivo
                require("../libro/libro_select.php");

                // Verificar si llegan datos
                if ($resultadoLibro):

                    // Iterar sobre los registros que llegaron
                    foreach ($resultadoLibro as $fila):
                        ?>

                        <!-- Opción que se genera -->
                        <option value="<?= $fila["isbn"]; ?>"><?= $fila["titulo"]; ?> - Código Libro: <?= $fila["isbn"]; ?>
                        </option>

                        <?php
                        // Cerrar los estructuras de control
                    endforeach;
                endif;
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Agregar</button>

    </form>

</div>

<?php
// Importar el código del otro archivo
require("libro_select.php");

// Verificar si llegan datos
if ($resultadoLibro and $resultadoLibro->num_rows > 0):
    ?>

    <!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
    <div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

        <table class="table table-striped table-bordered">

            <!-- Títulos de la tabla, cambiarlos -->
            <thead class="table-dark">
                <tr>
                    <th scope="col" class="text-center">ISBN</th>
                    <th scope="col" class="text-center">Titulo</th>
                    <th scope="col" class="text-center">Fecha Publicación</th>
                    <th scope="col" class="text-center">Paginas</th>
                    <th scope="col" class="text-center">Idioma</th>
                    <th scope="col" class="text-center">Volumen</th>
                    <th scope="col" class="text-center">Editorial</th>
                    <th scope="col" class="text-center">Valor</th>
                    <th scope="col" class="text-center">Código Bibliteca</th>
                    <th scope="col" class="text-center">ISBN Libro Volumen Anterior</th>
                    <th scope="col" class="text-center">Acciones</th>
                </tr>
            </thead>

            <tbody>

                <?php
                // Iterar sobre los registros que llegaron
                foreach ($resultadoLibro as $fila):
                    ?>

                    <!-- Fila que se generará -->
                    <tr>
                        <!-- Cada una de las columnas, con su valor correspondiente -->
                        <td class="text-center"><?= $fila["isbn"]; ?></td>
                        <td class="text-center"><?= $fila["titulo"]; ?></td>
                        <td class="text-center"><?= $fila["fecha_publicacion"]; ?></td>
                        <td class="text-center"><?= $fila["paginas"]; ?></td>
                        <td class="text-center"><?= $fila["idioma"]; ?></td>
                        <td class="text-center"><?= $fila["volumen"]; ?></td>
                        <td class="text-center"><?= $fila["editorial"]; ?></td>
                        <td class="text-center">$<?= $fila["valor"]; ?></td>
                        <td class="text-center"><?= $fila["codigo_biblioteca"]; ?></td>
                        <?php

                        if (empty($fila["libro_anterior"])) {
                            ?>
                            <td class="text-center">N/A</td>
                            <?php
                        } else {
                            ?>
                            <td class="text-center">NIT: <?= $fila["libro_anterior"]; ?></td>
                            <?php
                        }

                        ?>

                        <!-- Botón de eliminar. Debe de incluir la CP de la entidad para identificarla -->
                        <td class="text-center">
                            <form action="libro_delete.php" method="post">
                                <input hidden type="text" name="codigoEliminar" value="<?= $fila["isbn"]; ?>">
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