jQuery.fn.extend({
    live: function (event, callback) {
        if (this.selector) {
            jQuery(document).on(event, this.selector, callback);
        }
    }
});

// Avoid `console` errors in browsers that lack a console.
if (!(window.console && console.log)) {
	(function() {
		var noop = function() {};
		var methods = ['assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error', 'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log', 'markTimeline', 'profile', 'profileEnd', 'markTimeline', 'table', 'time', 'timeEnd', 'timeStamp', 'trace', 'warn'];
		var length = methods.length;
		var console = window.console = {};
		while (length--) {
			console[methods[length]] = noop;
		}
	}());
}


(function ($) {

    
	"use strict";

	$(function(){

                if($('body').hasClass('mobilescreen')){
                    var lastScrollTop = 0;
                    $(window).scroll(function() {
                            var top = $(window).scrollTop();
                            if (top > lastScrollTop){
                                // downscroll code
                                $('#header_wrapper').removeClass('header_fixed');
                                $('#header_wrapper').css({'overflow':'visible'});
                            } else {
                                if(top>300 && !$('#header_wrapper').hasClass('header_fixed')){
                                    $('#header_wrapper').hide();
                                    $('#header_wrapper').addClass('header_fixed');
                                    $('#header_wrapper').slideDown(200);
                                }
                            }
                            lastScrollTop = top;
                    });
                }

		$(document)
		.on('click', function(e) {
			if ( $(this).is( '[data-toggle]' ) === false ) {
				$('[data-toggled]').each(function(e) {
					if ( $(this).hasClass( $(this).attr('data-toggled') ) ) {
						$(this).toggleClass( $(this).attr('data-toggled') );
						$(this).removeAttr('data-toggled');
					}
				});
                                if($('body').hasClass('mobilescreen'))
                                    $('#header_wrapper').css({'position':'absolute'});
			}
                        
                        
//                         $('.navbar-nav li.nav-all.active a').each(function(){
//                                $(this).trigger('click');
//                        });

		})
		.on('click', '[data-toggle][href="#"]', function(e) {
			e.stopPropagation();
			e.preventDefault();
                        
                        $('.navbar-nav li.nav-all.active a').each(function(){
                                $(this).trigger('click');
                        });
                        
			var $target = $(this).closest( $(this).data('toggle') );
//                        if($target.hasClass('toggled-in'))
//                            return;
                        
			var class_name = ( $(this).data('toggle-class') ) ? $(this).data('toggle-class') : 'toggled-in';
			$target.toggleClass( class_name );

			if ( $target.hasClass( class_name ) ) {
                                if($('body').hasClass('mobilescreen'))
                                    $('#header_wrapper').css({'position':'fixed','overflow':'visible'});
                            
				$target.attr('data-toggled', class_name );
				var $input = $target.find('input');
				
				if ( $input.size() > 0 ) {
					$input[0].focus();
				}
			} 
                        else {
                            if($('body').hasClass('mobilescreen'))
                                $('#header_wrapper').css({'position':'absolute'});
                            $target.removeAttr('data-toggled');
			}

			if ( $( '.subnav-tabbed-panel:first', $target ).size() > 0 ) {
				$( '.subnav-tabbed-panel:first img[data-src]', $target ).unveil();
			}

			var $siblings = $target.siblings('.' + class_name );
			$siblings.find( '.' +class_name ).toggleClass(class_name).removeAttr('data-toggled');
			$siblings.toggleClass( class_name ).removeAttr( 'data-toggled' );

		})
                

		.on( 'click', '.js-stoppropagation', function(e) {
			e.stopPropagation();
		})

		.on('click', '.js .collapsible-widgets .widget-title', function(e) {
			if ( $(this).closest('.widget').hasClass('active') ) {
				$(this).closest('.widget').removeClass('active');
			} else {
				$(this).closest('.widget').addClass('active').siblings().removeClass('active');
			}
			
			$(window).trigger('scroll');
		})
		.on('mouseover', '.subnav-tabbed-tabs a', function(e) {
			e.preventDefault();
			$(this).closest('li').addClass('active').siblings().removeClass('active');
			$( $(this).attr('href') ).addClass('active').siblings().removeClass('active');

			$('img[data-src]', $(this).attr('href') ).unveil();

		})
		.on('mouseover', '.full-subnav-wrapper', function(e) {

			if ( $( '.subnav-tabbed-panel:first', $(this) ).size() > 0 ) {
				$( '.subnav-tabbed-panel:first img[data-src]', $(this) ).unveil();
			}

		})
		.on('click', '.nav-tabs a', function (e) {
			e.preventDefault();
			$(this).tab('show');
		});

		$('.js .collapsible-widgets .widget:first .widget-title').trigger('click');

//		$('#brand img[data-src]').unveil();

//		$('#main img[data-src]').unveil(200, function() {
//			$(this).load(function() {
//				this.style.opacity = 1;
//			});
//		});

		$(window).trigger('scroll');


	});


            $(document).delegate('a.uytget','click',function(e){
                 try{ 
                    var dialog_id=$(this).data('dialog_id');
                    var url=$(this).attr('href');
                    
                    if(dialog_id.length>0 && url.length>0)
                    {
                        $(document.body).append('<div id="'+dialog_id+'"></div>');
                        $.ajax({
                            url: url,             
                            success: function (data, textStatus) { 
                                $('#'+dialog_id).html(data);
                            } 
                        });
                    }
                }catch (e) {
                        var data={
                            status:'error',
                            message:'Yalnyshlyk boldy tazeden barlap gorun'+e
                        }
                        setMessage(data.status,data.message);
                }
                e.preventDefault();
                return false;
            });
            

//------------------------------comments --------------------------------------------
            $(document).delegate('.like_button','click',function(){
                try{
                    var like_button=$(this);
                    if(!like_button.hasClass('liked')){
                        var comment_id=like_button.data('comment_id');
                        var url = like_button.attr('href');
                        if(comment_id!=undefined){
                            $.ajax({
                                    url: url,
                                    type: 'get',
                                    // data: 'id=' + comment_id,
                                    success: function(data) {
                                         var data = $.parseJSON(data);
                                         setMessage(data.status,data.message);
                                         if(data.status=='success'){
                                             var like=like_button.parents('.comment_box').find('.like');
                                             var qnt=like.data('qnt');
                                             like.html(qnt+1);
                                             like.data('qnt',qnt+1);
                                             like_button.addClass('liked');
                                         }
                                    }
                            }); 
                        }
                    }
                }
                catch(e){
                    console.log(e);
                }
                return false;
        });
        
        
        
        $(document).delegate('.dislike_button','click',function(){
                try{
                    var dislike_button=$(this);
                    if(!dislike_button.hasClass('disliked')){
                        var comment_id=dislike_button.data('comment_id');
                        var url=dislike_button.attr('href');
                        if(comment_id!=undefined){
                            $.ajax({
                                    url: url,
                                    type: 'get',
                                    // data: 'id=' + comment_id,
                                    success: function(data) {
                                         var data = $.parseJSON(data);
                                         setMessage(data.status,data.message);
                                         if(data.status=='success'){
                                             var like=dislike_button.parents('.comment_box').find('.dislike');
                                             var qnt=like.data('qnt');
                                             like.html(qnt+1);
                                             like.data('qnt',qnt+1);
                                             dislike_button.addClass('disliked');
                                         }
                                    }
                            }); 
                        }
                    }
                }
                catch(e){
                    console.log(e);
                }
                return false;
        });
        
        
        
        $(document).delegate('.reply_button','click',function(){
                try{
                    $('#reply_form .form').remove();
                    var reply_button=$(this);
                    var comment_id=reply_button.data('comment_id');
                    var url=reply_button.attr('href');
                    if(comment_id!=undefined){
                        $.ajax({
                                url: url,
                                type: 'post',
                                // data: 'parent_id=' + comment_id,
                                success: function(data) {
                                    reply_button.parents('.comment_tools').find('#reply_form').html(data);
//                                     var data = $.parseJSON(data);
//                                     setMessage(data.status,data.message);
//                                     if(data.status=='success'){
//                                         var qnt=like.data('qnt');
//                                         like.html(qnt+1);
//                                         like.data('qnt',qnt+1);
//                                         like_button.addClass('disliked');
//                                     }
                                }
                        }); 
                    }
                }
                catch(e){
                    console.log(e);
                }
                return false;
        });









        function setMessage(status, message) {
            console.log('status: '+status+' message: '+message);
            
        }

        })(window.jQuery);





