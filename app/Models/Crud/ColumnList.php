<?php

namespace App\Models\Crud;
use Illuminate\Database\Eloquent\Model;

class ColumnList extends Model
{
    protected $fillable = [
        'label',
        'objectAttributeName',
        'size',
        'align',
        'attributeByFunction',
    ];

    public function __construct($label, $objectAttributeName, $attributeByFunction = false, $size = null, $align = 'left')
    {
        $this->label = $label;    
        $this->objectAttributeName = $objectAttributeName;
        $this->attributeByFunction = $attributeByFunction;
        $size ? $this->size = "col-".$size : null ;
        $this->align = "text-".$align;
    } 
}