<!--Jotorge -->
<!--===============MODAL PARA AGREGAR PARKING========================================-->
<dialog id="agregarParkingModal" class="modal bg-black-300 text-white">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 class="font-bold text-lg">Agregar Estacionamiento</h3>
        <div class="modal-action flex flex-col items-center">
            <form method="post" action="../../app/client/parking/crearParking.php">
                <!-- Aquí coloca los campos necesarios para agregar un estacionamiento -->
                <div class="m-2">
                    <label class="input input-bordered flex items-center gap-2">
                        No. Parking<input type="number" name="numeroParking" placeholder="1" required min="1" max="50">
                    </label>
                </div>

                <div class="m-2">
                    <label class="input input-bordered flex items-center gap-2">
                        Ubicación:
                        <input name="ubicacionParking" type="text" class="grow" />
                    </label>
                </div>
                <div class="m-2">
                    <label class="input input-bordered flex items-center gap-2">
                        Capacidad:
                        <input name="capacidadParking" type="number" class="grow" />
                    </label>
                </div>
                <!-- Otros campos que puedas necesitar -->

                <div class="flex justify-end">
                    <input type="submit" value="Agregar" class="cursor-pointer mt-5 btn btn-outline btn-info p-2 pl-4 pr-4">
                </div>
            </form>
        </div>
    </div>
</dialog>
<!--==============================TERMINA EL MODAL PARA AGREGAR PARKING================================-->

<!--============================== MODAL PARA ACTUALIZAR PARKING=======================================-->
<dialog id="actualizarParkingModal" class="modal bg-black-300 text-white">
    <div class="modal-box">
        <!-- Aquí coloca el contenido del modal para actualizar estacionamiento, similar al anterior -->
    </div>
</dialog>

<script>
    function agregarParking() {
        agregarParkingModal.showModal();
    }

    function actualizarParking(id, parking, ubicacion, capacidad, status) {
        var modal = document.getElementById('actualizarParkingModal');
        var modalContent = modal.querySelector('.modal-box');

        modalContent.innerHTML = `
    <form method="dialog">
        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
    </form>
    <h3 class="font-bold text-lg">Actualizar Estacionamiento</h3>
    <div class="modal-action flex flex-col items-center">
        <form method="post" action="../../app/client/parking/editParking.php">
            <div>
                <input name="parking_id" type="number" class="grow hidden" value="${id}" />
            </div>

            <div class="m-2">
                <label class="input input-bordered flex items-center gap-2">
                    Numero de Parking:
                    <input name="parking" type="text" class="grow" value="${parking}" />
                </label>
            </div>

            <!-- Aquí coloca los campos necesarios para actualizar un estacionamiento -->
            <div class="m-2">
                <label class="input input-bordered flex items-center gap-2">
                    Ubicación:
                    <input name="location" type="text" class="grow" value="${ubicacion}" />
                </label>
            </div>

            <div class="m-2">
                <label class="input input-bordered flex items-center gap-2">
                    Capacidad:
                    <input name="capacity" type="number" class="grow" value="${capacidad}" />
                </label>
            </div>

            <div class="m-2">
                <label class="input input-bordered flex items-center gap-2">
                    Estado:
                    <select name="status" class="grow">
                        <option value="1" ${status === 'Activo' ? 'selected' : ''}>Accesible</option>
                        <option value="2" ${status === 'Inactivo' ? 'selected' : ''}>Lleno</option>
                    </select>
                </label>
            </div>
            <!-- Otros campos que puedas necesitar -->

            <div class="flex justify-end">
                <input type="submit" value="Actualizar" class="cursor-pointer mt-5 btn btn-outline btn-info p-2 pl-4 pr-4">
            </div>
        </form>
    </div>`;


        actualizarParkingModal.showModal();
    }
</script>
<!--==============================TERMINA EL MODAL PARA ACTUALIZAR PARKING================================-->