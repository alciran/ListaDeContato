<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Crud\CrudTemplate;

class CrudTemplateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAllAttributes()
    {
        $crudTemplate = new CrudTemplate([
            'objectList'          => collect(['object0', 'object1', 'object2']),
            'objectMainAttribute' => 'attributeName',
            'columns'             => collect(['coluna0', 'coluna1', 'coluna2']),
            'crudName'            => 'Crud',
            'labelList'           => 'Lista de Cruds',
            'linkHelpPage'        => 'help/Crud/packages/crud.html' //padrão GDoc
        ]);

        $this->assertEquals($crudTemplate->crudName, 'Crud');
        $this->assertEquals($crudTemplate->objectMainAttribute, 'attributeName');
        $this->assertEquals($crudTemplate->labelList, 'Lista de Cruds');
        $this->assertEquals($crudTemplate->linkHelpPage, 'help/Crud/packages/crud.html');

        $this->assertContains('object0', $crudTemplate->objectList);
        $this->assertContains('coluna0', $crudTemplate->columns);
        $this->assertLessThan(sizeof($crudTemplate->objectList), 2);
        $this->assertLessThan(sizeof($crudTemplate->columns), 2);

    }

    public function testAttributesExceptlinkHelpPage()
    {
        $crudTemplate = new CrudTemplate([
            'objectList'          => collect(['object0', 'object1', 'object2']),
            'objectMainAttribute' => 'attributeName',
            'columns'             => collect(['coluna0', 'coluna1', 'coluna2']),
            'crudName'            => 'Crud',
            'labelList'           => 'Lista de Cruds'
        ]);

        $this->assertNull($crudTemplate->linkHelpPage);
    }

    public function testgetRoutesByCrudName()
    {
        //nome de cadastro simples
        $crudTemplate = new CrudTemplate([
            'crudName' => 'Crud'
        ]);
        $this->assertEquals($crudTemplate->getRouteCreate(), 'crud.create');
        $this->assertEquals($crudTemplate->getRouteEdit(1), 'crud/1/edit');

        //nome de cadastro composto
        $crudTemplateComposto = new CrudTemplate([
            'crudName' => 'Crud Name'
        ]);
        $this->assertEquals($crudTemplateComposto->getRouteCreate(), 'crud-name.create');
        $this->assertEquals($crudTemplateComposto->getRouteEdit(1), 'crud-name/1/edit');
    }
}
