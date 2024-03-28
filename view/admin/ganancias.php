<?php include_once "navbarAdmin.php"; ?>

<?php
//Agregamos la clase de pagos.
include_once(__DIR__ . "/../../data/class/payment.php");

//Creamos un objeto para obtener todos los pagos.
$payment = new Payment();
$payments = $payment->getAllPayments();

//Obtenemos la suma total de los pagos.
$sum = new Payment();
$totalAmount = $sum->sumPayment();
?>

<?php if ($payments != "error") { ?>
    <div class="main-content">
        <div class="relative md:pt-32 pb-32 pt-12">
            <div class="px-4 md:px-10 mx-auto w-full lg:w-3/4 xl:w-2/3">
                <div class="navbar rounded-box">
                    <div class="flex-1 px-2 lg:flex-none">
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <div class="table-wrapper">
                        <table class="table bg-gris-oscurito shadow-xl text-center items-center w-full max-w-screen-md">
                            <!-- Cabecera de la tabla -->
                            <thead>
                                <tr class="text-gray-200 font-semibold text-sm">
                                    <th class="border-b border-gray-300">ID</th>
                                    <th class="border-b border-gray-300">Monto</th>
                                    <th class="border-b border-gray-300">Descripción</th>
                                    <th class="border-b border-gray-300">Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Filas de la tabla -->
                                <?php while ($row = mysqli_fetch_assoc($payments)) { ?>
                                    <tr class="text-sm">
                                        <td class="border-b border-gray-300"><?php echo $row['pk_payment'] ?></td>
                                        <td class="border-b border-gray-300"><?php echo $row['payment_amount'] ?></td>
                                        <td class="border-b border-gray-300"><?php echo $row['payment_description'] ?></td>
                                        <td class="border-b border-gray-300"><?php echo date('d/m/Y', strtotime($row['payment_date'])); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <!-- Tabla adicional para mostrar el total de ganancias -->
                        <table class="table bg-gris-oscurito shadow-xl text-center items-center w-full max-w-screen-md mt-8">
                            <thead>
                                <tr class="text-gray-200 font-semibold text-sm">
                                    <th class="border-b border-gray-300">Monto Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-sm">
                                    <td class="border-b border-gray-300"><?php echo $totalAmount; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<script>
    function cambiarColor() {
        var gananciasLink = document.getElementById("gananciasLink");
        var gananciasLink = document.getElementById("gananciasContainer");
        gananciasLink.classList.add("text-gray-100");
        gananciasLink.classList.add("bg-gris-clarito");
    }

    // Llamada a la función para cambiar el color
    cambiarColor();
</script>
