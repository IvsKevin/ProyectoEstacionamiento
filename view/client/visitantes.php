<!--Incluimos el navbar-->
<?php include_once "navbar.php"; ?>
<?php include_once "modals/visitantesModal.php"; ?>

<?php
// Incluimos la clase de visitantes
include_once(__DIR__ . "/../../data/class/visit.php");

// Creamos un objeto de la clase Visit para obtener las visitas del cliente
$visit = new Visit();
$visit->setFkClient($_SESSION['client_id']);
$visits = $visit->getVisit();
?>
<div>
    <div class="relative md:pt-32 pb-32 pt-12">
        <div class="px-4 md:px-10 mx-auto w-full">
            <div>
                <!--Inicio de la barra de navegación-->
                <div class="navbar rounded-box">
                    <div class="flex-1 px-2 lg:flex-none">
                        <button class="btn h-8 min-h-8 btn-outline btn-info" onclick="agregarVisita()"> + Añadir visita</button>
                    </div>
                    <label class="relative flex items-center">
                        <input type="text" id="searchInput" placeholder="Buscar por nombre..." class="ml-2 pl-4 pr-10 py-1 bg-gris-oscurito border border-search rounded-lg focus:outline-none focus:ring focus:border-search transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="absolute right-3 top-1/2 transform -translate-y-1/2 h-6 w-6 text-gray-400">
                            <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0118 0Z" clip-rule="evenodd" />
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
                <?php if ($visits && $visits != "error" && mysqli_num_rows($visits) > 0) { ?>
                    <!--Contenido en tabla-->
                    <div class="overflow-x-auto hidden" id="table-view">
                        <table id="visitTable" class="table bg-gris-oscurito shadow-xl text-center items-center">
                            <!-- Encabezados -->
                            <thead>
                                <tr class="text-gray-200 font-semibold text-base">
                                    <th>ID</th>
                                    <th>Compañía</th>
                                    <th>Razón</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php // Almacenamos los resultados en un array
                                $visitData = [];
                                while ($row = mysqli_fetch_assoc($visits)) {
                                    $visitData[] = $row;
                                }

                                // Iteramos sobre el array para generar las filas de la tabla
                                foreach ($visitData as $row) { ?>
                                    <tr class="text-base">
                                        <td><?php echo $row['pk_visit'] ?></td>
                                        <td><?php echo $row['visit_company'] ?></td>
                                        <td><?php echo $row['visit_reason'] ?></td>
                                        <td><?php echo $row['visit_name'] ?></td>
                                        <td><?php echo $row['visit_lastName'] ?></td>
                                        <td>
                                            <button class="btn btn-outline btn-success btn-xs" onclick="actualizarVisitante(
                                                '<?php echo $row['pk_visit']; ?>',
                                                '<?php echo $row['visit_company']; ?>',
                                                '<?php echo $row['visit_reason']; ?>',
                                                '<?php echo $row['visit_name']; ?>',
                                                '<?php echo $row['visit_lastName']; ?>'
                                            )">Actualizar</button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!--Contenido en tarjetas-->
                    <div class="overflow-x-auto" id="card-view">
                        <div id="visitCardContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            <?php // Iteramos sobre el array para generar las tarjetas de visitantes
                            foreach ($visitData as $row) { ?>
                                <div class="bg-gris-oscurito p-6 rounded-xl shadow-md relative">
                                    <span class="absolute top-0 left-0 w-1/5 h-5 bg-blue-900 text-white rounded-sm flex items-center justify-center">
                                        <?= $row['pk_visit'] ?>
                                    </span>
                                    <span class="absolute top-0 right-0 w-4/5 h-5 bg-gris-oscurito border-b border-blue-900 text-white rounded-sm text-sm flex items-center justify-center">
                                        <?= $row['visit_company'] ?>
                                    </span>
                                    <div class="mb-2 mt-5">
                                        <p class="text-sm font-semibold">Razón: <?php echo $row['visit_reason']; ?></p>
                                    </div>
                                    <div class="mb-2">
                                        <p class="text-sm font-semibold">Nombre: <?php echo $row['visit_name']; ?></p>
                                    </div>
                                    <div class="mb-2">
                                        <p class="text-sm font-semibold">Apellidos: <?php echo $row['visit_lastName']; ?></p>
                                    </div>
                                    <button class="btn btn-outline btn-success btn-xs" onclick="actualizarVisitante(
                                                '<?php echo $row['pk_visit']; ?>',
                                                '<?php echo $row['visit_company']; ?>',
                                                '<?php echo $row['visit_reason']; ?>',
                                                '<?php echo $row['visit_name']; ?>',
                                                '<?php echo $row['visit_lastName']; ?>'
                                            )">Detalles</button>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } else { ?>
                    <p>No hay visitantes para mostrar.</p>
                <?php } ?>
            </div>
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
        <span>La inserción del visitante ha sido exitosa!</span>
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
                <h3 class='font-bold text-lg'>Resultado de la eliminacion del visitante</h3>
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
            cambiarVista.innerText = "Tarjeta";
        } else {
            cardView.style.display = 'block';
            tableView.style.display = 'none';
            cambiarVista.innerText = "Tabla";
        }
    }

    // Función para buscar visitantes por nombre en tiempo real
    function searchVisitors() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("visitTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[3]; // La cuarta columna contiene el nombre del visitante
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
    document.getElementById("searchInput").addEventListener("input", searchVisitors);

    // Función para buscar visitantes por nombre en tiempo real en la vista de tarjetas
    function searchVisitorsCards() {
        var input, filter, cards, card, name, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        cards = document.getElementById("visitCardContainer").getElementsByClassName("bg-gris-oscurito"); // Obtenemos todas las tarjetas de visitantes
        for (i = 0; i < cards.length; i++) {
            card = cards[i];
            name = card.getElementsByClassName("text-sm font-semibold")[0]; // Obtenemos el elemento que contiene el nombre del visitante
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
    document.getElementById("searchInput").addEventListener("input", searchVisitorsCards);
</script>
