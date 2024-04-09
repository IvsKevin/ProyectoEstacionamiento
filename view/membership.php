<!--Incluimos el header de la pagina-->
<script src="https://www.paypal.com/sdk/js?client-id=AbkuXPGgIsFuEbxeK_guk2T5TMPar03bCa7F9EhWWYyE8cMr4r9KhNvAx9qAdH1PGPo7_6J0Xks0p57v&currency=MXN"></script>
<?php include_once "components/header_2.php"; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['nombreEmpresa'] = $_POST['empresa'];
    $_SESSION['emailEmpresa'] = $_POST['email'];
    $_SESSION['direccionEmpresa'] = $_POST['direccion'];
    $_SESSION['paisEmpresa'] = $_POST['pais'];
    $_SESSION['estadoEmpresa'] = $_POST['estado'];
    $_SESSION['ciudadEmpresa'] = $_POST['ciudad'];
    $_SESSION['codigoEmpresa'] = $_POST['postal'];
    $_SESSION['telEmpresa'] = $_POST['tel'];
}
?>

<!--Cuerpo del HTML-->
<main>
    <section class="absolute w-full h-full">
        <div class="absolute top-0 w-full h-full bg-gray-900"></div>
        <div class="container mx-auto px-4 h-full">
            <div class="flex content-center items-center justify-center h-full ">
                <div class="w-full lg:w-10/12 px-4 flex flex-row"> <!--CONTENEDOR DE LAS MEMBRESIAS-->

                    <!-- Licencia Básica -->
                    <div class="relative mr-2 ml-2 flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-300 border-0">
                        <div class="flex-auto px-4 lg:px-10 py-10 pt-0 mt-5">
                            <div class="text-center mt-6">
                                <h1 class="text-lg font-bold">Básica</h1>
                                <ul class="mt-5 mb-5">
                                    <li class="m-2">Licencia para Control de Estacionamientos</li>
                                    <li class="m-2">Gestión Básica de Espacios</li>
                                    <li class="m-2">Informe de Ocupación</li>
                                    <li class="m-2">200 MXN</li>
                                </ul>
                                <div id="paypal-button-container-basica"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Licencia Regular -->
                    <div class="relative mr-2 ml-2 flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-300 border-0">
                        <div class="flex-auto px-4 lg:px-10 py-10 pt-0 mt-5">
                            <div class="text-center mt-6">
                                <h1 class="text-lg font-bold">Regular</h1>
                                <ul class="mt-5 mb-5">
                                    <li class="m-2">Licencia Empresarial Estándar</li>
                                    <li class="m-2">Gestión Avanzada de Espacios</li>
                                    <li class="m-2">Informe de Ocupación en Tiempo Real</li>
                                    <li class="m-2">Soporte Técnico 24/7</li>
                                    <li class="m-2">Precio: 500 MXN</li>
                                </ul>
                                <div id="paypal-button-container-regular"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Licencia Pro -->
                    <div class="relative mr-2 ml-2 flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-300 border-0">
                        <div class="flex-auto px-4 lg:px-10 py-10 pt-0 mt-5">
                            <div class="text-center mt-6">
                                <h1 class="text-lg font-bold">Pro</h1>
                                <ul class="mt-5 mb-5">
                                    <li class="m-2">Licencia Empresarial Avanzada</li>
                                    <li class="m-2">Gestión Integral de Estacionamientos</li>
                                    <li class="m-2">Informe de Ocupación en Tiempo Real</li>
                                    <li class="m-2">Soporte Técnico Prioritario 24/7</li>
                                    <li class="m-2">Integración con Sistemas de Seguridad</li>
                                    <li class="m-2">Precio: 600 MXN</li>
                                </ul>
                                <div id="paypal-button-container-pro"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-white absolute buttom-5 left-5 mb-20">
                    <a href="registerCompany.php">Volver atrás</a>
                </div>
            </div>
        </div>
    </section>

    <!--Inclumos los footers de los logins-->
    <?php include_once "components/footer_2.php"; ?>

    <script>
        // Function to handle PayPal payment
        function handlePayPalPayment(type) {
            let amount = 0;
            let description = '';
            let duration = 0;
            
            if (type === 'Basica') {
                amount = 200;
                description = 'Licencia Basica';
                duration = 1;
            } else if (type === 'Regular') {
                amount = 500;
                description = 'Licencia Regular';
                duration = 5;
            } else if (type === 'Pro') {
                amount = 600;
                description = 'Licencia Pro';
                duration = 9;
            }

            paypal.Buttons({
                style: {
                    background: '#1F2937',
                },
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: amount,
                                currency_code: 'MXN'
                            },
                            description: description,
                            name: description
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        window.location.href = "../app/register.php?amount=" + amount + "&description=" + description + "&duration=" + duration;
                    });
                },
                onCancel: function(data) {
                    alert("Pago cancelado");
                    console.log(data);
                }
            }).render('#paypal-button-container-' + type.toLowerCase());
        }
        handlePayPalPayment('Basica');
        handlePayPalPayment('Regular');
        handlePayPalPayment('Pro');
    </script>
</main>