<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
  protected $primaryKey = 'IdMunicipio';
  protected $IdMunicipio;
  protected $IdEntFed;
  protected $Municipio;
  protected $EntFed;
  protected $table= "Municipio";
}
