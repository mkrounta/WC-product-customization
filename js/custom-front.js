/* jQuery(document).ready(function($){
	alert('hi');
}); */

jQuery( document ).ready(function($) {



/* $('.cst_nxt').click(function(e) {
e.preventDefault();
	var inputs = $(this).siblings("input[required='required']");
	var current =

   inputs.each(function() {

    if ($(this).val() !== "") {

      $(this).parents(".panel-default").next('.panel-default').find('.collapse').addClass('in');

      return false;
    }
  });
}); */

	$('.collapse').on('shown.bs.collapse', function(){
    $(this).parent().find(".glyphicon-plus").removeClass("glyphicon-plus").addClass("glyphicon-minus");
});

$('.collapse').on('hidden.bs.collapse', function(){
    $(this).parent().find(".glyphicon-minus").removeClass("glyphicon-minus").addClass("glyphicon-plus");
});

	$(".minmaxwidth").focusout(function(){
		checkwidth = $(this).val();
		if(checkwidth<2000){
			$(this).val('');
			$('.minmaxwidth_er').text( "Minimum value is 2000mm" );

		}
		if(checkwidth>5000){
			$(this).val('');
			$('.minmaxwidth_er').text( "maximum value is 5000mm" );

		}
	});

	$(".minmaxheight").focusout(function(){
		checkwidth = $(this).val();
		if(checkwidth<1900){
			$(this).val('');
			$('.minmaxheight_er').text( "Minimum value is 1900mm" );

		}
		if(checkwidth>3000){
			$(this).val('');
			$('.minmaxheight_er').text( "maximum value is 3000mm" );

		}
	});

	$(".minmaxwidth").keyup(function(){
		$('.minmaxwidth_er').text( "" );
		$('.minmaxheight_er').text( "" );
	});
	$(".minmaxheight").keyup(function(){
		$('.minmaxwidth_er').text( "" );
		$('.minmaxheight_er').text( "" );
	});

//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

jQuery(".next").click(function(){

	var checknotnl='';
	$(this).siblings('.form-control').each(function(){
    checknotnl = $(this).val();
	if(checknotnl==''){
		 return false;
	}
  });

  if(checknotnl==''){
	 checknotnl =  $(this).siblings('.row').find('.radiobtn:checked').val();

	 /* if(checknotnl=='undefined'){

		 $('.minmaxheight_erclr').text( "select a color" );
	 } */
	}

	if(!checknotnl==''){
		if(animating) return false;
	animating = true;

	current_fs = jQuery(this).parent();
	next_fs = jQuery(this).parent().next();



	//show the next fieldset
	next_fs.show();
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({
        'transform': 'scale('+scale+')',
        'position': 'absolute'
      });
			next_fs.css({'left': left, 'opacity': opacity});
		},
		duration: 800,
		complete: function(){
			current_fs.hide();
			animating = false;
		},
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
	}
	else{
		$('.minmaxheight_er').text( "All field required" );
	}

});

jQuery(".previous").click(function(){

	if(animating) return false;
	animating = true;

	current_fs = jQuery(this).parent();
	previous_fs = jQuery(this).parent().prev();



	//show the previous fieldset
	previous_fs.show();
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = ((1-now) * 50)+"%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'left': left});
			previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
		},
		duration: 800,
		complete: function(){
			current_fs.hide();
			animating = false;
		},
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
	$(".myfieldsetcls").css( "position", "relative" );
});

jQuery(".submit").click(function(){
	return false;
});


