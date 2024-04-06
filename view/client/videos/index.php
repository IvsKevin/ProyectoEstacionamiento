<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Index</title>
</head>
<body>
    <h1>Canales</h1>
    <div class="canales">
    <?php
         $archivo = "canales.json";
         $json = file_get_contents($archivo);
         $array = json_decode($json, true);
    
         foreach ($array['canales'] as $element) {
            foreach ($element as $key => $value) {
                if(is_array($value)){
                    echo "<a href='mostrar.php?canal=".$key."'>";
                        echo "<div class='videos'>";
                        echo "<h1>".$key."</h1><br>"; //Nombre del canal.

                        foreach ($value as $key2 => $value2) {
                            if(!is_array($value2)) {
                                if($key2 == "portada") { 
                                    echo "<img src='$value2'>"; //Imagen del canal.
                                }                             
                            }
                        }

                        echo "</div>"; //Cierre del videos.
                    echo "</a>";
                } 
            }
         }
    ?>
    </div>
</body>
</html>