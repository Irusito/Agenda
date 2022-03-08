<?php


// RF1  Si he apretado submit

// RF2 Leer valores del formulario (nombre, tel, agenda)
#$nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_STRING);
//...

//RF3 Vamos a establecer una variable de error
#$error = null;
/*Identica los posibles errores a considerar:
   1.- El nombre está vacío
   2.- El teléfono no es numérico
   3.-
*/

//Creamos las funciones necesarias para
//Obtener el error
#$error = valida_nombre($nombre);
//...

/*
RF 4, el kernel del ejercicio:
 Ahora ya tenemos los datos del usuario RF1 y posible error RF 2
 Actuamos en consecuencia:

//Si hay error, informamos de ello
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
            <a class="navbar-brand" href="#">
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
                <section>
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
                            <?php
                            //foreach ($agenda as $nobmre => $tel) {
                            //   echo "<input type='hidden' name='agenda[$nombre]' value ='$tel'>\n";
                            //} ?>
                        </fieldset>
                    </form>
                </section>
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
