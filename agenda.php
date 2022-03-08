<?php

$error = null;
// RF1  Si he apretado submit

$submit = $_POST['submit'] ?? null;

if (isset ($submit)) {

// RF2 Leer valores del formulario (nombre, tel, agenda)

    $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_STRING);
    $telefono = $_POST['telefono'];
    var_dump($nombre);
    var_dump($telefono);

    $error = valida_contacto($nombre,$telefono);
    var_dump($error);
}


//RF3 Vamos a establecer una variable de error

/*Identica los posibles errores a considerar:
   1.- El nombre está vacío
   2.- El teléfono no es numérico
   3.-
*/

//Creamos las funciones necesarias para
//Obtener el error
function valida_contacto($nombre,$telefono)
{
    if($nombre === "")
        $error = "Introduce un nombre para el contacto";

    else if ($telefono === "")
        $error = "Introduce un teléfono para el contacto";

    else
        $error = null;

        return $error;
}

/*
RF 4, el kernel del ejercicio:
 Ahora ya tenemos los datos del usuario RF1 y posible error RF 2
 Actuamos en consecuencia:

//Si no  hay error realizamos la acción selecciona (add o borrar)
*/
#if ($error) {

#} else {
//Realizamos la acción seleccionada (borrar, actualizar )
//Generamos un mensaje , ya que la acción añadir puede ser una modificación del teléfono
#}


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
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/style.css"/> -->

</head>
<body>
<header class=" bg-dark navborder">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="agenda.php">
                <h1 class="logotipo"> Agenda </h1>
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
                    <form action="agenda.php" method="POST">
                        <fieldset>
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
                            <button type="submit" name="submit" class="btn btn-success submit"> Añadir </button>
                            <button type="submit" name="submit" class="btn btn-warning submit"> Borrar </button>
                            <button type="submit" name="submit" class="btn btn-danger submit"> Borrar todos </button>
                            <?php
                            //foreach ($agenda as $nombre => $tel) {
                            //   echo "<input type='hidden' name='agenda[$nombre]' value ='$tel'>\n";
                            //} ?>
                        </fieldset>
                    </form>
                </section>
                <?php
                //Si hay error, informamos de ello
                if($error)
                    echo "<div class='alert alert-danger' role='alert'> $error </div> "

                ?>
            </div>
            <!-- Lista contactos -->
            <div class="col col-md-6">
                <h4 class="display-5"> Mis contactos </h4>
            </div>
        </div>
</main>
<footer class="bg-secondary pt-2 pb-2 ">
    <div class="container">
        <div class="row">
            <nav class="menu-footer">
                <div class="text-center">
                    <!-- <h6 class="text-white"> Página de Rubén © </h6> -->
                </div>
            </nav>
        </div>
    </div>
</footer>
<!-- Bootstrap JS -->
<!-- <script src="node_modules/bootstrap/js/bootstrap.bundle.min.js"></script> -->
</body>
</html>
