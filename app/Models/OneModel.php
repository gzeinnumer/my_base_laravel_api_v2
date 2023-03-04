<?php

namespace App\Models;

use App\MyApp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OneModel extends Model
{
    use HasFactory;
    protected $table = "one";
    protected $casts = MyApp::datetime;
    
    public function paging(){
        return $this->belongsTo(PagingModel::class, 'id_paging', 'id');
    }
}
