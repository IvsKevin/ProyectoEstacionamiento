<?php include_once "navbarAdmin.php"; ?>
<?php
// Incluimos la clase payment
include_once(__DIR__ . "/../../data/class/payment.php");

// Creamos un objeto de nuestro cliente para obtener todos sus valores.
// $payment = new Payment();
// $payments = $payment->getAllPayments();
$tuObjeto = new Payment();

$resultadoLicenciasBasicas = $tuObjeto->sumBasicPayment();
$resultadoLicenciasPR = $tuObjeto->sumProPayment();
$resultadoLicenciasRegulares = $tuObjeto->sumRegularPayment();
?>
<?php if ($resultadoLicenciasBasicas !== null && $resultadoLicenciasPR !== null && $resultadoLicenciasRegulares !== null) { ?>
    <div class="main-content">
        <div class="relative md:pt-32 pb-32 pt-12">
            <div class="px-4 md:px-10 mx-auto w-full lg:w-3/4 xl:w-2/3">
                <div class="navbar rounded-box">
                    <div class="flex-1 px-2 lg:flex-none">
                        <!-- Botón para agregar membresía -->
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <div class="table-wrapper">
                        <table class="table bg-gris-oscurito shadow-xl text-center items-center w-full max-w-screen-md">
                            <thead>
                                <tr class="text-gray-200 font-semibold text-sm">
                                    <th class="border-b border-gray-300">Licencias</th>
                                    <th class="border-b border-gray-300">Licencias Adquiridas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-sm">
                                    <td class="border-b border-gray-300">Licencia Básica</td>
                                    <td class="border-b border-gray-300"><?php echo $resultadoLicenciasBasicas; ?></td>
                                </tr>
                                <tr class="text-sm">
                                    <td class="border-b border-gray-300">Licencia Pro</td>
                                    <td class="border-b border-gray-300"><?php echo $resultadoLicenciasPR; ?></td>
                                </tr>
                                <tr class="text-sm">
                                    <td class="border-b border-gray-300">Licencia Regular</td>
                                    <td class="border-b border-gray-300"><?php echo $resultadoLicenciasRegulares; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
