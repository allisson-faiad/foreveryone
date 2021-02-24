

/**
 * 
 *  Desativando todos campos de alteração do perfil
 * 
 * 
 */

 

 function ativarCampos(bool){
     var btnAltera = document.getElementById('btnAltera');
     var btnCancela = document.getElementById('btnCancela');
    var input = document.getElementsByTagName("input");
    var textarea = document.getElementsByTagName("textarea");
    for( var i=0; i<=(input.length-1); i++ )
	{
		if( input[i].type!='button' ) {
            input[i].disabled = bool;
        }
	}
       
    input.disabled = bool;
    btnAltera.hidden = bool;
    btnCancela.hidden = bool;
        
     }
    