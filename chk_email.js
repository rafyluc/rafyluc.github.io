// Funzione per controllare la validita di un indirizzo e-Mail
// da mettere onChange (onBlur ha problemi con il focus)
function chk_email(obj,i18n)
{
	var valEmail = obj.value;
	var expReg=/^[\w\d\_\-\.]+@\w+[\w\-\.]*\.\w{2,4}$/;
	var spaces=/^\s+$/;
	var valRit=false;
	var ns4 = ((navigator.appName == "Netscape") && (parseInt(navigator.appVersion) >= 4 ));


// Controllo mail multiple gli indirizzi devono essere separati da virgola  ....
	var arrayMail = valEmail.split(',');
	for(var i=0; i<arrayMail.length; i++) {
		var email = arrayMail[i];
		//alert(email);
		if (email!="" && !(spaces.test(email)))   {
			// ripulisco il campo dagli spazi all'inizio e alla fine ...
			email = email.replace(/^\s+/g,'');
			email = email.replace(/\s+$/g,'');
			if (!(expReg.test(email)))   {
				if (i18n)
				{
					alert(JS_INVALID_EMAIL);
				}
				else
				{
					alert("Attenzione, \nl'indirizzo di e-mail inserito:\n"+email+"\nrisulta non valido. Reinserirlo, grazie" );
				}
				myExp = new RegExp(email);
				obj.value = obj.value.replace(myExp,"");
				if(!ns4) {obj.style.backgroundColor = "#ff5500";}
			} else {
				valRit=true;
			}
		} else {
				if (i18n)
				{
					alert(JS_NO_EMAIL);
				}
				else
				{			
					alert("Attenzione, non e' stato specificato\nalcun indirizzo e-Mail!");
				}
			obj.focus();
		}

	}
	return valRit;

}

function chk_cell(objcell) {
         var numCell=objcell.value;
         re=/[\\s]+/g;
         numTel=numCell.replace(re,"");
         objcell.value=numTel;
            //alert("numtel="+numTel);
         var primoChar=numCell.charAt(0);
         // Controllo che non ci siano caratteri non ammessi
         re=/[^0-9\+]/;
         if(re.test(numTel)) {
            alert("Attenzione il campo Cellulare contiene caratteri non ammessi, si prega di correggerlo, grazie!");
            return false;
            }
         re=/^00/;
         numTel=numTel.replace(re,"+");

         //if (primoChar=="+" || )     {numCell=primoChar+numTel;}
         if (primoChar=="+" || primoChar=="0")     {numCell=numTel;}
         else { numCell='+39'+numTel; }
         objcell.value=numCell;
         return true;
}
