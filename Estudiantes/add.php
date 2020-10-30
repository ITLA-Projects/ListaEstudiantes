<?php
include '../layout/layout.php';
include '../helpers/utilities.php';

//inicia sesion
session_start();

if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['carrera'])){

    $_SESSION['estudiantes'] = isset($_SESSION['estudiantes']) ? $_SESSION['estudiantes'] : array();
    
    $estudiantes = $_SESSION['estudiantes'];

    $estudianteId = 1;

    if(!empty($estudiantes)){
        $lastElement = getLastElement($estudiantes);
        $estudianteId = $lastElement['id'] + 1;
    }

    array_push($estudiantes,['id'=>$estudianteId,'nombre'=>$_POST['nombre'],'apellido'=>$_POST['apellido'],'carrera'=>$_POST['carrera'],'estado'=>'on']);

    $_SESSION['estudiantes'] = $estudiantes;

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
                    Crear nuevo estudiante
                </div>
                <div class="card-body">

                    <form action="add.php" method="POST">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre">
                        </div>
                        <div class="form-group">
                            <label for="apellido">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido">
                        </div>
                        <div class="form-group">
                            <label for="carrera">Carrera</label>
                            <select class="form-control" id="carrera" name="carrera">
                                <?php foreach ($carrera as $id => $text) :  ?>
                                    <option value="<?php echo $id ?>"><?php echo $text ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Agregar Estudiante</button>
                        </div>


                    </form>

                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>




</main>


<?php printFooter(true); ?>