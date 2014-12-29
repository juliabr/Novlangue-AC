jQuery(document).ready(function($){
   
   $('html').removeClass('no-js');
   
   $( "#newspeak-art .item" ).fadeIn(1500);

   $('#newspeak-art-form').submit( function(e) {
      
      e.preventDefault();
      
      $('.btn').addClass('waiting').attr('disabled','disabled');
      
      $.ajax({
        url: "generate_newspeak.php",
        cache: false
      })
      .done(function( newspeak ) {
         
         $( "#newspeak-art" ).find('.item').removeClass('current').animate({
               opacity: 0.5,
            }, 1000)
            .end()
            .append('<section class="item current">'+newspeak+'</section>' )
            .find('.current').css('opacity', 0).show().animate({
               opacity: 1,
            }, 1000);
         
         $('html,body').animate({
	          scrollTop: $( "#newspeak-art" ).find('.current').offset().top
	     }, 1000);
      });
      
      $('.btn').removeClass('waiting').delay(1000).removeAttr('disabled');
      
   });
   
   $(document).on('mouseover', '#newspeak-art .item', function() {
      $(this).animate({
         opacity: 1
      }, 400);
   });
   
   $(window).resize(function() {
      var firstItem = $( "#newspeak-art .item" ).first();
      var containerHeight = $( "#newspeak-art" ).innerHeight();
      var mtFirst = containerHeight/2 - firstItem.innerHeight()/2 -30;
      $( "#newspeak-art" ).css('padding-top', mtFirst);
      
   }).resize();
      
});