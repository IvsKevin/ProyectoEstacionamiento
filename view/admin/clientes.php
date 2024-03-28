<?php include_once "navbarAdmin.php"; ?>
<?php include_once "modals/clientes.php"; ?>

<?php
include_once(__DIR__ . "/../../data/class/client.php");
$client = new Client();
$clientes = $client->getAllClientsC();
?>

<?php if ($clientes != "error") { ?>
    <div class="main-content">
        <div class="relative md:pt-32 pb-32 pt-12">
            <div class="px-4 md:px-10 mx-auto w-full lg:w-3/4 xl:w-2/3">
                <div class="navbar rounded-box">
                    <!-- <div class="flex-1 px-2 lg:flex-none">
                        <button class="btn h-8 min-h-8 btn-outline btn-info" onclick="agregarCliente()"> + Añadir cliente</button>
                    </div> -->
                </div>
                <div class="overflow-x-auto">
                    <div class="table-wrapper">
                        <table class="table bg-gris-oscurito shadow-xl text-center items-center w-full max-w-screen-md">
                            <thead>
                                <tr class="text-gray-200 font-semibold text-sm">
                                    <th class="border-b border-gray-300">ID</th>
                                    <th class="border-b border-gray-300">Logo</th>
                                    <th class="border-b border-gray-300">Nombre</th>
                                    <th class="border-b border-gray-300">Correo</th>
                                    <th class="border-b border-gray-300">Dirección</th>
                                    <th class="border-b border-gray-300">País</th>
                                    <th class="border-b border-gray-300">Ciudad</th>
                                    <th class="border-b border-gray-300">Estado</th>
                                    <th class="border-b border-gray-300">Código Postal</th>
                                    <th class="border-b border-gray-300">Teléfono</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($clientes)) { ?>
                                    <tr class="text-sm">
                                        <td class="border-b border-gray-300"><?php echo $row['pk_client'] ?></td>
                                        <td class="border-b border-gray-300">
                                            <div class="w-16 h-16 rounded-full overflow-hidden">
                                                <img src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" alt="Logo del cliente" class="w-full h-full object-cover">
                                            </div>
                                        </td>
                                        <td class="border-b border-gray-300"><?php echo $row['client_name'] ?></td>
                                        <td class="border-b border-gray-300"><?php echo $row['client_email'] ?></td>
                                        <td class="border-b border-gray-300"><?php echo $row['client_address'] ?></td>
                                        <td class="border-b border-gray-300"><?php echo $row['client_country'] ?></td>
                                        <td class="border-b border-gray-300"><?php echo $row['client_city'] ?></td>
                                        <td class="border-b border-gray-300"><?php echo $row['client_state'] ?></td>
                                        <td class="border-b border-gray-300"><?php echo $row['client_zip_code'] ?></td>
                                        <td class="border-b border-gray-300"><?php echo $row['client_tel'] ?></td>
                                    </tr>
                                <?php } ?>
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
        var clientLink = document.getElementById("clientLink");
        var clientLink = document.getElementById("clientContainer");
        clientLink.classList.add("text-gray-100");
        clientLink.classList.add("bg-gris-clarito");
    }

    // Llamada a la función para cambiar el color
    cambiarColor();
</script>