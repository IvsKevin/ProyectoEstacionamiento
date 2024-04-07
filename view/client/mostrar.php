<?php include_once "navbar.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Canal</title>
</head>
<body class="bg-gray-100">
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
            echo "<h1 class='text-3xl font-bold text-center mt mb-8'>".$channelTitle."</h1>";

            echo "<div class='container mx-auto px-4'>";
                echo "<div class='grid grid-cols-1 md:grid-cols-3 gap-8'>";
                    foreach ($channelData['items'] as $element) {
                        echo "<div class='bg-transparent rounded-lg shadow-md overflow-hidden'>";
                            $titulo = $element['snippet']['title']; //Obtenemos el titulo.
                
                            if(array_key_exists("videoId", $element['id'])) {
                                echo '<div class="overflow-hidden rounded-t-lg">';
                                echo '<img class="w-full h-50 object-cover object-top" src="'.$element['snippet']['thumbnails']['medium']['url'].'" alt="Video thumbnail">';
                                echo '</div>'; // Cierre de div.overflow-hidden.rounded-t-lg
                                
                                echo '<div class="p-4">';
                                echo '<a href="https://www.youtube.com/watch?v='.$element['id']['videoId'].'" target=_blank class="block text-white font-semibold hover:underline">'.$titulo.'</a>';
                                echo '<p class="text-gray-400 mt-2">'.substr($element['snippet']['description'], 0, 70).'...</p>';
                                echo '<p class="text-gray-400">Publicado: '.substr($element['snippet']['publishedAt'], 0, 10).'</p>';
                                echo '</div>'; // Cierre de div.p-4
                            }
                        echo '</div>'; // Cierre de div.bg-white
                    }
                echo "</div>"; //Cierre del grid
            echo "</div>"; // Cierre de div.container
        } else {
            echo "<p class='text-center text-red-600 mt-8'>El canal especificado no existe.</p>";
        }
    ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const videos = document.querySelectorAll('.video-container');

            videos.forEach(video => {
                video.addEventListener('click', function() {
                    this.classList.toggle('active');
                });
            });
        });
    </script>
</body>
</html>
