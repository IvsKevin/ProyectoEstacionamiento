<?php include_once "navbar.php"; ?>

<?php
// Incluimos la clase de licencias
include_once(__DIR__ . "/../../data/class/payment.php");

// Creamos un objeto para obtener las sumas de los pagos de diferentes tipos de licencias
$payment = new Payment();
$resultadoLicenciasBasicas = $payment->sumBasicPayment();
$resultadoLicenciasPR = $payment->sumProPayment();
$resultadoLicenciasRegulares = $payment->sumRegularPayment();

// Almacenamos los resultados en un array asociativo para facilitar el acceso
$licensesData = [
    [
        'id' => 1,
        'type' => 'Licencia Básica',
        'acquired' => $resultadoLicenciasBasicas
    ],
    [
        'id' => 2,
        'type' => 'Licencia Pro',
        'acquired' => $resultadoLicenciasPR
    ],
    [
        'id' => 3,
        'type' => 'Licencia Regular',
        'acquired' => $resultadoLicenciasRegulares
    ]
];
?>

<?php if (count($licensesData) > 0) { ?>
    <div class="main-content">
        <div class="relative md:pt-32 pb-32 pt-12">
            <div class="px-4 md:px-10 mx-auto w-full">
                <div>
                    <!-- Barra de navegación -->
                    <div class="navbar rounded-box">
                        <div class="flex-1 px-2 lg:flex-none">
                        </div>
                        <label class="relative flex items-center">
                            <input type="text" id="searchInput" placeholder="Buscar por nombre..." class="ml-2 pl-4 pr-10 py-1 bg-gris-oscurito border border-search rounded-lg focus:outline-none focus:ring focus:border-search transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="absolute right-3 top-1/2 transform -translate-y-1/2 h-6 w-6 text-gray-400" viewBox="0 0 16 16" fill="currentColor">
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
                    <!-- Contenido en tabla -->
                    <div class="overflow-x-auto hidden" id="table-view">
                        <table id="licensesTable" class="table bg-gris-oscurito shadow-xl text-center items-center">
                            <thead>
                                <tr class="text-gray-200 font-semibold text-base">
                                    <th>ID</th>
                                    <th>Tipo de Licencia</th>
                                    <th>Licencias Adquiridas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($licensesData as $row) { ?>
                                    <tr class="text-base">
                                        <td><?php echo $row['id'] ?></td>
                                        <td><?php echo $row['type'] ?></td>
                                        <td><?php echo $row['acquired'] ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Contenido en tarjetas -->
                    <div class="overflow-x-auto" id="card-view">
                        <div id="licensesCardContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            <?php foreach ($licensesData as $row) { ?>
                                <div class="bg-gris-oscurito p-6 rounded-xl shadow-md relative">
                                    <span class="absolute top-0 left-0 w-1/5 h-5 bg-blue-900 text-white rounded-sm flex items-center justify-center"><?php echo $row['id'] ?></span>
                                    <div class="mb-4 mt-5">
                                        <p class="text-sm font-semibold">Tipo de Licencia: <?php echo $row['type']; ?></p>
                                    </div>
                                    <p class="text-sm text-gray-500 mb-4">Licencias Adquiridas: <?php echo $row['acquired'] ?></p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <p>No hay licencias para mostrar.</p>
<?php } ?>

<!-- Script para cambiar entre la vista de tabla y tarjetas, y las funciones de búsqueda -->
<script>
    // Función para cambiar entre la vista de tabla y tarjetas
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

    // Función para buscar licencias por tipo en tiempo real en la vista de tabla
    function searchLicenses() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("licensesTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1]; // La segunda columna contiene el tipo de licencia
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

    // Función para buscar licencias por tipo en tiempo real en la vista de tarjetas
    function searchLicensesCards() {
        var input, filter, cards, card, type, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        cards = document.getElementById("licensesCardContainer").getElementsByClassName("bg-gris-oscurito"); // Obtenemos todas las tarjetas de licencia
        for (i = 0; i < cards.length; i++) {
            card = cards[i];
            type = card.getElementsByClassName("text-sm font-semibold")[0]; // Obtenemos el elemento que contiene el tipo de licencia
            if (type) {
                txtValue = type.textContent || type.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    card.style.display = "";
                } else {
                    card.style.display = "none";
                }
            }
        }
    }

    // Llamar a la función de búsqueda cada vez que el usuario escribe algo en el campo de búsqueda
    document.getElementById("searchInput").addEventListener("input", searchLicenses);
    document.getElementById("searchInput").addEventListener("input", searchLicensesCards);
</script>
