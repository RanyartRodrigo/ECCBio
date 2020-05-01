 function curso(este){
            var $form=$(document.createElement("form")).css({display:"none"}).attr("method","POST").attr("action",host+"curso.php");
            var $input=$(document.createElement("input")).attr("name","nombre").val(este.title);
            $form.append($input);
            $("body").append($form);
            $form.submit();
          }
        
    /*
        Portfolio
    */

    
    $('.curso-a a').on('click', function(e){
        e.preventDefault();
        if(!$(this).hasClass('active')) {
            $('.curso-a a').removeClass('active');
            var clicked_filter = $(this).attr('class').replace('filter-', '');
            $(this).addClass('active');
            if(clicked_filter != 'all') {
                $('.curso-b:not(.' + clicked_filter + ')').css('display', 'none');
                $('.curso-b:not(.' + clicked_filter + ')').removeClass('box');
                $('.' + clicked_filter).addClass('box');
                $('.' + clicked_filter).css('display', 'block');
                $('.CURSOS').masonry();
            }
            else {
                $('.CURSOS > div').addClass('box');
                $('.CURSOS > div').css('display', 'block');
                $('.CURSOS').masonry();
            }
        }
    });
        $(window).on('resize', function(){

        new WOW().init();});
    


$(document).ready(function(){
        $('.CURSOS').masonry({
        columnWidth: '.box', 
        itemSelector: '.box',
        transitionDuration: '0.5s'
    });
            // image popup  
    $('.curso-b img').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0,1] // Will preload 0 - before current, and 1 after the current image
        },
        image: {
            tError: 'The image could not be loaded.',
            titleSrc: function(item) {
                return item.el.siblings('.curso-c').find('h3').text();
            }
        },
        callbacks: {
            elementParse: function(item) {              
                if(item.el.hasClass('portfolio-video')) {
                    item.type = 'iframe';
                    item.src = item.el.data('portfolio-video');
                }
                else {
                    item.type = 'image';
                    item.src = item.el.attr('src');
                }
            }
        }
    });
/*
        Image popup (home latest work)
    */
    $('.view-work').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0,1] // Will preload 0 - before current, and 1 after the current image
        },
        image: {
            tError: 'The image could not be loaded.',
            titleSrc: function(item) {
                return item.el.parent('.work-bottom').siblings('img').attr('alt');
            }
        },
        callbacks: {
            elementParse: function(item) {
                item.src = item.el.attr('href');
            }
        }
    });
                            $(".slider-2-container").backstretch(["/static/uploads/galeria_MoFuSS/5.jpg","/static/uploads/galeria_MoFuSS/6.jpg","/static/uploads/galeria_MoFuSS/7.jpg","/static/uploads/galeria_MoFuSS/8.jpg","/static/uploads/galeria_MoFuSS/9.jpg","/static/uploads/galeria_MoFuSS/10.jpg","/static/uploads/galeria_MoFuSS/11.jpg","/static/uploads/galeria_MoFuSS/12.jpg","/static/uploads/galeria_MoFuSS/13.jpg","/static/uploads/galeria_MoFuSS/14.jpg","/static/uploads/galeria_MoFuSS/15.jpg","/static/uploads/galeria_MoFuSS/16.jpg","/static/uploads/galeria_MoFuSS/17.jpg","/static/uploads/galeria_MoFuSS/18.jpg","/static/uploads/galeria_MoFuSS/19.jpg","/static/uploads/galeria_MoFuSS/20.jpg","/static/uploads/galeria_MoFuSS/21.jpg","/static/uploads/galeria_MoFuSS/22.jpg","/static/uploads/galeria_MoFuSS/24.jpg","/static/uploads/galeria_MoFuSS/25.jpg","/static/uploads/galeria_MoFuSS/26.jpg","/static/uploads/galeria_MoFuSS/27.jpg","/static/uploads/galeria_MoFuSS/28.jpg","/static/uploads/galeria_MoFuSS/29.jpg","/static/uploads/galeria_MoFuSS/30.jpg","/static/uploads/galeria_MoFuSS/31.jpg","/static/uploads/galeria_MoFuSS/32.jpg","/static/uploads/galeria_MoFuSS/33.jpg","/static/uploads/galeria_MoFuSS/35.jpg","/static/uploads/galeria_MoFuSS/36.jpg","/static/uploads/galeria_MoFuSS/37.jpg","/static/uploads/galeria_MoFuSS/38.jpg"
                        ], {duration: 3000, fade: 750});
        new WOW().init();
    });
$(document).ready(function(){

	/*
	    Subscription form
	*/
	$('.success-message').hide();
	$('.error-message').hide();
	
	$('#correo').click(function() {
		
		var form = $(this.title);
	    var postdata = form.serialize();
	    
	    $.ajax({
	        type: 'POST',
	        url: 'assets/subscribe.php',
	        data: postdata,
	        dataType: 'json',
	        success: function(json) {
	            if(json.valid == 0) {
                    alert();
	                $('.success-message').hide();
	                $('.error-message').hide();
	                $('.error-message').php(json.message);
	                $('.error-message').fadeIn();
	            }
	            else {
	                $('.error-message').hide();
	                $('.success-message').hide();
	                form.hide();
	                $('.success-message').php(json.message);
	                $('.success-message').fadeIn();
	            }
	        }
	    });
	});
    
	
});
function cargarContenido(file,este){
window.location.href=file;}

function MapOf(place){
window.location.href=place;
}
