<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>MostrarCanal</title>
</head>
<body style="background-color: lightgray;">
    <?php
        $canal = $_GET['canal']; //Obtenemos el canal que nos pasaron.
        
        $archivo = "canales.json";
        $json = file_get_contents($archivo);
        $array = json_decode($json, true);

        $channelData = null;
        foreach ($array['canales'] as $canalData) { // Buscar el canal en el array
            if (isset($canalData[$canal])) {
                $channelData = $canalData[$canal];
                break;
            }
        }

        if ($channelData) { //Si encontramos el canal.
            $channelTitle = $channelData['items'][0]['snippet']['channelTitle'];
            echo "<h1>".$channelTitle."</h1>";

            echo "<div class='canales'>";
                foreach ($channelData['items'] as $element) {
                    echo "<div class='videos'>";
                        $titulo = $element['snippet']['title']; //Obtenemos el titulo.
            
                        if(array_key_exists("videoId", $element['id'])) {
                            echo '<a href="https://www.youtube.com/watch?v='.$element['id']['videoId'].'" target=_blank>'."<img id='imgVideo' src='".$element['snippet']['thumbnails']['medium']['url']."'>".'</a>'."<br>"; //Ver video con imagen.
                            
                            echo '<a href="https://www.youtube.com/watch?v='.$element['id']['videoId'].'" target=_blank>'.$titulo.'</a>'."<br>"; //Ver video.
                        }
            
                        echo substr($element['snippet']['description'], 0, 70)."...<br>";
            
                        $str = substr($element['snippet']['publishedAt'], 0, 10); //Convertimos la fecha sin hora.
                        echo "Publicado: ".$str."<br>";
                    echo '</div>';
                }
            echo "</div>"; //Cierre de la clase videos
        } else {
            echo "El canal especificado no existe.";
        }
    ?>
</body>
</html>
