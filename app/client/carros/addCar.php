<?php
include(__DIR__.'/../../../data/class/car.php');

session_start();

if(isset($_POST["empleado"])) {
    $employeeId = intval($_POST["empleado"]);
    $car = new Car();

    if($car->verificarCarroEmpleado($employeeId)) {
        $_SESSION['error_message'] = 'El empleado ya tiene un carro registrado.';
        header('Location: ../../../view/client/carros.php');
        exit;
    } else {
        $car->matricula = $_POST["matricula"];
        $car->model_year = $_POST["model_year"];
        $car->fk_employee = $employeeId;
        $car->fk_model = intval($_POST["modelo"]);
        $car->fk_color = intval($_POST["color"]);
        $car->fk_status = 1;
        $car->fk_client = $_SESSION["client_id"];

        $id = $car->setCarInformation();

        if($id > 0) {
            header('Location: ../../../view/client/carros.php');
            exit;
        } else {
            echo 'No se ha podido agregar el carro.';
        }
    }
} else {
    echo "Error: el campo 'empleado' no está definido en el formulario.";
}