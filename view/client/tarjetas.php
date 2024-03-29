<?php include_once "navbar.php"; ?>
<?php include_once "modals/tarjetasModal.php"; ?>
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
                                <div id="cambiarVista" tabindex="0" role="button" class="btn h-8 min-h-8 btn-ghost rounded-btn" onclick="toggleView()">Tarjeta</div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($accessCards != "error" && mysqli_num_rows($accessCards) > 0) { ?>
                    <!--Contenido en tabla-->
                    <div class="overflow-x-auto hidden" id="table-view">
                        <table class="table bg-gris-oscurito shadow-xl text-center items-center">
                            <!-- head -->
                            <thead>
                                <tr class="text-gray-200 font-semibold text-base">
                                    <th>ID</th>
                                    <th>QR Code</th>
                                    <th>Fecha de Creación</th>
                                    <th>Fecha de Vencimiento</th>
                                    <th>Tipo de Tarjeta</th>
                                    <th>Nombre</th>
                                    <th>Foto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row 1 -->
                                <?php  // Almacenamos los resultados en un array
                                $cardsData = [];
                                while ($row = mysqli_fetch_assoc($accessCards)) {
                                    $cardsData[] = $row;
                                }

                                foreach ($cardsData as $row) { ?>
                                    <tr class="text-base">
                                        <td><?php echo $row['pk_card']; ?></td>
                                        <td><?php echo $row['QR_code']; ?></td>
                                        <td><?php echo $row['card_creation_date']; ?></td>
                                        <td><?php echo $row['card_end_date']; ?></td>
                                        <td><?php echo $row['card_type']; ?></td>
                                        <?php if (isset($row['employee_name'])) { ?>
                                            <td><?php echo $row['employee_name']; ?></td>
                                        <?php } else { ?>
                                            <td><?php echo $row['visit_name']; ?></td>
                                        <?php } ?>
                                        <td>
                                            <div class="avatar online">
                                                <div class="w-16 rounded-full">
                                                    <img src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!--Contenido en tarjetas-->
                    <div class="overflow-x-auto" id="card-view">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            <?php // Iteramos sobre el array para generar las filas de la tabla
                            foreach ($cardsData as $row) { ?>
                                <div class="bg-gris-oscurito p-6 rounded-xl shadow-md relative overflow-hidden">
                                    <!--ID y Tipo de tarjtea del propietario-->
                                    <span class="absolute top-0 left-0 w-1/5 h-5 bg-blue-900 text-white rounded-sm flex items-center justify-center">
                                        <?= $row['pk_card'] ?>
                                    </span>
                                    <span class="absolute top-0 right-0 w-4/5 h-5 bg-gris-oscurito border-b border-blue-900 text-white rounded-sm text-sm flex items-center justify-center">
                                        <?= $row['card_type'] ?>
                                    </span>
                                    <!--Foto propietario de la tarjeta-->
                                    <div class="mb-4 mt-5">
                                        <img src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" alt="Employee Photo" class="w-full rounded-full">
                                    </div>
                                    <!--QR y nombre del propietario-->
                                    <div class="mb-4">
                                        <p class="text-sm font-semibold">QR: <?php echo $row['QR_code']; ?></p>
                                        <p class="text-sm text-gray-500">Propietario: <?php
                                                                                        if (isset($row['employee_name'])) {
                                                                                            echo $row['employee_name'];
                                                                                        } else {
                                                                                            echo $row['visit_name'];
                                                                                        }
                                                                                        ?></p>
                                    </div>
                                    <!--Fechas de vecimiento de las tarjetas-->
                                    <p class="text-sm text-gray-500 mb-4"><strong>Fecha de vencimiento:</strong> <?php echo $row['card_creation_date'] . ' ' . $row['card_end_date']; ?></p>
                                    <!--Detalles del empleado-->
                                    <button class="btn btn-outline btn-success btn-xs" onclick="verDetalles(
                        '<?php // echo $row['pk_employee']; ?>',
                        '<?php // echo $row['employee_name']; ?>',
                        '<?php // echo $row['employee_lastNameP']; ?>',
                        '<?php // echo $row['employee_lastNameM']; ?>',
                        '<?php // echo $row['rol_name']; ?>'
                    )">Detalles</button>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</div>
</body>
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
</script>