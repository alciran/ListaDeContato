@extends('adminlte::page')

@section('title', 'Adicionar Cadastro de Contato')

@section('css')
    <link rel="stylesheet" href="{{ asset('dist/css/global_style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css" />
@stop

@section('content')

    @if (isset($errors) && count($errors) > 0)
        <div class="text-center mt-4 mb-4 p-2 alert-danger" id="alert-box">
            @foreach ($errors->all() as $error)
                {{ $error }}</br>
            @endforeach
        </div>
    @elseif(isset($crudAlert))
        <x-crud-alert alertType="{{ $crudAlert->alertType }}" crudName="{{ $crudAlert->crudName }}"
            mainAttributeValue="{{ $crudAlert->mainAttributeValue }}" />
    @endif

    <div class="col-md-7">
        <div class="card card-lightblue">
            <div class="card-header">
                <div class="row">
                    <h3 class="text-center">Cadastrar Novo Contato</h3>
                    <a href="{{ asset('help/Contatos/packages/Lista_De_Contatos.html#subsection-1') }}" target="_blank"
                        class="logo_help" title="Abrir página de help para cadastrar um nono Contato">
                        <i class="fas fa-question-circle fa-1x" style="color: #ffffff;"></i>
                    </a>
                </div>
            </div>
            <form id="contact_form" action="{{ route('contato.store') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 contact-name">
                            <div class="col form-group">
                                <label>
                                    <cob>*</cob>Nome:
                                </label>
                                <input class="col-12 form-control" type="text" name="name" minlength="3" maxlength="50"
                                    placeholder="Nome..." tabindex="1" value="{{ old('name') }}" id="name" required
                                    autofocus>
                                {!! $errors->first('name', "<span class='text-danger'>:message</span>") !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 contact-email">
                            <div class="col form-group">
                                <label>
                                    <cob>*</cob>E-mail:
                                </label>
                                <input class="col-12 form-control" type="email" name="email" minlength="3" maxlength="255"
                                    placeholder="Endereço de e-mail..." tabindex="2" value="{{ old('email') }}" id="email"
                                    required>
                                {!! $errors->first('email', "<span class='text-danger'>:message</span>") !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 contact-phone">
                            <div class="col form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>
                                            <cob>*</cob>Telefone:
                                        </label>
                                    </div>
                                    <div class="col text-right float-right">
                                        <label class="float-right">Internacional?</label>
                                        <input type="checkbox" id="change_phone" class="form-check-input" tabindex="3"
                                            name="international_phone" onclick="setTypePhone('create')"
                                            {{ old('phone_int') ? 'checked' : '' }} />
                                    </div>
                                </div>
                                <input class="col-12 form-control phone" type="text" name="phone" minlength="10"
                                    onblur="mask(this, mphone);" placeholder="(42) 99999-9999"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    maxlength="15" tabindex="4" value="{{ old('phone') }}" id="phone">
                                <div id="phone_int" hidden>
                                    <input class="col-12 form-control phone_int" type="tel" id="phone_international"
                                        onblur="setPhoneInt()"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        value="{{ old('phone_int') }}" size="100" name="phone_int" tabindex="4"
                                        minlength="6" maxlength="20">
                                    <span id="valid-msg" style="color: rgb(80, 158, 80); font-weight: bold" hidden>
                                        <i class="fas fa-check"></i> Número de telefone Válido</span>
                                    <span id="error-msg" style="color: rgb(211, 47, 47); font-weight: bold"></span>
                                    <input type="hidden" name="country_code" id="country_code" />
                                </div>
                                {!! $errors->first('phone', "<span class='text-danger'>:message</span>") !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row float-right">
                        <div class="float-right">
                            <div class="col">
                                <button class="btn btn-success" type="submit" id="save" title="Salvar cadsatro de Contato [Enter]">
                                    <i class="fas fa-check" tabindex="5"></i> Salvar</button>
                            </div>
                        </div>
                        <div class="float-right">
                            <div class="col">
                                <a href="{{ route('contato.index') }}">
                                    <button type="button" class="btn btn-danger" tabindex="6"
                                        title="Cancelar e voltar para tela de Lista de Contatos [F4]"><i
                                            class="fas fa-ban"></i> Cancelar</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

@stop
@section('js')
    <script>
        window.onload = function() {
            setTypePhone('create');
        };
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="{{ asset('dist/js/jquery.js') }}"></script>
    <script src="{{ asset('dist/js/global_custom_configs.js') }}"></script>
    <script src="{{ asset('dist/js/crud/contact.js') }}"></script>
    <script src="{{ asset('dist/js/crud/type_phone_settings.js') }}"></script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('dist/js/shortcut.js') }}"></script>
    <script>
        shortcut.add("F4", function() {
            let url = "{{ route('contato.index') }}";
            document.location.href = url;
        });
    </script>

@stop
