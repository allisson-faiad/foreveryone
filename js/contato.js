function enviardados(){
  
    if(document.dados.nome.value=="" || document.dados.nome.value.length < 8)
    {
    alert( "Preencha campo NOME corretamente!" );
    document.dados.nome.focus();
    }
      
      
    if( document.dados.email.value=="" || document.dados.email.value.indexOf('@')==-1 || document.dados.email.value.indexOf('.')==-1 )
    {
    alert( "Preencha campo E-MAIL corretamente!" );
    document.dados.email.focus();
    }
      
    if (document.dados.mensagem.value=="" || document.dados.mensagem.value.length < 600 )
    {
    alert( "Preencha o campo MENSAGEM corretamente!" );
    document.dados.mensagem.focus();
    }


}
