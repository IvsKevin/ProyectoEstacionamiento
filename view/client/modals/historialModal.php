<!--===============MODAL PARA AGREGAR ENTRADA========================================-->
<dialog id="agregarEntradaModal" class="modal bg-black-300 text-white">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 class="font-bold text-lg">Registro de Entrada</h3>
        <div class="modal-action  flex flex-col items-center">
            <form method="post" action="../../app/client/historial/addEntry.php">
                <div class="m-2">
                    <label class="input input-bordered flex items-center gap-2">
                        Código de Acceso (QR):
                        <input name="QR_code" type="text" class="grow" required />
                    </label>
                </div>
                <div class="m-2">
                    <label class="input input-bordered flex items-center gap-2">
                        Seleccionar Parking:
                        <select id="selectedParking" name="selectedParking" class="select select-bordered">
                            <?php
                            include_once(__DIR__ . "/../../../data/class/parking.php");
                            $myParking = new Parking();
                            $myParking->setFKclient($_SESSION['client_id']);
                            $parkingResult = $myParking->getParkingActive();

                            if ($parkingResult && mysqli_num_rows($parkingResult) > 0) {
                                while ($row = mysqli_fetch_assoc($parkingResult)) {
                                    echo '<option value="' . $row['pk_parking'] . '">' . $row['parking_location'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </label>
                </div>
                <div class="flex justify-end">
                    <input type="submit" value="Enviar" class="cursor-pointer mt-5 btn btn-outline btn-info p-2 pl-4 pr-4">
                </div>
            </form>
        </div>
    </div>
</dialog>
<!--===============MODAL PARA AGREGAR SALIDA========================================-->
<dialog id="agregarSalidaModal" class="modal bg-black-300 text-white">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 class="font-bold text-lg">Registro de Salida</h3>
        <div class="modal-action  flex flex-col items-center">
            <form method="post" action="../../app/client/historial/exitEntry.php">
                <div class="m-2">
                    <label class="input input-bordered flex items-center gap-2">
                        Numero de Boleto:
                        <input name="entry_id" type="text" class="grow" required />
                    </label>
                </div>
                <div class="flex justify-end">
                    <input type="submit" value="Enviar" class="cursor-pointer mt-5 btn btn-outline btn-info p-2 pl-4 pr-4">
                </div>
            </form>
        </div>
    </div>
</dialog>
<!--==============================SCRIPTS PARA AGREGAR EMPLEAODS================================-->
<script>
    function cambiarColor() {
        var historialLink = document.getElementById("historialLink");
        var historialLink = document.getElementById("historialContainer");
        historialLink.classList.add("text-gray-100");
        historialLink.classList.add("bg-gris-clarito");
    }

    // Llamada a la función para cambiar el color
    cambiarColor();
    
    function agregarEntrada() {
        agregarEntradaModal.showModal();
    }

    function agregarSalida() {
        agregarSalidaModal.showModal();
    }

    function mostrarImagen(input) {
        var preview = document.getElementById('previewImagen');
        var file = input.files[0];
        var reader = new FileReader();

        reader.onloadend = function() {
            preview.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }
    }
</script>
<!--==============================TERMINA EL MODAL PARA AGREGAR EMPLEAODS================================-->

<!--============================== MODAL PARA ACTUALIZAR EMPLEAODS=======================================-->
<dialog id="actualizarEmpleadoModal" class="modal bg-black-300 text-white">
    <div class="modal-box">

    </div>
</dialog>

<script>
    function actualizarEmpleado(id, nombre, apPaterno, apMaterno, rol) {
        var modal = document.getElementById('actualizarEmpleadoModal');
        var modalContent = modal.querySelector('.modal-box');

        modalContent.innerHTML = `
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 class="font-bold text-lg">Actualizar empleado</h3>
        <div class="modal-action flex flex-col justify-content">
            <form class="flex flex-col items-center" method="post" action="../../app/client/empleados/editEmployee.php">
                <div>
                    <input name="idEmpleado" type="number" class="grow hidden" value="${id}" />
                </div>
                <div class="avatar flex justify-center items-center relative">
                    <input type="file" id="imagenEmpleado" class="hidden" accept="image/*" onchange="mostrarImagen(this)">
                    <label for="imagenEmpleado" class="cursor-pointer">
                        <div class="mask mask-squircle w-15 h-15 bg-white text-black relative">
                            <img id="previewImagen" class="w-full h-full object-cover" src="" alt="Foto del empleado" />
                        </div>
                    </label>
                </div>
                <div class="m-2">
                    <label class="input input-bordered flex items-center gap-2">
                        Nombre:
                        <input name="nombreEmpleado" type="text" class="grow" value="${nombre}" />
                    </label>
                </div>
                <div class="m-2">
                    <label class="input input-bordered flex items-center gap-2">
                        Apellido paterno:
                        <input name="apPaternoEmpleado" type="text" class="grow" value="${apPaterno}" />
                    </label>
                </div>
                <div class="m-2">
                    <label class="input input-bordered flex items-center gap-2">
                        Nombre:
                        <input name="apMaternoEmpleado" type="text" class="grow" value="${apMaterno}" />
                    </label>
                </div>
                <div>
                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                            <span class="label-text">Rol del empleado</span>
                        </div>
                        <select class="select select-bordered" name="rolEmpleado">
                        <option value="1" ${rol === 'Gerente de planta' ? 'selected' : ''}>Gerente de Planta</option>
                        <option value="2" ${rol === 'Gerente de produccion' ? 'selected' : ''}>Gerente de produccion</option>
                        <option value="3" ${rol === 'Gerente de recursos' ? 'selected' : ''}>Gerente de recursos</option>
                        <option value="4" ${rol === 'Secretaria' ? 'selected' : ''}>Secretaria</option>
                        <option value="5" ${rol === 'Supervisor' ? 'selected' : ''}>Supervisor</option>
                        <option value="6" ${rol === 'Empleado' ? 'selected' : ''}>Empleado</option>
                        <option value="7" ${rol === 'Administrador' ? 'selected' : ''}>Administrador</option>
                        <option value="8" ${rol === 'Recursos Humanos' ? 'selected' : ''}>Recursos HUmanos</option>
                        <option value="9" ${rol === 'Finanzas' ? 'selected' : ''}>Finanzas</option>
                        <option value="10" ${rol === 'Mantenimiento' ? 'selected' : ''}>Mantenimiento</option>
                        <option value="11" ${rol === 'Seguridad' ? 'selected' : ''}>Seguridad</option>
                        <option value="12" ${rol === 'Maquinado' ? 'selected' : ''}>Maquinado</option>
                        </select>
                    </label>
                </div>
                <div>
                    <input type="submit" value="Actualizar datos" class="cursor-pointer mt-5 btn btn-outline btn-info p-2 pl-4 pr-4">
                </div>
            </form>

            <form class="flex flex-col items-center mt-8" method="post" action="../../app/client/empleados/deleteEmployee.php">
                <div>
                    <input name="idEmpleado" type="number" class="grow hidden" value="${id}" />
                </div>
                <div class="w-full flex justify-end">
                    <input type="submit" value="Eliminar empleado" class="cursor-pointer mt-5 btn btn-outline btn-error p-0 pl-4 pr-4">
                </div>
            </form>
        </div>`;

        actualizarEmpleadoModal.showModal();
    }
</script>