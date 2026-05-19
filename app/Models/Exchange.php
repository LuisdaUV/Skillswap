<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Skill;
use App\Models\User;

class Exchange extends Model
{
    use HasFactory;

    // Campos que permitimos llenar masivamente
    protected $fillable = [
        'sender_id', 
        'receiver_id', 
        'skill_id', 
        'hours', 
        'status'
    ];

    /**
     * RELACIONES
     */

    // El estudiante que solicita y paga los créditos
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // El estudiante que enseña y recibe los créditos
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    // La habilidad que se intercambió
    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
}