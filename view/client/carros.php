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
                        <button class="btn h-8 min-h-8 btn-outline btn-primary" onclick="abrirFiltrosModal()">Filtrar por</button>
                    </div>
                    <label class="relative flex items-center">
                        <input type="text" id="searchInput" placeholder="Buscar por matricula..." class="ml-2 pl-4 pr-10 py-1 bg-gris-oscurito border border-search rounded-lg focus:outline-none focus:ring focus:border-search transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="absolute right-3 top-1/2 transform -translate-y-1/2 h-6 w-6 text-gray-400">
                            <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" />
                        </svg>
                    </label>
                    <div class="flex justify-end flex-1 px-2">
                        <div class="flex items-stretch">
                            <a class="btn h-8 min-h-8 btn-ghost rounded-btn">Button</a>
                            <div class="dropdown dropdown-end">
                                <div id="cambiarVista" tabindex="0" role="button" class="btn h-8 min-h-8 btn-ghost rounded-btn" onclick="toggleView()">Tarjeta</div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if ($cars != "error") {
                    // Almacenamos los resultados en un array
                    $carsData = [];
                    while ($row = mysqli_fetch_assoc($cars)) {
                        $carsData[] = $row;
                    }
                ?>
                    <div class="overflow-x-auto hidden" id="table-view">
                        <table id="carsTable" class="table bg-gris-oscurito shadow-xl text-center items-center">
                            <!-- head -->
                            <thead>
                                <tr class="text-gray-200 font-semibold text-base">
                                    <th>ID</th>
                                    <th>Empleado</th>
                                    <th>Matrícula</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Año del modelo</th>
                                    <th>Color</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row 1 -->
                                <?php foreach ($carsData as $row) : ?>
                                    <tr class="text-base">
                                        <td><?php echo $row['pk_car'] ?></td>
                                        <td><?php echo $row['employee_name'] ?></td>
                                        <td><?php echo $row['matricula'] ?></td>
                                        <td><?php echo $row['brand_name'] ?></td>
                                        <td><?php echo $row['model_name'] ?></td>
                                        <td><?php echo $row['model_year'] ?></td>
                                        <td><?php echo $row['model_color'] ?></td>
                                        <td><?php echo $row['status_name'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!--Contenido en tarjetas-->
                    <div class="overflow-x-auto" id="card-view">
                        <div id="carsCardContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            <?php // Iteramos sobre el array para generar las filas de la tabla
                            foreach ($carsData as $row) : ?>
                                <div class="bg-gris-oscurito p-6 rounded-xl shadow-md relative">
                                    <!--ID y Tipo de tarjeta del propietario-->
                                    <span class="absolute top-0 left-0 w-1/5 h-5 bg-blue-900 text-white rounded-sm flex items-center justify-center">
                                        <?= $row['pk_car'] ?>
                                    </span>
                                    <span id="matriculaSearch" class="absolute top-0 right-0 w-4/5 h-5 bg-gris-oscurito border-b border-blue-900 text-white rounded-sm text-sm flex items-center justify-center">
                                        <?= $row['matricula'] ?>
                                    </span>
                                    <!--Foto del empleado-->
                                    <div class="mb-4 mt-5">
                                        <label for="fileInput" class="cursor-pointer">
                                            <img src="../../assets/img/bg-carro.jpg" alt="Employee Photo" class="w-full rounded-full">
                                            <input id="fileInput" type="file" class="hidden" />
                                        </label>
                                    </div>
                                    <!--Datos del vehiculos-->
                                    <div class="mb-2">
                                        <p class="text-sm font-semibold m-0">Propietario: <?php echo $row['employee_name']; ?></p>
                                        <p class="text-sm text-gray-500 mt-1">Datos del vehiculo: </p>
                                        <p class="text-sm text-gray-500">Marca: <?php echo $row['brand_name']; ?> </p>
                                        <p class="text-sm text-gray-500">Modelo: <?php echo $row['model_name']; ?> </p>
                                        <p class="text-sm text-gray-500">Año: <?php echo $row['model_year']; ?> </p>
                                        <p class="text-sm text-gray-500">Color: <?php echo $row['model_color']; ?> </p>
                                        <p class="text-sm text-gray-500">Status: <?php echo $row['status_name']; ?> </p>
                                    </div>

                                    <div class="w-full flex flex-row mt-5">
                                        <button class="btn btn-outline btn-success btn-xs ml-0 m-2">Actualizar</button>
                                        <button class="btn btn-outline btn-error btn-xs m-2">Dar de baja</button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
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
if (isset($_SESSION['error_message'])) {
    echo '<script>abrirModal("errorModal");</script>';
    unset($_SESSION['error_message']);
}
?>