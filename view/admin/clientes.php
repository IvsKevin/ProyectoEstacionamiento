<?php include_once "navbar.php"; ?>

<?php
// Incluimos la clase de clientes
include_once(__DIR__ . "/../../data/class/client.php");
$client = new Client();
$clientes = $client->getAllClientsC();
$clientesData = []; // Array para almacenar los datos de los clientes
while ($row = mysqli_fetch_assoc($clientes)) {
    $clientesData[] = $row; // Almacenar los datos de cada cliente en el array
}
?>

<?php if ($clientes != "error" && count($clientesData) > 0) { ?>
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
                        <table id="clientTable" class="table bg-gris-oscurito shadow-xl text-center items-center">
                            <thead>
                                <tr class="text-gray-200 font-semibold text-base">
                                    <th>ID</th>
                                    <th>Logo</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Dirección</th>
                                    <th>País</th>
                                    <th>Ciudad</th>
                                    <th>Estado</th>
                                    <th>Código Postal</th>
                                    <th>Teléfono</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($clientesData as $row) { ?>
                                    <tr class="text-base">
                                        <td><?php echo $row['pk_client'] ?></td>
                                        <td>
                                            <div class="w-9 h-9 rounded-full overflow-hidden">
                                                <img src="https://daisyui.com/images/stock/photo-1609621838510-5ad474b7d25d.jpg" alt="Logo del cliente" class="w-full h-full object-cover">
                                            </div>
                                        </td>
                                        <td><?php echo $row['client_name'] ?></td>
                                        <td><?php echo $row['client_email'] ?></td>
                                        <td><?php echo $row['client_address'] ?></td>
                                        <td><?php echo $row['client_country'] ?></td>
                                        <td><?php echo $row['client_city'] ?></td>
                                        <td><?php echo $row['client_state'] ?></td>
                                        <td><?php echo $row['client_zip_code'] ?></td>
                                        <td><?php echo $row['client_tel'] ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Contenido en tarjetas -->
                    <div class="overflow-x-auto" id="card-view">
                        <div id="clientCardContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            <?php foreach ($clientesData as $row) { ?>
                                <div class="bg-gris-oscurito p-6 rounded-xl shadow-md relative">
                                    <span class="absolute top-0 left-0 w-1/5 h-5 bg-blue-900 text-white rounded-sm flex items-center justify-center"><?php echo $row['pk_client'] ?></span>
                                    <div class="mb-4 mt-5">
                                        <img src="https://daisyui.com/images/stock/photo-1609621838510-5ad474b7d25d.jpg" alt="Cliente Photo" class="w-full rounded-full">
                                    </div>
                                    <div class="mb-2">
                                        <p class="text-sm font-semibold">Nombre: <?php echo $row['client_name']; ?></p>
                                    </div>
                                    <p class="text-sm text-gray-500 mb-4">Correo: <?php echo $row['client_email'] ?></p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <p>No hay clientes para mostrar.</p>
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

    // Función para buscar clientes por nombre en tiempo real
    function searchClients() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("clientTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2]; // La tercera columna contiene el nombre del cliente
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
    document.getElementById("searchInput").addEventListener("input", searchClients);

    // Función para buscar clientes por nombre en tiempo real en la vista de tarjetas
    function searchClientsCards() {
        var input, filter, cards, card, name, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        cards = document.getElementById("clientCardContainer").getElementsByClassName("bg-gris-oscurito"); // Obtenemos todas las tarjetas de cliente
        for (i = 0; i < cards.length; i++) {
            card = cards[i];
            name = card.getElementsByClassName("text-sm font-semibold")[0]; // Obtenemos el elemento que contiene el nombre del cliente
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
    document.getElementById("searchInput").addEventListener("input", searchClientsCards);
</script>
