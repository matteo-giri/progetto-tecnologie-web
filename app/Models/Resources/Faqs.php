<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Faqs extends Model {
    
    protected $table = 'faqs';
    protected $primaryKey = 'faqId';
    public $timestamps = false;
    protected $fillable = ['Domanda','Risposta'];
    
    
}