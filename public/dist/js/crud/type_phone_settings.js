function setTypePhone(crud_type) {
    if (document.getElementById('change_phone').checked) {
        document.getElementById('phone').setAttribute("hidden", "true");
        document.getElementById('phone_int').removeAttribute("hidden");
        var phoneInputField = document.querySelector("#phone_international");
        var buttonSave = document.getElementById('save');
        buttonSave.setAttribute('disabled', '');

        var errorMap = ["Número Inválido", "Code de País Inválido", "Número Muito Curto", "Número Muito Longo", "Número Inválido"];
        if(crud_type == 'create'){
            errorMsg = document.querySelector("#error-msg"),
            validMsg = document.querySelector("#valid-msg");
        }else{
            errorMsg = document.querySelector("#error-msg-edit"),
            validMsg = document.querySelector("#valid-msg-edit");
        }
        
        const phoneInput = window.intlTelInput(phoneInputField, {           
            separateDialCode: true,
            excludeCountries: [
                'br' //Brasil não e internacional
            ],
            utilsScript:
                "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        }); 

        //Reset fields error e msg valid
        var reset = function() {
            phoneInputField.classList.remove("error");
            errorMsg.innerHTML = "";
            errorMsg.setAttribute("hidden", "true");
            validMsg.setAttribute("hidden", "true");            
        };

        var countryCode = $('.iti__selected-flag').attr('title');
        var countryCode = countryCode.replace(/[^0-9]/g,'');          
        $('#country_code').val("+"+countryCode);

        //Validation input phone_international
        phoneInputField.addEventListener('blur', function() {
            reset();
            if (phoneInputField.value.trim()) {
              if (phoneInput.isValidNumber()) {
                    validMsg.removeAttribute("hidden");
                    buttonSave.removeAttribute("disabled");
              } else {
                phoneInputField.classList.add("error");
                var errorCode = phoneInput.getValidationError();
                errorMsg.innerHTML = errorMap[errorCode];
                errorMsg.removeAttribute("hidden");
                buttonSave.setAttribute('disabled', '');
              }
            }
          });        
        
    } else {
        document.getElementById('phone_int').setAttribute("hidden", "true");
        document.getElementById('phone').removeAttribute("hidden");
        var buttonSave = document.getElementById('save');
        buttonSave.removeAttribute("disabled");
    }
}