<?php

namespace Modules\Patient\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Appointment\Entities\Appointment;


class Patient extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name','email','password'];

    protected static function newFactory()
    {
        return \Modules\Patient\Database\factories\PatientFactory::new();
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }
}
