<?php

// Crear conexión con la BD
require('../config/conexion.php');

// Sacar la CP de la entidad
$codigo_campus = $_POST["codigo_campus"];

// Query SQL a la BD
$query = "DELETE FROM campus WHERE codigo_campus = '$codigo_campus'";

// Ejecutar consulta
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

if ($result):
    // Si fue exitosa, redirigirse de nuevo a la página de la entidad
    header("Location: campus.php");
else:
    echo "Ha ocurrido un error al eliminar este registro";
endif;

mysqli_close($conn);