jQuery(".cst_nxt").click(function(){
	var number = $(this).parents('.panel-collapse').find("input[type='number']");
	var radiob = $(this).parents('.panel-collapse').find("input[type='radio']");
	var numexists = false;
	var radexists = false;
	var clickable = false;
	if($(this).hasClass('instaopt')){
		clickable = true;
	}
	else if(number.length>0){
		number.each(function() {
		if ($(this).val() !== "") {
		clickable = true;
		}
		else{
		clickable = false;
		return false;
		}
		});
	}
	else if(radiob.length>0){
		radiob.each(function() {
		if ($(this).prop("checked") == true) {
		clickable = true;
		return false;
		}
		else{
		clickable = false;
		}
		});
	}

  if(clickable){
	$(this).siblings('.visiblenone').trigger('click');

	/// Scroll To Top of next section //

	// console.log(this);

	// var scrollTo = $('.collapse.in');
	// var $container = $("html,body");
	//
	//
	setTimeout(
  function()
  {
		var $container = $("html,body");
		var $scrollTo = $('.collapse.in');

		$container.animate({scrollTop: $scrollTo.offset().top - $container.offset().top - 50 },300);
  }, 400);





	var product_id = $('.product_id').val();
	if($(this).hasClass('firstnextcls')){
	width =  $(this).siblings('.row').find('.minmaxwidth').val();
	height =  $(this).siblings('.row').find('.minmaxheight').val();


		if(!width=='' && !height==''){
			jQuery.ajax({
				type : "post",
				url : myAjax.ajaxurl,
				data : {action: "product_changeprice_ajax_request", width : width, height: height, product_id : product_id },
			success: function(response) {
				var resp = jQuery.parseJSON(response);
				$('.price--door span').html(myAjax.currency+resp.main);

				 $(".radiobtn").prop("checked", false);
				 $(".radiobtn1").prop("checked", false);
					$('.price--total span').html(myAjax.currency+resp.ttl);


					$('.price--options span').html('£0.00');
					$('.price--extras span').html('£0.00');
					$('.price--instopt span').html('£0.00');
					$('#cstwmm').html('mm');
					$('#csthmm').html('mm');
					$('.options--headroom').html('');
					$('.options--leftside').html('');
					$('.options--rightside').html('');
					$('.options--fixing').html('');
					$('.options--lintel').html('');
					$('.options--curtain').html('');
					$('.options--frame').html('');
					$('.options--intalloptons').html('');
					$('.order-extras .extras').html('');
					$('#headroom').val(' ');
					$('#leftside').val(' ');
					$('#rightside').val(' ');



				  $(".disbledatgf").removeClass("disbledatg");
				  $(".myaddtocrtbtn").removeClass("disbledatg");

				  $('#cstwmm').html(width+" mm");
				  $('#csthmm').html(height+" mm");

				//location.reload(true);
				//console.log(response);
			}
		});
		}
	}
	if($(this).hasClass('thirdnxt')){
	var headroom =  $(this).siblings('.row').find('#headroom').val();
	var leftside =  $(this).siblings('.row').find('#leftside').val();
	var rightside =  $(this).siblings('.row').find('#rightside').val();

			jQuery.ajax({
				type : "post",
				url : myAjax.ajaxurl,
				data : {action: "cst_save_val_session", headroom : headroom, leftside: leftside, rightside : rightside, product_id:product_id },
			success: function(response) {
				jQuery('.options--headroom').html("<b>Headroom: </b>"+headroom+' mm');
				jQuery('.options--leftside').html("<b>Left Side: </b>"+leftside+' mm');
				jQuery('.options--rightside').html("<b>Right Side: </b>"+rightside+' mm');
				//location.reload(true);
				//console.log(response);
			}
		});
	}
	if($(this).hasClass('fxngnxt')){
	var fixing =  $("input[name='fixing']:checked").val();
	var fixing_val =  fixing.replace(' ', '_');

			jQuery.ajax({
				type : "post",
				url : myAjax.ajaxurl,
				data : {action: "cst_save_val_session", fixing : fixing_val, product_id:product_id },
			success: function(response) {
				jQuery('.options--fixing').html("<b>Fixing: </b>"+fixing);
			}
		});
	}

	if($(this).hasClass('lintel')){
	var lintel =  $("input[name='lintel']:checked").val();
	var lintel_val =  lintel.replace(' ', '_');

			jQuery.ajax({
				type : "post",
				url : myAjax.ajaxurl,
				data : {action: "cst_save_val_session", lintel : lintel_val, product_id:product_id },
			success: function(response) {
				jQuery('.options--lintel').html("<b>Lintel: </b>"+lintel);
			}
		});
	}

	if($(this).hasClass('mtrnxt')){
	var mtrnxt =  $("input[name='motorposition']:checked").val();

			jQuery.ajax({
				type : "post",
				url : myAjax.ajaxurl,
				data : {action: "cst_save_val_session", motor : mtrnxt, product_id:product_id },
			success: function(response) {
				jQuery('.options--motor').html("<b>Motor: </b>"+mtrnxt);
			}
		});
	}


		if($(this).hasClass('instaopt')){
			$('.cst_addtocart').removeAttr('disabled');
		};
  }
  else{
		$(this).siblings('.cst_error').show();
	}
	});




