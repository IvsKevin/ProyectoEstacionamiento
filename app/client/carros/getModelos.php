<?php
// getModelos.php

include_once(__DIR__ . '/../../../data/class/car.php');

if (isset($_GET['marca'])) {
    $marca = $_GET['marca'];
    $carObj = new Car();
    $modelos = $carObj->getModelByID($marca);
    $data = array();
    while ($row = mysqli_fetch_assoc($modelos)) {
        $data[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    http_response_code(400);
    echo json_encode(array('error' => 'Parámetros incorrectos'));
}