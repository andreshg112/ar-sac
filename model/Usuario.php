<?php

require_once 'MiModelo.php';

use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends MiModelo {

    use SoftDeletes;

    protected $table = "usuarios";
    protected $primaryKey = 'EMAIL';
    //Modificar en la BD los campos para que sean mayusculas
    protected $hidden = ["CONTRASENIA", "datos_concatenados", "DELETED_AT"];
    //protected $fillable = array('CONTRASENIA', 'EMAIL', 'NOMBRE', 'APELLIDO', 'SEXO');
    public $incrementing = false;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function retos() {
        return $this->belongsToMany('Reto', 'participantes', 'EMAIL', 'CODRETO');
    }

    public function participantes() {
        return $this->hasMany('Participante', 'EMAIL', 'EMAIL');
    }

}
