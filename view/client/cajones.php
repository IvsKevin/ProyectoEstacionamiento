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
                                <section class="overflow-hidden relative flex flex-col items-center justify-center m-2 pt-3 pb-3 h-40 rounded-lg shadow-md border bg-gris-clarito border-blue-500 text-gray-300"> <!--Contenedor de cada espacio-->
                                    <?php if ($tupla['fk_employee'] != null) { ?>
                                        <h2 class="flex items-center justify-center bg-red-900 text-white w-1/5 h-6 absolute left-0 top-0"><?php echo $tupla['spaces_number']; ?></h2>
                                    <?php } else { ?>
                                        <h2 class="flex items-center justify-center bg-blue-900 text-white w-1/5 h-6 absolute left-0 top-0"><?php echo $tupla['spaces_number']; ?></h2>
                                    <?php } ?>
                                    <!-- <div>Status: <?php // echo $tupla['status_name'] ?></div> -->
                                    <?php
                                    if ($tupla['fk_employee'] != null) {
                                        echo "<div>";
                                        // echo "Estado:";
                                        echo "<div class='mt-2 text-xl'>Ocupado</div>";
                                        // echo $tupla['fk_employee'];
                                        echo "</div>";
                                        echo '<button type="button" class="m-2 btn h-8 min-h-8 btn-outline btn-info" onclick="verEmpleado(' . $tupla["fk_employee"] . ')">Ver empleado</button>';
                                    }
                                    ?>
                                    <div>
                                        <form action="../../app/client/parking/eliminarEspacio.php" method="POST">
                                            <input type="hidden" name="idespacio" value="<?php echo $tupla['pk_spaces']; ?>">
                                            <button type="submit" class="m-2 btn h-8 min-h-8 btn-outline btn-warning">Eliminar Espacio</button>
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
<?php
// Verifica si el parámetro 'resultado' está presente en la URL
if (isset($_GET['limite'])) {
    // Recupera el valor del parámetro 'resultado'
    $limite = $_GET['limite'];
    // Muestra los detalles de la entrada al usuario
    echo "<dialog id='resultadoLimiteModal' class='modal bg-black-300 text-white'>
            <div class='modal-box'>
                <form method='dialog'>
                    <button class='btn btn-sm btn-circle btn-ghost absolute right-2 top-2'>✕</button>
                </form>
                <h3 class='font-bold text-lg'>Añadir cajón mensaje</h3>
                <div class='modal-action  flex flex-col items-center'>";
    if ($limite != '') {
        echo "<p>$limite</p>";
    }
    echo "</div>
            </div>
        </dialog>";
?>
    <script>
        resultadoLimiteModal.showModal();
    </script>
<?php }
// Verifica si el parámetro 'resultado' está presente en la URL
if (isset($_GET['errorEliminacion'])) {
    // Recupera el valor del parámetro 'resultado'
    $errorEliminacion = $_GET['errorEliminacion'];
    // Muestra los detalles de la entrada al usuario
    echo "<dialog id='resultadoEliminacion' class='modal bg-black-300 text-white'>
            <div class='modal-box'>
                <form method='dialog'>
                    <button class='btn btn-sm btn-circle btn-ghost absolute right-2 top-2'>✕</button>
                </form>
                <h3 class='font-bold text-lg'>Eliminar cajón mensaje</h3>
                <div class='modal-action  flex flex-col items-center'>";
    if ($errorEliminacion != '') {
        echo "<p>$errorEliminacion</p>";
    }
    echo "</div>
            </div>
        </dialog>";
?>
    <script>
        resultadoEliminacion.showModal();
    </script>
<?php } ?>
<dialog id="verEmpleadoModal" class="modal bg-black-300 text-white">
    <div class="modal-box">

    </div>
</dialog>
<!--==============================SCRIPTS PARA AGREGAR EMPLEAODS================================-->
<script>
    function agregarCajones() {
        agregarCajonesModal.showModal();
    }

    function verEmpleado($idEmpleado) {
        <?php include_once(__DIR__ . "/../../data/class/employee.php"); ?>

        <?php
        $empleado = new Employee();
        $consulta = $empleado->getEmployeeById($idEmpleado);
        if ($consulta) {
            $nombre = $consulta['employee_name']; // Ajusta esto según la estructura de tu tabla de empleados
            $apellidoPaterno = $consulta['employee_lastNameP']; // Ajusta esto según la estructura de tu tabla de empleados
            $apellidoMaterno = $consulta['employee_lastNameM']; // Ajusta esto según la estructura de tu tabla de empleados

        ?>

            var modal = document.getElementById('verEmpleadoModal');
            var modalContent = modal.querySelector('.modal-box');

            modalContent.innerHTML = `
    <form method="dialog">
        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
    </form>
    <h3 class="font-bold text-lg">Datos del empleado ocupante</h3>
    <div class="modal-action  flex flex-col items-center">
        <section>
            <div class="m-2">
                <label class="input input-bordered flex items-center gap-2">
                    Nombre: <?php echo $nombre . ' ' . $apellidoPaterno . ' ' . $apellidoMaterno; ?>
                    <input name="spaces_number" type="number" class="grow" required />
                </label>
            </div>
            <div class="flex justify-end">
                <input type="submit" value="Enviar" class="cursor-pointer mt-5 btn btn-outline btn-info p-2 pl-4 pr-4">
            </div>
        </section>
    </div>
    `;
            verEmpleadoModal.showModal();
        <?php } ?>
    }
</script>