$(document).ready(function(){
  $('.not_now').hide();
  $('#role_view_tb').hide();
  $('#role_details').hide();
  $('#role_access_tb').hide();
  $('#role_access_tb_btn').hide();
  $('#edit_role_tb').hide();

     $('tr.header').click(function(){
        $(this).nextUntil('tr.header').css('display', function(i,v){
        return this.style.display === 'table-row' ? 'none' : 'table-row';
        });
        });

  
      (function($){
      $(window).on("load",function(){
      $('.fa-check-circle-o').css("color","#d3d3d3");
      $.mCustomScrollbar.defaults.scrollButtons.enable=true; //enable scrolling buttons by default
      $.mCustomScrollbar.defaults.axis="yx"; //enable 2 axis scrollbars by default

      $("#content-3dtd").mCustomScrollbar({theme:"3d-thick-dark"});

      $(".all-themes-switch a").click(function(e){
      e.preventDefault();
      var $this=$(this),
      rel=$this.attr("rel"),
      el=$(".custom-scroll");
      switch(rel){
      case "toggle-content":
      el.toggleClass("expanded-content");
      break;
      }
      });

      });
      })(jQuery);
      $(".openmodal").click(function(e){
      tableHTML=$(this).parent().parent().parent().parent().html();

      $('#modalBody').html(tableHTML);
      roletitle=$(this).parent().parent().parent().parent().parent().find('.roletitle').html();
      $('#modaltitle').html(roletitle);

      $('#modalBody1').html(tableHTML);
      roletitle=$(this).parent().parent().parent().parent().parent().find('.roletitle').html();
      $('#modaltitle1').html(roletitle);
      });

      (function($) {

      $('#search').keyup(function() {
         // $('#org_div').hide();
         var rex = new RegExp($(this).val(), 'i');
         $('.mem-list a').hide();
         $('.mem-list a').filter(function() {
            $('.num_rols').each(function() {
               var desg_id = $(this).attr('id');//find id of class 
               $('#' + desg_id).show();
            });
             

            return rex.test($(this).text());

         }).show();

      });

   }(jQuery)); // Search jequery
});




function show_roles_details(role_id){
  
  var data = role_id.toString();


        $.ajax({
              type:'POST',
              url:base_url+'add_roles/get_role_details',
              data:data,
              dataType:'json', 
           
            })

            .done(function( json ) { 
             
             //var role_crated = $.format.date(json.role_details[0].role_created, 'dd M yy')
             var formattedDate = new Date(json.role_details[0].role_created);
            var d = formattedDate.getDate();
            var m =  formattedDate.getMonth();
            m += 1;  // JavaScript months are 0-11
            var y = formattedDate.getFullYear();

             
              $('#role_access_tb').hide();
              $('#role_access_tb_btn').hide();
              $('#main_add_role_btn').hide();
              $('#edit_role_tb').hide();
              $('#role_view_tb').show();
              $('#added_on').text(d + "." + m + "." + y);
              $('#role_name').text(json.role_details[0].role_name);
              $('#del_role_id').val(json.role_details[0].role_id);
              $('#edit_role_id').val(json.role_details[0].role_id);
             

             
              //alert(json.perms[3]);
              var not_assigned = '<i class="fa fa-times" aria-hidden="true"></i>';
              var assigned = '<i class="fa fa-check" aria-hidden="true"></i>';
              for (var i = 0; i < 37; i++) {
                
                if (json.perms[i]==1){
                   $('#'+i).empty();
                  $('#'+i).append(assigned);
                } else {
                   $('#'+i).empty();
                  $('#'+i).append(not_assigned);
                }

              }
              

           

            })
            .fail(function( xhr, status, errorThrown ) {
          
                alert( "Sorry, there was a problem!" );
                console.log( "Error: " + errorThrown );
                console.log( "Status: " + status );
                console.dir( xhr );
            });


}

$('#btn_delete_role').click(function() {

    
    var data = $('#del_role_id').val();
    $.ajax({
              type:'POST',
              url:base_url+'add_roles/delete_role_details',
              data:data,
              dataType:'json', 
           
            })
            
            .done(function(json) { 
             
             alert("Selected Role Deleted");
             location.reload();         

            })
            .fail(function( xhr, status, errorThrown ) {
          
                alert( "Sorry, there was a problem!" );
                console.log( "Error: " + errorThrown );
                console.log( "Status: " + status );
                console.dir( xhr );
            });
  
 });// end of delete role button click function */

$('#bt_edit_role').click(function() {

    
    var data = $('#edit_role_id').val();
    


        $.ajax({
              type:'POST',
              url:base_url+'add_roles/edit_role_details',
              data:data,
              dataType:'json', 
           
            })

            .done(function( json ) { 
             
             
              $('#role_access_tb').hide();
              $('#role_access_tb_btn').hide();
              $('#main_add_role_btn').hide();
              $('#role_view_tb').hide();
              $('#edit_role_tb').show();
              $('#edit_role_tb_name').val(json.role_details[0].role_name);
              $('#edit_role_tb_id').val(json.role_details[0].role_id);
            
             
              for (var i = 0; i < 37; i++) {
                
                if (json.perms[i]==1){
                $('#e'+i).attr("checked", "");
                  $('#e'+i).attr("checked", true);
                } else {
                  $('#e'+i).attr("checked", "");
                  $('#e'+i).attr("checked", false);
                }

              }
              

           

            })
            .fail(function( xhr, status, errorThrown ) {
          
                alert( "Sorry, there was a problem!" );
                console.log( "Error: " + errorThrown );
                console.log( "Status: " + status );
                console.dir( xhr );
            });
  
 });// end of delete role button click function */





function show_roles_section(){
  $('#role_access_tb').show();
  $('#role_access_tb_btn').show();
  $('#main_add_role_btn').hide(); 
  $('#role_view_tb').hide();
}

