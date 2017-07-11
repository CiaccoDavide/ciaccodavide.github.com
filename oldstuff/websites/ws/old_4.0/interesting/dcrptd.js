//Web Decrypter
document.getElementById('add').innerHTML=stringa;
crptd = stringa;
var arraycrypted = crptd.split("");
var arraydecrypted = new String();
var tester = new Array();

//load disposti
var disposti = new Array();
k = 0;
for(x = 32; x <127; x++){
	for(y = 32; y <127; y++){
		for(z = 32; z <127; z++){
			disposti[k] = String.fromCharCode(x) + String.fromCharCode(y) + String.fromCharCode(z);
			k++;
		}
	}
}




$("#key").keyup(function () {
  	var unlocker = $(this).val();
	
	if(unlocker.length<1)
		document.getElementById('add').innerHTML=stringa;
	else{
		//svuoto la stringa che uscirà(altrimenti dalla seconda volta aggiunge sempre più dati...)
		arraydecrypted="";
		
		keyarray = unlocker.split("");
		l = keyarray.length;
		for(i = 0; i < l; i++){
			keyarray[i]=parseInt((keyarray[i].charCodeAt(0)+i*69)/10);
		}
		for(i = 0; i < +l; i++){
			keyarray[i]=(keyarray[i]+keyarray[l-1-i]);
		}
		
		
		
		kr=0;
		for(i = 0; i < arraycrypted.length; i++){

			mu=(arraycrypted[i].charCodeAt(0)-5121);
			cry=arraycrypted[i+1].charCodeAt(0)-keyarray[kr]-13312;
			cry+=(mu*1805);
			tester=cry;

			arraydecrypted += disposti[cry];

			if(kr<l-1){
				kr++;
			}
			else{
				kr=0;
			}
			i++;
		}
		document.getElementById('add').innerHTML=arraydecrypted;
		
		
		
	}
}).keyup();