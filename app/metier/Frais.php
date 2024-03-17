<?php

namespace App\metier;
use Illuminate\Database\Eloquent\Model;
use DB;

class Frais extends Model
{
 // on declare la table frais
    protected $table= 'frais ';
    public $timestamps=false ;
    protected $fillable=[
        'id_frais',
        'id_etat',
        'anneemois',
        'id_visiteur',
        'nbjustificatifs',
        'datemodification',
        'montant_valide'
    ];

    public function ___construrct(){
        $this->id_frais=0;
    }

}
