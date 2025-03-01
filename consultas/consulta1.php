<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Consulta 1</h1>

<p class="mt-3">
    Los datos de los tres libros de mayor valor junto con los datos de las bibliotecas asociados a cada uno de esos
    libros.
</p>

<?php
// Crear conexión con la BD
require('../config/conexion.php');

// Query SQL a la BD -> Crearla acá (No está completada, cambiarla a su contexto y a su analogía)
$query = "SELECT isbn, codigo_biblioteca, titulo, fecha_publicacion, valor, codigo_biblio, nombre_biblio, capacidad_maxima, horarios_link_pdf FROM libro JOIN biblioteca ON libro.codigo_biblioteca = biblioteca.codigo_biblio ORDER BY valor DESC LIMIT 3";

// Ejecutar la consulta
$resultadoC1 = mysqli_query($conn, $query) or die(mysqli_error($conn));

mysqli_close($conn);
?>

<?php
// Verificar si llegan datos
if ($resultadoC1 and $resultadoC1->num_rows > 0):
    ?>

    <!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
    <div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

        <table class="table table-striped table-bordered">

            <!-- Títulos de la tabla, cambiarlos -->
            <thead class="table-dark">
                <tr>
                    <th scope="col" class="text-center">ISBN - Titulo Libro</th>
                    <th scope="col" class="text-center">Fecha Publicación</th>
                    <th scope="col" class="text-center">CodBiblio - Nombre Biblio</th>
                    <th scope="col" class="text-center">Capacidad Máxima</th>
                    <th scope="col" class="text-center">Link Horarios</th>
                    <th scope="col" class="text-center">Valor</th>
                </tr>
            </thead>

            <tbody>

                <?php
                // Iterar sobre los registros que llegaron
                foreach ($resultadoC1 as $fila):
                    ?>

                    <!-- Fila que se generará -->
                    <tr>
                        <!-- Cada una de las columnas, con su valor correspondiente -->
                        <td class="text-center"><?= $fila["isbn"]; ?> - <?= $fila["titulo"]; ?></td>
                        <td class="text-center"><?= $fila["fecha_publicacion"]; ?></td>
                        <td class="text-center"><?= $fila["codigo_biblioteca"]; ?> - <?= $fila["nombre_biblio"]; ?></td>
                        <td class="text-center"><?= $fila["capacidad_maxima"]; ?></td>
                        <td class="text-center"><?= $fila["horarios_link_pdf"]; ?></td>
                        <td class="text-center">$<?= $fila["valor"]; ?></td>
                    </tr>

                    <?php
                    // Cerrar los estructuras de control
                endforeach;
                ?>

            </tbody>

        </table>
    </div>

    <!-- Mensaje de error si no hay resultados -->
    <?php
else:
    ?>

    <div class="alert alert-danger text-center mt-5">
        No se encontraron resultados para esta consulta
    </div>

    <?php
endif;

include "../includes/footer.php";
?>