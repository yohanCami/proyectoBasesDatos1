<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Búsqueda 2</h1>

<p class="mt-3">
    Con el código de un campus. Se debe mostrar los datos de los libros que hay en las bibliotecas de ese campus.
</p>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <!-- En esta caso, el Action va a esta mismo archivo -->
    <form action="busqueda2.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="codigo_campus" class="form-label">Numero 1</label>
            <input type="number" class="form-control" id="codigo_campus" name="codigo_campus" required>
        </div>

        <button type="submit" class="btn btn-primary">Buscar</button>

    </form>

</div>

<?php
// Dado que el action apunta a este mismo archivo, hay que hacer eata verificación antes
if ($_SERVER['REQUEST_METHOD'] === 'POST'):

    // Crear conexión con la BD
    require('../config/conexion.php');

    $codigo_campus = $_POST["codigo_campus"];

    // Query SQL a la BD -> Crearla acá (No está completada, cambiarla a su contexto y a su analogía)
    $query = "SELECT * 
              FROM libro JOIN biblioteca ON libro.biblioteca = biblioteca.codigo_biblio JOIN campus ON biblioteca.CAMPUS = campus.codigo_campus
              WHERE codigo_campus = $codigo_campus;";

    // Ejecutar la consulta
    $resultadoB2 = mysqli_query($conn, $query) or die(mysqli_error($conn));

    mysqli_close($conn);

    // Verificar si llegan datos
    if ($resultadoB2 and $resultadoB2->num_rows > 0):
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
                        <th scope="col" class="text-center">Codigo Biblioteca</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    // Iterar sobre los registros que llegaron
                    foreach ($resultadoB2 as $fila):
                        ?>

                        <!-- Fila que se generará -->
                        <tr>
                            <!-- Cada una de las columnas, con su valor correspondiente -->
                            <td class="text-center"><?= $fila["codigo_id"]; ?></td>
                            <td class="text-center"><?= $fila["isbn"]; ?></td>
                            <td class="text-center"><?= $fila["editorial"]; ?></td>
                            <td class="text-center"><?= $fila["valor"]; ?></td>
                            <td class="text-center"><?= $fila["fecha_publicacion"]; ?></td>
                            <td class="text-center"><?= $fila["biblioteca"]; ?></td>
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