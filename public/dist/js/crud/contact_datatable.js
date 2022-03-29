
$(function() {
    $('#tablelist').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,    
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "Nenhum resultado encontrado",
            "sEmptyTable": "Nenhum dado disponível nesta tabela",
            "sInfo": "Mostrando registros de _START_ até _END_ de um total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros de 0 até 0 de um total de 0 registros",
            "sInfoFiltered": "(filtrado de um total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Caregando...",
            "oPaginate": {
                "sFirst": "Primeiro",
                "sLast": "Último",
                "sNext": "Seguinte",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Ativar para ordenar a coluna de maneira ascendente",
                "sSortDescending": ": Ativar para ordenar a coluna de maneira descendente",
            }        
        },
        "buttons": [
            {
                extend: 'excel',
                text: 'Excel',
                exportOptions: {
                    columns: ':not(.notexport)'
                }
            },
            {
                extend: 'csv',
                text: 'CSV',
                exportOptions: {
                    columns: ':not(.notexport)'
                }
            },
            {
                extend: 'pdf',
                text: 'PDF',
                exportOptions: {
                    columns: ':not(.notexport)'
                }
            },
            {
                extend: 'print',
                text: 'Imprimir',
                exportOptions: {
                    columns: ':not(.notexport)'
                }
            },
        
        ],
        "drawCallback": function( settings ) {
            $(function() {
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

                
            })
        }

    }).buttons().container().appendTo('#tablelist_wrapper .col-md-6:eq(0)');
});
