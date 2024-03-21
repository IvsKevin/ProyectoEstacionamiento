<!-- Modal para añadir visitante -->
<dialog id="agregarVisitanteModal" class="modal bg-black-300 text-white">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 class="font-bold text-lg">Añadir visitante</h3>
        <div class="modal-action  flex flex-col items-center">
            <form method="post" action="../../app/client/visitantes/addVisita.php">
                <div class="m-2">
                    <label class="input input-bordered flex items-center gap-2">
                        Nombre de la empresa visitada:
                        <input name="visit_company" type="text" class="grow" />
                    </label>
                </div>
                <div class="m-2">
                    <label class="input input-bordered flex items-center gap-2">
                        Razón de la visita:
                        <input name="visit_reason" type="text" class="grow" />
                    </label>
                </div>
                <div class="m-2">
                    <label class="input input-bordered flex items-center gap-2">
                        Nombre del visitante:
                        <input name="visit_name" type="text" class="grow" />
                    </label>
                </div>
                <div class="m-2">
                    <label class="input input-bordered flex items-center gap-2">
                        Apellido del visitante:
                        <input name="visit_lastName" type="text" class="grow" />
                    </label>
                </div>
                <input type="hidden" name="fk_client" value="<?php echo $_SESSION['client_id']; ?>">
                <div class="flex justify-end">
                    <input type="submit" value="Enviar" class="cursor-pointer mt-5 btn btn-outline btn-info p-2 pl-4 pr-4">
                </div>
            </form>
        </div>
    </div>
</dialog>

<script>
    function cambiarColor() {
        var visitantesLink = document.getElementById("visitantesLink");
        var visitantesLink = document.getElementById("visitantesContainer");
        visitantesLink.classList.add("text-gray-100");
        visitantesLink.classList.add("bg-gris-clarito");
    }

    // Llamada a la función para cambiar el color
    cambiarColor();

    function agregarVisita() {
        agregarVisitanteModal.showModal();
    }
</script>

<!-- Modal para actualizar visitante -->
<dialog id="actualizarVisitanteModal" class="modal bg-black-300 text-white">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" onclick="cerrarModal('actualizarVisitanteModal')">✕</button>
        </form>
        <h3 class="font-bold text-lg">Actualizar visitante</h3>
        <div class="modal-action flex flex-col justify-content">
            <form class="flex flex-col items-center" method="post" action="../../app/client/visitantes/editVisit.php">
                <!-- Input oculto para almacenar el ID de visitante -->
                <input type="hidden" id="update_idVisitante" name="pk_visit" value="">
                <input type="hidden" name="fk_client" value="<?php echo $_SESSION['client_id']; ?>">
                <!-- Campo para modificar el nombre de la empresa visitada -->
                <div class="m-2">
                    <label class="input input-bordered flex items-center gap-2">
                        Nombre de la empresa visitada:
                        <input id="update_visit_company" name="visit_company" type="text" class="grow" />
                    </label>
                </div>
                <!-- Campo para modificar la razón de la visita -->
                <div class="m-2">
                    <label class="input input-bordered flex items-center gap-2">
                        Razón de la visita:
                        <input id="update_visit_reason" name="visit_reason" type="text" class="grow" />
                    </label>
                </div>
                <!-- Campo para modificar el nombre del visitante -->
                <div class="m-2">
                    <label class="input input-bordered flex items-center gap-2">
                        Nombre del visitante:
                        <input id="update_visit_name" name="visit_name" type="text" class="grow" />
                    </label>
                </div>
                <!-- Campo para modificar el apellido del visitante -->
                <div class="m-2">
                    <label class="input input-bordered flex items-center gap-2">
                        Apellido del visitante:
                        <input id="update_visit_lastName" name="visit_lastName" type="text" class="grow" />
                    </label>
                </div>
                <!-- Botón para enviar la solicitud de actualización -->
                <div>
                    <input type="submit" value="Actualizar datos" class="cursor-pointer mt-5 btn btn-outline btn-info p-2 pl-4 pr-4">
                </div>
            </form>
            <!-- Formulario para eliminar visitante -->
            <form class="flex flex-col items-center mt-8" method="post" action="../../app/client/visitantes/deleteVisit.php">
                <!-- Input oculto para almacenar el ID de visitante -->
                <input id="delete_idVisitante" name="idVisitante" type="hidden" class="grow" value="">
                <!-- Botón para enviar la solicitud de eliminación -->
                <div class="w-full flex justify-end">
                    <input type="submit" value="Eliminar visitante" class="cursor-pointer mt-5 btn btn-outline btn-error p-0 pl-4 pr-4">
                </div>
            </form>
        </div>
    </div>
</dialog>

<script>
    function actualizarVisitante(id, company, reason, name, lastName) {
        var modal = document.getElementById('actualizarVisitanteModal');

        // Setear los valores en los campos del formulario de actualizar
        document.getElementById('update_idVisitante').value = id;
        document.getElementById('update_visit_company').value = company;
        document.getElementById('update_visit_reason').value = reason;
        document.getElementById('update_visit_name').value = name;
        document.getElementById('update_visit_lastName').value = lastName;
        document.getElementById('delete_idVisitante').value = id;

        modal.showModal();
    }

    function cerrarModal(id) {
        var modal = document.getElementById(id);
        modal.close();
    }
</script>