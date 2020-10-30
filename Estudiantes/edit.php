<?php
include '../layout/layout.php';
include '../helpers/utilities.php';

//inicia sesion
session_start();

//solo actua si existe el id
if (isset($_GET['id'])) {

    $estudianteId = $_GET['id'];

    $_SESSION['estudiantes'] = isset($_SESSION['estudiantes']) ? $_SESSION['estudiantes'] : array();

    $estudiantes = $_SESSION['estudiantes'];

    $element = searchProperty($estudiantes, 'id', $estudianteId)[0];
    $elementIndex = getIndexElement($estudiantes, 'id', $estudianteId);



    if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['carrera'])) {

        $newEstado = false;

       
        

        $nuevoEstudiante = ['id' => $estudianteId, 'nombre' => $_POST['nombre'], 'apellido' => $_POST['apellido'], 'carrera' => $_POST['carrera'], 'estado' => $_POST['estado']];

        $estudiantes[$elementIndex] = $nuevoEstudiante;

        $_SESSION['estudiantes'] = $estudiantes;

        header("Location: ../index.php");
        exit();
    }
} else {
    header("Location: ../index.php");
    exit();
}



?>
<?php printHeader(true); ?>



<main role="main">

    <div style="margin-top:2%;" class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-dark text-light">
                    <a href="../index.php" class="btn btn-warning">Volver atras</a>
                    Editar este estudiante
                </div>
                <div class="card-body">

                    <form action="edit.php?id=<?php echo $element['id'] ?>" method="POST">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $element['nombre'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="apellido">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $element['apellido'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="carrera">Carrera</label>
                            <select class="form-control" id="carrera" name="carrera">
                                <?php foreach ($carrera as $id => $text) :  ?>
                                    <?php if ($id == $element['carrera']) : ?>
                                        <option selected value="<?php echo $id ?>"><?php echo $text ?></option>
                                    <?php else : ?>
                                        <option value="<?php echo $id ?>"><?php echo $text ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group form-check">
                            <?php if ($element['estado']) : ?>
                                <input checked type="checkbox" class="form-check-input" id="estado" name="estado">
                            <?php else : ?>
                                <input type="checkbox" class="form-check-input" id="estado" name="estado">
                            <?php endif; ?>

                            <label class="form-check-label" for="estado">Activo?</label>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>


                    </form>

                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>




</main>


<?php printFooter(true); ?>