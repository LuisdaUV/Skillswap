<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Skill;
use App\Models\User;

class Exchange extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sender_id', 
        'receiver_id',
        'requested_skill_id',
        'offered_skill_id',
        'status'
    ];

    /**
     * Los atributos que deben ser casteados (convertidos de tipo).
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * =========================================================================
     * RELACIONES ELOQUENT
     * =========================================================================
     */

    /**
     * El estudiante que inicia la solicitud (y descuenta/paga los créditos).
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * El estudiante que recibe la solicitud (y ganará los créditos al enseñar).
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    /**
     * La habilidad que el remitente (sender) quiere aprender del receptor.
     */
    public function requestedSkill()
    {
        return $this->belongsTo(Skill::class, 'requested_skill_id');
    }

    /**
     * La habilidad que el remitente (sender) ofrece enseñar a cambio.
     */
    public function offeredSkill()
    {
        return $this->belongsTo(Skill::class, 'offered_skill_id');
    }
}