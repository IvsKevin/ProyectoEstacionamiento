<dialog id="agregarCarroModal" class="modal bg-black-300 text-white">
    <div class="modal-box">
        <form method="post" action="../../app/client/carros/addCar.php">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" onclick="cerrarModal('agregarCarroModal')">✕</button>
            <h3 class="font-bold text-lg">Añadir carro</h3>
            <div class="modal-action flex flex-col items-center">
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

                <!-- Ventana modal para mostrar el mensaje de error -->
                <dialog id="errorModal" class="modal">
                    <div class="modal-box">
                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" onclick="cerrarModal('errorModal')">✕</button>
                        <p id="errorMessage" class="font-bold text-lg"><?php echo isset($_SESSION['error_message']) ? $_SESSION['error_message'] : ''; ?></p>
                    </div>
                </dialog>


                <div class="flex justify-end">
                    <button type="submit" class="cursor-pointer mt-5 btn btn-outline btn-info p-2 pl-4 pr-4" onclick="verificarEmpleado()">Enviar</button>
                </div>
            </div>
        </form>
    </div>
</dialog>

<!-- Agregar el modal de filtros -->
<dialog id="filtrarCarrosModal" class="modal bg-black-300 text-white">
    <div class="modal-box">
        <form id="filtroForm" method="post" action="">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" onclick="cerrarModal('filtrarCarrosModal')">✕</button>
            <h3 class="font-bold text-lg">Filtrar Carros</h3>
            <div class="modal-action flex flex-col items-center">
                <div class="m-2">
                    <label class="input input-bordered flex items-center gap-2">
                        Año del Modelo:
                        <input name="filtro-modelo" id="filtro-modelo" type="number" class="grow" />
                    </label>
                </div>
                <div class="m-2">
                    <!--Hacer la cconsulta de la BD las marcas-->
                    <label class="input input-bordered flex items-center gap-2">
                        Marca:
                        <input name="filtro-modelo" id="filtro-modelo" type="text" class="grow" />
                    </label>
                </div>
                <div class="m-2">
                    <!--Hacer consulta de la BD los colores disponibles-->
                    <label class="input input-bordered flex items-center gap-2">
                        Color:
                        <input name="filtro-modelo" id="filtro-modelo" type="text" class="grow" />
                    </label>
                </div>
                <!-- Agrega más campos de filtro según necesites -->
                <div class="flex justify-end">
                    <button type="button" class="cursor-pointer mt-5 btn btn-outline btn-info p-2 pl-4 pr-4" onclick="aplicarFiltros()">Aplicar Filtros</button>
                </div>
            </div>
        </form>
    </div>
</dialog>


<script>
    // Cambia el color de la seccion del navbar para identificar en donde estamos.
    function cambiarColor() {
        var carrosLink = document.getElementById("carrosLink");
        var carrosLink = document.getElementById("carrosContainer");
        carrosLink.classList.add("text-gray-100");
        carrosLink.classList.add("bg-gris-clarito");
    }

    // Llamada a la función para cambiar el color
    cambiarColor();

    // Función para abrir el modal de filtros
    function abrirFiltrosModal() {
        var modal = document.getElementById('filtrarCarrosModal');
        modal.showModal();
    }

    // Función para cerrar el modal de filtros
    function cerrarModal(idModal) {
        var modal = document.getElementById(idModal);
        modal.close();
    }

    // Función para verificar si el empleado ya tiene un carro registrado
    function verificarEmpleado() {
        var form = document.getElementById('carForm');
        var empleadoSelect = form.querySelector('select[name="empleado"]');
        var empleadoId = empleadoSelect.value;

        // Aquí debes realizar la lógica para verificar si el empleado ya tiene un carro registrado
        // Por ahora, simplemente mostraremos el mensaje de error en el modal
        var errorModal = document.getElementById('errorModal');
        errorModal.showModal();
    }

    // Modificar la vista entre las tarjetas o las tablas de los carros.
    function toggleView() {
        var cambiarVista = document.getElementById('cambiarVista');
        var tableView = document.getElementById('table-view');
        var cardView = document.getElementById('card-view');

        // Si la vista de tarjetas está visible, ocúltala y muestra la vista de tabla (y viceversa)
        if (cardView.style.display === 'block' || cardView.style.display === '') {
            cardView.style.display = 'none';
            tableView.style.display = 'block';
            cambiarVista.innerText = "Tabla";
        } else {
            cardView.style.display = 'block';
            tableView.style.display = 'none';
            cambiarVista.innerText = "Tarjeta";
        }
    }

    // Buscador del carro por matricula en ambas vistas.
    function searchCars() {
        var input, filter, elements, element, matriculaElement, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();

        // Buscar en la vista de tabla
        elements = document.getElementById("carsTable").getElementsByTagName("tr");
        for (i = 0; i < elements.length; i++) {
            element = elements[i];
            matriculaElement = element.getElementsByTagName("td")[2]; // La segunda columna contiene la matrícula del carro
            if (matriculaElement) {
                txtValue = matriculaElement.textContent || matriculaElement.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    element.style.display = "";
                } else {
                    element.style.display = "none";
                }
            }
        }

        // Buscar en la vista de tarjetas
        elements = document.getElementById("carsCardContainer").getElementsByClassName("bg-gris-oscurito");
        for (i = 0; i < elements.length; i++) {
            element = elements[i];
            matriculaElement = element.querySelector("#matriculaSearch"); // Seleccionar por ID
            if (matriculaElement) {
                txtValue = matriculaElement.textContent || matriculaElement.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    element.style.display = "";
                } else {
                    element.style.display = "none";
                }
            }
        }
    }

    // Llamar a la función de búsqueda cada vez que el usuario escribe algo en el campo de búsqueda
    document.getElementById("searchInput").addEventListener("input", searchCars);
</script>

<!-- En tu barra de navegación, agrega el botón "Filtrar por" -->
<div class="flex-1 px-2 lg:flex-none">
    <button class="btn h-8 min-h-8 btn-outline btn-primary" onclick="abrirFiltrosModal()">Filtrar por</button>
</div>

<script>
    function abrirModal(idModal) {
        var modal = document.getElementById(idModal);
        modal.showModal();
    }

    function cerrarModal(idModal) {
        var modal = document.getElementById(idModal);
        modal.close();
    }

    // Nos permite cambiar los modelos dependiendo de la marca seleccionada en tiempo real.
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