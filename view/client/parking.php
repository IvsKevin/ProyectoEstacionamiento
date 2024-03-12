<?php include_once "navbar.php"; ?>
<?php include_once "modals/parkingModal.php"; ?>


<?php
include_once("../../data/class/parking.php");
// Mostrar la lista de estacionamientos
$parkingHandler = new Parking();
$parkingHandler->setFKclient($_SESSION['client_id']);
$parkingList = $parkingHandler->getParkingList();
?>
<div>
    <div class="relative md:pt-32 pb-32 pt-12">
        <div class="px-4 md:px-10 mx-auto w-full">
            <div>
                <!--Inicio de la barrita de navegacion-->
                <div class="navbar rounded-box">
                    <div class="flex-1 px-2 lg:flex-none">
                        <button class="btn h-8 min-h-8 btn-outline btn-info" onclick="agregarParking()">+ Añadir estacionamiento</button>
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
                <?php
                // Verifica si $parkingList está definida y es un resultado válido
                if (isset($parkingList) && $parkingList !== "error") { ?>
                    <?php
                    // Itera sobre los resultados de la consulta
                    while ($row = mysqli_fetch_assoc($parkingList)) { ?>
                        <div class="overflow-x-auto">
                            <div class="rounded-lg overflow-hidden shadow-md border  bg-gray-800 border-blue-500 text-blue-600 mt-6">
                                <h3 class="font-bold text-xl p-4">Número de estacionamiento</h3>
                                <div class="p-4">
                                    <span class="font-bold block mt-2">Ubicación:</span>
                                    <p class="text-black-700 text-gray-300"><?php echo $row['parking_location']; ?></p>
                                    <span class="font-bold">Capacidad:</span>
                                    <p class="text-black-700 text-gray-300"><?php echo $row['parking_capacity']; ?></p>
                                    <span class="font-bold">Estado:</span>
                                    <p class="text-black-700 text-gray-300"><?php echo $row['status_name']; ?></p>
                                </div>
                                <?php echo "<a class='p-4 block border-blue-900 bg-blue-500 text-white text-center' href='cajones.php?idParking=" . $row["pk_parking"] . "'>Ver parking</a>"; ?>


                                <button class="btn btn-outline btn-success btn-xs" onclick="actualizarParking(
                                                '<?php echo $row['pk_parking']; ?>',
                                                '<?php echo $row['parking_location']; ?>',
                                                '<?php echo $row['status_name']; ?>'
                                            )">Editar</button>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>
        </div>
    </div>
</div>
</div>
</body>