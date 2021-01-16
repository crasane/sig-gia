<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable     = [];
    protected $table        = "orders";
    protected $primaryKey   = "id";
}