<?php include_once "navbar.php"; ?>

<div class="relative bg-base-200 md:pt-32 pb-32 pt-12">
    <div class="px-4 md:px-10 mx-auto w-full">
        <div>
            <div class="navbar bg-base-300 rounded-box mb-5">
                <div class="flex-1 px-2 lg:flex-none">
                    <button class="btn h-8 min-h-8 btn-outline btn-info" onclick="agregarEmpleado()"> + Añadir empleado</button>
                </div>
                <!-- Botón para filtrar últimos 30 días -->
                <div class="flex-1 px-2 lg:flex-none">
                    <button class="btn h-8 min-h-8h-8 min-h-8 btn-outline btn-primary" onclick="">Ultimos 30 días</button>
                </div>
                <!-- Botón para filtrar por -->
                <div class="flex-1 px-2 lg:flex-none">
                    <button class="btn h-8 min-h-8 btn-outline btn-primary" onclick="">Filtrar por</button>
                </div>
                <!-- Dropdown de configuración -->
                <div class="flex-1 px-2 lg:flex-none">
                    <button class="btn h-8 min-h-8h-8 min-h-8 btn-outline btn-primary" onclick="">Ultimos 30 días</button>
                </div>
                <div class="flex-1 px-2 lg:flex-none">
                    <button class="btn h-8 min-h-8 btn-outline btn-primary" onclick="">Filtrar por</button>
                </div>
                <div class="flex justify-end flex-1 px-2">
                    <div class="flex items-stretch">
                        <a class="btn h-8 min-h-8 btn-ghost rounded-btn">Config</a>
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

            <div class="overflow-x-auto">
                <table class="table bg-gray-700">
                    <thead>
                        <tr class="font-semibold text-base">
                            <th>ID</th>
                            <th>QR Code</th>
                            <th>Fecha de Creación</th>
                            <th>Fecha de Vencimiento</th>
                            <th>Tipo de Tarjeta</th>
                            <th>Empleado</th>
                            <th>Foto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        include_once(__DIR__ . '/../../data/class/accesscard.php');

                        $accessCard = new AccessCard();

                        $client_id = $_SESSION['client_id'];

          
                        $client_id = $_SESSION['client_id'];

                        $accessCards = $accessCard->getAccessCardsByClient($client_id);

                        if ($accessCards != "error" && mysqli_num_rows($accessCards) > 0) {
                            while ($row = mysqli_fetch_assoc($accessCards)) { 
                                ?>
                                <tr class="text-base">
                                    <td><?php echo $row['pk_card']; ?></td>
                                    <td><?php echo $row['QR_code']; ?></td>
                                    <td><?php echo $row['card_creation_date']; ?></td>
                                    <td><?php echo $row['card_end_date']; ?></td>
                                    <td><?php echo $row['card_type']; ?></td>
                                    <?php
                                    $employeeName = $accessCard->getEmployeeName($row['fk_employee']);
                                    $employeePhoto = $accessCard->getEmployeePhoto($row['fk_employee']);
                                    ?>
                                    <td><?php echo $employeeName; ?></td>
                                    <td><img src="<?php echo $employeePhoto; ?>" class="w-10 h-10 rounded-full"></td>
                                </tr>
                                <?php 
                            }
                        } else {
                            echo "<tr><td colspan='7'>No se encontraron tarjetas de acceso.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
