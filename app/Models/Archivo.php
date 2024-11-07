<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Archivo
 *
 * @property $id
 * @property $tipo_id
 * @property $descripcion
 * @property $archivo
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Archivo extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['tipo_id', 'descripcion', 'archivo','nombre_original'];


}
