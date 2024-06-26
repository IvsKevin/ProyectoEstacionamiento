<?php include_once(__DIR__ . '/../conexion.php');

class Car extends conexion
{

    private $id;
    private $matricula;
    private $model_year;
    private $fk_employee;
    private $fk_model;
    private $fk_color;
    private $fk_status;
    private $fk_client;

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        } else {
            throw new Exception("Property {$property} does not exist on this object.");
        }
    }
    public function getCarInformation()
    {
        $query = "SELECT c.*, 
                e.employee_name, 
                e.pk_employee,
                m.model_name, 
                b.brand_name, 
                mc.model_color,
                g.status_name,
                g.pk_status
            FROM car_information AS c
                INNER JOIN employee         AS e ON e.pk_employee = c.fk_employee
                INNER JOIN model            AS m ON m.pk_model = c.fk_model
                INNER JOIN brand            AS b ON b.pk_brand = m.fk_brand
                INNER JOIN model_Color      AS mc ON mc.pk_color = c.fk_color
                INNER JOIN general_Status   AS g ON g.pk_status = c.fk_status
            WHERE c.fk_client = " . $this->fk_client . "";
        $result = $this->connect();
        if ($result == true) {
            $dataset = $this->execquery($query);
        } else {
            //echo "algo fallo";
            $dataset = "error";
        }
        return $dataset;
    }
    public function getCarInformationWithFilters($filterData)
    {
        $query = "SELECT c.*, 
                e.employee_name, 
                e.pk_employee,
                m.model_name, 
                b.brand_name, 
                mc.model_color,
                g.status_name,
                g.pk_status
            FROM car_information AS c
                INNER JOIN employee         AS e ON e.pk_employee = c.fk_employee
                INNER JOIN model            AS m ON m.pk_model = c.fk_model
                INNER JOIN brand            AS b ON b.pk_brand = m.fk_brand
                INNER JOIN model_Color      AS mc ON mc.pk_color = c.fk_color
                INNER JOIN general_Status   AS g ON g.pk_status = c.fk_status
            WHERE c.fk_client = " . $this->fk_client;

        // Aplicar filtros
        if (!empty($filterData['marca'])) {
            $query .= " AND b.pk_brand = " . $filterData['marca'];
        }
        if (!empty($filterData['modelo'])) {
            $query .= " AND m.pk_model = " . $filterData['modelo'];
        }
        if (!empty($filterData['color'])) {
            $query .= " AND mc.pk_color = " . $filterData['color'];
        }
        // Agrega más condiciones para otros filtros como año, empleado, etc.

        $result = $this->connect();
        if ($result == true) {
            $dataset = $this->execquery($query);
        } else {
            //echo "algo fallo";
            $dataset = "error";
        }
        return $dataset;
    }
    public function getMarca()
    {
        $query = "SELECT * FROM brand";
        $result = $this->connect();
        if ($result == true) {
            $dataset = $this->execquery($query);
        } else {
            //echo "algo fallo";
            $dataset = "error";
        }
        return $dataset;
    }

    public function verificarCarroEmpleado($employeeId)
    {
        $query = "SELECT COUNT(*) AS count FROM car_information WHERE fk_employee = $employeeId";
        $result = $this->connect();
        if ($result == true) {
            $row = mysqli_fetch_assoc($this->execquery($query));
            return $row['count'] > 0;
        } else {
            //echo "Algo falló al verificar el carro del empleado.";
            return false;
        }
    }

    public function getMarcaID($brand_name)
    {
        $query = "SELECT pk_brand FROM brand WHERE brand_name = '" . $brand_name . "'";
        $result = $this->connect();
        if ($result == true) {
            $consultado = $this->execquery($query);
            if ($consultado) {
                $row = mysqli_fetch_assoc($consultado);
                if ($row) {
                    return $row['pk_brand'];
                } else {
                    return null;
                }
            }
        } else {
            //echo "algo fallo";
            $consultado = 0;
        }
        return $consultado;
    }
    public function getModel()
    {
        $query = "SELECT * FROM model";
        $result = $this->connect();
        if ($result == true) {
            $dataset = $this->execquery($query);
        } else {
            //echo "algo fallo";
            $dataset = "error";
        }
        return $dataset;
    }
    public function getModelByID($fk_brand)
    {
        $query = "SELECT * FROM model WHERE fk_brand = $fk_brand";
        $result = $this->connect();
        if ($result == true) {
            $dataset = $this->execquery($query);
        } else {
            //echo "algo fallo";
            $dataset = "error";
        }
        return $dataset;
    }
    public function getModelColor()
    {
        $query = "SELECT * FROM model_color";
        $result = $this->connect();
        if ($result == true) {
            $dataset = $this->execquery($query);
        } else {
            //echo "algo fallo";
            $dataset = "error";
        }
        return $dataset;
    }
    public function setCarInformation()
    {
        $query = "INSERT INTO car_information (matricula, model_year, fk_employee, fk_model, fk_color, fk_status, fk_client) 
            VALUES ('" . $this->matricula . "', " . $this->model_year . ", " . $this->fk_employee . ", " . $this->fk_model . ", " . $this->fk_color . ", " . $this->fk_status . ", " . $this->fk_client . ")";
        $result = $this->connect();
        if ($result) {
            $newID = $this->execquery($query);
            //echo "Ha funcionado el registro del carro";
        } else {
            //echo "algo salio mal";
            $newID = "error";
        }
        return $newID;
    }
    public function updateCar()
    {
        $query = 'UPDATE car_Information SET fk_status = "' . $this->fk_status . '" WHERE pk_car = ' . $this->id . '';
        $result = $this->connect();
        if ($result) {
            //echo "Ha funcionado la actualizacion de usuario";
            $newID = $this->execquery($query);
        } else {
            //echo "algo salio mal";
            $newID = "error";
        }
        return $newID;
    }
}
