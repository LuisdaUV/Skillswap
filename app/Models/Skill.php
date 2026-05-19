<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    // Campos que se pueden llenar (Mass Assignment)
    protected $fillable = ['name', 'description'];

    /**
     * Relación: Una habilidad pertenece a muchos usuarios (Muchos a Muchos)
     */
    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->withPivot('level')
                    ->withTimestamps();
    }

    /**
     * Relación: Una habilidad puede estar en muchos intercambios
     */
    public function exchanges()
    {
        return $this->hasMany(Exchange::class);
    }
}