

var appNFC = {
 // Application Constructor
 initialize: function() {
 this.bindEvents();
 console.log("Starting NFC Reader app");
 },
 // Bind Event Listeners
 bindEvents: function() {
 document.addEventListener('deviceready', this.onDeviceReady, false);
 },
 // deviceready Event Handler 
 onDeviceReady: function() {
 //app.receivedEvent('deviceready');
 nfc.addTagDiscoveredListener(
 appNFC.onNfc, // tag successfully scanned
 function (status) { // listener successfully initialized
 //app.display("Tap a tag to read its id number.");
 },
 function (error) { // listener fails to initialize
 appNFC.display("NFC reader failed to initialize " +
 JSON.stringify(error));
 }
 );
 },
  
 onNfc: function(nfcEvent) {
 var tag = nfcEvent.tag;
 //app.nro(nfc.bytesToHexString(tag.id));
 appNFC.nro(tag.id);
 },
  
 
 nro: function(ms) {


   function toDec( x ){
      var val = 0;
      var res = 0;
      var go = 0;
      var fa = 1;
       // reverse var i = x.length - 1; i >= 0; i--
       for (var i = 0; i < x.length; i++) {  
          res = x[i] & 0xff;
	  go = bigInt(res).times(fa).plus(val);
          val += bigInt(res).times(fa);
          fa *= 256;

	  //console.log(go);
       }

        return go;
   }

   	//document.getElementById('tagginro').value = toDec(ms);
	tag = toDec(ms);


$(document).ready(function(){



        $.ajax({
           url: url+'/tag',
	   type:'POST',
 	   data: { tilanne : "getObjbyTag", tag : tag },
           success: function(data){
        	console.log(data);
		data = JSON.parse(data);

		$("#result2").html(data).show();


    	},
    		error:function (xhr, ajaxOptions, thrownError){
        	console.log(xhr.responseText);
		$("#result2").html(xhr.responseText).show();
    	}
        });
});

  



 },

 clear: function() {
 	tagginro.innerHTML = "";
 },
  
 
};



function clearAndExit(){
	//alert('bdfff');
	navigator.app.exitApp();
}
