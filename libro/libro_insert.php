<?php

// Crear conexión con la BD
require('../config/conexion.php');

// Sacar los datos del formulario. Cada input se identifica con su "name"
$codigo_isbn = $_POST["codigo_isbn"];
$titulo = $_POST["titulo"];
$fechapublicacion = $_POST["fechapublicacion"];
$paginas = $_POST["paginas"];
$idioma = $_POST["idioma"];
$volumen = $_POST["volumen"];
$editorial = $_POST["editorial"];
$valor = $_POST["valor"];
$biblioteca = $_POST["biblioteca"];
$libro = $_POST["libro"];

if (empty($libro)):

	// Query SQL a la BD. Si tienen que hacer comprobaciones, hacerlas acá (Generar una query diferente para casos especiales)
	$query = "INSERT INTO `libro`(`isbn`,`titulo`, `fecha_publicacion`, `paginas`, `idioma`, `volumen`, `editorial`, `valor`, `codigo_biblioteca`) VALUES ('$codigo_isbn', '$titulo', '$fechapublicacion', '$paginas', '$idioma', '$volumen', '$editorial', '$valor', '$biblioteca')";

	// Ejecutar consulta
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

	// Redirigir al usuario a la misma pagina
	if ($result):
		// Si fue exitosa, redirigirse de nuevo a la página de la entidad
		header("Location: libro.php");
	else:
		echo "Ha ocurrido un error al crear el libro";
	endif;

	mysqli_close($conn);

else:

	// Query SQL a la BD. Si tienen que hacer comprobaciones, hacerlas acá (Generar una query diferente para casos especiales)
	$query = "INSERT INTO `libro`(`isbn`,`titulo`, `fecha_publicacion`, `paginas`, `idioma`, `volumen`, `editorial`, `valor`, `codigo_biblioteca`, `libro_anterior`) VALUES ('$codigo_isbn', '$titulo', '$fechapublicacion', '$paginas', '$idioma', '$volumen', '$editorial', '$valor', '$biblioteca', '$libro')";

	// Ejecutar consulta
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

	// Redirigir al usuario a la misma pagina
	if ($result):
		// Si fue exitosa, redirigirse de nuevo a la página de la entidad
		header("Location: libro.php");
	else:
		echo "Ha ocurrido un error al crear el libro";
	endif;

	mysqli_close($conn);

endif;