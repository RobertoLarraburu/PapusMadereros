<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorData extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table = 'sensor_data';

    // Asegúrate de incluir solo las columnas que se pueden llenar
    protected $fillable = ['troncos', 'largo'];
}
