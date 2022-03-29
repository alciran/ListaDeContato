<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Crud\ColumnList;

class ColumnListTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testDefaultAttributesCreateNewColumnList(){    
        $column = new ColumnList('Label', 'AttributeName');   
        $this->assertFalse($column->attributeByFunction);
        $this->assertEquals($column->label, 'Label'); 
        $this->assertEquals($column->objectAttributeName, 'AttributeName'); 
        $this->assertEquals($column->align, 'text-left'); 
        $this->assertNull($column->size);

        $column_1 = new ColumnList('Label', 'AttributeName', true, 2, 'right');
        $this->assertTrue($column_1->attributeByFunction);
        $this->assertEquals($column_1->label, 'Label'); 
        $this->assertEquals($column_1->objectAttributeName, 'AttributeName'); 
        $this->assertEquals($column_1->align, 'text-right'); 
        $this->assertEquals($column_1->size, 'col-2');
    }

}
