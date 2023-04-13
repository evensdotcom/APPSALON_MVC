<?php

namespace Controllers;

use Model\ActiveRecord;
use Model\AdminCita;
use MVC\Router;

class AdminController
{
    public static function index(Router $router)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        isAdmin();

        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $fechas = explode('-',$fecha);
        
        if(!checkdate($fechas['1'],$fechas['2'],$fechas['0'])){
            header('Location:/404');
        }

        $consulta = "SELECT c.id, c.hora, CONCAT(u.nombre,' ', u.apellido)as cliente,
        u.email, u.telefono, s.nombre as servicio, s.precio FROM citas c 
        LEFT OUTER JOIN usuarios u 
        ON c.usuarioId = u.id LEFT OUTER JOIN citaservicio cs 
        ON cs.citaId = c.id
        LEFT OUTER JOIN servicios s 
        ON s.id = cs.servicioId
        WHERE fecha =  '${fecha}' ";

        // $consulta = "SELECT citas.id, citas.hora, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        // $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
        // $consulta .= " FROM citas  ";
        // $consulta .= " LEFT OUTER JOIN usuarios ";
        // $consulta .= " ON citas.usuarioId=usuarios.id  ";
        // $consulta .= " LEFT OUTER JOIN citaservicio ";
        // $consulta .= " ON citaservicio.citaId=citas.id ";
        // $consulta .= " LEFT OUTER JOIN servicios ";
        // $consulta .= " ON servicios.id=citaservicio.servicioId ";
        // $consulta .= " WHERE fecha =  '${fecha}' ";

        $citas = AdminCita::SQL($consulta);

        $router->render('admin/index', [
            'nombre' => $_SESSION['nombre'],
            'citas' => $citas,
            'fecha' => $fecha
        ]);
    }
}
