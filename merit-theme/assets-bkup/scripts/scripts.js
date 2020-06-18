function menuIcon(){
	$("#menu-icon").click(function(e){
		e.preventDefault();
		$(this).toggleClass("active");
		$("header.banner").toggleClass("active");
		$(".nav-primary").toggleClass("active");
	});
}
		
function mobileDropdown(){
	$(".column h2").click(function(){
		if(!$(this).hasClass("open")){
			$(".column h2, .column ul").removeClass("open");
			$(this).toggleClass("open");
			$(this).next("ul").toggleClass("open");
		}else{
			$(this).removeClass("open");
			$(this).next("ul").removeClass("open");
		}
	});
}

function translatePage(){	
	$("a.translate").click(function(e){
		e.preventDefault();
		$(this).hide();
		$(".google_translate").css('display', 'inline-block');
	});
}
		
function createAccordion(){
	var allPanels = $(".accordion > .expand").hide();
	
	$(".accordion > h3 > a").click(function() {
		$this = $(this);
		$target =  $this.parent().next();
		
		if(!$target.hasClass("active")){
			$(".accordion > h3 > a").removeClass("active");
			$this.addClass("active");
			allPanels.removeClass("active").slideUp();
			$target.addClass("active").slideDown();
		}else{
			$this.removeClass("active");
			$target.removeClass("active").slideUp();
		}
		return false;
	});
}

function sponsorCarousel(){
	$(".carousel").slick({
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 1,
		responsive: [
			{
				breakpoint: 992,
				settings:{
					slidesToShow: 2,
					slidesToScroll: 1,
					infinite: true
				}
			},
			{
				breakpoint: 600,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}
		]
		
	});
}

function facultySearch(){
	$("#faculty-search .faculty:not(.none)").hide();
	$("#department-select").bind("change", function() {
	    $("." + this.value).show();
	    $(".faculty:not(." + this.value + ")").hide();
	});
	$("#view-all").click(function() {
		$(".faculty.none").hide();
		$(".faculty:not(.none)").show();
	});
}
		
function scrollParallax(){
	$(window).on("scroll touchmove", function () {
		
		// Resize Header on Scroll
		$("header.banner").toggleClass("narrow", $(document).scrollTop() > 100);
		
		// Parallax-effect on Homepage Banner content
		var scroll = $(document).scrollTop();
		var mastheadHeight = $("#masthead").outerHeight();
		var scrollPercent = (mastheadHeight - scroll) / mastheadHeight;
		$("#masthead.home .content, #masthead.image h1").css({ "bottom": scroll/2 + 45, "opacity": scrollPercent });
		
	});
}

function announcementBar(){
	if(Cookies.get("announcement") !== "closed"){
		$("#announcement").delay(800).slideDown(500);
	}
	$("#announcement .close").click(function() {
		Cookies.set("announcement", "closed");
		$("#announcement").slideUp(500);
	});		
}

function getValue( selector ){
    var value = $(selector).val();
    var returnSelector = '';
    if('all' !== value){
        returnSelector = '.' + value;
    }
    return returnSelector;
}

function filterCourses(){
    var ageValue = getValue('#course-age-filter');
    var instrumentValue = getValue('#course-instrument-filter');
    var programTypeValue = getValue('input:radio[name=course-program-filter]:checked');
    var categoryValue = getValue('#course-category-filter');

    $('.course-card').hide();
    $('#course-card-not-found').hide();
    var combinedSelector = ageValue  + instrumentValue + programTypeValue + categoryValue;
    if( '' === combinedSelector ){
        $('.course-card').show(); // show all cards
    } else {
        var jQResult = $(combinedSelector);
        if (jQResult.length > 0) {
            jQResult.show();
        } else {
            $('#course-card-not-found').show();
        }
    }
}

function setSelector( domSelector, varName ){
    if(typeof varName !== 'undefined' && null !== window[varName]){
        $(domSelector).val(window[varName]);
    }
}

function initCourseFeed() {
    $('#clear-filters').click( function(e){
        e.preventDefault();
        //$('.course-card').show();
		$('#course-card-not-found').hide();
        $('#course-age-filter').val('all');
        $('#course-instrument-filter').val('all');
        $('input:radio[name=course-program-filter][value=all]').prop('checked', true);
         filterCourses();
   });
    $('.course-filter').change(function (e) {
        filterCourses();
    });
    setSelector('#course-age-filter', 'selectedAge');
    setSelector('#course-category-filter', 'selectedCategory');
    setSelector('#course-instrument-filter', 'selectedInstrument');
    if(typeof selectedProgram !== 'undefined'){
        $('input:radio[name=course-program-filter][value=' + selectedProgram + ']').prop('checked', true);
    }
    filterCourses();
}

function initCoursePage(){
    $('#page-title').html(courseTitle);
    $('#course-detail-title').hide();
    $(".register-popup").colorbox({inline:true, width:"50%"});
   if($('input:radio[name=course-detail-section]').length > 0 ){
        $('input:radio[name=course-detail-section]').change(function(e) {
            //console.log($(e.target).data('url'));
            $(".course-register-button").attr('href', $(e.target).data('url'));
        });
        $('input:radio[name=course-detail-section]').first().prop('checked', true);
    }
}
		
/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */
 
(function ($) {
	
    // Use this variable to set up the common and page specific functions. If you
    // rename this variable, you will also need to rename the namespace below.
    var Sage = {
        // All pages
        'common': {
            init: function () {
				menuIcon();
				mobileDropdown();
				translatePage();
				createAccordion();
                sponsorCarousel();
                scrollParallax();
                announcementBar();
                initCourseFeed();
            },
            finalize: function () {
                // JavaScript to be fired on all pages, after page specific JS is fired
            }
        },
        'home': {
            init: function () {
                // JavaScript to be fired on the home page
            },
            finalize: function () {
                // JavaScript to be fired on the home page, after the init JS
            }
        },
        'faculty_staff': {
            init: function () {
	           	facultySearch();
            }
        },
        'course': {
            init: function() {
                initCoursePage();
            }
        }
    };

    // The routing fires all common scripts, followed by the page specific scripts.
    // Add additional events for more control over timing e.g. a finalize event
    var UTIL = {
        fire: function (func, funcname, args) {
            var fire;
            var namespace = Sage;
            funcname = (funcname === undefined) ? 'init' : funcname;
            fire = func !== '';
            fire = fire && namespace[func];
            fire = fire && typeof namespace[func][funcname] === 'function';

            if (fire) {
                namespace[func][funcname](args);
            }
        },
        loadEvents: function () {
            // Fire common init JS
            UTIL.fire('common');

            // Fire page-specific init JS, and then finalize JS
            $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function (i, classnm) {
                UTIL.fire(classnm);
                UTIL.fire(classnm, 'finalize');
            });

            // Fire common finalize JS
            UTIL.fire('common', 'finalize');
        }
    };

    // Load Events
    $(document).ready(UTIL.loadEvents);

})(jQuery);

