<!-- modal default -->
<div class="modal fade" id="modal-remove">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Remover {{ $crudName ?? 'Cadastro'}}</h4>
                <div class="col-2">
                    <a href="{{ asset("$removeHelpPage" ?? '') }}"
                    target="_blank" title="Abrir página de help sobre remover {{ $crudName ?? 'Cadastro' }}">
                        <i class="fas fa-question-circle fa-1x" style="color: #276acf;"></i>                            
                    </a>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="removeCrudForm" action="" method="POST">
                {{ method_field('DELETE') }}
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-2 text-center float-center">
                            <img src="{{ asset('dist/img/alert.png') }}" class="alert-icon-modal" />
                        </div>
                        <div class="col-sm-10">
                            <span>Atenção, após realizar esta operação, a remoção do cadastro torna-se irreversível.</span><br>
                            <span>Deseja remover o cadastro do {{ $crudName }}: &nbsp;</span><label id="mainattribute"></label><span>?</span>
                        </div>
                    </div>                 
                </div>
                <div class="modal-footer">
                    <div id="btn-remover">                        
                        <button type="submit" class="btn btn-primary" 
                            title="Remover o Cadastro">Remover</button>                        
                    </div>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->