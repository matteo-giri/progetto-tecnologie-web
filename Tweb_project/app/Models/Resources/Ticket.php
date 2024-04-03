<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model {
    
    protected $table = 'ticket';
    protected $primaryKey = 'TransId';
    public $timestamps = false;   
    protected $fillable = ['user_id','eventid','quantita','prezzo','data_acquisto'];
}