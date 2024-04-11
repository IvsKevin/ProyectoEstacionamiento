<?php include_once "navbar.php"; ?>

<div class="main-content">
    <div class="relative md:pt-32 pb-32 pt-12">
        <div class="px-4 md:px-10 mx-auto w-full lg:w-3/4 xl:w-2/3">
            <!-- <div class="navbar rounded-box">
                <div class="flex-1 px-2 lg:flex-none">
                    <button class="btn h-8 min-h-8 btn-outline btn-info" onclick="agregarCliente()"> + Añadir cliente</button>
                </div>
            </div> -->
            <div class="overflow-x-auto">
                <div>
                    <a href="#">
                        <img src="../../assets/img/1.png" alt="Imagen 1">
                    </a>
                    <a href="#">
                        <img src="../../assets/img/2.png" alt="Imagen 2">
                    </a>
                    <a href="#">
                        <img src="../../assets/img/3.png" alt="Imagen 3">
                    </a>
                    <a href="#">
                        <img src="../../assets/img/4.png" alt="Imagen 4">
                    </a>
                    <a href="#">
                        <img src="../../assets/img/5.png" alt="Imagen 5">
                    </a>
                    <a href="#">
                        <img src="../../assets/img/6.png" alt="Imagen 6">
                    </a>
                    <a href="#">
                        <img src="../../assets/img/7.png" alt="Imagen 7">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function cambiarColor() {
        var documentacionLink = document.getElementById("documentacionLink");
        var documentacionLink = document.getElementById("documentacionContainer");
        documentacionLink.classList.add("text-gray-100");
        documentacionLink.classList.add("bg-gris-clarito");
    }

    // Llamada a la función para cambiar el color
    cambiarColor();
</script>
