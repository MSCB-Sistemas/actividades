// JavaScript Document
function tabular(e,obj) {
  tecla=(document.all) ? e.keyCode : e.which;
  if(tecla!=13 && tecla!=38 ) return;
  frm=obj.form;
  for(i=0;i<frm.elements.length;i++) 
    if(frm.elements[i]==obj) { 
      if (i==frm.elements.length-1) i=-1;
      break }
  if(tecla==13) frm.elements[i+1].focus();
  if(tecla==38) frm.elements[i-1].focus();
  return false;
} 


function validar_caja(frm) {
  
  if (!confirm('¿Estas seguro de enviar este formulario?')){
       
	   return (false); 
   } 
}
