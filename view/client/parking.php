<?php include_once "navbar.php"; ?>
<?php include_once "modals/parkingModal.php"; ?>

<?php
include_once("../../data/class/parking.php");
include_once("../../data/class/Espacios.php");

//Perdomo gay

// Mostrar la lista de estacionamientos
$parkingHandler = new Parking();
$parkingHandler->setFKclient($_SESSION['client_id']);
$parkingList = $parkingHandler->getParkingList();

$myEspacios = new Espacios();
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
                    <div class="overflow-x-auto">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <?php
                            // Verifica si $parkingList está definida y es un resultado válido
                            if (isset($parkingList) && $parkingList !== "error") {
                                // Itera sobre los resultados de la consulta
                                while ($row = mysqli_fetch_assoc($parkingList)) {
                                    $myEspacios->setFk_parking($row['pk_parking']);
                                    $espaciosDisponibles = $myEspacios->getEspaciosDisponibles(); ?>
                                    <div class="overflow-hidden relative rounded-lg shadow-md border bg-gris-clarito border-blue-500 text-blue-600">
                                        <div class="p-6">
                                            <h2 class="flex items-center justify-center bg-blue-900 text-white w-1/5 h-6 absolute left-0 top-0"><?php echo $row['parking_number']; ?></h2>
                                            <p class="text-gray-300 mt-2 w-full">Estacionamientos disponibles
                                            <div class="flex items-center justify-center shadow w-full h-12 text-2xl text-gray-300 bg-gris-oscurito rounded-lg">
                                                <?php echo $espaciosDisponibles; ?>
                                            </div>
                                            </p>
                                            <p class="text-gray-300 mt-2">Ubicación: <?php echo $row['parking_location']; ?></p>
                                            <p class="text-gray-300">Capacidad: <?php echo $row['parking_capacity']; ?></p>
                                            <p class="text-gray-300">Estado: <?php echo $row['status_name']; ?></p>
                                        </div>
                                        <div class="p-4 bg-gray-800">
                                            <a href='cajones.php?idParking=<?php echo $row["pk_parking"]; ?>' class="w-full btn btn-outline btn-info btn-md rounded-md">Ver parking</a>
                                            <button class="block w-full mt-4 btn btn-outline btn-success btn-sm" onclick="actualizarParking(
                                                '<?php echo $row['pk_parking']; ?>',
                                                            '<?php echo $row['parking_number']; ?>',
                                                            '<?php echo $row['parking_location']; ?>',
                                                            '<?php echo $row['parking_capacity']; ?>',
                                                            '<?php echo $row['status_name']; ?>'
                                            )">Editar</button>
                                        </div>
                                    </div>
                            <?php }
                            } ?>
                        </div>
                    <?php
                }
                    ?>
                    </div>
            </div>
        </div>
    </div>
</div>
</body>