jQuery(".colornext").click(function(){

	color =  $(this).siblings('.row').find('.radiobtn:checked').val();
	colorkey =  $(this).siblings('.row').find('.radiobtn:checked').attr('colorkey');
	product_id = $('.product_id').val();

	  jQuery.ajax({
				type : "post",
				url : myAjax.ajaxurl,
				data : {action: "product_colorprice_ajax_request", color : color, colorkey: colorkey, product_id : product_id },
			success: function(response) {
				  var newresutl = jQuery.parseJSON(response);
				$('.price--options span').html(newresutl.ColorPrice);
				$('.price--total span').html(newresutl.pricettl);
				jQuery('.options--curtain').html("<b>Curtain: </b>"+color);
			}
		});

});


/// Mark Edit, Click both products, temp fix ///

jQuery("#collapseEight label").click(function(){
	var productID = jQuery(this).attr("prod-attr");

	if (productID == '391') {

		var closest = jQuery('div.prod-info#391 span');
		jQuery(closest).addClass('show-info');

	} // End of Product IF

	if (productID == '398') {

		var closest = jQuery('div.prod-info#398 span');
		jQuery(closest).addClass('show-info');

	} // End of Product IF

	if (productID == '379') {

		var closest = jQuery('div.prod-info#379 span');
		jQuery(closest).addClass('show-info');

	} // End of Product IF

	if (productID == '368') {

		var closest = jQuery('div.prod-info#368 span');
		jQuery(closest).addClass('show-info');

	} // End of Product IF


	if (productID == '363') {

		var closest = jQuery('div.prod-info#363 span');
		jQuery(closest).addClass('show-info');

	} // End of Product IF

});

jQuery("a.prev").click(function(){

	setTimeout(
	function()
	{
		var $container = $("html,body");
		var $scrollTo = $('.collapse.in');

		$container.animate({scrollTop: $scrollTo.offset().top - $container.offset().top - 50 },300);
	}, 400);

});

/// End of Mark Edit for click both products ///

jQuery(".fcolornext").click(function(){

	color =  $(this).siblings('.row').find('.radiobtn:checked').val();
	colorkey =  $(this).siblings('.row').find('.radiobtn:checked').attr('colorkey');
	product_id = $('.product_id').val();

	  jQuery.ajax({
				type : "post",
				url : myAjax.ajaxurl,
				data : {action: "product_fcolorprice_ajax_request", color : color, colorkey: colorkey, product_id : product_id },
			success: function(response) {
				  var newresutl = jQuery.parseJSON(response);
				$('.price--options span').html(newresutl.ColorPrice);
				$('.price--total span').html(newresutl.pricettl);
				jQuery('.options--frame').html("<b>Frame: </b>"+color);
			}
		});

});

jQuery(".nohid").click(function(){
	var opt =  $(this).val();
	var opttxt =  $(this).siblings('span').html();
	var product_id = $('.product_id').val();

	  jQuery.ajax({
				type : "post",
				url : myAjax.ajaxurl,
				data : {action: "product_instaopt_ajax_request", opt : opt, product_id : product_id },
			success: function(response) {
				 var newresutl = jQuery.parseJSON(response);
				$('.price--instopt span').html(myAjax.currency+newresutl.val);
				$('.price--total span').html(myAjax.currency+newresutl.ttlval);
				$('.options--intalloptons').html("<b>Installation Option: </b>"+opttxt);
			}
		});

});

jQuery('input[name=extraacc]').on('click', function(){
	var string = "";
	var fnlprc = 0;
	var idarr = [];
	var pro_id = $('.product_id').val();

	jQuery('input[name=extraacc]:checked').each(function(){
		var name = jQuery(this).attr('cst-attr-ttl');
		var price = jQuery(this).attr('cst-attr-prc');
		idarr.push(jQuery(this).attr('cst-attr-id'));
		fnlprc = parseFloat(fnlprc) + parseFloat(price);
		string = string + '<p class="opton"><b>'+name+': </b>'+myAjax.currency+price+'</p>';
	});
	jQuery('.extras').html(string);
	jQuery('.price--extras').find('span').html(myAjax.currency+fnlprc);

	 jQuery.ajax({
				type : "post",
				url : myAjax.ajaxurl,
				data : {action: "product_accss_ajax_request", idarr : idarr, pro_id:pro_id, fnlprc:fnlprc },
			success: function(response) {
			jQuery('.price--total span').html(myAjax.currency+response);
			}
		});

});

 $('.cst_addtocart').on('click', function(){
	 var pro_id = $('.product_id').val();
	 jQuery.ajax({
				type : "post",
				url : myAjax.ajaxurl,
				data : {action: "cst_addtocart", pro_id:pro_id },
			success: function(response) {
			window.location.href = myAjax.cart_url;
			}
		});
 });

	});
