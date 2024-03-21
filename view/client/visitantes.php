<?php
// Incluimos el archivo navbar.php
include_once "navbar.php";

// Verificamos si existe una sesión
if (!isset($_SESSION)) {
    session_start();
}

// Incluimos la clase de visitas
include_once(__DIR__ . "/../../data/class/visit.php");

// Creamos un objeto de la clase Visit para obtener las visitas del cliente
$visit = new Visit();
$visit->setFkClient($_SESSION['client_id']);
$visits = $visit->getVisit();
?>

<div>
    <div class="relative md:pt-32 pb-32 pt-12">
        <div class="px-4 md:px-10 mx-auto w-full">
            <div>
                <!--Inicio de la barra de navegación-->
                <div class="navbar rounded-box">
                    <div class="flex-1 px-2 lg:flex-none">
                        <button class="btn h-8 min-h-8 btn-outline btn-info" onclick="agregarVisita()"> + Añadir visita</button>
                    </div>
                    <!-- Otros botones de filtrado o acciones -->
                </div>
                <?php if ($visits && $visits != "error") { ?>
                    <!-- Contenido en tabla -->
                    <div class="overflow-x-auto" id="table-view">
                        <table class="table bg-gris-oscurito shadow-xl text-center items-center">
                            <!-- Encabezados -->
                            <thead>
                                <tr class="text-gray-200 font-semibold text-base">
                                    <th>ID</th>
                                    <th>Compañía</th>
                                    <th>Razón</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Acciones</th> <!-- Agregamos esta columna para las acciones -->
                                    <!-- Otros encabezados según tus necesidades -->
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Filas de visitantes -->
                                <?php while ($row = mysqli_fetch_assoc($visits)) { ?>
                                    <tr class="text-base">
                                        <!-- ID de la visita -->
                                        <td><?php echo $row['pk_visit'] ?></td>
                                        <!-- Compañía -->
                                        <td><?php echo $row['visit_company'] ?></td>
                                        <!-- Razón de la visita -->
                                        <td><?php echo $row['visit_reason'] ?></td>
                                        <!-- Nombre y apellidos del visitante -->
                                        <td><?php echo $row['visit_name'] ?></td>
                                        <td><?php echo $row['visit_lastName'] ?></td>
                                        <!-- Botones de acciones -->
                                        <td>
                                            <button class="btn btn-outline btn-success btn-xs" onclick="actualizarVisitante(
                                                '<?php echo $row['pk_visit']; ?>',
                                                '<?php echo $row['visit_company']; ?>',
                                                '<?php echo $row['visit_reason']; ?>',
                                                '<?php echo $row['visit_name']; ?>',
                                                '<?php echo $row['visit_lastName']; ?>'
                                            )">Actualizar</button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } else { ?>
                    <p>No hay visitantes para mostrar.</p>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</body>

<!-- Script para cambiar entre la vista de tabla y tarjetas -->
<script>
    function toggleView() {
        var tableView = document.getElementById('table-view');
        var cardView = document.getElementById('card-view');

        // Si la vista de tabla está visible, ocúltala y muestra la vista de tarjetas (y viceversa)
        if (tableView.style.display === 'block' || tableView.style.display === '') {
            tableView.style.display = 'none';
            cardView.style.display = 'block';
        } else {
            tableView.style.display = 'block';
            cardView.style.display = 'none';
        }
    }
</script>

<!-- Incluimos el modal de visitantes -->
<?php include_once "modals/visitantesModal.php"; ?>

<?php
// Verifica si el parámetro 'resultado' está presente en la URL
if (isset($_GET['resultado'])) {
    // Recupera el valor del parámetro 'resultado'
    $resultado = $_GET['resultado'];
    // Muestra los detalles de la entrada al usuario
    echo "<dialog id='resultadoModal' class='modal bg-black-300 text-white'>
            <div class='modal-box'>
                <form method='dialog'>
                    <button class='btn btn-sm btn-circle btn-ghost absolute right-2 top-2'>✕</button>
                </form>
                <h3 class='font-bold text-lg'>Resultado de la eliminacion de la visita</h3>
                <div class='modal-action  flex flex-col items-center'>";
    if ($resultado != '') {
        echo "<p>$resultado</p>";
    }
    echo "</div>
            </div>
        </dialog>";
?>
    <script>
        resultadoModal.showModal();
    </script>
<?php }