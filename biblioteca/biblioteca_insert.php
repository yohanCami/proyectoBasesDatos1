<?php

// Crear conexión con la BD
require('../config/conexion.php');

// Sacar los datos del formulario. Cada input se identifica con su "name"
$cod_biblio = $_POST["cod_biblio"];
$nombre = $_POST["nombre"];
$capacidad_maxima = $_POST["capacidad_maxima"];
$campus = $_POST["campus"];
$link_horarios = $_POST["link_horarios"];
$num_contacto = $_POST["num_contacto"];
$sis_ref = $_POST["sis_ref"];

if (empty($sis_ref)):

	// Query SQL a la BD. Si tienen que hacer comprobaciones, hacerlas acá (Generar una query diferente para casos especiales)
	$query = "INSERT INTO `biblioteca`(`codigo_biblio`,`nombre_biblio`, `capacidad_maxima`, `horarios_link_pdf`, `numero_contacto`, `CAMPUS`) VALUES ('$cod_biblio', '$nombre', '$capacidad_maxima', '$link_horarios', '$num_contacto', '$campus')";

	// Ejecutar consulta
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

	// Redirigir al usuario a la misma pagina
	if ($result):
		// Si fue exitosa, redirigirse de nuevo a la página de la entidad
		header("Location: biblioteca.php");
	else:
		echo "Ha ocurrido un error al crear la persona";
	endif;

	mysqli_close($conn);

else:

	// Query SQL a la BD. Si tienen que hacer comprobaciones, hacerlas acá (Generar una query diferente para casos especiales)
	$query = "INSERT INTO `biblioteca`(`codigo_biblio`,`nombre_biblio`, `capacidad_maxima`, `horarios_link_pdf`, `numero_contacto`, `sistema_referencia`, `CAMPUS`) VALUES ('$cod_biblio', '$nombre', '$capacidad_maxima', '$link_horarios', '$num_contacto', '$sis_ref','$campus')";

	// Ejecutar consulta
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

	// Redirigir al usuario a la misma pagina
	if ($result):
		// Si fue exitosa, redirigirse de nuevo a la página de la entidad
		header("Location: biblioteca.php");
	else:
		echo "Ha ocurrido un error al crear la persona";
	endif;

	mysqli_close($conn);

endif;

