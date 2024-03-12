<?php include_once "navbar.php"; ?>
<?php
include_once(__DIR__ . '/../../data/class/accesscard.php');

$accessCard = new AccessCard();
$accessCards = $accessCard->getAccessCardsByClient($_SESSION['client_id']);
?>

<div>
    <div class="relative md:pt-32 pb-32 pt-12">
        <div class="px-4 md:px-10 mx-auto w-full">
            <div>
                <!--Inicio de la barrita de navegacion-->
                <div class="navbar rounded-box">
                    <div class="flex-1 px-2 lg:flex-none">
                        <button class="btn h-8 min-h-8 btn-outline btn-info" onclick="agregarTarjeta()"> + Añadir tarjeta</button>
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
                                <div tabindex="0" role="button" class="btn h-8 min-h-8 btn-ghost rounded-btn">Config</div>
                                <ul tabindex="0" class="menu dropdown-content z-[1] p-2 shadow bg-base-100 rounded-box w-52 mt-4">
                                    <li><a>Item 1</a></li>
                                    <li><a>Item 2</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($accessCards != "error" && mysqli_num_rows($accessCards) > 0) { ?>
                    <div class="overflow-x-auto">
                        <table class="table bg-gris-oscurito shadow-xl text-center items-center">
                            <!-- head -->
                            <thead>
                                <tr class="text-gray-200 font-semibold text-base">
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
                                <!-- row 1 -->
                                <?php while ($row = mysqli_fetch_assoc($accessCards)) { ?>
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