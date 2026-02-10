<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VueloController extends Controller
{
    public function index() 
    {
        $vuelos = [
            [
                'id' => 'orf_1',
                'aerolinea' => 'Aeroméxico',
                'logo' => 'https://logowik.com/content/uploads/images/aeromexico7935.jpg',
                'salida' => '08:00 AM',
                'llegada' => '10:30 AM',
                'duracion' => '2h 30m',
                'precio' => 2450,
                'clase' => 'Economy',
                'tipo' => 'Directo'
            ],
            [
                'id' => 'orf_2',
                'aerolinea' => 'Volaris',
                'logo' => 'https://logowik.com/content/uploads/images/volaris6462.jpg',
                'salida' => '11:15 AM',
                'llegada' => '02:45 PM',
                'duracion' => '3h 30m',
                'precio' => 1850,
                'clase' => 'Economy',
                'tipo' => '1 Escala'
            ]
        ];

        return view('vuelos.index', compact('vuelos'));
    }

    public function show($id)
    {
        return "Detalles del vuelo: " . $id;
    }
}