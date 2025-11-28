<?php

// Clase que representa una película usando Programación Orientada a Objetos
class Pelicula {

    // Propiedades públicas de la película
    public $titulo;
    public $anio;
    public $genero;
    public $descripcion;

    // Constructor: se ejecuta automáticamente al crear un objeto
    public function __construct($titulo, $anio, $genero, $descripcion) {
        $this->titulo = $titulo;
        $this->anio = $anio;
        $this->genero = $genero;
        $this->descripcion = $descripcion;
    }

    // Getter para obtener el título de forma segura
    public function getTitulo() {
        return $this->titulo;
    }

    // Método estático: se puede llamar sin crear un objeto
    public static function saludo() {
        return "Bienvenido al catálogo de películas ";
    }
}
