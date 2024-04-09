<!--MODAL CON LOS DETALLES DE LA COMPRA-->
<dialog id="my_modal_1" class="modal bg-black-300 text-white">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 class="font-bold text-lg">Detalles de compra</h3>
        <p class="py-6">Ponemos todos los detalles para confirmar la compra</p>
        <div class="modal-action">
            <form method="dialog">
                <!-- if there is a button in form, it will close the modal -->
                <button class="btn" onclick="confirmarCompra()">Confirmar compra</button>
            </form>
        </div>
    </div>
</dialog>
<script>
    function showModal(membership) {
        // Obtén el elemento del modal y actualiza su contenido según la membresía seleccionada
        var modal = document.getElementById('my_modal_1');
        var modalContent = modal.querySelector('.modal-box');

        // Lógica para obtener y mostrar detalles según la membresía
        var details = getMembershipDetails(membership);
        var post = getMembershipPost(membership);

        // Actualiza el contenido del modal
        modalContent.innerHTML = `
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" onclick="closeModal()">✕</button>
            </form>
            <h3 class="font-bold text-lg">${membership}</h3>
            <p class="py-6">${details}</p>
            <div class="modal-action">
                <form method="post" action="../app/register.php">
                    ${post}
                    <button class="btn" onclick="confirmarCompra()">Confirmar compra</button>
                </form>
            </div>
        `;

        // Muestra el modal
        modal.showModal();
    }

    // Función para cerrar el modal
    function closeModal() {
        var modal = document.getElementById('my_modal_1');
        modal.close();
    }

    // Función para obtener detalles de membresía
    function getMembershipDetails(membership) {
        // Lógica para obtener detalles según la membresía seleccionada
        // Puedes almacenar y recuperar detalles desde un servidor, base de datos, etc.
        // Por ahora, simplemente devolveré un mensaje fijo para cada membresía.
        switch (membership) {
            case 'Basica':
                return 'Licencia para Control de Estacionamientos<br>Gestión Básica de Espacios<br>Informe de Ocupación.';
            case 'Regular':
                return 'Licencia Empresarial Estándar<br>Gestión Avanzada de Espacios<br>Informe de Ocupación en Tiempo Real<br>Soporte Técnico 24/7.';
            case 'Pro':
                return 'Licencia Empresarial Avanzada<br>Gestión Integral de Estacionamientos<br>Informe de Ocupación en Tiempo Real<br>Soporte Técnico Prioritario 24/7<br>Integración con Sistemas de Seguridad.';
            default:
                return '';
        }
    }
    // Función para obtener detalles de membresía
    function getMembershipPost(membership) {
        // Lógica para obtener detalles según la membresía seleccionada
        // Puedes almacenar y recuperar detalles desde un servidor, base de datos, etc.
        // Por ahora, simplemente devolveré un mensaje fijo para cada membresía.
        switch (membership) {
            case 'Basica':
                return `
                <input type="hidden" name="amount" value="200"> 
                <input type="hidden" name="description"  value="Licencia Basica"> 
                <input type="hidden" name="duration" value="1">`;
            case 'Regular':
                return `
                <input type="hidden" name="amount" value="500"> 
                <input type="hidden" name="description"  value="Licencia Regular"> 
                <input type="hidden" name="duration" value="5">`;
            case 'Pro':
                return `
                <input type="hidden" name="amount" value="600"> 
                <input type="hidden" name="description"  value="Licencia Pro"> 
                <input type="hidden" name="duration" value="9">`;
            default:
                return '';
        }
    }
</script>

<dialog id="my_modal_2" class="modal bg-black-300 text-white">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Confirmando compra...</h3>
    </div>
</dialog>

<dialog id="my_modal_3" class="modal bg-black-300 text-white">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Compra exitosa!</h3>
    </div>
</dialog>

<script>
    function iniciarSesion() {
        iniciar.showModal();
        
    }
</script>
<dialog id="iniciar" class="modal bg-black-300 text-white">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Verificando...</h3>
    </div>
</dialog>

<dialog id="cuentaEncontrada" class="modal bg-black-300 text-white">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Cuenta encontrada!</h3>
    </div>
</dialog>

<dialog id="logout" class="modal bg-black-300 text-white">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Cerrando sesion...</h3>
    </div>
</dialog>

<!--Efecto de esperar 2 segundos-->
<script>
    function confirmarCompra() {
        // Agregar un efecto de espera de 2 segundos antes de redirigir
        my_modal_2.showModal();

        setTimeout(function() {
            my_modal_3.showModal();
        }, 2000); // 2000 milisegundos = 2 segundos

        setTimeout(function() {
            window.location.href = "../app/register.php";
        }, 5000); // 2000 milisegundos = 2 segundos
    }

    function cerrarSesion() {
        logout.showModal();

        setTimeout(function() {
            window.location.href = "../../app/logOut.php";
        }, 3000); // 2000 milisegundos = 2 segundos
    }
</script>

<?php
// Verifica si el parámetro 'resultado' está presente en la URL
if (isset($_GET['resultado'])) {
    // Recupera el valor del parámetro 'resultado'
    $resultado = $_GET['resultado'];
    // Muestra los detalles de la entrada al usuario
    echo "<dialog id='inserccionUsuario' class='modal bg-black-300 text-white'>
            <div class='modal-box'>
                <form method='dialog'>
                    <button class='btn btn-sm btn-circle btn-ghost absolute right-2 top-2'>✕</button>
                </form>
                <h3 class='font-bold text-lg'>Resultado del registro</h3>
                <div class='modal-action  flex flex-col items-center'>";
    if ($resultado != '') {
        echo "<p>$resultado</p>";
    }
    echo "</div>
            </div>
        </dialog>";
?>
    <script>
        inserccionUsuario.showModal();
    </script>
<?php } ?>