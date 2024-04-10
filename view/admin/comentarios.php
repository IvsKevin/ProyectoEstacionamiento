<?php include_once "navbarAdmin.php"; ?>

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
                            <table class="border-collapse w-full ml-32"> <!-- Agregar margen izquierdo -->
                                <thead>
                                    <tr class="bg-gray-200">
                                        <th class="border border-gray-400 px-4 py-2">Nombre</th>
                                        <th class="border border-gray-400 px-4 py-2">Email</th>
                                        <th class="border border-gray-400 px-4 py-2">Mensaje</th>
                                        <th class="border border-gray-400 px-4 py-2">Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        // Recorrer los comentarios
                                        foreach ($comentarios as $comentario) {
                                    ?>
                                        <tr>
                                            <td class="border border-gray-400 px-4 py-2 overflow-hidden whitespace-nowrap max-w-[70px] text-overflow-ellipsis"><?php echo $comentario['nombre_completo']; ?></td>
                                            <td class="border border-gray-400 px-4 py-2"><?php echo $comentario['email']; ?></td>
                                            <td class="border border-gray-400 px-4 py-2 overflow-hidden whitespace-nowrap max-w-[70px] text-overflow-ellipsis"><?php echo $comentario['mensaje']; ?></td>
                                            <td class="border border-gray-400 px-4 py-2"><?php echo $comentario['comment_date']; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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
