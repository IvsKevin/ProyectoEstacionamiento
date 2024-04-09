    <?php
    // Extraemos todos las variables de SESSION.
    session_start();
    $nombreUsuario = $_SESSION['username'];
    $emailUsuario = $_SESSION['email'];
    $passwordUsuario = $_SESSION['password'];

    $nombreEmpresa = $_SESSION['nombreEmpresa'];
    $emailEmpresa = $_SESSION['emailEmpresa'];
    $direccionEmpresa = $_SESSION['direccionEmpresa'];
    $paisEmpresa = $_SESSION['paisEmpresa'];
    $estadoEmpresa = $_SESSION['estadoEmpresa'];
    $ciudadEmpresa = $_SESSION['ciudadEmpresa'];
    $codigoEmpresa = $_SESSION['codigoEmpresa'];
    $telEmpresa = $_SESSION['telEmpresa'];

    // echo '<pre>';
    // var_dump($_SESSION);
    // echo '</pre>';
    // exit;


    // Incluimos nuestras clases.
    include('../data/class/user.php'); // Usuario.
    include('../data/class/client.php'); // Empresa.
    include("../data/class/payment.php"); // Registrar pago.
    include("../data/class/licenses.php");

    // +==================================================================+
    // Establecemos los valores de los setters de la clase 'USER'.
    $User = new User();
    $User->setNickname($nombreUsuario);
    $User->setEmail($emailUsuario);
    $User->setPassword($passwordUsuario);

    $resultado = true;

    try { // Intentamos ejecutar la inserccion.
        $fk_user = $User->setUser(); // Me retorna el ID insertado.
    } catch (mysqli_sql_exception $e) { //En caso de ocurrir una entrada duplicada como nickname o password.
        // Si hay un error con la inserción, verifica si es por un valor duplicado
        $resultado = false;
        if ($e->getCode() === 1062) {
            echo "
            <script>
                alert('¡Ups! El nombre de usuario o correo electrónico ya está registrado. Por favor, elige otros.');
                window.location.href = '../view/login.php'; // Redireccionar a login.php
            </script>";
        } else {
            // Si es un error diferente, también deberías manejarlo
            echo 'Error con la inserccion del usuario';
        }
    } // Fin de las inserciones de la clase 'USER'.
    // +====================================================================+

    // +====================================================================+
    $fk_client = 0; // Establecemos el ID del 'CLIENTE'.

    try {
        if ($resultado) { // Validamos si se inserto el usuario.
            // Establecemos los valores de los setters de la clase Cliente.
            $Client = new Client();
            $Client->setName($nombreEmpresa);
            $Client->setEmail($emailEmpresa);
            $Client->setAddress($direccionEmpresa);
            $Client->setCountry($paisEmpresa);
            $Client->setCity($estadoEmpresa);
            $Client->setState($ciudadEmpresa);
            $Client->setZipCode($codigoEmpresa);
            $Client->setTel($telEmpresa);
            $Client->setFK_user($fk_user);

            //Llamamos al metodo y nos retorna el valor de un id de la fila insertada.
            $fk_client = $Client->setClient();
        }  // Fin de la inserciones del 'CLIENTE'.
    } catch (mysqli_sql_exception $e) {
        // Si hay un error con la inserción, verifica si es por un valor duplicado
        $resultado = false;
        echo "Error con la insercion de la empresa.";
    }
    // +=====================================================================+

    // +======================================================================+
    // Establecemos los valores de los setters de la clase payment.
    try {
        if ($resultado) {
            $payment = new Payment();
            $payment->setAmount($_GET["amount"]);
            $payment->setDescription($_GET["description"]);
            $payment->setDuration($_GET['duration']);
            $payment->setClient($fk_client);
            // Realizamos el pago y almacenamos el id de la inserccion realizada.
            $idPago = $payment->setPayment();
        }
    } catch (mysqli_sql_exception $e) {
        $resultado = false;
        echo "Error con la insercion del pago.";
    }
    // +=======================================================================+ 

    // +=======================================================================+
    //Validamos que se haya completado exitosamente el pago.
    try {
        if ($resultado) {
            //Creamos nuestra clase de licencias
            $license = new Licenses();
            $license->setDuration($_GET['duration']);
            $license->setPayment($idPago);
            $accessCode = $license->setLicenses(); //Obtenemos el accessCode

            if ($accessCode > 1) {
                $User->setID($fk_user); //Setteamos el ID de nuestro usuario.
                $User->updateAccessCode($accessCode); //Le mandamos el mismo code de la membresia al usuario.
                //Redireccionamos
                $inserccionExitosa = 'Se ha completado el registro del usuario correctamente.';
                header('Location: ../view/login.php?resultado=' . urlencode($inserccionExitosa) . '');
            } else {
                echo 'Ha ocurrido un error a la hora de registrar la licencia';
            }
        }
    } catch (mysqli_sql_exception $e) {
        $resultado = false;

        echo "Error con el registor de la licencia";
    }
