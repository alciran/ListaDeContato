$(function () {
    $('#contact_form').validate({
        rules: {
            name: {
                required: true,
                minlength: 3
            },
            email: {
                required: true,
                email: true,
                maxlength: 255
            },
            phone: {
                required: function() {
                    if (document.getElementById('change_phone').checked) {
                        return false;
                    } else {
                        return true;
                    }
                },
                minlength: 10
            },
            phone_int: {
                required: function() {
                    if (document.getElementById('change_phone').checked) {
                        return true;
                    } else {
                        return false;
                    }
                },
                minlength: 8
            }
        },
        messages: {
            name: {
                required: "Por favor digite um nome para o Contato",
                minlength: "O nome do deve ter ao menos 3 caracteres"
            },
            email: {
                required: "Por favor digite um endereço de e-mail para o Contato",
                email: "Por favor digite um endereço de e-mail válido",
                maxlength: "O edereço de e-mail não pode ser maior que 255 caracteres"
            },
            phone: {
                required: "Por favor digite um telefone para o Contato",
                minlength: "Por favor digite o número completo para o telefone"
            },
            phone_int: {
                required: "Por favor digite o número de telefone internacional",
                minlength: "Por favor digite o número completo para o telefone"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });    

});


$(document).on("input", ".phone", function(e) {
    this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');
});

$(document).on("input", ".phone_int", function(e) {
    this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');
});

function setPhoneInt(){
    var countryCode = $('.iti__selected-flag').attr('title');
    var countryCode = countryCode.replace(/[^0-9]/g,'');          
    $('#country_code').val("+"+countryCode);
}

function mask(o, f) {
    setTimeout(function() {
        var v = mphone(o.value);
        if (v != o.value) {
            o.value = v;
        }
    }, 1);
}

function mphone(v) {
    var r = v.replace(/\D/g, "");
    r = r.replace(/^0/, "");
    if (r.length > 10) {
        r = r.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
    } else if (r.length > 5) {
        r = r.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
    } else if (r.length > 2) {
        r = r.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
    } else {
        r = r.replace(/^(\d*)/, "($1");
    }
    return r;
}
