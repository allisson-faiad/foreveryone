
/**
 * Pagina de cadastro
 */





// VALIDANDO A SENHA


// $(document).ready(function () {   
//   $('#formulario').validate({
//     rules: {
//       nome_usuario: {
//         required:true
//       },
//       nome: {
//         required:true
//       },
//       email: {
//         required:true
//       },
//       senha: {
//         required: true
//       },
//       confirmaSenha: {
//         required: true,
//         equalTo: "#senha"
//       },
//     },
//     messages: {
//       nome_usuario: {
//         required: "O campo usuário é obrigatório."        
//       },
//       nome: {
//         required: "O campo nome completo é obrigatório."
//       },
//       email: {
//         required: "O campo email é obrigatório."
//       },
//       senha: {
//         required: "O campo senha é obrigatório."
//       },
//     }
//   });
//   $('#formulario').submit(function(event){
//     window.href = "teste.php";
//   event.preventDefault();
//   });
// });

/**
 * Confirmando a senha
 */
// $('#confirmaSenha').change(function () {
//   if ($('#senha') == $('#confirmaSenha')) {
//     return $('#aviso') = "erro0";
//   }
// });
$('#formulario').validate({
      rules: {
        senha: {
          required: true
        },
        confirmaSenha: {
          required: true,
          equalTo: "#senha"
        },
      },
      messages: {
        senha: {
          required: "O campo senha é obrigatório."
        },
      }
    });

// cpf / cnpj / telefones
$(document).ready(function () {
  $("#cpf").mask('000.000.000-00', { reverse: true });

  $("#telefone_fixo").mask('(00) 0000-0000');
  $("#telefone_celular").mask('(00) 00000-0000');


  // $('#cnpj').mask('00.000.000/0000-00', { reverse: true });

});

