<?php

namespace App\Enums;

enum CategoryEnum: string
{
    case CHINESE = 'chinese';
    case BRAZILIAN = 'brazilian';
    case PIZZAS = 'pizzas';
    case HAMBURGERS = 'hamburgers';
    case SWEETS_AND_CAKES = 'sweets-and-cakes';
    case SALTY = 'salty';
    case ICE_CREAMS = 'ice-creams';
    case JAPANESE = 'japanese';
    case HEALTHY = 'healthy';
    case DRINKS = 'drinks';

    public function label(): string
    {
        return match ($this) {
            self::CHINESE => 'Chinesas',
            self::BRAZILIAN => 'Brasileiras',
            self::PIZZAS => 'Pizzas',
            self::HAMBURGERS => 'Hambúrgueres',
            self::SWEETS_AND_CAKES => 'Doces e Bolos',
            self::SALTY => 'Salgados',
            self::ICE_CREAMS => 'Sorvetes',
            self::JAPANESE => 'Japonesa',
            self::HEALTHY => 'Saudável',
            self::DRINKS => 'Bebidas',
        };
    }

    public function cover(): string
    {
        return asset(match ($this) {
            self::CHINESE => 'images/culinaria-chinesa.jpg',
            self::BRAZILIAN => 'images/comida-brasileira.jpg',
            self::PIZZAS => 'images/pizzas.jpg',
            self::HAMBURGERS => 'images/hamburger.webp',
            self::SWEETS_AND_CAKES => 'images/doces-bolos.png',
            self::SALTY => 'images/salgados.jpg',
            self::ICE_CREAMS => 'images/sorvetes.jpg',
            self::JAPANESE => 'images/culinaria-japonesa.jpg',
            self::HEALTHY => 'images/saudavel.jpg',
            self::DRINKS => 'images/bebidas.webp',
        });
    }

    public function variant(): string
    {
        return match ($this) {
            self::CHINESE => 'blue',
            self::BRAZILIAN => 'green',
            self::PIZZAS => 'red',
            self::HAMBURGERS => 'yellow',
            self::SWEETS_AND_CAKES => 'indigo',
            self::SALTY => 'yellow',
            self::ICE_CREAMS => 'pink',
            self::JAPANESE => 'indigo',
            self::HEALTHY => 'green',
            self::DRINKS => 'red',
        };
    }
}
