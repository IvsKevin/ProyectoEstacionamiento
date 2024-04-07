<!--===============MODAL PARA AGREGAR EMPLEADO========================================-->
<dialog id="agregarEmpleadoModal" class="modal bg-black-300 text-white">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 class="font-bold text-lg">Añadir empleado</h3>
        <div class="modal-action  flex flex-col items-center">
            <form method="post" action="../../app/client/empleados/addEmployee.php">
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
                        <input name="nombreEmpleado" type="text" class="grow" required />
                    </label>
                </div>
                <div class="m-2">
                    <label class="input input-bordered flex items-center gap-2">
                        Apellido paterno:
                        <input name="apPaternoEmpleado" type="text" class="grow" required />
                    </label>
                </div>
                <div class="m-2">
                    <label class="input input-bordered flex items-center gap-2">
                        Apellido materno:
                        <input name="apMaternoEmpleado" type="text" class="grow" required />
                    </label>
                </div>
                <div class="m-2">
                    <label class="input input-bordered flex items-center gap-2">
                        Telefono:
                        <input name="tel" type="text" class="grow" required maxlength="10" required pattern="[0-9]{10}" title="Por favor, introduce un número de teléfono válido de 10 dígitos" Placeholder="Maximo 10 digitos"/>
                    </label>
                </div>
                <div class="m-2">
                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                            <span class="label-text">Rol del empleado</span>
                        </div>
                        <select class="select select-bordered" name="rolEmpleado" required>
                            <!-- <option disabled selected>Selecciona un rol</option> -->
                            <option value="1">Gerente de Planta</option>
                            <option value="2">Gerente de produccion</option>
                            <option value="3">Gerente de recursos</option>
                            <option value="4">Secretaria</option>
                            <option value="5">Supervisor</option>
                            <option value="6">Empleado</option>
                            <option value="7">Administrador</option>
                            <option value="8">Recursos HUmanos</option>
                            <option value="9">Finanzas</option>
                            <option value="10">Mantenimiento</option>
                            <option value="11">Seguridad</option>
                            <option value="12">Maquinado</option>
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
<!--==============================SCRIPTS PARA AGREGAR EMPLEAODS================================-->
<script>
    function cambiarColor() {
        var empleadosLink = document.getElementById("empleadosLink");
        var empleadosLink = document.getElementById("empleadosContainer");
        empleadosLink.classList.add("text-gray-100");
        empleadosLink.classList.add("bg-gris-clarito");
    }
    
    // Llamada a la función para cambiar el color
    cambiarColor();

    function agregarEmpleado() {
        agregarEmpleadoModal.showModal();
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
    function actualizarEmpleado(id, nombre, apPaterno, apMaterno, tel, rol) {
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
                        <input name="nombreEmpleado" type="text" class="grow" value="${nombre}" required/>
                    </label>
                </div>
                <div class="m-2">
                    <label class="input input-bordered flex items-center gap-2">
                        Apellido paterno:
                        <input name="apPaternoEmpleado" type="text" class="grow" value="${apPaterno}" required/>
                    </label>
                </div>
                <div class="m-2">
                    <label class="input input-bordered flex items-center gap-2">
                        Apellido Materno:
                        <input name="apMaternoEmpleado" type="text" class="grow" value="${apMaterno}" required/>
                    </label>
                </div>
                <div class="m-2">
                    <label class="input input-bordered flex items-center gap-2">
                        Telefono:
                        <input name="tel" type="text" class="grow" value="${tel}" required/>
                    </label>
                </div>
                <div>
                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                            <span class="label-text">Rol del empleado</span>
                        </div>
                        <select class="select select-bordered" name="rolEmpleado" required>
                            <option value="1" ${rol === 'Gerente de Planta' ? 'selected' : ''}>Gerente de Planta</option>
                            <option value="2" ${rol === 'Gerente de produccion' ? 'selected' : ''}>Gerente de producción</option>
                            <option value="3" ${rol === 'Gerente de recursos' ? 'selected' : ''}>Gerente de recursos</option>
                            <option value="4" ${rol === 'Secretaria' ? 'selected' : ''}>Secretaria</option>
                            <option value="5" ${rol === 'Supervisor' ? 'selected' : ''}>Supervisor</option>
                            <option value="6" ${rol === 'Empleado' ? 'selected' : ''}>Empleado</option>
                            <option value="7" ${rol === 'Administrador' ? 'selected' : ''}>Administrador</option>
                            <option value="8" ${rol === 'Recursos Humanos' ? 'selected' : ''}>Recursos Humanos</option>
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