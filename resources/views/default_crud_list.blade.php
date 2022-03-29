@extends('adminlte::page')

@section('title', $crudTemplate->labelList ?? 'Lista de Cadastros')

@section('css')
    <link rel="stylesheet" href="{{ asset('dist/css/global_style.css') }}">
@stop

@section('content')
    @if (isset($crudTemplate)) {{-- Show the page --}}   

        @php($user = Auth::user())
        @if(Session::has('crudAlert'))
            @php($crudAlert = Session::get('crudAlert'))            
            <x-crud-alert alertType="{{ $crudAlert->alertType}}" crudName="{{ $crudAlert->crudName }}"  mainAttributeValue="{{ $crudAlert->mainAttributeValue}}" />
        @endif

        <div class="card card-lightblue">
            <div class="card-header">
                <div class="row">
                    <div class="col-8 text-left">
                        <div class="row">
                            <h3>{{ $crudTemplate->labelList ?? 'Lista de Cadastros' }}</h3>
                            @if (isset($crudTemplate->linkHelpPage) && $user->uid == 0 )
                                <a href="{{ asset($crudTemplate->linkHelpPage) }}" target="_blank" class="logo_help"
                                    title="Abrir página de help para cadastro de: {{ $crudTemplate->crudName }} ">
                                    <i class="fas fa-question-circle fa-1x" style="color: #ffffff;"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                    @if($user->uid == 0)
                    <div class="col-4 text-right">
                        <a href="{{ route($crudTemplate->getRouteCreate()) }}"><button class="btn btn-success"
                                title="Adicionar novo  {{ $crudTemplate->crudName ?? "Cadastro" }}"><i class="fas fa-plus"></i><b> Adicionar Novo
                                {{ $crudTemplate->crudName ?? "Cadastro" }} [F2]</b></button></a>
                    </div>
                    @endif
                </div>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <table id="tablelist" class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            @foreach ($crudTemplate->columns as $column)
                                <th class="{{ $column->size ?? '' }} {{ $column->align ?? 'text-left' }}">
                                    {{ $column->label ?? '---' }}</th>
                            @endforeach
                            @if($user->uid == 0)
                            <th class="col-2 text-center notexport">Ações</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($crudTemplate->objectList as $object)
                            <tr>
                                @foreach ($crudTemplate->columns as $colunmValue)
                                    @if ($colunmValue->attributeByFunction)
                                        <td class="{{ $colunmValue->align ?? 'text-left' }}">
                                            {{ $object->{$colunmValue->objectAttributeName}() }}</td>
                                    @else
                                        <td class="text-{{ $colunmValue->align ?? 'left' }}">
                                            {{ $object->{$colunmValue->objectAttributeName} }}</td>
                                    @endif
                                @endforeach
                                @if($user->uid == 0)
                                <td class="text-center">
                                    <a href="{{ $crudTemplate->getRouteEdit($object->id) }}"
                                        title="Editar cadastro {{ $crudTemplate->objectMainAttribute ? 'de: ' . $object->{$crudTemplate->objectMainAttribute} : null }}">
                                        <button class="btn btn-outline btn-info btn-sm"><i
                                                class="fas fa-pencil-alt"></i></button></a>
                                    <a href='' data-toggle="modal" data-target="#modal-remove"
                                    data-id='{{ $object->id }}' data-mainattribute="{{ $object->{$crudTemplate->objectMainAttribute} }}"
                                        title="Remover cadastro {{ $crudTemplate->objectMainAttribute ? 'de: ' . $object->{$crudTemplate->objectMainAttribute} : null }}">
                                        <button type="submit" class="btn btn-outline  btn-danger btn-sm"><i
                                                class="fas fa-trash"></i></button></a>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

        <x-crud-modal-remove crudName="{{ $crudTemplate->crudName }}" removeHelpPage="help/Contatos/packages/Lista_De_Contatos.html#subsection-3" />
    @else
        <h1>The crudTemplate is empty...</h1>
    @endif

@stop
@section('js')
<script src="{{ asset("dist/js/global_custom_configs.js") }}"></script>
<script src="{{ asset("dist/js/shortcut.js") }}"></script>
<script>
shortcut.add("F2", function() {
    let url = "{{ route('contato.create') }}";
    document.location.href = url;
});
</script>
<script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{ asset("dist/js/crud/contact_datatable.js") }}"></script>
<script src="{{ asset('vendor/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendor/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('vendor/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('vendor/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('vendor/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('vendor/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('vendor/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('vendor/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
    $(function () {
        $('a[data-toggle=modal], button[data-toggle=modal]').click(function() {
            var data_id = '';
            var data_mainattribute = '';
        
            if (typeof $(this).data('id') !== 'undefined') {
                data_id = $(this).data('id');
            }
        
            if (typeof $(this).data('mainattribute') !== 'undefined') {
                data_mainattribute = $(this).data('mainattribute');
            }
        
            $('#mainattribute').html(data_mainattribute);   
            document.getElementById('removeCrudForm').action = "contato/" + data_id;           
        
        });
    });
</script>
@stop