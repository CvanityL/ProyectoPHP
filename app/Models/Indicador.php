<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicador extends Model
{
    use HasFactory;
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'indicadores';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombreIndicador',
        'codigoIndicador',
        'unidadMedidaIndicador',
        'valorIndicador',
        'fechaIndicador',
        'tiempoIndicador',
        'origenIndicador'
    ];

}
