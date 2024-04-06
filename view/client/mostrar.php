<?php include_once "navbar.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
            echo "<h1 class='text-3xl font-bold text-center mt-8'>".$channelTitle."</h1>";

            echo "<div class='grid grid-cols-1 md:grid-cols-3 gap-8 mt-8'>";
                foreach ($channelData['items'] as $element) {
                    echo "<div class='bg-white rounded-lg shadow-md overflow-hidden'>";
                        $titulo = $element['snippet']['title']; //Obtenemos el titulo.
            
                        if(array_key_exists("videoId", $element['id'])) {
                            echo '<div class="rounded-t-lg overflow-hidden">';
                            echo '<img class="w-full rounded-full" src="'.$element['snippet']['thumbnails']['medium']['url'].'" alt="Video thumbnail">';
                            echo '</div>'; // Cierre de div.rounded-t-lg
                            
                            echo '<div class="p-4">';
                            echo '<a href="https://www.youtube.com/watch?v='.$element['id']['videoId'].'" target=_blank class="block text-blue-600 font-semibold hover:underline">'.$titulo.'</a>';
                            echo '<p class="text-gray-600 mt-2">'.substr($element['snippet']['description'], 0, 70).'...</p>';
                            echo '<p class="text-gray-600">Publicado: '.substr($element['snippet']['publishedAt'], 0, 10).'</p>';
                            echo '</div>'; // Cierre de div.p-4
                        }
                    echo '</div>'; // Cierre de div.bg-white
                }
            echo "</div>"; //Cierre del grid
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
