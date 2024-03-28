<?php include_once "navbarAdmin.php"; ?>

<div class="main-content">
    <div class="relative md:pt-32 pb-32 pt-12">
        <div class="px-4 md:px-10 mx-auto w-full lg:w-3/4 xl:w-2/3">
            <!-- <div class="navbar rounded-box">
                <div class="flex-1 px-2 lg:flex-none">
                    <button class="btn h-8 min-h-8 btn-outline btn-info" onclick="agregarCliente()"> + Añadir cliente</button>
                </div>
            </div> -->
            <div class="overflow-x-auto">
                <div>Proximamente...</div>
            </div>
        </div>
    </div>
</div>
<script>
    function cambiarColor() {
        var configuracionLink = document.getElementById("configuracionLink");
        var configuracionLink = document.getElementById("configuracionContainer");
        configuracionLink.classList.add("text-gray-100");
        configuracionLink.classList.add("bg-gris-clarito");
    }

    // Llamada a la función para cambiar el color
    cambiarColor();
</script>