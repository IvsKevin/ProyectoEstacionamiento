<?php
include("../data/class/user.php");

//Creamos nuestro objeto de usuario.
$myUser = new User();

//Hacemos la consulta en busca de nuestro usuario.
$myUser->setNickname($_POST['user']);
$myUser->setPassword($_POST['password']);
$usuarioExiste = $myUser->getAllUser();

$tupla = mysqli_fetch_assoc($usuarioExiste); //Capturamos los valores de la fila de la consulta.

//Inicimos el proceso de busqueda.
if ($usuarioExiste != 'error' && $tupla['category'] == 'A') {
    $count = mysqli_num_rows($usuarioExiste); //Contamos si encontro una coincidencia.
    if ($count == 1) { //Si es asi, iniciamos la sesion.

        session_start();

        //Le ponemos un alias a nuestro campo por seguridad.
        $_SESSION['user_id'] = $tupla['pk_user'];
        $_SESSION['user'] = $tupla['nickname'];
        $_SESSION['mail'] = $tupla['email'];

        //Redireccionamos hacia los archivos del admin en caso de serlo.
        //echo "Eres admin";
        echo '
                <script type="text/javascript">
                    var nickname = "' . $_SESSION['user'] . '";
                </script>
                <script src="../js/accesoGranted.js"></script>';
    }
} else if ($usuarioExiste != 'error' && $tupla['category'] == 'C') {

    //Redireccionamos hacia los archivos del cliente (empresa) en caso de no ser admin.
    session_start();

    //Le ponemos un alias a nuestro campo por seguridad.
    $_SESSION['user_id'] = $tupla['pk_user'];
    $_SESSION['user'] = $tupla['nickname'];
    $_SESSION['mail'] = $tupla['email'];

    //echo "Eres cliente (empresa)";
    // echo $_SESSION['user_id']; //Ver id del usuario.
    // echo $_SESSION['user']; //Ver el nombre del usuario.

    //Le mandamos el nombre de usuario a nuestro javascript.
    header('Content-type: text/html; charset=utf-8');
    echo '
        <script type="text/javascript">
            var nickname = "' . $_SESSION['user'] . '";
        </script>
        <script src="../js/accesoGranted_C.js"></script>';
} else {
    //echo 'Usuario no encontrado';
    // echo $dataSet; viendo los errores.
    echo '<script src="../js/accesoDenegado.js"></script>';
}
