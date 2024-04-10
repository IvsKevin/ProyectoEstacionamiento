<?php include_once "navbar.php"; ?>
<?php include_once "modals/parkingModal.php"; ?>

<?php
include_once("../../data/class/parking.php");
include_once("../../data/class/Espacios.php");

//Perdomo gay
// Obtener el parámetro 'orden' de la URL
$orden = isset($_GET['orden']) ? $_GET['orden'] : 'asc';

// Instanciar la clase Parking
$parkingHandler = new Parking();
$parkingHandler->setFKclient($_SESSION['client_id']);

// Mostrar la lista de estacionamientos ordenada según el parámetro
$parkingList = $parkingHandler->getParkingList($orden);


// Mostrar la lista de estacionamientos
$parkingHandler = new Parking();
$parkingHandler->setFKclient($_SESSION['client_id']);
$parkingList = $parkingHandler->getParkingList($orden);

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
                    <!-- <div class="flex-1 px-2 lg:flex-none">
                        <button class="btn h-8 min-h-8h-8 min-h-8 btn-outline btn-primary" onclick="">Ultimos 30 dias</button>
                    </div> -->
                    <div class="flex-1 px-2 lg:flex-none relative">
                        <div class="dropdown dropdown-left dropdown-up dropdown-right" style="z-index: 999;">
                            <button class="btn h-8 min-h-8 btn-outline btn-primary">Filtrar por</button>
                            <!-- Opciones de filtrado -->
                            <ul tabindex="0" class="menu dropdown-content w-40 mt-2 py-1 bg-base-100 shadow-md rounded-md">
                                <li class="py-1"><a href="?orden=asc" class="flex items-center"><img src="../../assets/iconos/menor_a_mayor.png" class="w-8 h-8 mr-2 rounded-full border border-base-200 bg-transparent text-white" alt="De menor a mayor"> De menor a mayor</a></li>
                                <li class="py-1"><a href="?orden=desc" class="flex items-center"><img src="../../assets/iconos/mayor_a_menor.png" class="w-8 h-8 mr-2 rounded-full border border-base-200 bg-transparent text-white" alt="De mayor a menor"> De mayor a menor</a></li>

                            </ul>
                        </div>
                    </div>
                    <label class="relative flex items-center">
                        <input type="text" id="searchInput" placeholder="Buscar por Ubicacion..." class="ml-2 pl-4 pr-10 py-1 bg-gris-oscurito border border-search rounded-lg focus:outline-none focus:ring focus:border-search transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="absolute right-3 top-1/2 transform -translate-y-1/2 h-6 w-6 text-gray-400">
                            <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" />
                        </svg>
                    </label>
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
                        <div id="parkingContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <?php
                            // Verifica si $parkingList está definida y es un resultado válido
                            if (isset($parkingList) && $parkingList !== "error") {
                                // Itera sobre los resultados de la consulta
                                while ($row = mysqli_fetch_assoc($parkingList)) {
                                    $myEspacios->setFk_parking($row['pk_parking']);
                                    $espaciosDisponibles = $myEspacios->getEspaciosDisponibles();

                                    // Calcula la mitad de la capacidad del estacionamiento
                                    $mitadCapacidad = ceil($row['parking_capacity'] / 2);

                                    // Asigna un color según la cantidad de espacios disponibles
                                    $color = '';
                                    if ($espaciosDisponibles == 0) {
                                        $color = 'bg-red-600';
                                    } elseif ($espaciosDisponibles <= $mitadCapacidad) {
                                        $color = 'bg-yellow-600';
                                    } else {
                                        $color = 'bg-green-700';
                                    }
                            ?>
                                    <div class="overflow-hidden relative rounded-lg shadow-xl border border-gray-700 bg-gris-clarito">
                                        <div class="p-6">
                                            <h2 class="flex items-center justify-center <?php echo $color; ?>  text-white w-1/5 h-6 absolute left-0 top-0"><?php echo $row['parking_number']; ?></h2>

                                            <p class="text-gray-300 mt-2 font-bold w-full">Estacionamientos disponibles
                                            <div class="flex items-center justify-center shadow w-full h-12 text-2xl text-gray-300 bg-gris-oscurito rounded-lg">
                                                <?php echo $espaciosDisponibles; ?>
                                            </div>
                                            </p>

                                            <p id="ubicacionSearch_<?php echo $row['pk_parking']; ?>" class="text-gray-300 mt-3">
                                                <img src="../../assets/iconos/ubi.png" alt="Icono de ubicación" class="inline-block w-7 h-7 mr-3" />
                                                Ubicacion: <?php echo $row['parking_location']; ?>
                                            </p>

                                            <p class="text-gray-300 mt-3 ">
                                                <img src="../../assets/iconos/capacidad.png" alt="Icono de capacidad" class="inline-block w-7 h-7 mr-3" />Capacidad: <?php echo $row['parking_capacity']; ?>
                                            </p>

                                            <p class="text-gray-300 mt-3">
                                            <div class="flex items-center">
                                                <!-- Círculo dinámico de estado -->
                                                <div class="w-5 h-5 rounded-full ml-1 mr-3 <?php echo ($row['status_name'] == 'Activo') ? 'bg-green-500' : 'bg-red-500'; ?>"></div>
                                                <!-- Texto descriptivo del estado -->
                                                Estado: <?php echo $row['status_name']; ?>
                                            </div>
                                            </p>
                                        </div>
                                        <div class="p-4 bg-gray-800">
                                            <a href='cajones.php?idParking=<?php echo $row["pk_parking"]; ?>' class="w-full btn btn-info btn-outline btn-md rounded-md">Ver parking</a>
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
<script>
    // Función para buscar parkings por ubicación
    function searchParkings() {
        var input, filter, elements, element, ubicacionElement, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();

        // Buscar en la vista de tabla
        elements = document.getElementById("parkingContainer").getElementsByClassName("bg-gris-clarito");
        for (i = 0; i < elements.length; i++) {
            element = elements[i];
            ubicacionElement = element.querySelector("p:nth-of-type(3)"); // Corregir selector
                txtValue = ubicacionElement.textContent || ubicacionElement.innerText;
                // Cambio en la condición para buscar coincidencias en cualquier parte del texto de ubicación
                if (txtValue.toUpperCase().includes(filter)) {
                    element.style.display = "";
                } else {
                    element.style.display = "none";
                }
            }
        }
    }


    // Llamar a la función de búsqueda cada vez que el usuario escribe algo en el campo de búsqueda
    document.getElementById("searchInput").addEventListener("input", searchParkings);
</script>

