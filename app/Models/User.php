<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;

// class User extends Model implements MustVerifyEmail
class User extends Model
{
    use HasFactory,Sortable;
    protected $fillable = [ 'name', 'email','mobile','gender','country','state','city' ];
	public $sortable = ['id','name', 'email','mobile','gender','country','state','city'];
}
