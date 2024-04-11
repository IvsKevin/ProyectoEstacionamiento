<!--===============MODAL PARA AGREGAR CAJONES========================================-->
<dialog id="agregarCajonesModal" class="modal bg-black-300 text-white">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 class="font-bold text-lg">Añadir cajon</h3>
        <div class="modal-action  flex flex-col items-center">
            <form method="post" action="../../app/client/parking/crearEspacio.php">
                <div class="m-2">
                    <label class="input input-bordered flex items-center gap-2">
                        Número del cajon:
                        <input name="spaces_number" type="number" class="grow" required />
                    </label>
                </div>
                <div class="flex justify-end">
                    <input type="submit" value="Enviar" class="cursor-pointer mt-5 btn btn-outline btn-info p-2 pl-4 pr-4">
                </div>
            </form>
        </div>
    </div>
</dialog>
<!--==============================TERMINA EL MODAL PARA AGREGAR CAJONES================================-->
<script>
    function agregarCajones() {
        agregarCajonesModal.showModal();
    }

    function cambiarColor() {
        var parkingLink = document.getElementById("parkingLink");
        var parkingLink = document.getElementById("parkingContainer");
        parkingLink.classList.add("text-gray-100");
        parkingLink.classList.add("bg-gris-clarito");
    }

    // Llamada a la función para cambiar el color
    cambiarColor();
</script>

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
<!--==============================SCRIPTS PARA VER EL EMPLEADO EN EL CAJON OCUPANTE================================-->
<?php if (isset($_GET['idEmpleado'])) { ?>
    <?php
    include_once(__DIR__ . "/../../../data/class/employee.php");
    $empleado = new Employee();
    // Suponiendo que $idEmpleado está definido o se pasa como parámetro a esta página
    $idEmpleado = $_GET['idEmpleado']; // Suponiendo que se pasa como parámetro GET
    $consulta = $empleado->getEmployeeById3($idEmpleado);
    if ($consulta) {
        $nombre = $consulta['employee_name']; // Ajusta esto según la estructura de tu tabla de empleados
        $apellidoPaterno = $consulta['employee_lastNameP']; // Ajusta esto según la estructura de tu tabla de empleados
        $apellidoMaterno = $consulta['employee_lastNameM']; // Ajusta esto según la estructura de tu tabla de empleados
        $tel = $consulta['tel'];
        $matricula = $consulta['matricula'];
        $modelo = $consulta['model_name'];
        $marca = $consulta['brand_name'];
    }
    ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            verEmpleado();
        });
    </script>
<?php } ?>

<dialog id="verEmpleadoModal" class="modal bg-black-300 text-white">
    <div class="modal-box"></div>
</dialog>

<script>
    function verEmpleado() {
        var modal = document.getElementById('verEmpleadoModal');
        var modalContent = modal.querySelector('.modal-box');

        modalContent.innerHTML = `
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="font-bold text-lg">Datos del empleado ocupante</h3>
            <div class="modal-action flex flex-col items-center">
                <section class="flex flex-col items-center">
                    <h2 class="font-bold text-lg">Datos del empleado</h2>
                    <p>Nombre del empleado: <?php echo $nombre . ' ' . $apellidoPaterno . ' ' . $apellidoMaterno; ?></p>
                    <p>Teléfono: <?php echo $tel; ?></p><br>

                    <h2 class="font-bold text-lg">Datos del vehiculo</h2>
                    <p>Marca del auto: <?php echo $marca; ?></p>
                    <p>Modelo del auto: <?php echo $modelo; ?></p>
                    <p>Matrícula del auto: <?php echo $matricula; ?></p>
                </section>
            </div>
        `;
        verEmpleadoModal.showModal();
    }
</script>
<!--==============================SCRIPTS PARA VER LA VISITA EN EL CAJON OCUPANTE================================-->
<?php if (isset($_GET['idVisita'])) { ?>
    <?php
    include_once(__DIR__ . "/../../../data/class/visit.php");
    $visita = new Visit();
    // Suponiendo que $idVisita está definido o se pasa como parámetro a esta página
    $idVisita = $_GET['idVisita']; // Suponiendo que se pasa como parámetro GET
    $consultaVisita = $visita->getVisitById($idVisita);
    if ($consultaVisita) {
        $visitCompany = $consultaVisita['visit_company']; // Ajusta esto según la estructura de tu tabla de visitas
        $visitReason = $consultaVisita['visit_reason']; // Ajusta esto según la estructura de tu tabla de visitas
        $visitName = $consultaVisita['visit_name']; // Ajusta esto según la estructura de tu tabla de visitas
        $visitLastName = $consultaVisita['visit_lastName']; // Ajusta esto según la estructura de tu tabla de visitas
        // Otros campos de la visita que quieras mostrar
    }
    ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            verVisita();
        });
    </script>
<?php } ?>

<dialog id="verVisitaModal" class="modal bg-black-300 text-white">
    <div class="modal-box"></div>
</dialog>

<script>
    function verVisita() {
        var modal = document.getElementById('verVisitaModal');
        var modalContent = modal.querySelector('.modal-box');

        modalContent.innerHTML = `
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="font-bold text-lg">Datos de la visita ocupante</h3>
            <div class="modal-action  flex flex-col items-center">
                <section>
                    <p>Compañía: <?php echo $visitCompany; ?></p>
                    <p>Razón de visita: <?php echo $visitReason; ?></p>
                    <p>Nombre de la visita: <?php echo $visitName . ' ' . $visitLastName; ?></p>
                    <p>Datos del vehículo: Sin carro asociado </p>
                </section>
            </div>
        `;
        verVisitaModal.showModal();
    }
</script>