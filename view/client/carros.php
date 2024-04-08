<?php
include_once "navbar.php";
include_once(__DIR__ . "/../../data/class/car.php");
include_once(__DIR__ . "/../../data/class/employee.php");

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
                <!--Inicio de la barrita de navegacion-->
                <div class="navbar rounded-box">
                    <div class="flex-1 px-2 lg:flex-none">
                        <button class="btn h-8 min-h-8 btn-outline btn-info" onclick="abrirModal('agregarCarroModal')"> + Añadir carro</button>
                    </div>
                    <div class="flex-1 px-2 lg:flex-none">
                        <button class="btn h-8 min-h-8h-8 min-h-8 btn-outline btn-primary" onclick="">Ultimos 30 dias</button>
                    </div>
                    <div class="flex-1 px-2 lg:flex-none">
                        <button class="btn h-8 min-h-8 btn-outline btn-primary" onclick="abrirFiltrosModal()">Filtrar por</button>
                    </div>
                    <div class="flex justify-end flex-1 px-2">
                        <div class="flex items-stretch">
                            <a class="btn h-8 min-h-8 btn-ghost rounded-btn">Button</a>
                            <div class="dropdown dropdown-end">
                                <div tabindex="0" role="button" class="btn h-8 min-h-8 btn-ghost rounded-btn">Config</div>
                                <ul tabindex="0" class="menu dropdown-content z-[1] p-2 shadow bg-base-100 rounded-box w-52 mt-4">
                                    <li><a>Item 1</a></li>
                                    <li><a>Item 2</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($cars != "error") { ?>
                    <div class="overflow-x-auto">
                        <table class="table bg-gris-oscurito shadow-xl text-center items-center">
                            <!-- head -->
                            <thead>
                                <tr class="text-gray-200 font-semibold text-base">
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
                                <!-- row 1 -->
                                <?php while ($row = mysqli_fetch_assoc($cars)) { ?>
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
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</div>
</body>

<?php include_once "modals/carModal.php"; ?>

<?php
if(isset($_SESSION['error_message'])) {
    echo '<script>abrirModal("errorModal");</script>';
    unset($_SESSION['error_message']);
}
?>
