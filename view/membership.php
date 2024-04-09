<!--Incluimos el header de la pagina-->
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

                    <div class="relative mr-2 ml-2 flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-300 border-0">
                        <div class="flex-auto px-4 lg:px-10 py-10 pt-0 mt-5">
                            <div class="text-center mt-6">
                                <h1 class="text-lg font-bold">Basica</h1>
                                <ul class="mt-5 mb-5">
                                    <li class="m-2">Licencia para Control de Estacionamientos</li>
                                    <li class="m-2">Gestión Básica de Espacios</li>
                                    <li class="m-2">Informe de Ocupación</li>
                                </ul>
                                <button onclick="showModal('Basica')" class="btn bg-gray-900 text-white active:bg-gray-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full" type="button" style="transition: all 0.15s ease 0s;">
                                    Comprar
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="relative mr-2 ml-2 flex flex-row min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-300 border-0">
                        <div class="flex-auto px-4 lg:px-10 py-10 pt-0 mt-5">
                            <div class="text-center mt-6">
                                <h1 class="text-lg font-bold">Regular</h1>
                                <ul class="mt-5 mb-5">
                                    <li class="m-2">Licencia Empresarial Estándar</li>
                                    <li class="m-2">Gestión Avanzada de Espacios</li>
                                    <li class="m-2">Informe de Ocupación en Tiempo Real</li>
                                    <li class="m-2">Soporte Técnico 24/7</li>
                                </ul>
                                <button onclick="showModal('Regular')" class="btn bg-gray-900 text-white active:bg-gray-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full" type="button" style="transition: all 0.15s ease 0s;">
                                    Comprar
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="relative mr-2 ml-2 flex flex-row min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-300 border-0">
                        <div class="flex-auto px-4 lg:px-10 py-10 pt-0 mt-5">
                            <div class="text-center mt-6">
                                <h1 class="text-lg font-bold">Pro</h1>
                                <ul class="mt-5 mb-5">
                                    <li class="m-2">Licencia Empresarial Avanzada</li>
                                    <li class="m-2">Gestión Integral de Estacionamientos</li>
                                    <li class="m-2">Informe de Ocupación en Tiempo Real</li>
                                    <li class="m-2">Soporte Técnico Prioritario 24/7</li>
                                    <li class="m-2">Integración con Sistemas de Seguridad</li>
                                </ul>
                                <button onclick="showModal('Pro')" class="btn bg-gray-900 text-white active:bg-gray-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full" type="button" style="transition: all 0.15s ease 0s;">
                                    Comprar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-white absolute buttom-5 left-5 mb-20">
                    <a href="registerCompany.php">Volver atras</a>
                </div>
            </div>

        </div>



        <!--Inclumos los modales-->
        <?php include_once "components/modals.php"; ?>

        <!--Inclumos los footers de los logins-->
        <?php include_once "components/footer_2.php"; ?>