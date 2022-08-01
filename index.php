<?php

require 'includes/config/database.php';
$db = conectarDB();

// consultar para optener los datos de los select

$queryTipoDocumento = "SELECT * FROM tipo_documento";
$resultadoTipoDocumento = mysqli_query($db, $queryTipoDocumento);

$queryGenero = "SELECT * FROM genero";
$resultadoGenero = mysqli_query($db, $queryGenero);

$queryEstadoCivil = "SELECT * FROM estado_civil";
$resultadoEstadoCivil = mysqli_query($db, $queryEstadoCivil);


//variables de los campos del formulario
$errores = [];
$nombre = '';
$apellido = '';
$tipoDocumento = '';
$numeroDocumento = '';
$fechaNacimiento = '';
$edad = '';
$genero = '';
$estadoCivil = '';
$doctor = '';
$odontologico = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
    $apellido = mysqli_real_escape_string($db, $_POST['apellido']);
    $tipoDocumento = mysqli_real_escape_string($db, $_POST['tipoDocumento']);
    $numeroDocumento = mysqli_real_escape_string($db, $_POST['numeroDocumento']);
    $fechaNacimiento = mysqli_real_escape_string($db, $_POST['fechaNacimiento']);
    $edad = mysqli_real_escape_string($db, $_POST['edad']);
    $genero = mysqli_real_escape_string($db, $_POST['genero']);
    $estadoCivil = mysqli_real_escape_string($db, $_POST['estadoCivil']);
    $doctor = mysqli_real_escape_string($db, $_POST['doctor']);
    // $odontologico = mysqli_real_escape_string($db, $_POST['odontologico']);



    /*validar campos si se encuentran vacios añadir la informacion
 a el arreglo errores para luego validar dicho arreglo*/
    if (!$nombre) {
        $errores[] = '* nombre sin diligenciar';
    }
    if (!$apellido) {
        $errores[] = '* apellido sin diligenciar';
    }
    if (!$tipoDocumento) {
        $errores[] = '* tipo documento sin diligenciar';
    }
    if (!$fechaNacimiento) {
        $errores[] = '* fecha nacimiento sin diligenciar';
    }
    if (!$edad) {
        $errores[] = '* edad sin diligenciar';
    }
    if (!$genero) {
        $errores[] = '* genero sin diligenciar';
    }
    if (!$estadoCivil) {
        $errores[] = '* estado civil sin diligenciar';
    }
    if (!$doctor) {
        $errores[] = '* doctor sin diligenciar';
    }
    // REVISAR QUE EL ARRAY ERRORES ESTE VACIO PARA EJECUTAR EL QUERY

    if (empty($errores)) {
        $query = "INSERT INTO pacientes (nombre, apellido,  tipo_documento_idtipo_documento, numero_documento, fecha_nacimiento, edad, genero_idgenero, estado_civil_idestado_civil, doctor, odontologico) VALUES ('$nombre', '$apellido', '$tipoDocumento',
        '$numeroDocumento', '$fechaNacimiento', '$edad', '$genero', '$estadoCivil', '$doctor', '$odontologico' )";

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            //redireccionar
            header('Location: /index.php');
        }
    }
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacientes</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/style.css">
</head>

<body class="bg-light">
    <header>
        <div class="container">
            <div class="row">
                <div class="container col-md-12">
                    <img src="/img/header.jpg" alt="" class="" width="100%" height="300px">
                </div>
            </div>
            <div class="row px-2">
                <nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-primary">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarText">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="inicio.php">Inicio</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="index.php">Crear</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="pacientes.php">Pacientes</a>
                                </li>
                               
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <section>
        <div class="container ">



            <div class="row">
                <form class="row g-3" method="POST" action="index.php">
                    <fieldset> <b>Crear Paciente </b> </fieldset>
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text"  class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $apellido; ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="tipoDocumento" class="form-label">Tipo de documento</label>
                        <select id="tipoDocumento" class="form-select" name="tipoDocumento" value="<?php echo $tipoDocumento; ?>">
                        <option selected></option>  
                        <option disabled >--seleccione--</option>
                            <?php while ($row = mysqli_fetch_assoc($resultadoTipoDocumento)) : ?>
                                <option <?php echo $tipoDocumento === $row['idtipo_documento'] ? 'selected' : '';  ?> value="<?php echo $row['idtipo_documento']; ?>"><?php echo $row['tipo']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="numeroDocumento" class="form-label">Numero de documento</label>
                        <input type="number" class="form-control" id="numeroDocumento" name="numeroDocumento" value="<?php echo $numeroDocumento; ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="fechaNacimiento" class="form-label">Fecha de nacimiento</label>
                        <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo $fechaNacimiento; ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="edad" class="form-label">edad</label>
                        <input type="number" class="form-control" id="edad" name="edad" value="<?php echo $edad; ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="genero" class="form-label">Genero</label>
                        <select id="genero" class="form-select" name="genero" value="<?php echo $genero; ?>">
                        <option selected></option>  
                        <option disabled>--seleccione</option>
                            <?php while ($row = mysqli_fetch_assoc($resultadoGenero)) : ?>
                                <option <?php echo $genero === $row['idgenero'] ? 'selected' : '';  ?> value="<?php echo $row['idgenero']; ?>"> <?php echo $row['nombre_genero'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="estadoCivil" class="form-label">Estado civil</label>
                        <select id="estadoCivil" class="form-select" name="estadoCivil" value="<?php echo $estadoCivil; ?>">
                        <option selected></option>  
                        <option  disabled>--seleccione--</option>
                            <?php while ($estado = mysqli_fetch_assoc($resultadoEstadoCivil)) : ?>
                                <option <?php echo $estadoCivil === $estado['idestado_civil'] ? 'selected' : '';  ?> value="<?php echo $estado['idestado_civil']; ?>"> <?php echo $estado['estado'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="doctor" class="form-label">Doctor</label>
                        <input type="text" class="form-control" id="doctor" name="doctor" value="<?php echo $doctor; ?>">
                    </div>
                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="odontologico" value="no" name="odontologico">
                            <label class="form-check-label" for="odontologico">Paciente Odontologico</label>
                        </div>
                        <div class="row  mt-5">

                            <?php foreach ($errores as $error) : ?>
                                <div class="error text-center m-1 p-1">
                                    <?php echo $error; ?>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                    <div class="col-12 pt-4">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>

            </div>

        </div>
    </section>

    <footer class="bg-light mt-5">
        <div class="container text-center pt-5">
            <div class="row justify-content-center">
                <i class="bi bi-facebook col-md-4"></i>
                <i class="bi bi-instagram col-md-4"></i>
                <i class="bi bi-whatsapp col-md-4"></i>
            </div>
            <div class="row justify-content-center pt-2">
                <h6>Todos los derechos reservados</h6>
            </div>
        </div>
    </footer>
<script src="app.js"></script>
</body>

</html>