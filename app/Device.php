<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $table = "devices";
    protected $fillable = ['name', 'items', 'commands', 'device_id', 'status'];
    protected $casts = [
      'items' => 'array',
      'commands' => 'array',
      'status' => 'array'
    ];
}
