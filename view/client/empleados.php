<!--Incluimos el navbar-->
<?php include_once "navbar.php"; ?>
<?php include_once "modals/empleadosModal.php"; ?>

<?php
//Agregamos la clase del empleados.
include_once(__DIR__ . "/../../data/class/employee.php");

//Creamos un objeto que sea de nuestro cliente para obtener todos sus valores.
$employee = new Employee();

//Le decimos que haga el display de los empleados que coincidan con la pk del cliente.
$employee->setFKclient($_SESSION['client_id']);
$employees = $employee->getEmployee();
?>
<div>
    <div class="relative md:pt-32 pb-32 pt-12">
        <div class="px-4 md:px-10 mx-auto w-full">
            <div>
                <!--Inicio de la barrita de navegacion-->
                <div class="navbar rounded-box">
                    <div class="flex-1 px-2 lg:flex-none">
                        <button class="btn h-8 min-h-8 btn-outline btn-info" onclick="agregarEmpleado()"> + Añadir empleado</button>
                    </div>
                    <div class="flex-1 px-2 lg:flex-none">
                        <button class="btn h-8 min-h-8h-8 min-h-8 btn-outline btn-primary" onclick="">Ultimos 30 dias</button>
                    </div>
                    <div class="flex-1 px-2 lg:flex-none">
                        <button class="btn h-8 min-h-8 btn-outline btn-primary" onclick="">Filtrar por</button>
                    </div>
                    <div class="flex justify-end flex-1 px-2">
                        <div class="flex items-stretch">
                            <a class="btn h-8 min-h-8 btn-ghost rounded-btn">Button</a>
                            <div class="dropdown dropdown-end">
                                <div id="cambiarVista" tabindex="0" role="button" class="btn h-8 min-h-8 btn-ghost rounded-btn" onclick="toggleView()">Tabla</div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($employees != "error") { ?>
                    <!--Contenido en tabla-->
                    <div class="overflow-x-auto" id="table-view">
                        <table class="table bg-gris-oscurito shadow-xl text-center items-center">
                            <!-- head -->
                            <thead>
                                <tr class="text-gray-200 font-semibold text-base">
                                    <th>ID</th>
                                    <th>Photo</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row 1 -->
                                <?php // Almacenamos los resultados en un array
                                $employeeData = [];
                                while ($row = mysqli_fetch_assoc($employees)) {
                                    $employeeData[] = $row;
                                }

                                // Iteramos sobre el array para generar las filas de la tabla
                                foreach ($employeeData as $row) { ?>
                                    <tr class="text-base">
                                        <!--ID del empleado-->
                                        <td><?php echo $row['pk_employee'] ?></td>
                                        <!--Foto del empleado-->
                                        <td>
                                            <div class="avatar online">
                                                <div class="w-16 rounded-full">
                                                    <img src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                                                </div>
                                            </div>
                                        </td>
                                        <!--Nombre del empleado-->
                                        <td>
                                            <?php echo $row['employee_name'] ?>
                                            <br />
                                            <!--Rol del empleado-->
                                            <span class="p-3 badge badge-ghost badge-sm"><?php echo $row['rol_name'] ?></span>
                                        </td>
                                        <!--Apellidos del empleado-->
                                        <td><?php echo $row['employee_lastNameP'] . ' ' . $row['employee_lastNameM'] ?></td>
                                        <!--Ver detalles del empleado-->
                                        <td>
                                            <button class="btn btn-outline btn-success btn-xs" onclick="actualizarEmpleado(
                                                '<?php echo $row['pk_employee']; ?>',
                                                '<?php echo $row['employee_name']; ?>',
                                                '<?php echo $row['employee_lastNameP']; ?>',
                                                '<?php echo $row['employee_lastNameM']; ?>',
                                                '<?php echo $row['rol_name']; ?>'
                                            )">Detalles</button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!--Contenido en tarjetas-->
                    <div class="overflow-x-auto hidden" id="card-view">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            <?php // Iteramos sobre el array para generar las filas de la tabla
                            foreach ($employeeData as $row) { ?>
                                <div class="bg-gris-oscurito p-6 rounded-xl shadow-md">
                                    <!--Foto del empleado-->
                                    <div class="mb-4">
                                        <img src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" alt="Employee Photo" class="w-full rounded-full">
                                    </div>
                                    <!--Nombre y rol del empleado-->
                                    <div class="mb-2">
                                        <p class="text-lg font-semibold"><?php echo $row['employee_name']; ?></p>
                                        <p class="text-sm text-gray-500"><?php echo $row['rol_name']; ?></p>
                                    </div>
                                    <!--Apellidos del empleado-->
                                    <p class="text-sm text-gray-700 mb-4"><?php echo $row['employee_lastNameP'] . ' ' . $row['employee_lastNameM']; ?></p>
                                    <!--Detalles del empleado-->
                                    <button class="btn btn-outline btn-success btn-xs" onclick="actualizarEmpleado(
                        '<?php echo $row['pk_employee']; ?>',
                        '<?php echo $row['employee_name']; ?>',
                        '<?php echo $row['employee_lastNameP']; ?>',
                        '<?php echo $row['employee_lastNameM']; ?>',
                        '<?php echo $row['rol_name']; ?>'
                    )">Detalles</button>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } else { ?>
                    <p>No hay empleados para mostrar.</p>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</div>
</body>

<?php
// Verifica si el parámetro 'eliminacion' está presente en la URL
if (isset($_GET['eliminacion'])) {
    // Recupera el valor del parámetro 'eliminacion'
    $eliminacion = $_GET['eliminacion'];
    // Muestra los detalles de la entrada al usuario
    echo "<dialog id='eliminacionModal' class='modal bg-black-300 text-white'>
            <div class='modal-box'>
                <form method='dialog'>
                    <button class='btn btn-sm btn-circle btn-ghost absolute right-2 top-2'>✕</button>
                </form>
                <h3 class='font-bold text-lg'>Resultado de la eliminacion del empleado</h3>
                <div class='modal-action  flex flex-col items-center'>";
    if ($eliminacion != '') {
        echo "<p>$eliminacion</p>";
    }
    echo "</div>
            </div>
        </dialog>";
?>
    <script>
        eliminacionModal.showModal();
    </script>
<?php } ?>

<!-- Script para cambiar entre la vista de tabla y tarjetas -->
<script>
    function toggleView() {
        var cambiarVista = document.getElementById('cambiarVista');
        var tableView = document.getElementById('table-view');
        var cardView = document.getElementById('card-view');

        // Si la vista de tabla está visible, ocúltala y muestra la vista de tarjetas (y viceversa)
        if (tableView.style.display === 'block' || tableView.style.display === '') {
            tableView.style.display = 'none';
            cardView.style.display = 'block';
            cambiarVista.innerText = "Tarjeta";
        } else {
            tableView.style.display = 'block';
            cardView.style.display = 'none';
            cambiarVista.innerText = "Tabla";
        }
    }
</script>