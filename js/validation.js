 // 29-04-2017 Validation custome js 

 $(function () {
            $('.keyup-characters').keyup(function () {
            $('span.error-keyup-2').remove();
    var inputVal = $(this).val();
    var characterReg = /^\s*[0-9\.\s]+\s*$/;
    if(!characterReg.test(inputVal)  && inputVal != '') {
       
      var no_spl_char = inputVal.replace(/[`~!@#$%^&*()_|+\-=?;:'",a-zA-Z<>\{\}\[\]\\\/]/gi, '');
            $(this).val(no_spl_char);
      $(this).after('<span class="error error-keyup-2" style="color:red;">No special characters and characters allowed.</span>');
 
    }
            });



              $('.digit-only').keyup(function () {
            $('span.error-keyup-2').remove();
    var inputVal = $(this).val();
    var characterReg = /^\s*[0-9\s]+\s*$/;
    if(!characterReg.test(inputVal)  && inputVal != '') {
       
      var no_spl_char = inputVal.replace(/[`~!@#$%^&*()_|+\-=?;:'",.a-zA-Z<>\{\}\[\]\\\/]/gi, '');
            $(this).val(no_spl_char);
      $(this).after('<span class="error error-keyup-2" style="color:red;">Digit only.</span>');
 
    }
            });
 
        });
// shiv