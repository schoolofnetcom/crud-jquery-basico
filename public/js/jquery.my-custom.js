$.formatPhone = function (phone) {
    if (!phone || phone.length < 10 || phone.length > 11) {
        return phone;
    }

    var numDigits = phone.length == 10 ? 6 : 7;
    return '(' +
        phone.substring(0, 2) +
        ') ' +
        phone.substring(2, numDigits) +
        '-' +
        phone.substring(numDigits, phone.length)
};

$.formatCpf = function (cpf) {
    if (!cpf || cpf.length < 11) {
        return cpf;
    }

    return cpf.substring(0, 3) +
        '.' +
        cpf.substring(3, 6) +
        '.' +
        cpf.substring(6, 9) +
        '-' +
        cpf.substring(9, 11);
};

$.formatDate = function (date) { //YYYY-MM-DD
    if (!date || date.length < 10 || date.length > 10) {
        return date;
    }

    var dateArray = date.split('-');
    return new Date(dateArray[0],parseInt(dateArray[1])-1,dateArray[2]).toLocaleDateString();
};

$.formatMaritalStatus = function (maritalStatus) { //1 - Solteiro, 2 - Casado, 3 - Divorciado
    switch (parseInt(maritalStatus)){
        case 1:
            return "Solteiro";
        case 2:
            return "Casado";
        case 3:
            return "Divorciado";
    }
};

$.fn.serializeObject = function(){
  var formArray = $(this).serializeArray();
    //[{name: 'cpf',value:''}]
    //{cpf: '000',....}
    var result = {};
    for(var i = 0; i< formArray.length;i++){
        result[formArray[i]['name']] = formArray[i]['value'];
    }
    return result;
};