function date_time_tm(id)
{
        
        date = new Date;
        year = date.getFullYear();
        month = date.getMonth();
        months = new Array('Ýanwar', 'Fewral', 'Mart', 'Aprel', 'Maý', 'Iýun', 'Iýul', 'Awgust', 'Sentýabr', 'Oktýabr', 'Noýabr', 'Dekabr');
        d = date.getDate();
        day = date.getDay();
        days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
        h = date.getHours();
        if(h<10)
        {
                h = "0"+h;
        }
        m = date.getMinutes();
        if(m<10)
        {
                m = "0"+m;
        }
        s = date.getSeconds();
        if(s<10)
        {
                s = "0"+s;
        }
//        result = ''+days[day]+' '+months[month]+' '+d+' '+year+' '+h+':'+m+':'+s;
        result = ''+months[month]+' '+d+', '+year+' '+h+':'+m+':'+s;
        if(document.getElementById(id)!=null && document.getElementById(id)!=undefined){
            document.getElementById(id).innerHTML = result;
            setTimeout('date_time_tm("'+id+'");','1000');
        }
        return true;
}


function date_time_ru(id)
{
        date = new Date;
        year = date.getFullYear();
        month = date.getMonth();
        months = new Array('Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь');
        d = date.getDate();
        day = date.getDay();
        days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
        h = date.getHours();
        if(h<10)
        {
                h = "0"+h;
        }
        m = date.getMinutes();
        if(m<10)
        {
                m = "0"+m;
        }
        s = date.getSeconds();
        if(s<10)
        {
                s = "0"+s;
        }
        
        
//        result = ''+days[day]+' '+months[month]+' '+d+' '+year+' '+h+':'+m+':'+s;
        result = ''+months[month]+' '+d+', '+year+' &nbsp;'+h+':'+m+':'+s;
        var element=document.getElementById(id);
        if(element!=undefined)
            element.innerHTML = result;
        
        setTimeout('date_time_ru("'+id+'");','1000');
        return true;
}

