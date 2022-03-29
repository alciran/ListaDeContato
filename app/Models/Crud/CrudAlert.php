<?php

namespace App\Models\Crud;
use Illuminate\Database\Eloquent\Model;

class CrudAlert extends Model
{
    protected $fillable = [
        'crudName',
        'mainAttributeValue', //Atributo principal do object para identificacao, nome, descricao, etc
        'alertType'
    ];

    public function __construct($crudName, $mainAttributeValue, $alertType)
    {
        $this->crudName = $crudName;
        $this->mainAttributeValue = $mainAttributeValue;
        $this->alertType = $alertType;
    }

}