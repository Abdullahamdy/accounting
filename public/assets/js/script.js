/*global $, jQuery, console, alert, prompt */
$(document).ready(function () {
     $('.active-sidebar').on('click', function () {
          $('.sidebar').toggleClass('side-active');
          $(this).toggleClass('open');
     });
     $('.active-sidebar').on('click', function () {
          $('.main').on('click',function (){
               $('.sidebar').removeClass('side-active');
          })
     });
});