var debounce = function(func, wait, immediate) {
  var timeout, result;
  return function() {
    var context = this, args = arguments;
    var later = function() {
      timeout = null;
      if (!immediate) result = func.apply(context, args);
    };
    var callNow = immediate && !timeout;
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
    if (callNow) result = func.apply(context, args);
    return result;
  };
} 

function pagesize_mine(){
    if($(window).width() >= 765){
        $('.indexLink.blueColor').show();
        $('.sidebar').show();
        $("body").removeClass("mobilescreen").addClass("bigscreen");
    }
    else{
        $('.indexLink.blueColor').hide();
        // $('.sidebar').hide();
        $("body").addClass("mobilescreen").removeClass("bigscreen");
    }
}


$(document).ready(function(){
// 
// var data={};
// data.message={};
// data.message="test";
// data.redirect={};
// data.redirect="test";
// 
// clientConfirmDialog(data);
//    
//    alert('pagesize_mine'+$(window).width());



  pagesize_mine();
  inputOnlyDigit('validate_number');
  // aziadaCountDown()

  $(window).resize(debounce(pagesize_mine,100));
  
    $(document).delegate('.ajaxLogin','click',function(e){
                e.preventDefault();
                var li=$(this).parent('li');
                $('.navbar-nav li.active a').each(function(){
                    if(!$(this).hasClass('ajaxLogin'))
                        $(this).trigger('click');
                });
               
               $('[data-toggled]').each(function(e) {
                        if ( $(this).hasClass( $(this).attr('data-toggled') ) ) {
                                $(this).toggleClass( $(this).attr('data-toggled') );
                                $(this).removeAttr('data-toggled');
                        }
                });
               
                if($(".nav-popup").hasClass("opened"))
                {
                    $(".nav-popup").removeClass("opened");   
                    $(".nav-popup").slideUp(300);   
                    li.removeClass('active');
                    $('.background_glow').hide();
                }else{
                   
                    var url=$(this).attr('href');
                    $.ajax({
                            url: url,
                            type: 'get',
                            beforeSend:function(){
                                $(".nav-popup").addClass("opened");   
                                var loading='<div class="loading"></div>';
                                $("#nav-popup-inner").html(loading);
                                $(".nav-popup").css({'min-height':'250px'});
                                $(".nav-popup").slideDown(500);
                            },
                            complete:function(data){ 
                                $("#nav-popup-inner .loading").remove();
                                $(".nav-popup").css({'min-height':'10px'});
                             },
                            success: function(data){
                                try {
                                    $("#nav-popup-inner").html(data);
                                    $('ul.config-panel li.active').removeClass('active');
                                    li.addClass('active');
                                    $('.background_glow').show();
                                 } catch (e) {
                                    var data={
                                        status:"error",
                                        message:"Yalnyshlyk boldy tazeden barlap gorun"
                                    }
                                 }
                            }
                    }); 
                }
                return false;
            });
            
            
    $(document).delegate('.close_panel','click',function(e){
        if($(".nav-popup").hasClass("opened"))
        {
            $(".nav-popup").removeClass("opened");   
            $(".nav-popup").slideUp(600);   
            $('li.nav-all.active').removeClass('active');
        }
    });
    
    $(document).delegate('.ajaxSearch','click',function(e){
                e.preventDefault();
                var li=$(this).parent('li');
                $('.navbar-nav li.active a').each(function(){
                    if(!$(this).hasClass('ajaxSearch'))
                        $(this).trigger('click');
                });
                
                $('[data-toggled]').each(function(e) {
                        if ( $(this).hasClass( $(this).attr('data-toggled') ) ) {
                                $(this).toggleClass( $(this).attr('data-toggled') );
                                $(this).removeAttr('data-toggled');
                        }
                });
               
                if(li.hasClass('active'))
                {
                    li.removeClass('active');
                    $('.searchPanel').hide();
                    $('.background_glow').hide();
                }else{
                    li.addClass('active');
                    $('.searchPanel').show();
                    $('.background_glow').show();
                }
                
                return false;
    });
   
    
    $(document).delegate('.background_glow','click',function(e){
             $('.navbar-nav li.active a').each(function(){
                    $(this).trigger('click');
            });
    });
            
            
//    $(document).delegate('.table-tp tr','hover',
//            function(){
//                console.log('on');
//            },
//            function(){
//                console.log('off');
//            }
//    );
//            
            
    $('#topOfPage').click(function(){
            $('html, body').animate({scrollTop:0}, 1500);
	});
	
	$(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $('#topOfPage').fadeIn('slow');
        } else {
            $('#topOfPage').fadeOut('slow');
        }
    });
            
            
            
    $(".content #nav .has_sub > a").on('click',function(e){
        if($(this).parents(".content:first").hasClass("enlarged")){
          e.preventDefault();
          return false;
        }

        if($(this).parent().hasClass("has_sub")) {
          e.preventDefault();
        }   

        if(!$(this).hasClass("subdrop")) {
          // hide any open menus and remove all other classes
          $("ul",$(this).parents("ul:first")).slideUp(350);
          $("a",$(this).parents("ul:first")).removeClass("subdrop");
          $("#nav .pull-right i").removeClass("icon-fa-chevron-down").addClass("icon-fa-chevron-left");

          // open our new menu and add the open class
          $(this).next("ul").slideDown(350);
          $(this).addClass("subdrop");
          $(".pull-right i",$(this).parents(".has_sub:last")).removeClass("icon-fa-chevron-left").addClass("icon-fa-chevron-down");
          $(".pull-right i",$(this).siblings("ul")).removeClass("icon-fa-chevron-down").addClass("icon-fa-chevron-left");
        }else if($(this).hasClass("subdrop")) {
          $(this).removeClass("subdrop");
          $(this).next("ul").slideUp(350);
          $(".pull-right i",$(this).parent()).removeClass("icon-fa-chevron-down").addClass("icon-fa-chevron-left");
          //$(".pull-right i",$(this).parents("ul:eq(1)")).removeClass("icon-fa-chevron-down").addClass("icon-fa-chevron-left");
        } 
    });
            
});


