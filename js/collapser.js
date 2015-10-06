$(function(){
	 
"use strict";	 

    var $menu          = $('.menu_container'),
        $menu_ul       = $('ul', $menu),
        $collapser     = $('.mobile_collapser', $menu),
        $lihasdropdown = $('.menu_container ul li').has( ".dmui_dropdown_block" ),
        $sublihasdropdown = $('.menu_container ul li ul li').has( ".dmui-submenu" ),
        $subsublihasdropdown = $('.menu_container ul li ul li ul li').has( ".dmui-submenu" );


    $collapser.on('click', function(){
        $menu_ul.toggleClass('collapsed');
    })
    
    $lihasdropdown.addClass('has-dropdown');
    $sublihasdropdown.addClass('subli has-dropdown');
    $subsublihasdropdown.addClass('subsubli').removeClass('subli');

    $lihasdropdown.on('click', 'a', function(e){
        $lihasdropdown.not( $(this).parent() ).children(".dmui_dropdown_block").removeClass("show");
        $sublihasdropdown.children(".dmui-submenu").removeClass('show');
        $(this).next(".dmui_dropdown_block").toggleClass("show");

        e.stopPropagation();
    });

    $('.subli.has-dropdown').on('click', 'a', function(e){
        
        $sublihasdropdown.not( $(this).parent() ).children(".show").removeClass("show");
        $(this).next(".dmui-submenu").toggleClass("show");
        
        e.stopPropagation();
    });

    $('.subsubli.has-dropdown').on('click', 'a', function(e){
        
        $subsublihasdropdown.not( $(this).parent() ).children(".show").removeClass("show");
        $(this).next(".dmui-submenu").toggleClass("show");
        
        e.stopPropagation();
    });

    // HIDE DROPDOWN MENU WHEN CLICKING ELSEWHERE (v1.0.2)
    if (window.matchMedia("(min-width: 767px)").matches) {      
        $(document.body).on('click', function(){
            $lihasdropdown
            .children(".dmui_dropdown_block").removeClass('show')
            .children(".dmui-container").removeClass('show');
        $sublihasdropdown
            .children(".dmui-submenu").removeClass('show');    
        })
    }

});

// FIX Menu Resize Bug from mobile to desktop (Thanks to irata for fixing that!) (v1.0.2)
$(window).resize(function(){
		      
"use strict";		      

$('.menu_container ul').removeClass('collapsed'); 

});