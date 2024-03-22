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
                        <button class="btn h-8 min-h-8 btn-outline btn-info" onclick="agregarCajones()"> + Añadir cajon</button>
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
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-2">
                        <?php if ($consulta != "error" && mysqli_num_rows($consulta) > 0) { ?>
                            <?php while ($tupla = mysqli_fetch_assoc($consulta)) { ?>
                                <!-- <section class="overflow-hidden relative flex flex-col items-center justify-center m-2 pt-3 pb-3 h-40 rounded-lg shadow-md border bg-gris-clarito border-blue-500 text-gray-300"> Contenedor de cada espacio -->
                                <?php if ($tupla['fk_employee'] != null || $tupla['fk_visit'] != null) { // En caso de estar ocupado por un empleado o visita lo establecemos en rojo. 
                                ?>
                                    <section class="overflow-hidden relative flex flex-col items-center justify-center m-2 pt-3 pb-3 h-40 rounded-lg shadow-md border bg-gris-clarito border-red-500 text-gray-300"> <!--Contenedor de cada espacio-->
                                        <h2 class="flex items-center justify-center bg-red-900 text-white w-1/5 h-6 absolute left-0 top-0"><?php echo $tupla['spaces_number']; ?></h2>
                                        <h2 class="flex items-center justify-center bg-gray-800 text-white w-4/5 h-6 absolute right-0 top-0">Ocupado</h2>
                                    <?php } else { ?>
                                        <section class="overflow-hidden relative flex flex-col items-center justify-center m-2 pt-3 pb-3 h-40 rounded-lg shadow-md border bg-gris-clarito border-green-500 text-gray-300"> <!--Contenedor de cada espacio-->
                                            <h2 class="flex items-center justify-center bg-blue-900 text-white w-1/5 h-6 absolute left-0 top-0"><?php echo $tupla['spaces_number']; ?></h2>
                                            <h2 class="flex items-center justify-center bg-gray-800 text-white w-4/5 h-6 absolute right-0 top-0">Libre</h2>
                                        <?php } ?>
                                        <!-- <div>Status: <?php // echo $tupla['status_name'] 
                                                            ?></div> -->
                                        <?php
                                        if ($tupla['fk_employee'] != null) {
                                            echo "<div>";
                                            // echo "Estado:";
                                            // echo "<div class='mt-2 text-xl'>Ocupado</div>";
                                            // echo $tupla['fk_employee'];
                                            echo "</div>";
                                            echo '<a href="cajones.php?idEmpleado=' . $tupla['fk_employee'] . '"><button type="button" class="m-2 btn h-8 min-h-8 btn-outline btn-info">Ver empleado</button></a>';
                                        }
                                        if ($tupla['fk_visit'] != null) {
                                            echo "<div>";
                                            // echo "Estado:";
                                            // echo "<div class='mt-2 text-xl'>Ocupado</div>";
                                            // echo $tupla['fk_employee'];
                                            echo "</div>";
                                            echo '<a href="cajones.php?idVisita=' . $tupla['fk_visit'] . '"><button type="button" class="m-2 btn h-8 min-h-8 btn-outline btn-info">Ver visita</button></a>';
                                        }
                                        ?>
                                        <div>
                                            <form action="../../app/client/parking/eliminarEspacio.php" method="POST">
                                                <input type="hidden" name="idespacio" value="<?php echo $tupla['pk_spaces']; ?>">
                                                <button type="submit" class="m-2 btn h-8 min-h-8 btn-outline btn-warning">Eliminar espacio</button>
                                            </form>
                                        </div>
                                        </section>
                                    <?php } ?>
                                <?php } ?>
                    </div>
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