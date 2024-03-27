<?php include_once "navbarAdmin.php"; ?>
<?php include_once "modals/clientes.php"; ?>

<?php
include_once(__DIR__ . "/../../data/class/client.php");
$client = new Client();
$clientes = $client->getAllClientsC();
?>

<?php if ($clientes != "error") { ?>
    <nav class="absolute top-0 left-0 w-full z-10 bg-transparent md:flex-row md:flex-nowrap md:justify-start flex items-center p-4">
        <div class="w-full mx-auto items-center flex justify-between md:flex-nowrap flex-wrap md:px-10 px-4">
            <a class="text-white text-3xl uppercase hidden lg:inline-block font-semibold"></a>
            <form class="md:flex hidden flex-row flex-wrap items-center lg:ml-auto mr-3">
                <div class="relative flex w-full flex-wrap items-stretch">
                    <span class="z-10 h-full leading-snug font-normal text-center text-blueGray-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3"><i class="fas fa-search"></i></span>
                    <input type="text" placeholder="Buscar aquí..." class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm shadow outline-none focus:outline-none focus:ring w-full pl-10" />
                </div>
            </form>
            <ul class="flex-col md:flex-row list-none items-center hidden md:flex">
                <a class="text-blueGray-500 block" href="#pablo" onclick="openDropdown(event,'user-dropdown')">
                    <div class="items-center flex">
                        <span class="w-12 h-12 text-sm text-white bg-blueGray-200 inline-flex items-center justify-center rounded-full"><img alt="..." class="w-full rounded-full align-middle border-none shadow-lg" src="./assets/img/team-1-800x800.jpg" /></span>
                    </div>
                </a>
                <div class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mt-1" style="min-width: 12rem;" id="user-dropdown">
                    <a href="#pablo" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Acción</a>
                    <a href="#pablo" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Otra acción</a>
                    <a href="#pablo" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Algo más aquí</a>
                    <div class="h-0 my-2 border border-solid border-blueGray-100"></div>
                    <a href="#pablo" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Enlace separado</a>
                </div>
            </ul>
        </div>
    </nav>
    <div class="relative md:pt-32 pb-32 pt-12">
        <div class="px-4 md:px-10 mx-auto w-full">
        <div class="overflow-x-auto">
    <table class="table bg-gray-600">
        <!-- Encabezado -->
        <thead>
            <tr>
                <th class="text-white">ID</th>
                <th class="text-white">Logo</th>
                <th class="text-white">Nombre</th>
                <th class="text-white">Correo</th>
                <th class="text-white">Dirección</th>
                <th class="text-white">País</th>
                <th class="text-white">Ciudad</th>
                <th class="text-white">Estado</th>
                <th class="text-white">Código Postal</th>
                <th class="text-white">Teléfono</th>
            </tr>
        </thead>
        <tbody>
            <!-- Fila 1 -->
            <?php while ($row = mysqli_fetch_assoc($clientes)) { ?>
                <tr>
                    <!-- ID del cliente -->
                    <td><?php echo $row['pk_client'] ?></td>
                    <!-- Logo del cliente -->
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="avatar">
                                <div class="mask mask-squircle w-12 h-12">
                                    <img src="/tailwind-css-component-profile-2@56w.png" alt="Avatar Tailwind CSS Component" />
                                </div>
                            </div>
                        </div>
                    </td>
                    <!-- Nombre del cliente -->
                    <td><?php echo $row['client_name'] ?></td>
                    <!-- Correo del cliente -->
                    <td><?php echo $row['client_email'] ?></td>
                    <!-- Dirección del cliente -->
                    <td><?php echo $row['client_address'] ?></td>
                    <!-- País del cliente -->
                    <td><?php echo $row['client_country'] ?></td>
                    <!-- Ciudad del cliente -->
                    <td><?php echo $row['client_city'] ?></td>
                    <!-- Estado del cliente -->
                    <td><?php echo $row['client_state'] ?></td>
                    <!-- Código Postal del cliente -->
                    <td><?php echo $row['client_zip_code'] ?></td>
                    <!-- Teléfono del cliente -->
                    <td><?php echo $row['client_tel'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

    </div>
<?php } ?>