function clientFormReset(){
    $("#Catalog_catalog_category_id").val("");
    $('#dynamicForm').html('');
}



function clientConfirmDialog(data){
    $.confirm({
            text: data.message,
            title: data.message,
            confirm: function() {
                location.href=data.redirect;
            },
            cancel: function() {
                clientFormReset();
            },
            confirmButton: "Hawa",
            cancelButton: "Yok",
    });
}


function inputOnlyDigit(element_class) {
        //input only digits
        $(document).delegate('.'+element_class,'keydown',function(event) {
       // Allow: backspace, delete, tab, escape, enter and .
        if ( $.inArray(event.keyCode,[46,8,9,27,13,190,110]) !== -1 ||
             // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) || 
             // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault(); 
            }   
        }
    });
}


function aziadaCountDown(lang){
    // $(function () {
    //     var austDay = new Date();
    //     austDay = new Date(2017, 8, 17, 17,0,0,0);
    //     if(lang=='tm')
    //         $('#defaultCountdown').countdown({until: austDay,  padZeroes: true, labels: ['Ýyl', 'Aý', 'Hepde', 'Gün', 'Sagat', 'Minut', 'Sekund']});
    //     else
    //         $('#defaultCountdown').countdown({until: austDay,  padZeroes: true, labels: ['Год', 'Месяц', 'Неделя', 'Дней', 'Часов', 'Минут', 'Секунд']});
    // });
}