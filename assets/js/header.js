/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var checker = function(item1, item2, item3) {
    if (item1 || item2 || item3) {
        jQuery('.subcatagories').toggleClass('hidden');
    }
    if (item1) {
        //window.alert(item1);
        temp = '.menu-' + item1;
        $(temp).css({
            "background-color" : "#ffffff"
        });
        temp = '.m' + item1;
        $(temp).css({
            "color" : "#666062"
        });
        temp = '#' + item1 + '-links';
        jQuery( temp).toggleClass('hidden');
    }
    if (item2) {
        temp = '.menu-' + item2;
        $(temp).css({
            "background-color" : "#ffffff"
        });
        temp = '.m' + item2;
        $(temp).css({
            "color" : "#666062"
        });
        temp = '#' + item2 + '-links';
        jQuery( temp).toggleClass('hidden');
    }
    if (item3) {
        temp = '.menu-' + item3;
        $(temp).css({
            "background-color" : "#ffffff",
        });
        temp = '.m' + item3;
        $(temp).css({
            "color" : "#666062"
        });
        temp = '#' + item3 + '-links';
        jQuery( temp).toggleClass('hidden');
    }
};

var main = function() {
    var about, involvement, resources, media;
    $('.menu-about').mouseenter(function() {
        if (!about) {
            about = 'about';
            //window.alert(about);
            $(this).css({
                "background-color": "#f9b625"
            });
            $('.mabout').css({
                "color": "#ffffff"
            });
            jQuery('#about-links, .subcatagories').toggleClass('hidden');
        }
        /*$('.subcatagories').css({
            "background-color": "#f9b625"
        });*/
        checker(involvement, resources, media);
        involvement = resources = media = "";
    });
    
    /*$('.menu-about, #about-links').mouseout(function() {
        //window.alert("leaving");
        if (!$('#about-links').mouseover()) {
            //window.alert("not entering links");
            about = "";
            //window.alert(about);
            $('.menu-about').css({
                "background-color" : "#ffffff",
                "font-family" : "FreightSansProLight",
                "color" : "#666062"
            });
            jQuery('#about-links, .subcatagories').toggleClass('hidden');
        }
        /*$('.subcatagories').css({
            "background-color": "#f9b625"
        });*//*
        checker(involvement, resources, media);
        involvement = resources = media = "";
    });*/
    
    $('.menu-involvement').mouseenter(function() {
        if (!involvement) {
            involvement = 'involvement';
            //window.alert(about);
            $(this).css({
                "background-color": "#f9b625"
            });
            $('.minvolvement').css({
                "color": "#ffffff"
            });
            jQuery('#involvement-links, .subcatagories').toggleClass('hidden');

        }
        checker(about, resources, media);
        about = resources = media = "";
    });
    
    $('.menu-resources').mouseenter(function() {
        if (!resources) {
            resources = 'resources';
            //window.alert(about);
            $(this).css({
                "background-color": "#f9b625"
            });
            $('.mresources').css({
                "color": "#ffffff"
            });
            jQuery('#resources-links, .subcatagories').toggleClass('hidden');
        }
        checker(involvement, about, media);
        involvement = about = media = "";
    });
    
    $('.menu-media').mouseenter(function() {
        if (!media) {
            media = 'media';
            //window.alert(about);
            $(this).css({
                "background-color": "#f9b625"
            });
            $('.mmedia').css({
                "color": "#ffffff"
            });
            jQuery('#media-links, .subcatagories').toggleClass('hidden');
        }
        checker(involvement, resources, about);
        involvement = resources = about = "";
        
    });
};

var sourceSwap = function () {
    var $this = $(this);
    var newSource = $this.data('alt-src');
    $this.data('alt-src', $this.attr('src'));
    $this.attr('src', newSource);
};

$(function () {
    $('img.central').hover(sourceSwap, sourceSwap);
});

$(document).ready(main);