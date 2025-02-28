<?php

// Crear conexión con la BD
require('../config/conexion.php');

// Sacar la CP de la entidad
$codigo_biblio = $_POST["codigo_biblio"];

// Query SQL a la BD
$query = "DELETE FROM biblioteca WHERE codigo_biblio = '$codigo_biblio'";

// Ejecutar consulta
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

if ($result):
    // Si fue exitosa, redirigirse de nuevo a la página de la entidad
    header("Location: biblioteca.php");
else:
    echo "Ha ocurrido un error al eliminar este registro";
endif;

mysqli_close($conn);