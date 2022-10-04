<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Event extends Model {

    protected $table = 'event';
    protected $primaryKey = 'eventid';
    public $timestamps = false;
    protected $guarded = ['eventid']; //eventid non modificabile

    public function isPastEvent() {
        if (strtotime($this->data) < strtotime(date('Y-m-d'))
        )
            return true;
        return false;
    }

    public function scontoIsEnable() {
        $ngiorni = $this->nGiorniAttSconto;

        if(strtotime($this->data)< strtotime(date('Y-m-d'))){
            return false;
        }    
        if (strtotime($this->data . ' - ' . $ngiorni . ' days') < strtotime(date('Y-m-d'))){
            return true;
        }
        return false;
    }

    public function getPrice($withDiscount = false) {
        $prezzo = $this->prezzo;
        $ngiorni = $this->nGiorniAttSconto;

        if ($this->scontoIsEnable()) {
            if (1 == ($this->sconto) && 1 == $withDiscount) {
                $sconto = ($prezzo * $this->scontoPerc) / 100;
                $prezzo = round($prezzo - $sconto, 2);
            }
        }

        return $prezzo;
    }

    public function getVendutiPerc() {

        return $this->bigl_acquis / $this->bigl_tot * 100;
    }

}
