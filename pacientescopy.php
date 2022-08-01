<?php



//importar Conexión
require 'includes/config/database.php';
$db = conectarDB();

//Query
// $query = "SELECT * FROM pacientes";
if($_POST["buscar"] == '' AND $_POST['buscarDocumento'] == '' AND $_POST['buscarDoctor'] == '' AND $_POST['buscarOdontologico'] == ''){
$filtro = '';
}else{
    if($_POST["buscar"] != '' AND $_POST['buscarDocumento'] == '' AND $_POST['buscarDoctor'] == '' AND $_POST['buscarOdontologico'] == ''){
        $filtro = "WHERE nombre = '".$_POST["buscar"]."'";
    }if($_POST["buscar"] == '' AND $_POST['buscarDocumento'] != '' AND $_POST['buscarDoctor'] == '' AND $_POST['buscarOdontologico'] == ''){
        $filtro = "WHERE nombre = '".$_POST["buscar"]."' AND numero_documento = '".$_POST["buscarDocumento"]."' ";
    }if($_POST["buscar"] != '' AND $_POST['buscarDocumento'] != '' AND $_POST['buscarDoctor'] == '' AND $_POST['buscarOdontologico'] == ''){
        $filtro = "WHERE nombre = '".$_POST["buscar"]."' AND numero_documento = '".$_POST["buscarDocumento"]."' ";
    }if($_POST["buscar"] == '' AND $_POST['buscarDocumento'] != '' AND $_POST['buscarDoctor'] != '' AND $_POST['buscarOdontologico'] == ''){
        $filtro = "WHERE nombre = '".$_POST["buscar"]."' AND numero_documento = '".$_POST["buscarDocumento"]."' AND doctor =  '".$_POST["buscarDoctor"]."' ";
    }
}

$query = "SELECT pacientes.idPacientes, nombre, apellido, numero_documento, fecha_nacimiento, edad, doctor, odontologico, 
genero.nombre_genero, estado_civil.estado, tipo_documento.tipo FROM pacientes 
LEFT jOIN genero on pacientes.genero_idgenero = genero.idgenero
LEFT jOIN estado_civil on pacientes.estado_civil_idestado_civil = estado_civil.idestado_civil
LEFT jOIN tipo_documento on pacientes.tipo_documento_idtipo_documento = tipo_documento.idtipo_documento
$filtro;
";
//consultar datos

$resultado = mysqli_query($db, $query);

//mostrar datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id) {
        $query = "DELETE FROM pacientes WHERE idPacientes = ${id}";

        $resultado = mysqli_query($db, $query);
        if ($resultado) {
            header('location: /pacientescopy.php');
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
                <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
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
                                    <a class="nav-link" href="index.php">Crear</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="pacientes.php">Pacientes</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <section>
        <div class="container">
            <div class="container-fluid col-md-6 mt-4 ">
                <form class="d-flex justify-content-end" action="pacientescopy.php" method="POST" role="search">
                    <div class="col-8 row">
                        <label for="" class="form-label"> Paciente</label>
                        <input type="text" class="form-control" id="buscar" name="buscar" value="<?php echo  $_POST['buscar'] ?>">

                        <div class="col-11">
                            <table class="table">
                                <thead>
                                    <tr class="filters">
                                        <th>
                                            numero documento:
                                            <input class="form-control mt-2" type="number" id="buscarDocumento" name="buscarDocumento" value="<?php echo  $_POST['buscarDocumento'] ?>">
                                        </th>
                                        <th>
                                            Doctor:
                                            <input class="form-control mt-2" type="text" id="buscarDoctor" name="buscarDoctor" value="<?php echo  $_POST['buscarDoctor'] ?>">
                                        </th>
                                        <th>
                                            Odontologico:
                                            <input class="form-control mt-2" type="text" id="buscarOdontologico" name="buscar=dontologico" value="<?php echo  $_POST['buscarOdontologico'] ?>">
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                            <div class="col-1">
                                <input type="submit" class="btn btn-primary" value="ver">
                            </div>
                    </div>

                    <?php 
                    //filtrar
                    // $queryFiltrar =  "SELECT * FROM pacientes"; 

                    // $filtrar = mysqli_query($db, $queryFiltrar);

                    ?>
                </form>
            </div>

        </div>
        </div>

        <div class="container mt-5 table-responsive">


            <table class="pacientes table table-striped-columns table-bordered table-sm">
                <thead class="text-bg-info p-3">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Tipo Documento</th>
                        <th scope="col">Numero Documento</th>
                        <th scope="col">Fecha de nacimiento</th>
                        <th scope="col">edad</th>
                        <th scope="col">Genero</th>
                        <th scope="col">Estado civil</th>
                        <th scope="col">Doctor</th>
                        <th scope="col">Odontologico</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while ($paciente = mysqli_fetch_assoc($resultado)) : ?>
                        <tr>
                            <td><?php echo $paciente['nombre'] ?></td>
                            <td><?php echo $paciente['apellido'] ?></td>
                            <td><?php echo $paciente['tipo'] ?></td>
                            <td><?php echo $paciente['numero_documento'] ?></td>
                            <td><?php echo $paciente['fecha_nacimiento'] ?></td>
                            <td><?php echo $paciente['edad'] ?> años</td>
                            <td><?php echo $paciente['nombre_genero'] ?></td>
                            <td><?php echo $paciente['estado'] ?></td>
                            <td><?php echo $paciente['doctor'] ?></td>
                            <td><?php echo $paciente['odontologico'] ?></td>
                            <td>
                                <form method="POST">

                                    <input type="hidden" name='id' value="<?php echo $paciente['idPacientes'] ?>">
                                    <input type="image" src="img/delete2.png" class="p-2">


                                </form>
                                <a href="editar.php?id=<?php echo $paciente['idPacientes'] ?>" class="link-primary p-2"> <i class="bi bi-pencil-square fs-5"></i></a>

                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>


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

</body>

</html>