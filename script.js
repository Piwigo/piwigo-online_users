$(document).ready(function() {
  $('#icon-circle').click(function() {
      $('#overlay').toggle();
      $('#infoCircle').toggle();
      
      $('#icon-circle').toggleClass('icon-circle icon-circle-open');
  });
});
