<?php

namespace App\Enums;
enum DishesCategoriesEnum: string
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

    public function cover(): string
    {
        return match ($this) {
            self::CHINESE => asset('images/culinaria-chinesa.jpg'),
            self::BRAZILIAN => asset('images/comida-brasileira.jpg'),
            self::PIZZAS => asset('images/pizzas.jpg'),
            self::HAMBURGERS => asset('images/hamburger.webp'),
            self::SWEETS_AND_CAKES => asset('images/doces-bolos.png'),
            self::SALTY => asset('images/salgados.jpg'),
            self::ICE_CREAMS => asset('images/sorvetes.jpg'),
            self::JAPANESE => asset('images/culinaria-japonesa.jpg'),
            self::HEALTHY => asset('images/saudavel.jpg'),
            self::DRINKS => asset('images/bebidas.webp'),
        };
    }

    public function name(): string
    {
        return match ($this) {
            self::CHINESE => 'chinesas',
            self::BRAZILIAN => 'brasileiras',
            self::PIZZAS => 'pizzas',
            self::HAMBURGERS => 'hambúrgueres',
            self::SWEETS_AND_CAKES => 'doces e bolos',
            self::SALTY => 'salgados',
            self::ICE_CREAMS => 'sorvetes',
            self::JAPANESE => 'japonesa',
            self::HEALTHY => 'saudável',
            self::DRINKS => 'bebidas',
        };
    }
}
