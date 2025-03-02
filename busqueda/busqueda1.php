<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Búsqueda 1</h1>

<p class="mt-3">
    Con el código de la biblioteca y un rango de fechas f1 y f2 se desea obtener todos lo libros que se encuentran en
    esa biblioteca y que fueron publicados dentro de ese rango de fechas
</p>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <!-- En esta caso, el Action va a esta mismo archivo -->
    <form action="busqueda1.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="fecha1" class="form-label">Fecha 1</label>
            <input type="date" class="form-control" id="fecha1" name="fecha1" required>
        </div>

        <div class="mb-3">
            <label for="fecha2" class="form-label">Fecha 2</label>
            <input type="date" class="form-control" id="fecha2" name="fecha2" required>
        </div>

        <div class="mb-3">
            <label for="codigo_biblio" class="form-label">Código Bilioteca</label>
            <input type="number" class="form-control" id="codigo_biblio" name="codigo_biblio" required>
        </div>

        <button type="submit" class="btn btn-primary">Buscar</button>

    </form>

</div>

<?php
// Dado que el action apunta a este mismo archivo, hay que hacer eata verificación antes
if ($_SERVER['REQUEST_METHOD'] === 'POST'):

    // Crear conexión con la BD
    require('../config/conexion.php');

    $fecha1 = $_POST["fecha1"];
    $fecha2 = $_POST["fecha2"];
    $codigo_biblio = $_POST["codigo_biblio"];

    // Query SQL a la BD -> Crearla acá (No está completada, cambiarla a su contexto y a su analogía)
    $query = "SELECT *
              FROM libro
              WHERE libro.biblioteca = $codigo_biblio
                AND libro.fecha_publicacion BETWEEN '$fecha1' AND '$fecha2';";

    // Ejecutar la consulta
    $resultadoB1 = mysqli_query($conn, $query) or die(mysqli_error($conn));

    mysqli_close($conn);

    // Verificar si llegan datos
    if ($resultadoB1 and $resultadoB1->num_rows > 0):
        ?>

        <!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
        <div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

            <table class="table table-striped table-bordered">

                <!-- Títulos de la tabla, cambiarlos -->
                <thead class="table-dark">
                    <tr>
                        <th scope="col" class="text-center">Código Libro</th>
                        <th scope="col" class="text-center">ISBN</th>
                        <th scope="col" class="text-center">Editorial</th>
                        <th scope="col" class="text-center">Valor</th>
                        <th scope="col" class="text-center">Fecha de publicación</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    // Iterar sobre los registros que llegaron
                    foreach ($resultadoB1 as $fila):
                        ?>

                        <!-- Fila que se generará -->
                        <tr>
                            <!-- Cada una de las columnas, con su valor correspondiente -->
                            <td class="text-center"><?= $fila["codigo_id"]; ?></td>
                            <td class="text-center"><?= $fila["isbn"]; ?></td>
                            <td class="text-center"><?= $fila["editorial"]; ?></td>
                            <td class="text-center"><?= $fila["valor"]; ?></td>
                            <td class="text-center"><?= $fila["fecha_publicacion"]; ?></td>
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
endif;

include "../includes/footer.php";
?>