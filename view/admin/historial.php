<?php include_once "navbar.php"; ?>

<?php
// Incluimos la clase de historial.
include_once(__DIR__ . "/../../data/class/payment.php");
$payment = new Payment();
$payments = $payment->getAllPayments();
$paymentsData = []; // Array para almacenar los datos de los pagos
while ($row = mysqli_fetch_assoc($payments)) {
    $paymentsData[] = $row; // Almacenar los datos de cada pago en el array
}
?>

<?php if ($payments != "error" && count($paymentsData) > 0) { ?>
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
                        <table id="paymentTable" class="table bg-gris-oscurito shadow-xl text-center items-center">
                            <thead>
                                <tr class="text-gray-200 font-semibold text-base">
                                    <th>Cliente</th>
                                    <th>Tipo de Licencia</th>
                                    <th>Método de Pago</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($paymentsData as $row) { ?>
                                    <tr class="text-base">
                                        <td><?php echo $row['client_name'] ?></td>
                                        <td><?php echo $row['payment_description'] ?></td>
                                        <td><?php echo $row['method_name'] ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($row['payment_date'])); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Contenido en tarjetas -->
                    <div class="overflow-x-auto" id="card-view" style="display: block;">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            <?php foreach ($paymentsData as $row) { ?>
                                <div class="bg-gris-oscurito p-6 rounded-xl shadow-md relative">
                                <span class="absolute top-0 left-0 w-1/5 h-5 bg-blue-900 text-white rounded-sm flex items-center justify-center"><?php echo $row['pk_payment'] ?></span>
                                    <div class="mb-4 mt-5">
                                        <p class="text-sm font-semibold-500 mb-2" >Cliente: <?php echo $row['client_name']; ?></p>
                                        <p class="text-sm text-gray-500 mb-2">Tipo de Licencia: <?php echo $row['payment_description']; ?></p>
                                        <p class="text-sm text-gray-500 mb-2">Método de Pago: <?php echo $row['method_name']; ?></p>
                                        <p class="text-sm text-gray-500 mb-2">Fecha: <?php echo date('d/m/Y', strtotime($row['payment_date'])); ?></p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <p>No hay registros de historial para mostrar.</p>
<?php } ?>

<script>
    function toggleView() {
        var cambiarVista = document.getElementById('cambiarVista');
        var tableView = document.getElementById('table-view');
        var cardView = document.getElementById('card-view');

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

    function searchPayments() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("paymentTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0]; // Cambia el índice según la columna que desees buscar
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

    document.getElementById("searchInput").addEventListener("input", searchPayments);

    function searchPaymentsCards() {
        var input, filter, cards, card, name, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        cards = document.getElementById("card-view").getElementsByClassName("bg-gris-oscurito");
        for (i = 0; i < cards.length; i++) {
            card = cards[i];
            name = card.getElementsByClassName("text-sm font-semibold")[0];
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

    document.getElementById("searchInput").addEventListener("input", searchPaymentsCards);
</script>
