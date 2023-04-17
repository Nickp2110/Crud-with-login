<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class crudoperation extends Model
{
    use HasFactory, Sortable;
    protected $fillable = [ 'name', 'email','mobile','gender' ];
	public $sortable = ['id', 'name', 'email','mobile','gender'];
}
