// JavaScript Document 

$(document).ready(function() {

$('.myCarousel').carousel({
  interval: 2000
})

var scroller = new StickyScroller("#publicidad",
        {
            start: 509,
            margin: 10
        });
$(function() {
		$( "#tabs" ).tabs();
	});	
		
});

	