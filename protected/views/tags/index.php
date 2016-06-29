<?php
/* @var $this TagsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tags',
);


?>



  <div class="panel heading-border">
   <div class="panel-body">
    <div id="tb" class="table-responsive"></div>
   </div>
  </div>




  <input type="hidden" id="dataChange" >


<script type="text/javascript">
$(document).ready(function(){

/* koko taulukko päivittä joka 60 sek, ja uuden rivin tarkistaminen on 10 sek kuluttua */

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
var mobnum = getParameterByName('Mobile_page');


$(".haemob").click(function(){
	$("#mobForm").submit();
});


// Send form by ajax
$('#mobForm').on('submit',function(e) {

  $.ajax({
  url: 'index?Tags_page='+mobnum,
  data:$(this).serialize(),
  type:'POST',
  success:function(data){
  	console.log(data);
	tableAjax();
	return false;
  },
  error:function(data){
  	console.log(data); 
  }
  });

e.preventDefault(); 
});



function tableAjax(){

   $.ajax({
  url: 'index?Tags_page='+mobnum,
      type: "POST",
      data: { index_ajax : "true" },
      	success: function(data){
  	  	//console.log(data);
	  	$('#tb').html(data);
      	},
  	error:function(data){
  		console.log(data); 
  	}
   });

}

   setTimeout(function(){tableAjax();},1500);
   setInterval(tableAjax, "60000");


    updateRivi();
    function updateRivi() {
        $.ajax({
           url: 'index_ajax',
           success: function(data){

        var date = new Date();
        var hours = date.getHours() < 10 ? "0" + date.getHours() : date.getHours();
        var minutes = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
        var seconds = date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();
        time = hours + ":" + minutes + ":" + seconds;


	  	$('.klo').text( time );	
		if(data)
		{
		  if(($("#dataChange").val() != data) & ($("#dataChange").val() != ''))
		  {
                    //console.log("new "+data);
		    var e = data;

		   $.ajax({
		      url: 'index?Tags_page='+mobnum,
		      type: "POST",
		      data: { index_ajax : "true" },
		      success: function(data){		
			  $('#tb').html(data);	
			  if(e){
			    console.log(e);
			    $('#rivi_'+e).fadeOut(1000).fadeIn(1000).fadeOut(1000).fadeIn(1000);
			  }		
		      }
		   });

		  }
		}
		$("#dataChange").val(data);
           }
        });
    }
    setInterval(updateRivi, "5000");

   if($('#tunni_status').val())
   $('#tunni_status_select').val($('#tunni_status').val());

});
</script>
