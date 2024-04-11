<?php include_once "navbar.php"; ?>

<div>
    <div class="relative md:pt-32 pb-32 pt-12">
        <div class="px-4 md:px-10 mx-auto w-full">
            <div>
                <!--Inicio de la barrita de navegacion-->
                <div class="container mx-auto px-4 py-8">
                    <?php
                        // Nombre del archivo que contiene los comentarios
                        $archivo = "../../app/admin/clientes/comentarios/comments.json"; 
                        
                        // Obtener el contenido del archivo JSON
                        $json = file_get_contents($archivo); 
                        
                        // Decodificar el JSON en un array asociativo
                        $comentarios = json_decode($json, true); 
                        
                        // Verificar si hay comentarios
                        if (!empty($comentarios)) {
                    ?>
                            <div id="licensesCardContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                                <?php foreach ($comentarios as $comentario) { ?>
                                    <div class="bg-gris-oscurito p-6 rounded-xl shadow-md relative">
                                        <div class="mb-4 mt-5">
                                            <p class="text-sm font-semibold">Nombre: <?php echo $comentario['nombre_completo']; ?></p>
                                        </div>
                                        <p class="text-sm text-gray-500 mb-4">Email: <?php echo $comentario['email']; ?></p>
                                        <p class="text-sm text-gray-500 mb-4">Mensaje: <?php echo $comentario['mensaje']; ?></p>
                                        <p class="text-sm text-gray-500 mb-4">Fecha: <?php echo $comentario['comment_date']; ?></p>
                                    </div>
                                <?php } ?>
                            </div>
                    <?php
                        } else {
                            // Mostrar un mensaje si no hay comentarios
                    ?>
                            <div class="bg-white p-6 rounded-lg shadow-md">
                                <p class="text-red-600">Aun no hay comentarios disponibles.</p>
                            </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
