<?php

// Crear conexión con la BD
require('../config/conexion.php');

// Query SQL a la BD
$query = "SELECT * FROM campus";

// Ejecutar la consulta
$resultadoCliente = mysqli_query($conn, $query) or die(mysqli_error($conn));

mysqli_close($conn);