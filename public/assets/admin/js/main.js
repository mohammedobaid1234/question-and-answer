$( function (){

    'use strict';
     
    // Hide placeholder when input focus
    $('[placeholder]').focus(function (){
        $(this).attr('data-text', $(this).attr('placeholder'));
       $('.search').css('display' , 'none');
        $(this).attr('placeholder', '');
    }).blur(function(){
        $(this).attr('placeholder', $(this).attr('data-text'));
       $('.search').css('display' , 'inline');

    })
    $(function() {
        $(".aside").niceScroll({
           cursorcolor: "#b7afa8",
            //Change the scroll bar color
         });
    });
    
   
});
$(function() {
//   console.log(); 
$("li").click(function() {
       if ($(this).hasClass('normal1')){

        //    console.log('object');
          // remove classes from all
          $("li").removeClass("active");
          // add class to the one we clicked
          $(this).addClass("active");
       }
    });
 });
$(function() {
//   console.log(); 
$("a").click(function() {
      

        //    console.log('object');
          // remove classes from all
          $("a").removeClass("active");
          // add class to the one we clicked
          $(this).addClass("active");
       
    });
 });
 