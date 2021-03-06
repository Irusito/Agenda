<?php
//RF3 Vamos a establecer una variable de error

$error = null;
$msg = null;

//Creamos las funciones necesarias para obtener el error:

//paso $nombre por referencia para poder modificarlo (quitándole espacios en blanco)
function valida_contacto(&$nombre, $telefono, $agenda, &$msg)
{
    $error = null;
    $nombre = trim($nombre);
    if ($nombre === "") {
        $msg = "Introduce un nombre para el contacto";
        $error = true;
    } else if ($agenda === []) {
        if ($telefono === false) {
            $msg = "Introduce un teléfono para el contacto";
            $error = true;
        }
    }
    return $error;
}

$submit = $_POST['submit'] ?? null;
// RF1  Si he apretado submit
if (isset ($submit)) {
// RF2 Leer valores del formulario (nombre, tel, agenda)

    $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_STRING);
    $telefono = filter_input(INPUT_POST, "telefono", FILTER_VALIDATE_INT);
    $agenda = $_POST['agenda'] ?? [];

    $error = valida_contacto($nombre, $telefono, $agenda, $msg);

//Si error es null realizamos la accion:

    switch ($submit) {
        case("actualizar"):
            if (is_null($error)) {
                # si teléfono está vacío eliminara el contacto de la agenda
                if ($telefono === false) {
                    if (array_key_exists($nombre, $agenda)) {
                        unset($agenda[$nombre]);

                        $msg = "Se ha borrado el contacto: '$nombre' de la agenda";
                    } else {
                        $msg = "No se puede eliminar un contacto inexistente";
                    }
                } else //Le asigna el nombre con el valor teléfono al array agenda
                {
                    if (array_key_exists($nombre, $agenda)) {
                        $agenda [$nombre] = $telefono;
                        $msg = "Se ha modificado el contacto: '$nombre' ";
                        break;
                    } else {
                        $agenda [$nombre] = $telefono;
                        $msg = "Se ha añadido el contacto: '$nombre' ";
                    }
                }
                break;
            }
            break;
        case("borrar_todos"):
            if ($agenda == []) {
                $msg = "Todavía no hay contactos que borrar";
            } else {
                $agenda = [];
                $msg = "Se han eliminado todos los contactos";
            }
            break;
    }
}
?>
<!doctype html>
<html lang="es">
<head>
    <title>Agenda</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <!-- Bootstrap CSS -->
    <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS propio -->
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<header class=" bg-dark navborder">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <h1 class="logotipo"> Mi Agenda </h1>
            </a>
        </div>
    </nav>
</header>
<main>
    <div class="container mt-5 mb-5">
        <div class="row mb-5">
            <div class="col col-md-6">
                <!-- Formulario -->
                <section class="mb-3">
                    <h4 class="display-5"> Añadir contactos </h4>
                    <form action="index.php" method="POST">
                        <fieldset class="mb-3">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input placeholder="Juan" name="nombre" type="text"
                                       class="form-control" id="nombre">
                            </div>
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input placeholder="000111222" name="telefono" type="number"
                                       class="form-control" id="telefono">
                            </div>
                            <button type="submit" name="submit" value="actualizar" class="btn btn-success submit">
                                Actualizar
                            </button>
                            <button type="submit" name="submit" value="borrar_todos" class="btn btn-danger submit">
                                Borrar todos
                            </button>
                            <?php
                            foreach ($agenda as $nombre => $telefono)
                                echo "<input type='hidden' name='agenda[$nombre]' value ='$telefono'>";
                            ?>
                        </fieldset>
                    </form>
                    <p class="info-extra"> Introduce un contacto listado con el teléfono vacío para eliminarlo </p>
                </section>
                <?php
                //Mensaje de información
                if ($msg)
                    echo "<div class='alert alert-info' role='alert'> $msg </div> ";
                ?>
            </div>
            <!-- Lista contactos -->
            <div class="col col-md-6">
                <h4 class="display-5"> Mis contactos </h4>
                <?php
                //si se agrega un contacto aparece esto:
                if ($_POST['submit'] === "actualizar") {
                    if ($agenda !== []) {
                        echo "<fieldset class='tabla-contactos p-3 mb-2'>";
                        foreach ($agenda as $nombre => $telefono) {
                            echo "<h6>Nombre:</h6>";
                            echo "<p> $nombre </p>";

                            echo "<h6>Teléfono:</h6>";
                            echo "<p> $telefono </p>";

                            echo "<hr>";
                        }
                        echo "</fieldset>";
                    }
                }
                ?>
            </div>
        </div>
</main>
<footer class="bg-dark pt-2 pb-2 ">
    <div class="container">
        <div class="row">
            <nav class="menu-footer">
                <div class="text-center">
                    <h6 class="text-white"> Página de Rubén © </h6>
                </div>
            </nav>
        </div>
    </div>
</footer>
</body>
</html>