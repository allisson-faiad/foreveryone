
/**
 * Pagina de cadastro
 */


//Celular
jQuery.validator.addMethod('celular', function (value, element) {
  value = value.replace("(","");
  value = value.replace(")", "");
  value = value.replace("-", "");
  value = value.replace(" ", "").trim();
  if (value == '0000000000') {
      return (this.optional(element) || false);
  } else if (value == '00000000000') {
      return (this.optional(element) || false);
  } 
  if (["00", "01", "02", "03", , "04", , "05", , "06", , "07", , "08", "09", "10"]
  .indexOf(value.substring(0, 2)) != -1) {
      return (this.optional(element) || false);
  }
  if (value.length < 10 || value.length > 11) {
      return (this.optional(element) || false);
  }
  if (["6", "7", "8", "9"].indexOf(value.substring(2, 3)) == -1) {
      return (this.optional(element) || false);
  }
  return (this.optional(element) || true);
}, 'Informe um número de telefone celular válido!'); 

//Telefone fixo
jQuery.validator.addMethod('telefone', function (value, element) {
  value = value.replace("(", "");
  value = value.replace(")", "");
  value = value.replace("-", "");
  value = value.replace(" ", "").trim();
  if (value == '0000000000') {
    return (this.optional(element) || false);
  } else if (value == '00000000000') {
    return (this.optional(element) || false);
  }
  if (["00", "01", "02", "03", , "04", , "05", , "06", , "07", , "08", "09", "10"].indexOf(value.substring(0, 2)) != -1) {
    return (this.optional(element) || false);
  }
  if (value.length < 10 || value.length > 11) {
    return (this.optional(element) || false);
  }
  if (["6", "7", "8", "9"].indexOf(value.substring(2, 3)) == -1) {
    return (this.optional(element) || false);
  }
  return (this.optional(element) || true);
}, 'Informe um número de telefone fixo válido!'); 





// cpf / cnpj / telefones
$(document).ready(function () {
  $("#cpf").mask('000.000.000-00', { reverse: true });

  $("#telefone_fixo").mask('(00) 0000-0000');
  $("#telefone_celular").mask('(00) 00000-0000');


  $('#cnpj').mask('00.000.000/0000-00', { reverse: true });

});

