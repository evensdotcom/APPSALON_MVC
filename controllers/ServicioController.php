<?php

namespace Controllers;

use Model\Servicio;
use MVC\Router;

class ServicioController {

    public static function index( Router $router) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        isAdmin();
        $servicio = Servicio::all();
        $nombre = $_SESSION['nombre'];
        $router->render('servicios/index', [
            'nombre' => $nombre,
            'servicios' => $servicio
        ]);
    } 

    public static function crear( Router $router) {
    
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        isAdmin();
        $nombre = $_SESSION['nombre'];

        $servicio = new Servicio;
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();

            if(empty($alertas)) {
                $servicio->guardar();
                header('Location: /servicios');
            }
        }

        $router->render('servicios/crear',[
            'nombre' => $nombre,
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    } 

    public static function actualizar( Router $router) {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        isAdmin();
       if(!is_numeric($_GET['id'])) return;
        $servicio = Servicio::find($_GET['id']);

        $nombre = $_SESSION['nombre'];

        $alertas = [];
        
    
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
           
            $alertas = $servicio->validar();

            if(empty($alertas)) {
               $servicio->sincronizar($_POST); 
               $servicio->guardar();
               header('Location: /servicios');
               
            }
        }

        $router->render('servicios/actualizar', [
            'nombre' => $nombre,
            'alertas' => $alertas,
            'servicio' => $servicio
        ]);
    } 

    public static function eliminar() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        isAdmin();
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id =  $_POST['id'];
            $servicio = Servicio::find($id);
            $servicio->eliminar();
            header('Location: /servicios');
        }
    } 
}