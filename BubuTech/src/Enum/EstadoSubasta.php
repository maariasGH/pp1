<?php
namespace App\Enum;

enum EstadoSubasta: string
{
    case PAUSADA = 'pausada';
    case ACTIVA = 'activa';
    case FINALIZADA = 'finalizada';
}