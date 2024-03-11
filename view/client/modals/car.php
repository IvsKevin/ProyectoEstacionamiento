<dialog id="agregarCarroModal" class="modal bg-black-300 text-white">
    <div class="modal-box">
        <form method="post" action="../../app/client/carros/addCar.php">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" onclick="cerrarModal('agregarCarroModal')">✕</button>
            <h3 class="font-bold text-lg">Añadir carro</h3>
            <div class="modal-action  flex flex-col items-center">
                <div class="m-2">
                    <label class="input input-bordered flex items-center gap-2">
                        Matrícula:
                        <input name="matricula" type="text" class="grow" required />
                    </label>
                </div>
                <div class="m-2">
                    <label class="input input-bordered flex items-center gap-2">
                        Año del modelo:
                        <input name="model_year" type="number" class="grow" required />
                    </label>
                </div>
                <div class="m-2">
                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                            <span class="label-text">Marca:</span>
                        </div>
                        <select class="select select-bordered" name="marca" required>
                            <?php
                            include_once(__DIR__ . "/../../../data/class/car.php");
                            $carObj = new Car();
                            $marcas = $carObj->getMarca();
                            while ($row = mysqli_fetch_assoc($marcas)) {
                                echo '<option value="' . $row['pk_brand'] . '">' . $row['brand_name'] . '</option>';
                            }
                            ?>
                        </select>
                    </label>
                </div>
                <div class="m-2">
                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                            <span class="label-text">Modelo:</span>
                        </div>
                        <select class="select select-bordered" name="modelo" required>
                        </select>
                    </label>
                </div>
                <div class="m-2">
                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                            <span class="label-text">Color:</span>
                        </div>
                        <select class="select select-bordered" name="color" required>
                            <?php
                            $colors = $carObj->getModelColor();
                            while ($row = mysqli_fetch_assoc($colors)) {
                                echo '<option value="' . $row['pk_color'] . '">' . $row['model_color'] . '</option>';
                            }
                            ?>
                        </select>
                    </label>
                </div>
                <div class="m-2">
    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Empleado:</span>
        </div>
        <select class="select select-bordered" name="empleado" required>
            <?php
            while ($row = mysqli_fetch_assoc($empleados)) {
                echo '<option value="' . $row['pk_employee'] . '">' . $row['employee_name'] . '</option>';
            }
            ?>
        </select>
    </label>
</div>

                <div class="flex justify-end">
                    <button type="submit" class="cursor-pointer mt-5 btn btn-outline btn-info p-2 pl-4 pr-4">Enviar</button>
                </div>
            </div>
        </form>
    </div>
</dialog>

<script>
    function abrirModal(idModal) {
        var modal = document.getElementById(idModal);
        modal.showModal();
    }

    function cerrarModal(idModal) {
        var modal = document.getElementById(idModal);
        modal.close();
    }

    function cargarModelos() {
        var marcaSelect = document.querySelector('select[name="marca"]');
        var modeloSelect = document.querySelector('select[name="modelo"]');
        var marca = marcaSelect.value;

        modeloSelect.innerHTML = '<option value="">Seleccione un modelo</option>';

        fetch('../../app/client/carros/getModelos.php?marca=' + marca)
            .then(response => response.json())
            .then(data => {
                data.forEach(modelo => {
                    var option = document.createElement('option');
                    option.value = modelo.pk_model;
                    option.textContent = modelo.model_name;
                    modeloSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error al cargar modelos:', error));
    }
    document.querySelector('select[name="marca"]').addEventListener('change', cargarModelos);

    window.addEventListener('DOMContentLoaded', cargarModelos);
</script>
