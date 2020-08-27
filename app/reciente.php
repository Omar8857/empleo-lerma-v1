<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reciente extends Model
{
    protected $primaryKey = 'id_reciente'; 
    protected $id_reciente;
    protected $nombre_reciente;
    protected $slug;
    protected $id_usuario; 
    protected $table= "recientes";
}
