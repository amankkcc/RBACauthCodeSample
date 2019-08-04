$(document).ready(function(){
	$('#worng_otp_msg').hide();


	$('#bt_otp_verify').click(function(){
      
     
      var data = JSON.stringify($('#verify_otp_form').serializeArray(this));

        $.ajax({
              type:'POST',
              url : base_url + 'signup/verify_otp',
              data:data,
              dataType:'json', 
           
            })
            .done(function( json ) { 
              if(json){
              	$('#worng_otp_msg').hide();
              	$('#loginModal').modal('show');
              }
              else{
                $('#worng_otp_msg').show();
              }
             
              
            })
            .fail(function( xhr, status, errorThrown ) {
          
                alert( "Sorry, there was a problem!" );
                console.log( "Error: " + errorThrown );
                console.log( "Status: " + status );
                console.dir( xhr );
            });
   });// end of otp verify function
});