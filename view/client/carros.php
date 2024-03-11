<?php 
    include_once "navbar.php";
    include_once(__DIR__ . "/../../data/class/car.php");
    include_once(__DIR__ . "/../../data/class/employee.php");
    
    if(!isset($_SESSION['client_id'])) {
        header("Location: index.php");
        exit();
    }
    $client_id = $_SESSION['client_id'];
    $car = new Car();
    $car->fk_client = $client_id;
    $employee = new Employee();
    $employee->setFKclient($client_id);
    $cars = $car->getCarInformation();
    $empleados = $employee->getEmployee();
?>
<div>
    <div class="relative md:pt-32 pb-32 pt-12">
        <div class="px-4 md:px-10 mx-auto w-full">
            <div>
                <div class="navbar bg-base-300 rounded-box mb-5">
                    <div class="flex-1 px-2 lg:flex-none">
                        <button class="btn h-8 min-h-8 btn-outline btn-info" onclick="abrirModal('agregarCarroModal')"> + Añadir carro</button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="table bg-gray-700">
                        <thead>
                            <tr class="font-semibold text-base">
                                <th>ID</th>
                                <th>Matrícula</th>
                                <th>Año del modelo</th>
                                <th>Marca</th>
                                <th>Color</th>
                                <th>Estado</th>
                                <th>Empleado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                while ($row = mysqli_fetch_assoc($cars)) { ?>
                                <tr class="text-base">
                                    <td><?php echo $row['pk_car'] ?></td>
                                    <td><?php echo $row['matricula'] ?></td>
                                    <td><?php echo $row['model_year'] ?></td>
                                    <td><?php echo $row['brand_name'] ?></td>
                                    <td><?php echo $row['model_color'] ?></td>
                                    <td><?php echo $row['status_name'] ?></td>
                                    <td><?php echo $row['employee_name'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once "modals/car.php"; ?>
