<?php
/*
    Alumno: Gallardo Joaquín
    Tema: Catálogo de Películas
    Descripción: 
    Este proyecto permite mostrar un catálogo de películas guardadas en un archivo json
    externo. El usuario puede agregar nuevas películas mediante un formulario. El programa
    usa Programación Orientada a Objetos (clase Pelicula) para representar cada película.
*/

// Carga la clase pelicula desde la carpeta "clases" la cual esta en la carpeta de assets
require_once __DIR__ . "/clases/pelicula.php";

// Ruta al archivo JSON donde se guardan las películas
$archivo = __DIR__ . "/data/peliculas.json";

// *****************************************************
// Carga películas existentes desde el archivo json
// *****************************************************
$peliculas = [];

if (file_exists($archivo)) {
    // Lee el contenido del json
    $contenido = file_get_contents($archivo);

    // Decodifica json a array de PHP
    $decoded = json_decode($contenido, true);

    // Valida que sea un array antes de usarlo
    if (is_array($decoded)) {
        $peliculas = $decoded;
    }
}

// *****************************************************
// Convierte el array de películas en objetos Pelicula
// *****************************************************
$peliculasObjetos = [];

foreach ($peliculas as $p) {
    // Crea un objeto Pelicula por cada entrada del json
    $peliculasObjetos[] = new Pelicula(
        $p["titulo"],
        $p["anio"],
        $p["genero"],
        $p["descripcion"]
    );
}

// *****************************************************
// Procesa el formulario cuando el usuario agrega una película
// *****************************************************

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Limpia datos ingresados por el usuario
    $titulo = trim($_POST["titulo"]);
    $anio = trim($_POST["anio"]);
    $genero = trim($_POST["genero"]);
    $descripcion = trim($_POST["descripcion"]);

    // Hace que valide los campos vacíos
    if ($titulo !== "" && $anio !== "" && $genero !== "" && $descripcion !== "") {

        // Crea un objeto pelicula usando POO
        $nueva = new Pelicula($titulo, (int)$anio, $genero, $descripcion);

        // Guarda los datos en el array que luego se irá al json
        $peliculas[] = [
            "titulo" => $titulo,
            "anio" => (int)$anio,
            "genero" => $genero,
            "descripcion" => $descripcion
        ];

        // Guarda todo el array actualizado dentro del archivo json
        file_put_contents(
            $archivo,
            json_encode($peliculas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
            LOCK_EX
        );

        // Para evitar reenvío del formulario, recarga la página
        header("Location: index.php");
        exit;

    } else {
        // Mensaje por si falta completar algún campo
        $mensajeError = "Completá todos los campos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Catálogo de Películas</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<h1><?php echo Pelicula::saludo(); ?></h1>

<!-- Muestra un error si existe -->
<?php if (!empty($mensajeError)): ?>
    <p class="error"><?= htmlspecialchars($mensajeError) ?></p>
<?php endif; ?>

<!-- Cantidad total de películas -->
<h2>Listado de películas (<?= count($peliculasObjetos) ?>)</h2>

<div class="contenedor">
<?php
// Si no hay películas cargadas, muestra mensaje
if (empty($peliculasObjetos)) {
    echo "<p>No hay películas cargadas.</p>";
} else {
    // Busca las peliculas y los muestra en pantalla
    foreach ($peliculasObjetos as $p) {
        echo "<div class='pelicula'>";
        echo "<h3>" . htmlspecialchars($p->getTitulo()) . " (" . htmlspecialchars($p->anio) . ")</h3>";
        echo "<p><b>Género:</b> " . htmlspecialchars($p->genero) . "</p>";
        echo "<p>" . nl2br(htmlspecialchars($p->descripcion)) . "</p>";
        echo "</div>";
    }
}
?>
</div>

<hr>

<h2>Agregar nueva película</h2>

<!-- Botón que muestra/oculta el formulario con JS -->
<button id="btn-toggle">Mostrar formulario</button>

<!-- Formulario para agregar películas -->
<form id="form-pelicula" method="POST" action="" style="display:none;">
    <label>Título:</label>
    <input type="text" name="titulo" required><br>

    <label>Año:</label>
    <input type="text" name="anio" required><br>

    <label>Género:</label>
    <input type="text" name="genero" required><br>

    <label>Descripción:</label><br>
    <textarea name="descripcion" rows="3" cols="40" required></textarea><br>

    <input type="submit" value="Agregar">
</form>

<script src="assets/js/script.js"></script>
</body>
</html>
