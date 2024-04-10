<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre_completo = $_POST['nombre_completo'];
    $email = $_POST['email'];
    $mensaje = $_POST['mensaje'];
    
    // Nombre del archivo JSON
    $archivo = "comments.json";

    // Obtener el contenido actual del archivo JSON
    $json = file_get_contents($archivo);
    
    // Decodificar el JSON en un array asociativo
    $comentarios = json_decode($json, true);

    // Obtener el último comment_id y aumentarlo en 1
    $last_comment_id = end($comentarios)['comment_id'] ?? 0;
    $comment_id = $last_comment_id + 1;
    
    // Crear el arreglo del comentario con el nuevo comment_id
    $comentario = array(
        'comment_id' => $comment_id,
        'nombre_completo' => $nombre_completo,
        'email' => $email,
        'mensaje' => $mensaje,
        'comment_date' => date("Y-m-d H:i:s") // Agregar la fecha actual
    );
    
    // Agregar el nuevo comentario al array de comentarios
    $comentarios[] = $comentario;
    
    // Codificar el array de comentarios de nuevo a formato JSON
    $json_actualizado = json_encode($comentarios, JSON_PRETTY_PRINT);
    
    // Escribir el JSON actualizado de nuevo al archivo
    file_put_contents($archivo, $json_actualizado);
    
    // Redirigir de vuelta a la página del formulario
    header("Location: ../../../../index.php");
    exit();
}
?>
