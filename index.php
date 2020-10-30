<?php
include 'layout/layout.php';
include 'helpers/utilities.php';
//crea tu sesion tranquilo en index
session_start();

$_SESSION['estudiantes'] = isset($_SESSION['estudiantes']) ? $_SESSION['estudiantes'] : array();

$listadoEstudiantes = $_SESSION['estudiantes'];

if (!empty($listadoEstudiantes)) {
    if (isset($_GET['carreraId'])) {
        $listadoEstudiantes = searchProperty($listadoEstudiantes, 'carrera', $_GET['carreraId']);
    }
}

?>
<?php printHeader(); ?>

<main role="main">

    <section class="jumbotron text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1>Listado de Estudiantes</h1>
                </div>
                <div class="col-md-4">
                    <a href="Estudiantes/add.php" class="btn btn-primary my-2">Agregar Estudiante</a>
                </div>
            </div>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row" style="margin-bottom: 1%;">
                <div class="col-md-3">Filtrar por:</div>
                <div class="col-md-9">
                    <div class="btn-group">
                        <a href="index.php" class="btn btn-dark text-light">Todos</a>
                        <a href="index.php?carreraId=1" class="btn btn-dark text-light">Redes</a>
                        <a href="index.php?carreraId=2" class="btn btn-dark text-light">Software</a>
                        <a href="index.php?carreraId=3" class="btn btn-dark text-light">Multimedia</a>
                        <a href="index.php?carreraId=4" class="btn btn-dark text-light">Mecatronica</a>
                        <a href="index.php?carreraId=5" class="btn btn-dark text-light">Seg. Informatica</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">Carrera</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listadoEstudiantes as $estudiante) : ?>
                            <tr>
                                <th scope="row"><?php echo $estudiante['id']; ?></th>
                                <th><?php echo $estudiante['nombre']; ?></th>
                                <th><?php echo $estudiante['apellido']; ?></th>
                                <th><?php echo getCarrera($estudiante['carrera']); ?></th>
                                <?php if ($estudiante['estado']) : ?>
                                    <th>Activo</th>
                                <?php else : ?>
                                    <th>Inactivo</th>
                                <?php endif; ?>
                                <th>
                                    <a href="Estudiantes/edit.php?id=<?php echo $estudiante['id']; ?>" class="btn btn-warning">Editar</a>
                                    <a href="Estudiantes/delete.php?id=<?php echo $estudiante['id']; ?>" class="btn btn-danger">Eliminar</a>
                                </th>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</main>
<?php printFooter(); ?>