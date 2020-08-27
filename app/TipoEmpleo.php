<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoEmpleo extends Model
{
  protected $primaryKey = 'IdTipoEmpleo';
  protected $IdTipoEmpleo;
  protected $TipoEmpleo;
  protected $table= "TipoEmpleo";
}
