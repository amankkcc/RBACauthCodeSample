$(document).ready(function(){
	
	
$("#mem_logo_file").change(function(e){
    
    var img = e.target.files[0];
                
    if(!img.type.match('image.*')){
      alert("Whoops! That is not an image.");
      return;
    }
    iEdit.open(img, true, function(res){
                    $('#mem_pic').html('<img src="'+res+'" class="img-circle img-responsive">');
                        //alert(img);exit();
      //$("#result").attr("src", res);
                        //$('#file').val(res);
                       // return;
    });
  });
	

});

	 