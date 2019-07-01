$(document).ready(function(){
  $("#search").focus(function() {
    $(".search-box").addClass("border-searching");
    $(".search-icon").addClass("si-rotate");
  });
  $("#search").blur(function() {
    $(".search-box").removeClass("border-searching");
    $(".search-icon").removeClass("si-rotate");
  });
  $("#search").keyup(function() {
    if($(this).val().length > 0) {
      $(".go-icon").addClass("go-in");
    }
    else {
      $(".go-icon").removeClass("go-in");
    }
  });
  $(".go-icon").click(function(){
    $(".search-form").submit();
  });
});


function openNav() {
  document.getElementById("mySidenav").style.width = "100%";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}

$(document).ready(function(){

  $('#make-3D-space #product-card').mouseenter(function(){
    $(this).addClass('animate');
    $('div.carouselNext, div.carouselPrev').addClass('visible');      
  }); 

  $('#make-3D-space #product-card').mouseleave(function(){
    $(this).removeClass('animate');     
    $('div.carouselNext, div.carouselPrev').removeClass('visible');
  }); 
  

});

$(document).ready(function(){

  $('.element-card').on('click', function(){

    if ( $(this).hasClass('open') ) {
      $(this).removeClass('open');
    } else {
      $('.element-card').removeClass('open');
      $(this).addClass('open');
    }
    
  });
  
});


