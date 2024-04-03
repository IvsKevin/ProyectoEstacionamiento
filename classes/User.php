<?php

namespace App;

class User extends ActiveRecord {
    // Base DE DATOS
    protected static $tabla = 'user';
    protected static $columnasDB = ['pk_user', 'first_name', 'last_name', 'password', 'email', 'nickname', 'category', 'accessCode'];

    public $id;
    public $first_name;
    public $last_name;
    public $password;
    public $email;
    public $nickname;
    public $category;
    public $accessCode;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->first_name = $args['first_name'] ?? '';
        $this->last_name = $args['last_name'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->nickname = $args['nickname'] ?? '';
        $this->category = $args['category'] ?? '';
        $this->accessCode = $args['accessCode'] ?? '';
    }

    public function validar() {
        if(!$this->email) {
            self::$errores[] = "El Email del usuario es obligatorio";
        }
        if(!$this->password) {
            self::$errores[] = "El Password del usuario es obligatorio";
        }
        return self::$errores;
    }

    public function existeUsuario() {
        // Revisar si el usuario existe.
        $query = "SELECT * FROM user WHERE email = '" . $this->email . "' LIMIT 1";
        $resultado = self::$db->query($query);

        if($resultado->num_rows) {
            return [
                true,
                $resultado
            ];
        } else {
            self::$errores[] = 'El Usuario No Existe';
            return [
                false,
                self::$errores
            ];
        } 
    }

    public function verificarPassword($resultado) {

        $usuario = $resultado->fetch_assoc();
        $auth = password_verify($this->password, $usuario['password']);


        if($auth) {

            // El usuario esta autenticado
            session_start();

            // Llenar el arreglo de la sesión
            $_SESSION['usuario'] = $usuario['email'];
            $_SESSION['login'] = true;
            return true;
        } else {
            self::$errores[] = 'Password Incorrecto';
            return [
                false,
                self::$errores
            ];
        }


    }

}
