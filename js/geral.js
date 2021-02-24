/**
 *  Aqui vamos lidar com a formatação de datas juntas ao php;
 */


 /**
  * Formatando para que o campo só receba numeros
  */

 function somenteNumeros(e) {
    
    var tecla=(window.event)?event.keyCode:e.which;
    // tecla 48 equivale a 0   
        // tecla 57 equivale a 9
    if((tecla>47 && tecla<58)) return true;
    else{
        // tecla 8 = backspace   
    // tecla 9 = tab
    if (tecla==8 || tecla==0) return true;
    else  return false;
    }
}










