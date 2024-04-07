<?php include_once "navbar.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videos</title>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold  mt-20 mb-8">Canales</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php
                 $archivo = "canales.json";
                 $json = file_get_contents($archivo);
                 $array = json_decode($json, true);
            
                 foreach ($array['canales'] as $element) {
                    foreach ($element as $key => $value) {
                        if(is_array($value)){
                            echo "<a href='mostrar.php?canal=".$key."' class='block'>";
                            echo "<div class='bg-slate-800 rounded-lg shadow-md overflow-hidden border border-solid border-gray-600 flex flex-col items-center justify-center p-4'>";
                            foreach ($value as $key2 => $value2) {
                                    if(!is_array($value2)) {
                                        if($key2 == "portada") { 
                                            echo "<div class='w-48 h-48 rounded-full overflow-hidden'>";
                                            echo "<img class='w-full h-full object-cover' src='$value2' alt='Channel thumbnail'>"; //Imagen del canal.
                                            echo "</div>";
                                        }                             
                                    }
                                }
                                echo "<h1 class='text-center text-lg font-bold mt-8 text-gray-300'>".$key."</h1>"; //Nombre del canal con margen superior y color blanco
                                echo "</div>"; //Cierre del div.bg-white
                            echo "</a>";
                        } 
                    }
                 }
            ?>
        </div>
    </div>
</body>
</html>
