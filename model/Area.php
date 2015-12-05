<?php

require_once 'MiModelo.php';

use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends MiModelo {

    use SoftDeletes;

    protected $table = "areas";
    protected $primaryKey = "CODAREA";
    protected $dates = ['deleted_at'];

    public function preguntas() {
        return $this->hasMany("Pregunta", "CODAREA", "CODAREA");
    }

}
