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
                    <label class="relative flex items-center">
                        <input type="text" id="searchInput" placeholder="Buscar por nombre..." class="ml-2 pl-4 pr-10 py-1 bg-gris-oscurito border border-search rounded-lg focus:outline-none focus:ring focus:border-search transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="absolute right-3 top-1/2 transform -translate-y-1/2 h-6 w-6 text-gray-400">
                            <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" />
                        </svg>
                    </label>

                    <!-- <div class="flex-1 px-2 lg:flex-none">
                        <button class="btn h-8 min-h-8h-8 min-h-8 btn-outline btn-primary" onclick="">Ultimos 30 dias</button>
                    </div>
                    <div class="flex-1 px-2 lg:flex-none">
                        <button class="btn h-8 min-h-8 btn-outline btn-primary" onclick="">Filtrar por</button>
                    </div> -->
                    <div class="flex justify-end flex-1 px-2">
                        <div class="flex items-stretch">
                            <a class="btn h-8 min-h-8 btn-ghost rounded-btn">Button</a>
                            <div class="dropdown dropdown-end">
                                <div id="cambiarVista" tabindex="0" role="button" class="btn h-8 min-h-8 btn-ghost rounded-btn" onclick="toggleView()">Tarjeta</div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($employees != "error") { ?>
                    <!--Contenido en tabla-->
                    <div class="overflow-x-auto hidden" id="table-view">
                        <table id="employeeTable" class="table bg-gris-oscurito shadow-xl text-center items-center">
                            <!-- head -->
                            <thead>
                                <tr class="text-gray-200 font-semibold text-base">
                                    <th>ID</th>
                                    <th>Photo</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Telefono</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
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
                                        <!--Ver telefono-->
                                        <td><?php echo $row['tel']?></td>
                                        <td>
                                            <button class="btn btn-outline btn-success btn-xs" onclick="actualizarEmpleado(
                                                '<?php echo $row['pk_employee']; ?>',
                                                '<?php echo $row['employee_name']; ?>',
                                                '<?php echo $row['employee_lastNameP']; ?>',
                                                '<?php echo $row['employee_lastNameM']; ?>',
                                                '<?php echo $row['tel']; ?>',
                                                '<?php echo $row['rol_name']; ?>'
                                            )">Detalles</button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!--Contenido en tarjetas-->
                    <div class="overflow-x-auto" id="card-view">
                        <div id="employeeCardContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            <?php // Iteramos sobre el array para generar las filas de la tabla
                            foreach ($employeeData as $row) { ?>
                                <div class="bg-gris-oscurito p-6 rounded-xl shadow-md relative">
                                    <!--ID y Tipo de tarjtea del propietario-->
                                    <span class="absolute top-0 left-0 w-1/5 h-5 bg-blue-900 text-white rounded-sm flex items-center justify-center">
                                        <?= $row['pk_employee'] ?>
                                    </span>
                                    <span class="absolute top-0 right-0 w-4/5 h-5 bg-gris-oscurito border-b border-blue-900 text-white rounded-sm text-sm flex items-center justify-center">
                                        <?= $row['rol_name'] ?>
                                    </span>
                                    <!--Foto del empleado-->
                                    <div class="mb-4 mt-5">
                                        <img src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" alt="Employee Photo" class="w-full rounded-full">
                                    </div>
                                    <!--Nombre y rol del empleado-->
                                    <div class="mb-2">
                                        <p class="text-sm font-semibold">Nombre: <?php echo $row['employee_name']; ?></p>
                                    </div>
                                    <!--Apellidos del empleado-->
                                    <p class="text-sm text-gray-500 mb-4">Apellidos: <?php echo $row['employee_lastNameP'] . ' ' . $row['employee_lastNameM']; ?></p>
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
<?php if (isset($_GET['insercionExitosa'])) { ?>
    <div id="insercionExitosa" role="alert" class="alert alert-success absolute z-20 bottom-5 left-5 w-2/5 transition-opacity duration-1000">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>La inserccion del empleado ha sido exitosa!</span>
    </div>
    <script>
        // Obtener el elemento del mensaje de éxito
        var insercionExitosa = document.getElementById('insercionExitosa');

        // Función para ocultar el mensaje después de 3 segundos
        setTimeout(function() {
            insercionExitosa.style.opacity = '0';
        }, 3000);
    </script>
<?php } ?>
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

        // Si la vista de tarjetas está visible, ocúltala y muestra la vista de tabla (y viceversa)
        if (cardView.style.display === 'block' || cardView.style.display === '') {
            cardView.style.display = 'none';
            tableView.style.display = 'block';
            cambiarVista.innerText = "Tabla";
        } else {
            cardView.style.display = 'block';
            tableView.style.display = 'none';
            cambiarVista.innerText = "Tarjeta";
        }
    }

    // Función para buscar empleados por nombre en tiempo real
    function searchEmployees() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("employeeTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2]; // La tercera columna contiene el nombre del empleado
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    // Llamar a la función de búsqueda cada vez que el usuario escribe algo en el campo de búsqueda
    document.getElementById("searchInput").addEventListener("input", searchEmployees);

    // Función para buscar empleados por nombre en tiempo real en la vista de tarjetas
    function searchEmployeesCards() {
        var input, filter, cards, card, name, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        cards = document.getElementById("employeeCardContainer").getElementsByClassName("bg-gris-oscurito"); // Obtenemos todas las tarjetas de empleado
        for (i = 0; i < cards.length; i++) {
            card = cards[i];
            name = card.getElementsByClassName("text-sm font-semibold")[0]; // Obtenemos el elemento que contiene el nombre del empleado
            if (name) {
                txtValue = name.textContent || name.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    card.style.display = "";
                } else {
                    card.style.display = "none";
                }
            }
        }
    }

    // Llamar a la función de búsqueda cada vez que el usuario escribe algo en el campo de búsqueda
    document.getElementById("searchInput").addEventListener("input", searchEmployeesCards);
</script>