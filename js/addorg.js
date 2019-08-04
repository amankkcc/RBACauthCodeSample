$(document).ready(function() {
$('#org_selected').hide();
  
var initialText = $('.editable').val();
$('.editOption').val(initialText);

$('#dropdown').change(function(){
var selected = $('option:selected', this).attr('class');
var optionText = $('.editable').text();

if(selected == "editable"){
  $('.editOption').show();


  $('.editOption').keyup(function(){
      var editText = $('.editOption').val();
      $('.editable').val(editText);
      $('.editable').html(editText);
  });

}else{
  $('.editOption').hide();
}
});


$("#org_logo_file").change(function(e){
    
    var img = e.target.files[0];
                
    if(!img.type.match('image.*')){
      alert("Whoops! That is not an image.");
      return;
    }
    iEdit.open(img, true, function(res){
                    $('#logo_pic').html('<img src="' + res + '" class="img-circle img-responsive">');
                        //alert(img);exit();
      //$("#result").attr("src", res);
                        //$('#file').val(res);
                       // return;
    });
  });


});

	