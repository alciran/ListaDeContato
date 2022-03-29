<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Crud\ColumnList;
use App\Models\Crud\CrudTemplate;
use App\Models\Crud\CrudAlert;
use App\Models\Contact;

class ContactController extends Controller
{
    private function setColumnsList()
    {
        return collect([
            new ColumnList('Nome', 'name' ),
            new ColumnList('E-mail', 'email'),
            new ColumnList('Telefone', 'getPhoneNumberFormatted', true, 3)
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $crudTemplate = new CrudTemplate([
            'objectList'          => Contact::orderBy("name", "asc")->get(),
            'objectMainAttribute' => 'name',
            'columns'             => $this->setColumnsList(),
            'crudName'            => 'Contato',
            'labelList'           => 'Lista de Contatos Cadastrados',
            'linkHelpPage'        => 'help/Contatos/packages/Lista_De_Contatos.html'
        ]);
        
        return view('default_crud_list', compact('crudTemplate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contato.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ContactRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        $request->international_phone ? $request['phone'] = $request->country_code ." $request->phone_int" :        
        $request['phone'] = preg_replace('/-/', '', preg_replace('/[^z0-9.-]/', '', $request->phone));
       
        Contact::create($request->all());

        return view('contato.create', ['crudAlert' => new CrudAlert('Contato', $request->name, 'storeSuccess')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::where('id', $id)->first();
        return view('contato.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\ContactRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContactRequest $request, $id)
    {
        if($request->international_phone) {
            $request['phone'] = $request->country_code ." $request->phone_int";            
            $request['international_phone'] = true;
        }else{
            $request['international_phone'] = false ;
            $request['phone'] = preg_replace('/-/', '', preg_replace('/[^z0-9.-]/', '', $request->phone));
        }

        Contact::where('id', $id)->update($request->except('_token', '_method', 'phone_int', 'country_code'));

        return redirect()->route('contato.index')
            ->with('crudAlert', new CrudAlert('Contato', $request->name, 'updateSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exclude_name = Contact::select('name')->where('id', $id)->first();

        Contact::find($id)->delete();

        return redirect()->route('contato.index')
            ->with('crudAlert', new CrudAlert('Contato', $exclude_name->name, 'destroySuccess'));
    }
}
