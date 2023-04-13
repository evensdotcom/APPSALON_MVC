<?php

namespace Model;

class Usuario extends ActiveRecord
{

    // Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = [
        'id', 'nombre', 'apellido', 'email', 'password', 'confirmado', 'admin',
        'token', 'telefono'
    ];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $confirmado;
    public $admin;
    public $token;
    public $telefono;

    public function __construct($args =  [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->admin = $args['admin'] ?? '0';
        $this->token = $args['token'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }

    public function validarNuevaCuenta()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }
        if (!$this->apellido) {
            self::$alertas['error'][] = 'El Apellido es Obligatorio';
        }
        if (!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'La Password es Obligatoria';
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'el Password debe contener al menos 6 caracteres';
        }

        if (!$this->telefono) {
            self::$alertas['error'][] = 'El Telefono es Obligatorio';
        }

        return self::$alertas;
    }

    // Revisar si el usuario existe
    public function existeUsuario()
    {
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";

        $resultado = self::$db->query($query);
        if ($resultado->num_rows) {
            self::$alertas['error'][] = 'El Usuario ya esta registrado';
        }
        return $resultado;
    }
    // Hachear password
    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
    // Crear Token Unico para cada ususuario
    public function crearToken(){
        $this->token = uniqid();
    }
    // Validar el Usuario
    public function validarLogin() {
        if(!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'El Password es Obligatoria';
        }
        return self::$alertas;
    }

    public function validarEmail(){
        if(!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }
        return self::$alertas;
    }

    public function validarPassword()
    {
        if(!$this->password) {
            self::$alertas['error'][] = 'El Password es Obligatoria';
        }

        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'el Password debe contener al menos 6 caracteres';
        }
        return self::$alertas;
    }
    
    public function comprobarPasswordAndVerificado($password){
        $resultado = password_verify($password, $this->password);

        if(!$this->confirmado || !$resultado){
            self::$alertas['error'][] = 'Password Incorrecto o tu cuenta no ha sido confirmada';
        }else {
            return true;
        }
    }


}
