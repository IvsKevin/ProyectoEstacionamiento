<?php //session.php
    //Iniciamos una session o en caso de existir la retomamos.
    session_start();

    if(isset($_SESSION['user'])){ //Validamos si aun no se ha definido nuestro cliente por usuario.
        //Creamos un objeto que sea de nuestro cliente para obtener todos sus valores.
        include(__DIR__."/../data/class/client.php");
        $client = new Client();

        //Obtenemos el cliente por la llave foranea que seria el User.
        //Llamamos al metodo del cliente que retorna la pk del cliente asociada con la pk usuario.
        $myclient = $client->getClientByUser($_SESSION['user_id']);
        $row = mysqli_fetch_assoc($myclient);

        $_SESSION['client_id'] = $row['pk_client']; //Obtenemos el id del cliente relacionado al usuario.
        $_SESSION['client_name'] = $row['client_name']; //Obtenemos el id del cliente relacionado al usuario.
        //echo $_SESSION['client_id'];

        $menuAdmin = true; //Le damos acceso de admin.
        $user = 'Welcome '.$_SESSION['user']; //Le damos un valor a user con la bienvenida.

        //Validar si el cliente ya ha comprado nuestro servicios.
        include(__DIR__."/../data/class/licenses.php");
        $license = new Licenses();
        $data = $license->getLicensesDuration($_SESSION['client_id']);

        if ($data == "aprobado") {
            $licenciaVigente = true;
        } else {
            $licenciaVigente = false;
        }
    } else {
        $menuAdmin = false; //Le negamos el acceso de admin.
        $licenciaVigente = false;
        $user = '';
    }