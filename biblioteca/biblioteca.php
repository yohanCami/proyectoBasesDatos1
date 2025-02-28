<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Biblioteca</h1>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <form action="biblioteca_insert.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="cod_biblio" class="form-label">Codigo Biblioteca*</label>
            <input type="number" class="form-control" id="cod_biblio" name="cod_biblio" required min="1">
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre*</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="mb-3">
            <label for="capacidad_maxima" class="form-label">Capacidad Máxima*</label>
            <input type="number" class="form-control" id="capacidad_maxima" name="capacidad_maxima" required min="1">
        </div>

        <!-- Consultar la lista de clientes y desplegarlos -->
        <div class="mb-3">
            <label for="campus" class="form-label">Campus*</label>
            <select name="campus" id="camus" class="form-select">

                <!-- Option por defecto -->
                <option value="" selected disabled hidden></option>

                <?php
                // Importar el código del otro archivo
                require("../campus/campus_select.php");

                // Verificar si llegan datos
                if ($resultadoCampus):

                    // Iterar sobre los registros que llegaron
                    foreach ($resultadoCampus as $fila):
                        ?>

                        <!-- Opción que se genera -->
                        <option value="<?= $fila["codigo_campus"]; ?>"><?= $fila["nombre"]; ?> - Código
                            <?= $fila["codigo_campus"]; ?>
                        </option>

                        <?php
                        // Cerrar los estructuras de control
                    endforeach;
                endif;
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="link_horarios" class="form-label">Link de horarios en PDF*</label>
            <input type="text" class="form-control" id="link_horarios" name="link_horarios" required>
        </div>

        <div class="mb-3">
            <label for="num_contacto" class="form-label">Número de contacto*</label>
            <input type="number" class="form-control" id="num_contacto" name="num_contacto" required min="1">
        </div>

        <div class="mb-3">
            <label for="sis_ref" class="form-label">Sistema de Referencia</label>
            <input type="text" class="form-control" id="sis_ref" name="sis_ref">
        </div>

        <button type="submit" class="btn btn-primary">Agregar</button>

    </form>

</div>

<?php
// Importar el código del otro archivo
require("biblioteca_select.php");

// Verificar si llegan datos
if ($resultadoBiblioteca and $resultadoBiblioteca->num_rows > 0):
    ?>

    <!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
    <div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

        <table class="table table-striped table-bordered">

            <!-- Títulos de la tabla, cambiarlos -->
            <thead class="table-dark">
                <tr>
                    <th scope="col" class="text-center">Código Biblioteca</th>
                    <th scope="col" class="text-center">Nombre</th>
                    <th scope="col" class="text-center">Capacidad Máxima</th>
                    <th scope="col" class="text-center">Link Horarios</th>
                    <th scope="col" class="text-center">Número de Contacto</th>
                    <th scope="col" class="text-center">Sistema de Referencia</th>
                    <th scope="col" class="text-center">Código Campus</th>
                    <th scope="col" class="text-center">Acciones</th>
                </tr>
            </thead>

            <tbody>

                <?php
                // Iterar sobre los registros que llegaron
                foreach ($resultadoBiblioteca as $fila):
                    ?>

                    <!-- Fila que se generará -->
                    <tr>
                        <!-- Cada una de las columnas, con su valor correspondiente -->
                        <td class="text-center"><?= $fila["codigo_biblio"]; ?></td>
                        <td class="text-center"><?= $fila["nombre_biblio"]; ?></td>
                        <td class="text-center"><?= $fila["capacidad_maxima"]; ?></td>
                        <td class="text-center"><a href="<?= $fila["horarios_link_pdf"]; ?>" target="_blank">Link horarios</a>
                        </td>
                        <td class="text-center"><?= $fila["numero_contacto"]; ?></td>
                        <td class="text-center"><?= $fila["sistema_referencia"]; ?></td>
                        <td class="text-center"><?= $fila["CAMPUS"]; ?></td>

                        <!-- Botón de eliminar. Debe de incluir la CP de la entidad para identificarla -->
                        <td class="text-center">
                            <form action="biblioteca_delete.php" method="post">
                                <input hidden type="text" name="codigo_biblio" value="<?= $fila["codigo_biblio"]; ?>">
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