<?php

namespace App;

class Car extends ActiveRecord
{
    // Base DE DATOS
    protected static $tabla = 'car_information';
    protected static $columnasDB = ['pk_car', 'matricula', 'model_year', 'fk_employee', 'fk_model', 'fk_color', 'fk_status', 'fk_client'];

    public $pk_car;
    public $matricula;
    public $model_year;
    public $fk_employee;
    public $fk_model;
    public $fk_color;
    public $fk_status;
    public $fk_client;

    // Externas
    public $brand_name;
    public $model_color;
    public $status_name;
    public $employee_name;

    public function __construct($args = [])
    {
        $this->pk_car = $args['pk_car'] ?? null;
        $this->matricula = $args['matricula'] ?? '';
        $this->model_year = $args['model_year'] ?? '';
        $this->fk_employee = $args['fk_employee'] ?? '';
        $this->fk_model = $args['fk_model'] ?? '';
        $this->fk_color = $args['fk_color'] ?? '';
        $this->fk_status = $args['fk_status'] ?? '';
        $this->fk_client = $args['fk_client'] ?? '';
    }

    public static function getCarInformation($id)
    {
        $query = "SELECT c.*, 
        e.employee_name, 
        e.pk_employee,
        m.model_name, 
        b.brand_name, 
        mc.model_color,
        g.status_name,
        g.pk_status
        FROM Car_Information AS c
            INNER JOIN Employee         AS e ON e.pk_employee = c.fk_employee
            INNER JOIN Model            AS m ON m.pk_model = c.fk_model
            INNER JOIN Brand            AS b ON b.pk_brand = m.fk_brand
            INNER JOIN Model_Color      AS mc ON mc.pk_color = c.fk_color
            INNER JOIN General_Status   AS g ON g.pk_status = c.fk_status
        WHERE c.fk_client = " . $id . "";

        $resultados = static::consultarSQL($query);

        return $resultados;
    }
}
