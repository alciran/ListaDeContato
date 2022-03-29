@switch($alertType)
    @case("storeSuccess")
        <div class="alert alert-success" id="alert-box">
            {{ $crudName }}: <strong>{{ $mainAttributeValue }}</strong> cadastrado com sucesso!
        </div>
        @break

    @case("updateSuccess")
        <div class="alert alert-success" id="alert-box">
            {{ $crudName }}: <strong>{{ $mainAttributeValue }}</strong> editado com sucesso!
        </div>
        @break

    @case("destroySuccess")
        <div class="alert alert-success" id="alert-box">
            {{ $crudName }}: <strong>{{ $mainAttributeValue }}</strong> removido com sucesso!
        </div>
        @break
@endswitch