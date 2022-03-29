<?php

namespace App\Models\Crud;
use Illuminate\Database\Eloquent\Model;

class CrudTemplate extends Model
{
    protected $fillable = [
        'objectList', //Collection com os objetos para listar
        'objectMainAttribute', //Atributo principal do object para identificacao, nome, descricao, etc
        'columns', //Lista de ColumnList a serem listadas na tabela na view
        'crudName', //Nome do Cadastro
        'labelList', //Label apresentada no top da lista de objetos na view
        'linkHelpPage' //Link para pagina de documentacao no padrao GDoc
    ];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    public function getRouteCreate(){
        return strtolower(preg_replace('/ /', '-', $this->crudName)).".create";
    }

    public function getRouteEdit($id){        
        return strtolower(preg_replace('/ /', '-', $this->crudName)) . "/$id/edit";
    }    

}