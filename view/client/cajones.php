<!--Incluimos el navbar-->
<?php include_once "navbar.php"; ?>
<?php include_once "modals/cajonesModal.php"; ?>

<?php
//Agregamos la clase del empleados.
include_once(__DIR__ . "/../../data/class/espacios.php");

// Obtenemos el GET del ID Parking.
if (isset($_GET['idParking'])) {
    $_SESSION['pk_parking'] = $_GET['idParking'];
};
// Creamos un objeto que sea de nuestro cliente para obtener todos sus valores.
$cajones = new Espacios();
$consulta = $cajones->getEspacios($_SESSION['pk_parking']);

?>
<div>
    <div class="relative md:pt-32 pb-32 pt-12">
        <div class="px-4 md:px-10 mx-auto w-full">
            <div>
                <!--Inicio de la barrita de navegacion-->
                <div class="navbar rounded-box">
                    <div class="flex-1 px-2 lg:flex-none">
                        <button class="btn h-8 min-h-8 btn-outline btn-info" onclick="agregarCajon()"> + Añadir cajon</button>
                    </div>
                    <div class="flex-1 px-2 lg:flex-none">
                        <button class="btn h-8 min-h-8h-8 min-h-8 btn-outline btn-primary" onclick="">Ultimos 30 dias</button>
                    </div>
                    <div class="flex-1 px-2 lg:flex-none">
                        <button class="btn h-8 min-h-8 btn-outline btn-primary" onclick="">Filtrar por</button>
                    </div>
                    <div class="flex justify-end flex-1 px-2">
                        <div class="flex items-stretch">
                            <a class="btn h-8 min-h-8 btn-ghost rounded-btn">Button</a>
                            <div class="dropdown dropdown-end">
                                <div tabindex="0" role="button" class="btn h-8 min-h-8 btn-ghost rounded-btn">Config</div>
                                <ul tabindex="0" class="menu dropdown-content z-[1] p-2 shadow bg-base-100 rounded-box w-52 mt-4">
                                    <li><a>Item 1</a></li>
                                    <li><a>Item 2</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Contenedor-->
                <div class="overflow-x-auto">
                    <?php if ($consulta != "error" && mysqli_num_rows($consulta) > 0) { ?>
                        <?php while ($tupla = mysqli_fetch_assoc($consulta)) { ?>
                            <section class="bg-gris-oscurito m-2"> <!--Contenedor de cada espacio-->
                                <div><?php $tupla['pk_spaces'] ?></div>
                                <div><?php echo $tupla['spaces_number'] ?></div>
                                <div><?php echo $tupla['fk_employee'] ?></div>
                                <div><?php echo $tupla['status_name'] ?></div>
                            </section>
                    <?php }
                    } ?>
                </div>
                <div class="navbar rounded-box">
                    <div class="flex-1 px-2 lg:flex-none">
                        <a href="parking.php"><button class="btn h-8 min-h-8 btn-outline btn-info">Volver</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>