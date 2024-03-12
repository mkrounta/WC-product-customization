<?php

/**

 * Generate child theme functions and definitions

 *

 * @package Generate

 */



add_action( 'wp_enqueue_scripts', 'enqueue_wp_child_theme' );

function enqueue_wp_child_theme(){

		wp_enqueue_script('child-js', get_stylesheet_directory_uri() . '/js/custom-front.js', array( 'jquery' ), '1.0', true );

		

		wp_enqueue_style('bootstrapcss', get_stylesheet_directory_uri() . '/css/bootstrap.min.css');

		

		wp_enqueue_script('bootstrapminjs', get_stylesheet_directory_uri() . '/js/bootstrap.min.js');

		

		wp_enqueue_script('easingminjs', get_stylesheet_directory_uri() . '/js/jquery.easing.min.js');

		
global $woocommerce;
$cart_url = get_permalink( wc_get_page_id( 'cart' ) ) ;
		wp_localize_script( 'child-js', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'currency' => get_woocommerce_currency_symbol(), 'cart_url'=>$cart_url));

}



// JD width height Price



function wpdocs_selectively_enqueue_admin_script( $hook ) {

    wp_enqueue_script( 'my_custom_script', get_stylesheet_directory_uri() . '/js/repeater.js', array(), '1.0' );

	

	wp_enqueue_media();

    

	wp_enqueue_script( 'media_uploader', get_stylesheet_directory_uri() . '/js/media-uploader.js', array(), '1.0' );

	

    wp_enqueue_style( 'my_custom_style', get_stylesheet_directory_uri() . '/css/cst_style.css', array(), '1.0' );

	

	wp_localize_script( 'child-js', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));

}

add_action( 'admin_enqueue_scripts', 'wpdocs_selectively_enqueue_admin_script' );



// JD width height Price

add_filter( 'woocommerce_product_data_tabs', 'add_set_custom_product_dimension_tab' , 99 , 1 );

function add_set_custom_product_dimension_tab( $product_data_tabs ) {

    $product_data_tabs['set_custom_price'] = array(

        'label' => __( 'Set Width, Height,Price', 'my_text_domain' ),

        'target' => 'set_custom_product_data',

    );

    return $product_data_tabs;

}









add_action('woocommerce_product_data_panels', 'cst_section');

function cst_section(){

	

	$all_fileds = get_post_meta( get_the_ID(), 'cst_dynamic_pricing', true );

	if(is_array($all_fileds)){

			$out = '<div id="set_custom_product_data" class="panel woocommerce_options_panel"><div class="repeater form-field">

			<div class="label_repeater">Height</div>

			<div for="" class="label_repeater">width</div>

			<div for="" class="label_repeater">Price</div>

    <div data-repeater-list="cst_dynamic_pricing">';

		foreach($all_fileds as $key=>$val){

	$out .= '<div data-repeater-item="">

       <input type="text" name="cst_dynamic_pricing['.$key.'][doorheight]" value="'.$val['doorheight'].'" class="dynamic_repeater"/>

       <input type="text" name="cst_dynamic_pricing['.$key.'][doorwidth]" value="'.$val['doorwidth'].'" class="dynamic_repeater" step=".01"/>

	   <input type="number" name="cst_dynamic_pricing['.$key.'][doorprice]" value="'.$val['doorprice'].'" class="dynamic_repeater" step=".01"/>

	   <input data-repeater-delete="" type="button" value="Delete" class="button cst_btn">

      </div>';

		}

		$out .= '</div>

    <input data-repeater-create type="button" value="Add" class="button cst_btn"/>

</div></div>';

	}

	else{

		$out = '

		<div id="set_custom_product_data" class="panel woocommerce_options_panel"><div class="repeater form-field">

			<div class="label_repeater">Height</div>

			<div for="" class="label_repeater">width</div>

			<div for="" class="label_repeater">Price</div>

    <div data-repeater-list="cst_dynamic_pricing">

      <div data-repeater-item>

       <input type="text" name="doorheight" class="dynamic_repeater"/>

       <input type="text" name="doorwidth" class="dynamic_repeater" step=".01"/>

	   <input type="number" name="doorprice" class="dynamic_repeater" step=".01"/>

	  

	   <input data-repeater-delete type="button" value="Delete" class="button cst_btn"/>

      </div>

    </div>

    <input data-repeater-create type="button" value="Add" class="button cst_btn"/>

</div></div>';

	}

	echo $out;

}



add_action('woocommerce_process_product_meta', 'cst_section_save', 10, 2);

function cst_section_save($post_id, $post)

{

	if(isset($_POST['cst_dynamic_pricing']))

		{

			$cst_dynamic_pricing = $_POST['cst_dynamic_pricing'];

			if ( isset( $cst_dynamic_pricing ) ) 

			{

			update_post_meta( $post_id, 'cst_dynamic_pricing', $cst_dynamic_pricing );

			}

		}

		

		if(isset($_POST['cst_dynamic_color_attr']))

		{

			$cst_color = $_POST['cst_dynamic_color_attr'];

			if ( isset( $cst_color ) ) 

			{

			update_post_meta( $post_id, 'cst_dynamic_color_attr', $cst_color );

			}

		}
		
		if(isset($_POST['white_dynamic_color_attr']))

		{

			$white_color = $_POST['white_dynamic_color_attr'];

			if ( isset( $white_color ) ) 

			{

			update_post_meta( $post_id, 'white_dynamic_color_attr', $white_color );

			}

		}
		
		
		if(isset($_POST['white_cst_curtaincolor_below']))

		{

			$white_cst_curtaincolor_below = $_POST['white_cst_curtaincolor_below'];

			if ( isset( $white_cst_curtaincolor_below ) ) 

			{

			update_post_meta( $post_id, 'white_cst_curtaincolor_below', $white_cst_curtaincolor_below );

			}

		} 
		
		if(isset($_POST['white_cst_curtaincolor_above']))

		{

			$white_cst_curtaincolor_above = $_POST['white_cst_curtaincolor_above'];

			if ( isset( $white_cst_curtaincolor_above ) ) 

			{

			update_post_meta( $post_id, 'white_cst_curtaincolor_above', $white_cst_curtaincolor_above );

			}

		} 
		
		if(isset($_POST['white_fcst_curtaincolor_below']))

		{

			$white_fcst_curtaincolor_below = $_POST['white_fcst_curtaincolor_below'];

			if ( isset( $white_fcst_curtaincolor_below ) ) 

			{

			update_post_meta( $post_id, 'white_fcst_curtaincolor_below', $white_fcst_curtaincolor_below );

			}

		} 
		
		if(isset($_POST['white_fcst_curtaincolor_above']))

		{

			$white_fcst_curtaincolor_above = $_POST['white_fcst_curtaincolor_above'];

			if ( isset( $white_fcst_curtaincolor_above ) ) 

			{

			update_post_meta( $post_id, 'white_fcst_curtaincolor_above', $white_fcst_curtaincolor_above );

			}

		}
		
		
		if(isset($_POST['white_dynamic_color_attr_enabled']))

		{

			$white_dynamic_color_attr_enabled = $_POST['white_dynamic_color_attr_enabled'];

			if ( isset( $white_dynamic_color_attr_enabled ) ) 

			{

			update_post_meta( $post_id, 'white_dynamic_color_attr_enabled', $white_dynamic_color_attr_enabled );

			}
		

		}
			else
			{

			update_post_meta( $post_id, 'white_dynamic_color_attr_enabled', false );

			}
		
		if(isset($_POST['cst_dynamic_color_attr_enabled']))

		{

			$cst_dynamic_color_attr_enabled = $_POST['cst_dynamic_color_attr_enabled'];

			if ( isset( $cst_dynamic_color_attr_enabled ) ) 

			{

			update_post_meta( $post_id, 'cst_dynamic_color_attr_enabled', $cst_dynamic_color_attr_enabled );

			}
	

		}
				else
			{

			update_post_meta( $post_id, 'cst_dynamic_color_attr_enabled', false );

			}
		
		if(isset($_POST['framecst_dynamic_color_attr_enabled']))

		{

			$framecst_dynamic_color_attr_enabled = $_POST['framecst_dynamic_color_attr_enabled'];

			if ( isset( $framecst_dynamic_color_attr_enabled ) ) 

			{

			update_post_meta( $post_id, 'framecst_dynamic_color_attr_enabled', $framecst_dynamic_color_attr_enabled );

			}

		}
					else
			{

			update_post_meta( $post_id, 'framecst_dynamic_color_attr_enabled', false );

			}
		if(isset($_POST['frame_special_painted_color_attr_enabled']))

		{

			$frame_special_painted_color_attr_enabled = $_POST['frame_special_painted_color_attr_enabled'];

			if ( isset( $frame_special_painted_color_attr_enabled ) ) 

			{

			update_post_meta( $post_id, 'frame_special_painted_color_attr_enabled', $frame_special_painted_color_attr_enabled );

			}
			

		}
		else
			{

			update_post_meta( $post_id, 'frame_special_painted_color_attr_enabled', false );

			}
		
		if(isset($_POST['frame_laminatewoodgrain_color_attr_enabled']))

		{

			$frame_laminatewoodgrain_color_attr_enabled = $_POST['frame_laminatewoodgrain_color_attr_enabled'];

			if ( isset( $frame_laminatewoodgrain_color_attr_enabled ) ) 

			{

			update_post_meta( $post_id, 'frame_laminatewoodgrain_color_attr_enabled', $frame_laminatewoodgrain_color_attr_enabled );

			}
			

		}
		else
			{

			update_post_meta( $post_id, 'frame_laminatewoodgrain_color_attr_enabled', false );

			}
		
		if(isset($_POST['special_painted_color_attr_enabled']))

		{

			$special_painted_color_attr_enabled = $_POST['special_painted_color_attr_enabled'];

			if ( isset( $special_painted_color_attr_enabled ) ) 

			{

			update_post_meta( $post_id, 'special_painted_color_attr_enabled', $special_painted_color_attr_enabled );

			}
		

		}
			else
			{

			update_post_meta( $post_id, 'special_painted_color_attr_enabled', false );

			}
		
		if(isset($_POST['laminate_wood_color_attr_enabled']))

		{

			$laminate_wood_color_attr_enabled = $_POST['laminate_wood_color_attr_enabled'];

			if ( isset( $laminate_wood_color_attr_enabled ) ) 

			{

			update_post_meta( $post_id, 'laminate_wood_color_attr_enabled', $laminate_wood_color_attr_enabled );

			}
		

		}
			else
			{

			update_post_meta( $post_id, 'laminate_wood_color_attr_enabled', false );

			}
		
		
		if(isset($_POST['cst_supply_price_enable']))

		{

			$cst_supply_price_enable = $_POST['cst_supply_price_enable'];

			if ( isset( $cst_supply_price_enable ) ) 

			{

			update_post_meta( $post_id, 'cst_supply_price_enable', $cst_supply_price_enable );

			}
	

		}
				else
			{

			update_post_meta( $post_id, 'cst_supply_price_enable', false );

			}
		
		if(isset($_POST['product_dimensions_enabled']))

		{

			$product_dimensions_enabled = $_POST['product_dimensions_enabled'];

			if ( isset( $product_dimensions_enabled ) ) 

			{

			update_post_meta( $post_id, 'product_dimensions_enabled', $product_dimensions_enabled );

			}
		

		}
				else
			{

			update_post_meta( $post_id, 'product_dimensions_enabled', false );

			}
			
		if(isset($_POST['Fixing_info_attr_enabled']))

		{

			$Fixing_info_attr_enabled = $_POST['Fixing_info_attr_enabled'];

			if ( isset( $Fixing_info_attr_enabled ) ) 

			{

			update_post_meta( $post_id, 'Fixing_info_attr_enabled', $Fixing_info_attr_enabled );

			}
	
		}
		else
			{

			update_post_meta( $post_id, 'Fixing_info_attr_enabled', false );

			}
		
		if(isset($_POST['LintelPosition_attr_enabled']))

		{

			$LintelPosition_attr_enabled = $_POST['LintelPosition_attr_enabled'];

			if ( isset( $LintelPosition_attr_enabled ) ) 

			{

			update_post_meta( $post_id, 'LintelPosition_attr_enabled', $LintelPosition_attr_enabled );

			}
			


		}
		else{
				update_post_meta( $post_id, 'LintelPosition_attr_enabled', false );
			}
			
		if(isset($_POST['product_motorposition_enabled']))

		{

			$product_motorposition_enabled = $_POST['product_motorposition_enabled'];

			if ( isset( $product_motorposition_enabled ) ) 

			{

			update_post_meta( $post_id, 'product_motorposition_enabled', $product_motorposition_enabled );

			}
			


		}
		else{
				update_post_meta( $post_id, 'product_motorposition_enabled', false );
			}
			
		if(isset($_POST['product_OptionalExtras_enabled']))

		{

			$product_OptionalExtras_enabled = $_POST['product_OptionalExtras_enabled'];

			if ( isset( $product_OptionalExtras_enabled ) ) 

			{

			update_post_meta( $post_id, 'product_OptionalExtras_enabled', $product_OptionalExtras_enabled );

			}
			

		}
		else{
				update_post_meta( $post_id, 'product_OptionalExtras_enabled', false );
			}
		
		if(isset($_POST['framecst_dynamic_color_attr']))

		{

			$framecst = $_POST['framecst_dynamic_color_attr'];

			if ( isset( $framecst ) ) 

			{

			update_post_meta( $post_id, 'framecst_dynamic_color_attr', $framecst );

			}

		}
		
		
		if(isset($_POST['framestd_cst_curtaincolor_below']))

		{

			$framestd_cst_curtaincolor_below = $_POST['framestd_cst_curtaincolor_below'];

			if ( isset( $framestd_cst_curtaincolor_below ) ) 

			{

			update_post_meta( $post_id, 'framestd_cst_curtaincolor_below', $framestd_cst_curtaincolor_below );

			}

		} 
		
		if(isset($_POST['framestd_cst_curtaincolor_above']))

		{

			$framestd_cst_curtaincolor_above = $_POST['framestd_cst_curtaincolor_above'];

			if ( isset( $framestd_cst_curtaincolor_above ) ) 

			{

			update_post_meta( $post_id, 'framestd_cst_curtaincolor_above', $framestd_cst_curtaincolor_above );

			}

		} 
		
		 /* standard frame start */
		 
		 if(isset($_POST['frame_special_painted_color_attr']))

		{

			$framestndr = $_POST['frame_special_painted_color_attr'];

			if ( isset( $framestndr ) ) 

			{

			update_post_meta( $post_id, 'frame_special_painted_color_attr', $framestndr );

			}

		}
		
		
		if(isset($_POST['spc_fcst_frame_above']))

		{

			$spc_fcst_frame_above = $_POST['spc_fcst_frame_above'];

			if ( isset( $spc_fcst_frame_above ) ) 

			{

			update_post_meta( $post_id, 'spc_fcst_frame_above', $spc_fcst_frame_above );

			}

		} 
		
		if(isset($_POST['spc_fcst_framecolor_below']))

		{

			$spc_fcst_framecolor_below = $_POST['spc_fcst_framecolor_below'];

			if ( isset( $spc_fcst_framecolor_below ) ) 

			{

			update_post_meta( $post_id, 'spc_fcst_framecolor_below', $spc_fcst_framecolor_below );

			}

		}
		 /* standard frame End */
		 
		 
		  /* Frame Laminate Woodgrain Color start */
		 
		 if(isset($_POST['frame_laminatewoodgrain_color_attr']))

		{

			$frmwood = $_POST['frame_laminatewoodgrain_color_attr'];

			if ( isset( $frmwood ) ) 

			{

			update_post_meta( $post_id, 'frame_laminatewoodgrain_color_attr', $frmwood );

			}

		}
		
		
		if(isset($_POST['frame_laminatewoodgrain_above']))

		{

			$frame_laminatewoodgrain_above = $_POST['frame_laminatewoodgrain_above'];

			if ( isset( $frame_laminatewoodgrain_above ) ) 

			{

			update_post_meta( $post_id, 'frame_laminatewoodgrain_above', $frame_laminatewoodgrain_above );

			}

		} 
		
		if(isset($_POST['frame_laminatewoodgrain_below']))

		{

			$frame_laminatewoodgrain_below = $_POST['frame_laminatewoodgrain_below'];

			if ( isset( $frame_laminatewoodgrain_below ) ) 

			{

			update_post_meta( $post_id, 'frame_laminatewoodgrain_below', $frame_laminatewoodgrain_below );

			}

		}
		 /*Frame Laminate Woodgrain Color End */
		 
		 
		 
		
		if(isset($_POST['std_cst_curtaincolor_below']))

		{

			$std_cst_curtaincolor_below = $_POST['std_cst_curtaincolor_below'];

			if ( isset( $std_cst_curtaincolor_below ) ) 

			{

			update_post_meta( $post_id, 'std_cst_curtaincolor_below', $std_cst_curtaincolor_below );

			}

		} 
		
		 
		
		if(isset($_POST['std_cst_curtaincolor_above']))

		{

			$std_cst_curtaincolor_above = $_POST['std_cst_curtaincolor_above'];

			if ( isset( $std_cst_curtaincolor_above ) ) 

			{

			update_post_meta( $post_id, 'std_cst_curtaincolor_above', $std_cst_curtaincolor_above );

			}

		} 
		
		 
		
		if(isset($_POST['lmt_cst_curtaincolor_below']))

		{

			$lmt_cst_curtaincolor_below = $_POST['lmt_cst_curtaincolor_below'];

			if ( isset( $lmt_cst_curtaincolor_below ) ) 

			{

			update_post_meta( $post_id, 'lmt_cst_curtaincolor_below', $lmt_cst_curtaincolor_below );

			}

		} 
		
		
		if(isset($_POST['lmt_cst_curtaincolor_above']))

		{

			$lmt_cst_curtaincolor_above = $_POST['lmt_cst_curtaincolor_above'];

			if ( isset( $lmt_cst_curtaincolor_above ) ) 

			{

			update_post_meta( $post_id, 'lmt_cst_curtaincolor_above', $lmt_cst_curtaincolor_above );

			}

		} 
		
		
		
		if(isset($_POST['spc_cst_curtaincolor_below']))

		{

			$spc_cst_curtaincolor_below = $_POST['spc_cst_curtaincolor_below'];

			if ( isset( $spc_cst_curtaincolor_below ) ) 

			{

			update_post_meta( $post_id, 'spc_cst_curtaincolor_below', $spc_cst_curtaincolor_below );

			}

		} 
		
		
		
		if(isset($_POST['spc_cst_curtaincolor_above']))

		{

			$spc_cst_curtaincolor_above = $_POST['spc_cst_curtaincolor_above'];

			if ( isset( $spc_cst_curtaincolor_above ) ) 

			{

			update_post_meta( $post_id, 'spc_cst_curtaincolor_above', $spc_cst_curtaincolor_above );

			}

		} 
		
		
		if(isset($_POST['special_painted_color_attr']))

		{

			$cpclpnt_color = $_POST['special_painted_color_attr'];

			if ( isset( $cpclpnt_color ) ) 

			{

			update_post_meta( $post_id, 'special_painted_color_attr', $cpclpnt_color );

			}

		}

		if(isset($_POST['laminate_wood_color_attr']))

		{

			$cpclpnt_color = $_POST['laminate_wood_color_attr'];

			if ( isset( $cpclpnt_color ) ) 

			{

			update_post_meta( $post_id, 'laminate_wood_color_attr', $cpclpnt_color );

			}

		}
		if(isset($_POST['product_dimensions']))

		{

			$cpclpnt_color = $_POST['product_dimensions'];

			if ( isset( $cpclpnt_color ) ) 

			{

			update_post_meta( $post_id, 'product_dimensions', $cpclpnt_color );

			}

		}
		
		if(isset($_POST['product_motorposition']))

		{

			$motorposition = $_POST['product_motorposition'];

			if ( isset( $motorposition ) ) 

			{

			update_post_meta( $post_id, 'product_motorposition', $motorposition );

			}

		}
		if(isset($_POST['Fixing_info_attr']))

		{

			$fixinginfo = $_POST['Fixing_info_attr'];

			if ( isset( $fixinginfo ) ) 

			{

			update_post_meta( $post_id, 'Fixing_info_attr', $fixinginfo );

			}

		}
		
		if(isset($_POST['LintelPosition_attr']))

		{

			$LintelPosition = $_POST['LintelPosition_attr'];

			if ( isset( $LintelPosition ) ) 

			{

			update_post_meta( $post_id, 'LintelPosition_attr', $LintelPosition );

			}

		}
		
		if(isset($_POST['product_OptionalExtras']))

		{

			$ecinf = $_POST['product_OptionalExtras'];

			if ( isset( $ecinf ) ) 

			{

			update_post_meta( $post_id, 'product_OptionalExtras', $ecinf );

			}

		}
		
		if(isset($_POST['cst_pe_2_8_upper']))

		{

			$cst_pe_2_8_upper = $_POST['cst_pe_2_8_upper'];

			if ( isset( $cst_pe_2_8_upper ) ) 

			{

			update_post_meta( $post_id, 'cst_pe_2_8_upper', $cst_pe_2_8_upper );

			}

		}
		
		if(isset($_POST['cst_pe_2_8_lower']))

		{

			$cst_pe_2_8_lower = $_POST['cst_pe_2_8_lower'];

			if ( isset( $cst_pe_2_8_lower ) ) 

			{

			update_post_meta( $post_id, 'cst_pe_2_8_lower', $cst_pe_2_8_lower );

			}

		}
		
		if(isset($_POST['cst_supply_price']))

		{

			$cst_supply_price = $_POST['cst_supply_price'];

			if ( isset( $cst_supply_price ) ) 

			{

			update_post_meta( $post_id, 'cst_supply_price', $cst_supply_price );

			}

		}

			

		

}







//JD White color		


add_filter( 'woocommerce_product_data_tabs', 'white_set_white_product_color_tab' , 99 , 1 );

function white_set_white_product_color_tab( $product_data_tabs ) {

    $product_data_tabs['white_set_custom_color'] = array(

        'label' => __( 'White color', 'my_white_color' ),

        'target' => 'set_white_product_color',

    );

    return $product_data_tabs;

}



add_action('woocommerce_product_data_panels', 'white_color_section');

function white_color_section(){

	$all_fileds = get_post_meta( get_the_ID(), 'white_dynamic_color_attr', true );
	$white_cst_curtaincolor_below = get_post_meta( get_the_ID(), 'white_cst_curtaincolor_below', true );
	$white_cst_curtaincolor_above = get_post_meta( get_the_ID(), 'white_cst_curtaincolor_above', true );
	$white_fcst_curtaincolor_below = get_post_meta( get_the_ID(), 'white_fcst_curtaincolor_below', true );
	$white_fcst_curtaincolor_above = get_post_meta( get_the_ID(), 'white_fcst_curtaincolor_above', true );
	$all_fileds_enabled = get_post_meta( get_the_ID(), 'white_dynamic_color_attr_enabled', true );
	if($all_fileds_enabled){
		$checked= "checked";
	}
	else{
		$checked = "";
	}
	if(is_array($all_fileds)){

			$out .= '<div id="set_white_product_color" class="panel woocommerce_options_panel"><div class="repeater form-field">
<div class="attr_enabled">
<h3>Enable this section</h3>
<input type="checkbox" name="white_dynamic_color_attr_enabled" '.$checked.'>
</div>
			<div class="label_repeaterimg">Image</div>

			<div for="" class="label_repeater">Color name</div>

			

    <div data-repeater-list="white_dynamic_color_attr">';

		foreach($all_fileds as $key=>$val){

	$out .= '<div data-repeater-item="" class="data_repeater_item">

	<div class="imgdivcolr dynamic_repeaterimg"><img class=""  src="'.$val['white_img_clorurl'].'" width="50" height="50"></div>

	<input type="hidden" name="white_dynamic_color_attr['.$key.'][white_img_clorid]" value="'.$val['white_img_clorid'].'" class="dynamic_repeater background_imageid"/>

	<input type="hidden" name="white_dynamic_color_attr['.$key.'][white_img_clorurl]" value="'.$val['white_img_clorurl'].'" class="dynamic_repeater background_imageurl"/>

<input type="button" class="button-primary upload_image_button" value="Insert Image" />

       

       <input type="text" name="white_dynamic_color_attr['.$key.'][white_clr_name]" value="'.$val['white_clr_name'].'" class="dynamic_repeater" step=".01"/>

	   <input type="hidden" name="white_dynamic_color_attr['.$key.'][white_color_price]" value="'.$val['white_color_price'].'" class="dynamic_repeater" step=".01"/>

	   <input data-repeater-delete="" type="button" value="Delete" class="button cst_btn">

      </div>';

		}

		$out .= '<input data-repeater-create type="button" value="Add" class="button cst_btn cst_btnclr"/>
	</div>';

	} 

	else{

		$out = '<div id="set_white_product_color" class="panel woocommerce_options_panel"><div class="repeater form-field">
<div class="attr_enabled">
<h3>Enable this section</h3>
<input type="checkbox" name="white_dynamic_color_attr_enabled" '.$checked.'>
</div>
			<div class="label_repeaterimg">Image</div>

			<div for="" class="label_repeater">Color name</div>

			

    <div data-repeater-list="white_dynamic_color_attr">

	

	

      <div data-repeater-item="" class="data_repeater_item">

	  <div class="imgdivcolr dynamic_repeaterimg"><img class=""  src=" " alt="img" width="50" height="50"></div>

	  

       <input type="hidden" name="white_img_clorid" class="dynamic_repeater background_imageid"/>

	<input type="hidden" name="white_img_clorurl" class="dynamic_repeater background_imageurl"/>

<input type="button" class="button-primary upload_image_button" value="Insert Image" />

	   

	   

	   <input type="text" name="white_clr_name" class="dynamic_repeater" step=".01"/>

	   <input type="hidden" name="white_color_price" class="dynamic_repeater" step=".01"/>

	  

	   <input data-repeater-delete type="button" value="Delete" class="button cst_btn"/>

      </div>

    <input data-repeater-create type="button" value="Add" class="button cst_btn"/></div>';

	}
$out .= '<div class="cprices_cls">
<h3>White Curtain Color Prices</h3>
<div class="cstprows"><label>Below 3500mm : </label><input type="number" name="white_cst_curtaincolor_below" value="'.$white_cst_curtaincolor_below.'"></div>
<div class="cstprows"><label>Above 3500mm : </label><input type="number" name="white_cst_curtaincolor_above" value="'.$white_cst_curtaincolor_above.'"></div>
</div>
<div class="cprices_cls">
<h3>White Frame Color Prices</h3>
<div class="cstprows"><label>Below 2800mm : </label><input type="number" name="white_fcst_curtaincolor_below" value="'.$white_fcst_curtaincolor_below.'"></div>
<div class="cstprows"><label>Above 2800mm : </label><input type="number" name="white_fcst_curtaincolor_above" value="'.$white_fcst_curtaincolor_above.'">
</div>
</div></div></div>';
	echo $out;

}




//JD Curtain STANDARD RAL COLOUR PRICES			





add_filter( 'woocommerce_product_data_tabs', 'add_set_custom_product_color_tab' , 99 , 1 );

function add_set_custom_product_color_tab( $product_data_tabs ) {

    $product_data_tabs['set_custom_color'] = array(

        'label' => __( 'Curtain Standard Ral color', 'my_text_color' ),

        'target' => 'set_custom_product_color',

    );

    return $product_data_tabs;

}



add_action('woocommerce_product_data_panels', 'cst_color_section');

function cst_color_section(){

	

	$all_fileds = get_post_meta( get_the_ID(), 'cst_dynamic_color_attr', true );
	$all_fileds_arrt_enabled = get_post_meta( get_the_ID(), 'cst_dynamic_color_attr_enabled', true );
	$std_cst_curtaincolor_below = get_post_meta( get_the_ID(), 'std_cst_curtaincolor_below', true );
	$std_cst_curtaincolor_above = get_post_meta( get_the_ID(), 'std_cst_curtaincolor_above', true );
	
	if($all_fileds_arrt_enabled){
		$checked= "checked";
	}
	else{
		$checked = "";
	}

	if(is_array($all_fileds)){

			$out = '<div id="set_custom_product_color" class="panel woocommerce_options_panel"><div class="repeater form-field">
<div class="attr_enabled">
<h3>Enable this section</h3>
<input type="checkbox" name="cst_dynamic_color_attr_enabled" '.$checked.'>
</div>
			<div class="label_repeaterimg">Image</div>

			<div for="" class="label_repeater">Color name</div>

			

    <div data-repeater-list="cst_dynamic_color_attr">';

		foreach($all_fileds as $key=>$val){

	$out .= '<div data-repeater-item="" class="data_repeater_item">

	<div class="imgdivcolr dynamic_repeaterimg"><img class=""  src="'.$val['cst_img_clorurl'].'" width="50" height="50"></div>

	<input type="hidden" name="cst_dynamic_color_attr['.$key.'][cst_img_clorid]" value="'.$val['cst_img_clorid'].'" class="dynamic_repeater background_imageid"/>

	<input type="hidden" name="cst_dynamic_color_attr['.$key.'][cst_img_clorurl]" value="'.$val['cst_img_clorurl'].'" class="dynamic_repeater background_imageurl"/>

<input type="button" class="button-primary upload_image_button" value="Insert Image" />

       

       <input type="text" name="cst_dynamic_color_attr['.$key.'][cst_clr_name]" value="'.$val['cst_clr_name'].'" class="dynamic_repeater" step=".01"/>

	   <input type="hidden" name="cst_dynamic_color_attr['.$key.'][cst_color_price]" value="'.$val['cst_color_price'].'" class="dynamic_repeater" step=".01"/>

	   <input data-repeater-delete="" type="button" value="Delete" class="button cst_btn">

      </div>';

		}

		$out .= '<input data-repeater-create type="button" value="Add" class="button cst_btn cst_btnclr"/>
	</div>';

	} 

	else{

		$out = '<div id="set_custom_product_color" class="panel woocommerce_options_panel"><div class="repeater form-field">
<div class="attr_enabled">
<h3>Enable this section</h3>
<input type="checkbox" name="cst_dynamic_color_attr_enabled" '.$checked.'>
</div>
			<div class="label_repeaterimg">Image</div>

			<div for="" class="label_repeater">Color name</div>

			

    <div data-repeater-list="cst_dynamic_color_attr">

	

	

      <div data-repeater-item="" class="data_repeater_item">

	  <div class="imgdivcolr dynamic_repeaterimg"><img class=""  src=" " alt="img" width="50" height="50"></div>

	  

       <input type="hidden" name="cst_img_clorid" class="dynamic_repeater background_imageid"/>

	<input type="hidden" name="cst_img_clorurl" class="dynamic_repeater background_imageurl"/>

<input type="button" class="button-primary upload_image_button" value="Insert Image" />

	   

	   

	   <input type="text" name="cst_clr_name" class="dynamic_repeater" step=".01"/>

	   <input type="hidden" name="cst_color_price" class="dynamic_repeater" step=".01"/>

	  

	   <input data-repeater-delete type="button" value="Delete" class="button cst_btn"/>

      </div>

    <input data-repeater-create type="button" value="Add" class="button cst_btn"/></div>';

	}
$out .= '<div class="cprices_cls">
<h3>Curtain Color Prices</h3>
<div class="cstprows"><label>Below 3500mm : </label><input type="number" name="std_cst_curtaincolor_below" value="'.$std_cst_curtaincolor_below.'"></div>
<div class="cstprows"><label>Above 3500mm : </label><input type="number" name="std_cst_curtaincolor_above" value="'.$std_cst_curtaincolor_above.'"></div>
</div>
</div></div>';
	echo $out;

}



//Standard Frame Ral color Start


add_filter( 'woocommerce_product_data_tabs', 'add_set_custom_product_framecolor_tab' , 99 , 1 );

function add_set_custom_product_framecolor_tab( $product_data_tabs ) {

    $product_data_tabs['set_custom_colorframe'] = array(

        'label' => __( 'Frame Standard Ral color', 'my_text_colorframe' ),

        'target' => 'frameset_custom_product_colorfram',

    );

    return $product_data_tabs;

}



add_action('woocommerce_product_data_panels', 'frame_color_section');

function frame_color_section(){

	

	$all_fileds = get_post_meta( get_the_ID(), 'framecst_dynamic_color_attr', true );
	$all_fileds_enabled = get_post_meta( get_the_ID(), 'framecst_dynamic_color_attr_enabled', true );
	$framestd_cst_curtaincolor_below = get_post_meta( get_the_ID(), 'framestd_cst_curtaincolor_below', true );
	$framestd_cst_curtaincolor_above = get_post_meta( get_the_ID(), 'framestd_cst_curtaincolor_above', true );
	if($all_fileds_enabled){
		$checked= "checked";
	}
	else{
		$checked = "";
	}
	if(is_array($all_fileds)){

			$out = '<div id="frameset_custom_product_colorfram" class="panel woocommerce_options_panel"><div class="repeater form-field">
<div class="attr_enabled">
<h3>Enable this section</h3>
<input type="checkbox" name="framecst_dynamic_color_attr_enabled" '.$checked.'>
</div>
			<div class="label_repeaterimg">Image</div>

			<div for="" class="label_repeater">Color name</div>

			

    <div data-repeater-list="framecst_dynamic_color_attr">';

		foreach($all_fileds as $key=>$val){

	$out .= '<div data-repeater-item="" class="data_repeater_item">

	<div class="imgdivcolr dynamic_repeaterimg"><img class=""  src="'.$val['cst_img_clorurl'].'" width="50" height="50"></div>

	<input type="hidden" name="framecst_dynamic_color_attr['.$key.'][cst_img_clorurl]" value="'.$val['cst_img_clorurl'].'" class="dynamic_repeater background_imageid"/>

	<input type="hidden" name="framecst_dynamic_color_attr['.$key.'][cst_img_clorurl]" value="'.$val['cst_img_clorurl'].'" class="dynamic_repeater background_imageurl"/>

<input type="button" class="button-primary upload_image_button" value="Insert Image" />

       

       <input type="text" name="framecst_dynamic_color_attr['.$key.'][cst_clr_name]" value="'.$val['cst_clr_name'].'" class="dynamic_repeater" step=".01"/>

	   <input type="hidden" name="framecst_dynamic_color_attr['.$key.'][cst_color_price]" value="'.$val['cst_color_price'].'" class="dynamic_repeater" step=".01"/>

	   <input data-repeater-delete="" type="button" value="Delete" class="button cst_btn">

      </div>';

		}

		$out .= '<input data-repeater-create type="button" value="Add" class="button cst_btn cst_btnclr"/>
	</div>';

	} 

	else{

		$out = '<div id="frameset_custom_product_colorfram" class="panel woocommerce_options_panel"><div class="repeater form-field">
<div class="attr_enabled">
<h3>Enable this section</h3>
<input type="checkbox" name="framecst_dynamic_color_attr_enabled" '.$checked.'>
</div>
			<div class="label_repeaterimg">Image</div>

			<div for="" class="label_repeater">Color name</div>

			

    <div data-repeater-list="framecst_dynamic_color_attr">

	

	

      <div data-repeater-item="" class="data_repeater_item">

	  <div class="imgdivcolr dynamic_repeaterimg"><img class=""  src=" " alt="img" width="50" height="50"></div>

	  

       <input type="hidden" name="cst_img_clorurl" class="dynamic_repeater background_imageid"/>

	<input type="hidden" name="cst_img_clorurl" class="dynamic_repeater background_imageurl"/>

<input type="button" class="button-primary upload_image_button" value="Insert Image" />

	   

	   

	   <input type="text" name="cst_clr_name" class="dynamic_repeater" step=".01"/>

	   <input type="hidden" name="cst_color_price" class="dynamic_repeater" step=".01"/>

	  

	   <input data-repeater-delete type="button" value="Delete" class="button cst_btn"/>

      </div>

    <input data-repeater-create type="button" value="Add" class="button cst_btn"/></div>';

	}
$out .= '<div class="cprices_cls">
<h3>Frame Color Prices</h3>
<div class="cstprows"><label>Below 2800mm : </label><input type="number" name="framestd_cst_curtaincolor_below" value="'.$framestd_cst_curtaincolor_below.'"></div>
<div class="cstprows"><label>Above 2800mm : </label><input type="number" name="framestd_cst_curtaincolor_above" value="'.$framestd_cst_curtaincolor_above.'"></div>
</div>
</div></div>';
	echo $out;

}

//Standard Frame Ral color END








//JD FRAME SPECIAL PAINTED COLOUR START



add_filter( 'woocommerce_product_data_tabs', 'frameadd_set_spcl_painted_color_tab' , 99 , 1 );

function frameadd_set_spcl_painted_color_tab( $product_data_tabs ) {

    $product_data_tabs['set_frmspcl_paint_color'] = array(

        'label' => __( 'Frame Special Painted Color', 'my_frmspcl_pnt_color' ),

        'target' => 'set_framespcl_panted_clr_color',

    );

    return $product_data_tabs;

}



add_action('woocommerce_product_data_panels', 'framescpl_painted_color_color_section');

function framescpl_painted_color_color_section(){

	

	$all_fileds = get_post_meta( get_the_ID(), 'frame_special_painted_color_attr', true );
	$all_fileds_enabled = get_post_meta( get_the_ID(), 'frame_special_painted_color_attr_enabled', true );
	$spc_fcst_frame_above = get_post_meta( get_the_ID(), 'spc_fcst_frame_above', true );
	$spc_fcst_framecolor_below = get_post_meta( get_the_ID(), 'spc_fcst_framecolor_below', true );
if($all_fileds_enabled){
		$checked= "checked";
	}
	else{
		$checked = "";
	}
	if(is_array($all_fileds)){

			$out = '<div id="set_framespcl_panted_clr_color" class="panel woocommerce_options_panel"><div class="repeater form-field">
<div class="attr_enabled">
<h3>Enable this section</h3>
<input type="checkbox" name="frame_special_painted_color_attr_enabled" '.$checked.'>
</div>
			<div class="label_repeaterimg">Image</div>

			<div for="" class="label_repeater">Color name</div>

		

    <div data-repeater-list="frame_special_painted_color_attr">';

		foreach($all_fileds as $key=>$val){

	$out .= '<div data-repeater-item="" class="data_repeater_item">

	<div class="imgdivcolr dynamic_repeaterimg"><img class=""  src="'.$val['cst_img_clorurl'].'" width="50" height="50"></div>

	<input type="hidden" name="frame_special_painted_color_attr['.$key.'][cst_img_clorid]" value="'.$val['cst_img_clorid'].'" class="dynamic_repeater background_imageid"/>

	<input type="hidden" name="frame_special_painted_color_attr['.$key.'][cst_img_clorurl]" value="'.$val['cst_img_clorurl'].'" class="dynamic_repeater background_imageurl"/>

<input type="button" class="button-primary upload_image_button" value="Insert Image" />

       

       <input type="text" name="frame_special_painted_color_attr['.$key.'][cst_clr_name]" value="'.$val['cst_clr_name'].'" class="dynamic_repeater" step=".01"/>

	   <input type="hidden" name="frame_special_painted_color_attr['.$key.'][cst_color_price]" value="'.$val['cst_color_price'].'" class="dynamic_repeater" step=".01"/>

	   <input data-repeater-delete="" type="button" value="Delete" class="button cst_btn">

      </div>';

		}

		$out .= '</div>

    <input data-repeater-create type="button" value="Add" class="button cst_btn cst_btnclr"/>';

	} 

	else{

		$out = '<div id="set_framespcl_panted_clr_color" class="panel woocommerce_options_panel"><div class="repeater form-field">
<div class="attr_enabled">
<h3>Enable this section</h3>
<input type="checkbox" name="frame_special_painted_color_attr_enabled" '.$checked.'>
</div>
			<div class="label_repeaterimg">Image</div>

			<div for="" class="label_repeater">Color name</div>

			

    <div data-repeater-list="frame_special_painted_color_attr">

	

	

      <div div data-repeater-item="" class="data_repeater_item">

	  <div class="imgdivcolr dynamic_repeaterimg"><img class=""  src=" " alt="img" width="50" height="50"></div>

	  

       <input type="hidden" name="cst_img_clorid" class="dynamic_repeater background_imageid"/>

	<input type="hidden" name="cst_img_clorurl" class="dynamic_repeater background_imageurl"/>

<input type="button" class="button-primary upload_image_button" value="Insert Image" />

	   

	   

	   <input type="text" name="cst_clr_name" class="dynamic_repeater" step=".01"/>

	   <input type="hidden" name="cst_color_price" class="dynamic_repeater" step=".01"/>

	  

	   <input data-repeater-delete type="button" value="Delete" class="button cst_btn"/>

      </div>


    <input data-repeater-create type="button" value="Add" class="button cst_btn"/>
    </div>

';

	}
$out .= '
<div class="cprices_cls">
<h3>Frame Color Prices</h3>
<div class="cstprows"><label>Below 2800mm : </label><input type="number" name="spc_fcst_framecolor_below" value="'.$spc_fcst_framecolor_below.'"></div>
<div class="cstprows"><label>Above 2800mm : </label><input type="number" name="spc_fcst_frame_above" value="'.$spc_fcst_frame_above.'">
</div>
</div></div></div>';
	echo $out;

}

//JD FRAME SPECIAL PAINTED COLOUR END





//JD Laminate Woodgrain Color START



add_filter( 'woocommerce_product_data_tabs', 'frame_laminatewoodgrain_color_tab' , 99 , 1 );

function frame_laminatewoodgrain_color_tab( $product_data_tabs ) {

    $product_data_tabs['frm_llaminatewood_color'] = array(

        'label' => __( 'Frame Laminate Woodgrain Color', 'frmllaminatewood_color' ),

        'target' => 'frame_laminatewoodgrain_color',

    );

    return $product_data_tabs;

}



add_action('woocommerce_product_data_panels', 'framelaminatewoodgrain_color_section');

function framelaminatewoodgrain_color_section(){

	

	$all_fileds = get_post_meta( get_the_ID(), 'frame_laminatewoodgrain_color_attr', true );
	$all_fileds_enabled = get_post_meta( get_the_ID(), 'frame_laminatewoodgrain_color_attr_enabled', true );
	$frame_laminatewoodgrain_above = get_post_meta( get_the_ID(), 'frame_laminatewoodgrain_above', true );
	$frame_laminatewoodgrain_below = get_post_meta( get_the_ID(), 'frame_laminatewoodgrain_below', true );
	if($all_fileds_enabled){
		$checked= "checked";
	}
	else{
		$checked = "";
	}
	if(is_array($all_fileds)){

			$out = '<div id="frame_laminatewoodgrain_color" class="panel woocommerce_options_panel"><div class="repeater form-field">
<div class="attr_enabled">
<h3>Enable this section</h3>
<input type="checkbox" name="frame_laminatewoodgrain_color_attr_enabled" '.$checked.'>
</div>
			<div class="label_repeaterimg">Image</div>

			<div for="" class="label_repeater">Color name</div>

		

    <div data-repeater-list="frame_laminatewoodgrain_color_attr">';

		foreach($all_fileds as $key=>$val){

	$out .= '<div data-repeater-item="" class="data_repeater_item">

	<div class="imgdivcolr dynamic_repeaterimg"><img class=""  src="'.$val['cst_img_clorurl'].'" width="50" height="50"></div>

	<input type="hidden" name="frame_laminatewoodgrain_color_attr['.$key.'][cst_img_clorid]" value="'.$val['cst_img_clorid'].'" class="dynamic_repeater background_imageid"/>

	<input type="hidden" name="frame_laminatewoodgrain_color_attr['.$key.'][cst_img_clorurl]" value="'.$val['cst_img_clorurl'].'" class="dynamic_repeater background_imageurl"/>

<input type="button" class="button-primary upload_image_button" value="Insert Image" />

       

       <input type="text" name="frame_laminatewoodgrain_color_attr['.$key.'][cst_clr_name]" value="'.$val['cst_clr_name'].'" class="dynamic_repeater" step=".01"/>

	   <input type="hidden" name="frame_laminatewoodgrain_color_attr['.$key.'][cst_color_price]" value="'.$val['cst_color_price'].'" class="dynamic_repeater" step=".01"/>

	   <input data-repeater-delete="" type="button" value="Delete" class="button cst_btn">

      </div>';

		}

		$out .= '</div>

    <input data-repeater-create type="button" value="Add" class="button cst_btn cst_btnclr"/>';

	} 

	else{

		$out = '<div id="frame_laminatewoodgrain_color" class="panel woocommerce_options_panel"><div class="repeater form-field">
<div class="attr_enabled">
<h3>Enable this section</h3>
<input type="checkbox" name="frame_laminatewoodgrain_color_attr_enabled" '.$checked.'>
</div>
			<div class="label_repeaterimg">Image</div>

			<div for="" class="label_repeater">Color name</div>

			

    <div data-repeater-list="frame_laminatewoodgrain_color_attr">

	

	

      <div div data-repeater-item="" class="data_repeater_item">

	  <div class="imgdivcolr dynamic_repeaterimg"><img class=""  src=" " alt="img" width="50" height="50"></div>

	  

       <input type="hidden" name="cst_img_clorid" class="dynamic_repeater background_imageid"/>

	<input type="hidden" name="cst_img_clorurl" class="dynamic_repeater background_imageurl"/>

<input type="button" class="button-primary upload_image_button" value="Insert Image" />

	   

	   

	   <input type="text" name="cst_clr_name" class="dynamic_repeater" step=".01"/>

	   <input type="hidden" name="cst_color_price" class="dynamic_repeater" step=".01"/>

	  

	   <input data-repeater-delete type="button" value="Delete" class="button cst_btn"/>

      </div>


    <input data-repeater-create type="button" value="Add" class="button cst_btn"/>
    </div>

';

	}
$out .= '
<div class="cprices_cls">
<h3>Frame Color Prices</h3>
<div class="cstprows"><label>Below 2800mm : </label><input type="number" name="frame_laminatewoodgrain_below" value="'.$frame_laminatewoodgrain_below.'"></div>
<div class="cstprows"><label>Above 2800mm : </label><input type="number" name="frame_laminatewoodgrain_above" value="'.$frame_laminatewoodgrain_above.'">
</div>
</div></div></div>';
	echo $out;

}

//JD FRAME Laminate Woodgrain Color END






//JD CURTAIN SPECIAL PAINTED COLOUR



add_filter( 'woocommerce_product_data_tabs', 'add_set_spcl_painted_color_tab' , 99 , 1 );

function add_set_spcl_painted_color_tab( $product_data_tabs ) {

    $product_data_tabs['set_spcl_paint_color'] = array(

        'label' => __( 'Curtain Special Painted Color', 'my_spcl_pnt_color' ),

        'target' => 'set_spcl_panted_clr_color',

    );

    return $product_data_tabs;

}



add_action('woocommerce_product_data_panels', 'scpl_painted_color_color_section');

function scpl_painted_color_color_section(){

	

	$all_fileds = get_post_meta( get_the_ID(), 'special_painted_color_attr', true );
	$all_fileds_enabled = get_post_meta( get_the_ID(), 'special_painted_color_attr_enabled', true );
	$spc_cst_curtaincolor_below = get_post_meta( get_the_ID(), 'spc_cst_curtaincolor_below', true );
	$spc_cst_curtaincolor_above = get_post_meta( get_the_ID(), 'spc_cst_curtaincolor_above', true );
	if($all_fileds_enabled){
		$checked= "checked";
	}
	else{
		$checked = "";
	}

	if(is_array($all_fileds)){

			$out = '<div id="set_spcl_panted_clr_color" class="panel woocommerce_options_panel"><div class="repeater form-field">
<div class="attr_enabled">
<h3>Enable this section</h3>
<input type="checkbox" name="special_painted_color_attr_enabled" '.$checked.'>
</div>
			<div class="label_repeaterimg">Image</div>

			<div for="" class="label_repeater">Color name</div>

		

    <div data-repeater-list="special_painted_color_attr">';

		foreach($all_fileds as $key=>$val){

	$out .= '<div data-repeater-item="" class="data_repeater_item">

	<div class="imgdivcolr dynamic_repeaterimg"><img class=""  src="'.$val['cst_img_clorurl'].'" width="50" height="50"></div>

	<input type="hidden" name="special_painted_color_attr['.$key.'][cst_img_clorid]" value="'.$val['cst_img_clorid'].'" class="dynamic_repeater background_imageid"/>

	<input type="hidden" name="special_painted_color_attr['.$key.'][cst_img_clorurl]" value="'.$val['cst_img_clorurl'].'" class="dynamic_repeater background_imageurl"/>

<input type="button" class="button-primary upload_image_button" value="Insert Image" />

       

       <input type="text" name="special_painted_color_attr['.$key.'][cst_clr_name]" value="'.$val['cst_clr_name'].'" class="dynamic_repeater" step=".01"/>

	   <input type="hidden" name="special_painted_color_attr['.$key.'][cst_color_price]" value="'.$val['cst_color_price'].'" class="dynamic_repeater" step=".01"/>

	   <input data-repeater-delete="" type="button" value="Delete" class="button cst_btn">

      </div>';

		}

		$out .= '</div>

    <input data-repeater-create type="button" value="Add" class="button cst_btn cst_btnclr"/>';

	} 

	else{

		$out = '<div id="set_spcl_panted_clr_color" class="panel woocommerce_options_panel"><div class="repeater form-field">
<div class="attr_enabled">
<h3>Enable this section</h3>
<input type="checkbox" name="special_painted_color_attr_enabled" '.$checked.'>
</div>
			<div class="label_repeaterimg">Image</div>

			<div for="" class="label_repeater">Color name</div>

			

    <div data-repeater-list="special_painted_color_attr">

	

	

      <div div data-repeater-item="" class="data_repeater_item">

	  <div class="imgdivcolr dynamic_repeaterimg"><img class=""  src=" " alt="img" width="50" height="50"></div>

	  

       <input type="hidden" name="cst_img_clorid" class="dynamic_repeater background_imageid"/>

	<input type="hidden" name="cst_img_clorurl" class="dynamic_repeater background_imageurl"/>

<input type="button" class="button-primary upload_image_button" value="Insert Image" />

	   

	   

	   <input type="text" name="cst_clr_name" class="dynamic_repeater" step=".01"/>

	   <input type="hidden" name="cst_color_price" class="dynamic_repeater" step=".01"/>

	  

	   <input data-repeater-delete type="button" value="Delete" class="button cst_btn"/>

      </div>


    <input data-repeater-create type="button" value="Add" class="button cst_btn"/>
    </div>

';

	}
$out .= '<div class="cprices_cls">
<h3>Curtain Color Prices</h3>
<div class="cstprows"><label>Below 3500mm : </label><input type="number" name="spc_cst_curtaincolor_below" value="'.$spc_cst_curtaincolor_below.'"></div>
<div class="cstprows"><label>Above 3500mm : </label><input type="number" name="spc_cst_curtaincolor_above" value="'.$spc_cst_curtaincolor_above.'"></div>
</div>
</div></div>';
	echo $out;

}









//JD Curtain LAMINATE WOODGRAIN COLOUR PRICES				

add_filter( 'woocommerce_product_data_tabs', 'add_laminate_woodgrain_color_tab' , 99 , 1 );

function add_laminate_woodgrain_color_tab( $product_data_tabs ) {

    $product_data_tabs['laminate_wood_color'] = array(

        'label' => __( 'Curtain Laminate Woodgrain Color', 'my_laminate_wood_color' ),

        'target' => 'set_laminate_wood_clr_color',

    );

    return $product_data_tabs;

}



add_action('woocommerce_product_data_panels', 'laminate_wood_color_section');

function laminate_wood_color_section(){

	

	$all_fileds = get_post_meta( get_the_ID(), 'laminate_wood_color_attr', true );
	$all_fileds_enabled = get_post_meta( get_the_ID(), 'laminate_wood_color_attr_enabled', true );
	$lmt_cst_curtaincolor_below = get_post_meta( get_the_ID(), 'lmt_cst_curtaincolor_below', true );
	$lmt_cst_curtaincolor_above = get_post_meta( get_the_ID(), 'lmt_cst_curtaincolor_above', true );
	
	if($all_fileds_enabled){
		$checked= "checked";
	}
	else{
		$checked = "";
	}

	if(is_array($all_fileds)){

			$out = '<div id="set_laminate_wood_clr_color" class="panel woocommerce_options_panel"><div class="repeater form-field">
<div class="attr_enabled">
<h3>Enable this section</h3>
<input type="checkbox" name="laminate_wood_color_attr_enabled" '.$checked.'>
</div>
			<div class="label_repeaterimg">Image</div>

			<div for="" class="label_repeater">Color name</div>

			

    <div data-repeater-list="laminate_wood_color_attr">';

		foreach($all_fileds as $key=>$val){

	$out .= '<div data-repeater-item="" class="data_repeater_item">

	<div class="imgdivcolr dynamic_repeaterimg"><img class=""  src="'.$val['cst_img_clorurl'].'" width="50" height="50"></div>

	<input type="hidden" name="laminate_wood_color_attr['.$key.'][cst_img_clorid]" value="'.$val['cst_img_clorid'].'" class="dynamic_repeater background_imageid"/>

	<input type="hidden" name="laminate_wood_color_attr['.$key.'][cst_img_clorurl]" value="'.$val['cst_img_clorurl'].'" class="dynamic_repeater background_imageurl"/>

<input type="button" class="button-primary upload_image_button" value="Insert Image" />

       

       <input type="text" name="laminate_wood_color_attr['.$key.'][cst_clr_name]" value="'.$val['cst_clr_name'].'" class="dynamic_repeater" step=".01"/>

	   <input type="hidden" name="laminate_wood_color_attr['.$key.'][cst_color_price]" value="'.$val['cst_color_price'].'" class="dynamic_repeater" step=".01"/>

	   <input data-repeater-delete="" type="button" value="Delete" class="button cst_btn">

      </div>';

		}

		$out .= '</div>

    <input data-repeater-create type="button" value="Add" class="button cst_btn cst_btnclr"/>';

	} 

	else{

		$out = '<div id="set_laminate_wood_clr_color" class="panel woocommerce_options_panel"><div class="repeater form-field">
<div class="attr_enabled">
<h3>Enable this section</h3>
<input type="checkbox" name="laminate_wood_color_attr_enabled" '.$checked.'>
</div>
			<div class="label_repeaterimg">Image</div>

			<div for="" class="label_repeater">Color name</div>

			

    <div data-repeater-list="laminate_wood_color_attr">

	

	

      <div div data-repeater-item="" class="data_repeater_item">

	  <div class="imgdivcolr dynamic_repeaterimg"><img class=""  src=" " alt="img" width="50" height="50"></div>

	  

       <input type="hidden" name="cst_img_clorid" class="dynamic_repeater background_imageid"/>

	<input type="hidden" name="cst_img_clorurl" class="dynamic_repeater background_imageurl"/>

<input type="button" class="button-primary upload_image_button" value="Insert Image" />

	   

	   

	   <input type="text" name="cst_clr_name" class="dynamic_repeater" step=".01"/>

	   <input type="hidden" name="cst_color_price" class="dynamic_repeater" step=".01"/>

	  

	   <input data-repeater-delete type="button" value="Delete" class="button cst_btn"/>

      </div>


    <input data-repeater-create type="button" value="Add" class="button cst_btn"/>
    </div>';

	}
$out .= '<div class="cprices_cls">
<h3>Curtain Color Prices</h3>
<div class="cstprows"><label>Below 3500mm : </label><input type="number" name="lmt_cst_curtaincolor_below" value="'.$lmt_cst_curtaincolor_below.'"></div>
<div class="cstprows"><label>Above 3500mm : </label><input type="number" name="lmt_cst_curtaincolor_above" value="'.$lmt_cst_curtaincolor_above.'"></div>
</div>
</div></div>';
	echo $out;

}
add_filter( 'woocommerce_product_data_tabs', 'add_installopt_tab' , 99 , 1 );

function add_installopt_tab( $product_data_tabs ) {

    $product_data_tabs['installopt_data'] = array(

        'label' => __( 'Installation Options', 'installopt' ),

        'target' => 'set_installopt',

    );

    return $product_data_tabs;

}

add_action('woocommerce_product_data_panels', 'cst_installation_process');
function cst_installation_process(){
	$cst_supply_price = get_post_meta( get_the_ID(), 'cst_supply_price', true );
	$cst_supply_price_enable = get_post_meta( get_the_ID(), 'cst_supply_price_enable', true );
	$cst_pe_2_8_lower = get_post_meta( get_the_ID(), 'cst_pe_2_8_lower', true );
	$cst_pe_2_8_upper = get_post_meta( get_the_ID(), 'cst_pe_2_8_upper', true );
	
	if($cst_supply_price_enable){
		$checked= "checked";
	}
	else{
		$checked = "";
	}
	
	echo '<div id="set_installopt" class="panel woocommerce_options_panel"><div class="set_installopt form-field"><div class="cprices_cls">
	<div class="attr_enabled">
<h3>Enable this section</h3>
<input type="checkbox" name="cst_supply_price_enable" '.$checked.'>
</div>
<h3>Installation Option</h3>
<div class="cstprows"><label>Supply only : </label><input type="number" name="cst_supply_price" value="'.$cst_supply_price.'"></div>
<div class="cstprows"><label>Professional installation (under 2.8m wide doors)</label><input type="number" name="cst_pe_2_8_lower" value="'.$cst_pe_2_8_lower.'"></div>
<div class="cstprows"><label>Professional installation (over 2.8m wide doors)</label><input type="number" name="cst_pe_2_8_upper" value="'.$cst_pe_2_8_upper.'"></div>
</div></div></div>';
}

//JD set_dimensions				

add_filter( 'woocommerce_product_data_tabs', 'add_Dimensions_tab' , 99 , 1 );

function add_Dimensions_tab( $product_data_tabs ) {

    $product_data_tabs['dimensionsdata'] = array(

        'label' => __( 'Dimensions', 'my_dimensions' ),

        'target' => 'set_dimensions',

    );

    return $product_data_tabs;

}



add_action('woocommerce_product_data_panels', 'set_dimensions_section');

function set_dimensions_section(){

	

	$all_fileds = get_post_meta( get_the_ID(), 'product_dimensions', true );
	$all_fileds_enabled = get_post_meta( get_the_ID(), 'product_dimensions_enabled', true );
if($all_fileds_enabled){
		$checked= "checked";
	}
	else{
		$checked = "";
	}
	if(is_array($all_fileds)){

			$out = '<div id="set_dimensions" class="panel woocommerce_options_panel"><div class="repeater form-field">
<div class="attr_enabled">
<h3>Enable this section</h3>
<input type="checkbox" name="product_dimensions_enabled" '.$checked.'>
</div>
			<div class="label_repeater">Dimensions Info</div>

		<div data-repeater-list="product_dimensions">';

		foreach($all_fileds as $key=>$val){

	$out .= '<div data-repeater-item="" class="data_repeater_item">

	<textarea name="product_dimensions['.$key.'][dimensions_info]" class="dynamic_repeater dynamic_repeatertext" step=".01"/>'.$val['dimensions_info'].'</textarea>

	 <input data-repeater-delete="" type="button" value="Delete" class="button cst_btn">

      </div>';

		}

		$out .= '</div>

    <input data-repeater-create type="button" value="Add" class="button cst_btn cst_btnclr"/>

</div></div>';

	} 

	else{

		$out = '<div id="set_dimensions" class="panel woocommerce_options_panel"><div class="repeater form-field">
<div class="attr_enabled">
<h3>Enable this section</h3>
<input type="checkbox" name="product_dimensions_enabled" '.$checked.'>
</div>
			

		<div for="" class="label_repeater">Dimensions Info</div>

			

    <div data-repeater-list="product_dimensions">

	<div div data-repeater-item="" class="data_repeater_item">

	  <textarea name="dimensions_info" class="dynamic_repeater dynamic_repeatertext" step=".01"/></textarea>

	   <input data-repeater-delete type="button" value="Delete" class="button cst_btn"/>

      </div>

    </div>

    <input data-repeater-create type="button" value="Add" class="button cst_btn"/>

</div></div>';

	} 

	echo $out;

}


//JD Fixing				

add_filter( 'woocommerce_product_data_tabs', 'add_Fixing_tab' , 99 , 1 );

function add_Fixing_tab( $product_data_tabs ) {

    $product_data_tabs['fixing'] = array(

        'label' => __( 'Fixing', 'my_Fixing' ),

        'target' => 'set_Fixing',

    );

    return $product_data_tabs;

}



add_action('woocommerce_product_data_panels', 'Fixing_section');

function Fixing_section(){

	

	$all_fileds = get_post_meta( get_the_ID(), 'Fixing_info_attr', true );
	$all_fileds_enabled = get_post_meta( get_the_ID(), 'Fixing_info_attr_enabled', true );
if($all_fileds_enabled){
		$checked= "checked";
	}
	else{
		$checked = "";
	}
	if(is_array($all_fileds)){

			$out = '<div id="set_Fixing" class="panel woocommerce_options_panel"><div class="repeater form-field">

			<div class="attr_enabled">
<h3>Enable this section</h3>
<input type="checkbox" name="Fixing_info_attr_enabled" '.$checked.'>
</div>
			<div class="label_repeaterimg">Image</div>

			<div for="" class="label_repeater">Fixing name</div>
			<div for="" class="label_repeater">Fixing info</div>

			

    <div data-repeater-list="Fixing_info_attr">';

		foreach($all_fileds as $key=>$val){

	$out .= '<div data-repeater-item="" class="data_repeater_item">

	<div class="imgdivcolr dynamic_repeaterimg"><img class=""  src="'.$val['cst_img_clorurl'].'" width="50" height="50"></div>

	<input type="hidden" name="Fixing_info_attr['.$key.'][cst_img_clorid]" value="'.$val['cst_img_clorid'].'" class="dynamic_repeater background_imageid"/>

	<input type="hidden" name="Fixing_info_attr['.$key.'][cst_img_clorurl]" value="'.$val['cst_img_clorurl'].'" class="dynamic_repeater background_imageurl"/>

<input type="button" class="button-primary upload_image_button" value="Insert Image" />

       

       <input type="text" name="Fixing_info_attr['.$key.'][fixing_name]" value="'.$val['fixing_name'].'" class="dynamic_repeater" step=".01"/>

	   <textarea name="Fixing_info_attr['.$key.'][fixing_info]" class="dynamic_repeater dynamic_repeaterfix" step=".01"/>
	   '.$val['fixing_info'].' </textarea>

	   <input data-repeater-delete="" type="button" value="Delete" class="button cst_btn">

      </div>';

		}

		$out .= '</div>

    <input data-repeater-create type="button" value="Add" class="button cst_btn cst_btnclr"/>

</div></div>';

	} 

	else{

		$out = '<div id="set_Fixing" class="panel woocommerce_options_panel"><div class="repeater form-field">
	<div class="attr_enabled">
<h3>Enable this section</h3>
<input type="checkbox" name="Fixing_info_attr_enabled" '.$checked.'>
</div>
			<div class="label_repeaterimg">Image</div>

			<div for="" class="label_repeater">Fixing name</div>

			

    <div data-repeater-list="Fixing_info_attr">

	

	

      <div div data-repeater-item="" class="data_repeater_item">

	  <div class="imgdivcolr dynamic_repeaterimg"><img class=""  src=" " alt="img" width="50" height="50"></div>

	  

       <input type="hidden" name="cst_img_clorid" class="dynamic_repeater background_imageid"/>

	<input type="hidden" name="cst_img_clorurl" class="dynamic_repeater background_imageurl"/>

<input type="button" class="button-primary upload_image_button" value="Insert Image" />

	   
  
	   

	   <input type="text" name="fixing_name" class="dynamic_repeater" step=".01"/>

	   <input type="text" name="fixing_info" class="dynamic_repeater dynamic_repeaterfix" step=".01"/>

	  

	   <input data-repeater-delete type="button" value="Delete" class="button cst_btn"/>

      </div>

    </div>

    <input data-repeater-create type="button" value="Add" class="button cst_btn"/>

</div></div>';

	}

	echo $out;

}

//JD Fixing



//JD Lintel Position			

add_filter( 'woocommerce_product_data_tabs', 'add_LintelPosition_tab' , 99 , 1 );

function add_LintelPosition_tab( $product_data_tabs ) {

    $product_data_tabs['LintelPosition'] = array(

        'label' => __( 'Lintel Position', 'my_LintelPosition' ),

        'target' => 'set_LintelPosition',

    );

    return $product_data_tabs;

}



add_action('woocommerce_product_data_panels', 'LintelPosition_section');

function LintelPosition_section(){

	

	$all_fileds = get_post_meta( get_the_ID(), 'LintelPosition_attr', true );
	$all_fileds_enabled = get_post_meta( get_the_ID(), 'LintelPosition_attr_enabled', true );
if($all_fileds_enabled){
		$checked= "checked";
	}
	else{
		$checked = "";
	}
	if(is_array($all_fileds)){

			$out = '<div id="set_LintelPosition" class="panel woocommerce_options_panel"><div class="repeater form-field">

			<div class="attr_enabled">
<h3>Enable this section</h3>
<input type="checkbox" name="LintelPosition_attr_enabled" '.$checked.'>
</div>
			<div class="label_repeaterimg">Image</div>

			<div for="" class="label_repeater">Lintel Position</div>
			<div for="" class="label_repeater">Lintel info</div>

			

    <div data-repeater-list="LintelPosition_attr">';

		foreach($all_fileds as $key=>$val){

	$out .= '<div data-repeater-item="" class="data_repeater_item">

	<div class="imgdivcolr dynamic_repeaterimg"><img class=""  src="'.$val['LintelPositionurl'].'" width="50" height="50"></div>

	<input type="hidden" name="LintelPosition_attr['.$key.'][LintelPositionid]" value="'.$val['LintelPositionid'].'" class="dynamic_repeater background_imageid"/>

	<input type="hidden" name="LintelPosition_attr['.$key.'][LintelPositionurl]" value="'.$val['LintelPositionurl'].'" class="dynamic_repeater background_imageurl"/>

<input type="button" class="button-primary upload_image_button" value="Insert Image" />

       

       <input type="text" name="LintelPosition_attr['.$key.'][LintelPosition_name]" value="'.$val['LintelPosition_name'].'" class="dynamic_repeater" step=".01"/>

	   <textarea name="LintelPosition_attr['.$key.'][LintelPosition_info]" class="dynamic_repeater dynamic_repeaterfix" step=".01"/>
	   '.$val['LintelPosition_info'].' </textarea>

	   <input data-repeater-delete="" type="button" value="Delete" class="button cst_btn">

      </div>';

		}

		$out .= '</div>

    <input data-repeater-create type="button" value="Add" class="button cst_btn cst_btnclr"/>

</div></div>';

	} 

	else{

		$out = '<div id="set_LintelPosition" class="panel woocommerce_options_panel"><div class="repeater form-field">
<div class="attr_enabled">
<h3>Enable this section</h3>
<input type="checkbox" name="LintelPosition_attr_enabled" '.$checked.'>
</div>
			<div class="label_repeaterimg">Image</div>

			<div for="" class="label_repeater">Fixing name</div>

			

    <div data-repeater-list="LintelPosition_attr">

	

	

      <div div data-repeater-item="" class="data_repeater_item">

	  <div class="imgdivcolr dynamic_repeaterimg"><img class=""  src=" " alt="img" width="50" height="50"></div>

	  

       <input type="hidden" name="LintelPositionid" class="dynamic_repeater background_imageid"/>

	<input type="hidden" name="LintelPositionurl" class="dynamic_repeater background_imageurl"/>

<input type="button" class="button-primary upload_image_button" value="Insert Image" />

	   
  
	   

	   <input type="text" name="LintelPosition_name" class="dynamic_repeater" step=".01"/>

	   <textarea name="LintelPosition_info" class="dynamic_repeater dynamic_repeaterfix" step=".01"/></textarea>

	  

	   <input data-repeater-delete type="button" value="Delete" class="button cst_btn"/>

      </div>

    </div>

    <input data-repeater-create type="button" value="Add" class="button cst_btn"/>

</div></div>';

	}

	echo $out;

}

//JD Lintel Position




//JD Motor Position				

add_filter( 'woocommerce_product_data_tabs', 'add_motorposition_tab' , 99 , 1 );

function add_motorposition_tab( $product_data_tabs ) {

    $product_data_tabs['motorpositionsdata'] = array(

        'label' => __( 'Motor Position', 'my_motorpositions' ),

        'target' => 'set_motorposition',

    );

    return $product_data_tabs;

}



add_action('woocommerce_product_data_panels', 'set_motorposition_section');

function set_motorposition_section(){

	

	$all_fileds = get_post_meta( get_the_ID(), 'product_motorposition', true );
	$all_fileds_enabled = get_post_meta( get_the_ID(), 'product_motorposition_enabled', true );
if($all_fileds_enabled){
		$checked= "checked";
	}
	else{
		$checked = "";
	}
	if(is_array($all_fileds)){

			$out = '<div id="set_motorposition" class="panel woocommerce_options_panel"><div class="repeater form-field">
<div class="attr_enabled">
<h3>Enable this section</h3>
<input type="checkbox" name="product_motorposition_enabled" '.$checked.'>
</div>
			<div class="label_repeater">Motor Position</div>

		<div data-repeater-list="product_motorposition">';

		foreach($all_fileds as $key=>$val){

	$out .= '<div data-repeater-item="" class="data_repeater_item">

	<textarea name="product_motorposition['.$key.'][motorposition_info]" class="dynamic_repeater dynamic_repeatertext" step=".01"/>'.$val['motorposition_info'].'</textarea>

	 <input data-repeater-delete="" type="button" value="Delete" class="button cst_btn">

      </div>';

		}

		$out .= '</div>

    <input data-repeater-create type="button" value="Add" class="button cst_btn cst_btnclr"/>

</div></div>';

	} 

	else{

		$out = '<div id="set_motorposition" class="panel woocommerce_options_panel"><div class="repeater form-field">

			
<div class="attr_enabled">
<h3>Enable this section</h3>
<input type="checkbox" name="product_motorposition_enabled" '.$checked.'>
</div>
		<div for="" class="label_repeater">Motor Position</div>

			

    <div data-repeater-list="product_motorposition">

	<div div data-repeater-item="" class="data_repeater_item">

	  <textarea name="motorposition_info" class="dynamic_repeater dynamic_repeatertext" step=".01"/></textarea>

	   <input data-repeater-delete type="button" value="Delete" class="button cst_btn"/>

      </div>

    </div>

    <input data-repeater-create type="button" value="Add" class="button cst_btn"/>

</div></div>';

	} 

	echo $out;

}
// end motorposition




// JD Optional Extras

add_filter( 'woocommerce_product_data_tabs', 'add_OptionalExtras_tab' , 99 , 1 );

function add_OptionalExtras_tab( $product_data_tabs ) {

    $product_data_tabs['set_OptionalExtras'] = array(

        'label' => __( 'Optional Extras', 'my_OptionalExtras' ),

        'target' => 'set_OptionalExtras',

    );

    return $product_data_tabs;

}

add_action('woocommerce_product_data_panels', 'cst_OptionalExtras');

function cst_OptionalExtras(){

	

	$all_fileds = get_post_meta( get_the_ID(), 'product_OptionalExtras', true );
	$all_fileds_enabled = get_post_meta( get_the_ID(), 'product_OptionalExtras_enabled', true );
if($all_fileds_enabled){
		$checked= "checked";
	}
	else{
		$checked = "";
	}
	if(is_array($all_fileds)){

			$out = '<div id="set_OptionalExtras" class="panel woocommerce_options_panel"><div class="repeater form-field">
<div class="attr_enabled">
<h3>Enable this section</h3>
<input type="checkbox" name="product_OptionalExtras_enabled" '.$checked.'>
</div>
			<div class="label_repeater">Heading</div>

			<div for="" class="label_repeater">Info</div>

			

    <div data-repeater-list="product_OptionalExtras">';

		foreach($all_fileds as $key=>$val){

	$out .= '<div data-repeater-item="">

       <input type="text" name="product_OptionalExtras['.$key.'][ex_heading]" value="'.$val['ex_heading'].'" class="dynamic_repeater"/>

       <textarea name="product_OptionalExtras['.$key.'][ex_info]" class="dynamic_repeater" step=".01"/>'.$val['ex_info'].' </textarea>

	   <input data-repeater-delete="" type="button" value="Delete" class="button cst_btn">

      </div>';

		}

		$out .= '</div>

    <input data-repeater-create type="button" value="Add" class="button cst_btn"/>

</div></div>';

	}

	else{

		$out = '

		<div id="set_OptionalExtras" class="panel woocommerce_options_panel"><div class="repeater form-field">
<div class="attr_enabled">
<h3>Enable this section</h3>
<input type="checkbox" name="product_OptionalExtras_enabled" '.$checked.'>
</div>
			<div class="label_repeater">heading</div>

			<div for="" class="label_repeater">info</div>

		

    <div data-repeater-list="product_OptionalExtras">

      <div data-repeater-item>

       <input type="text" name="ex_heading" class="dynamic_repeater"/>

       <textarea name="ex_heading" class="dynamic_repeater" step=".01"/></textarea>

	  <input data-repeater-delete type="button" value="Delete" class="button cst_btn"/>

      </div>

    </div>

    <input data-repeater-create type="button" value="Add" class="button cst_btn"/>

</div></div>';

	}

	echo $out;

}

//end Optional Extras




//jd frontend


 add_action('wp_ajax_product_colorprice_ajax_request',  'product_colorprice_ajax_request');

add_action('wp_ajax_nopriv_product_colorprice_ajax_request','product_colorprice_ajax_request');

function product_colorprice_ajax_request(){

	$color = isset( $_POST['color'] ) ? sanitize_text_field( $_POST['color'] ) : '';

	

	$colorkey = isset( $_POST['colorkey'] ) ? sanitize_text_field( $_POST['colorkey'] ) : '';

	

	$product_id = isset( $_POST['product_id'] ) ? sanitize_text_field( $_POST['product_id'] ) : '';

	

	if (!session_id()){

    session_start();

	}
	
	$_SESSION["tempcurtain_product_color_price"] =  $_SESSION["curtain_product_color_price"];
unset($_SESSION["curtain_product_color_price"]);

	if(isset($_SESSION['closhwidth']))

   {

	 $closhwidth = $_SESSION["closhwidth"];

     

   }

   if(isset($_SESSION['fnlprice']))

   {

	 $price = $_SESSION["fnlprice"];

     $_SESSION["temp_price"] = $_SESSION["fnlprice"];

   }

   	$std_cst_curtaincolor_below = get_post_meta( $product_id, 'std_cst_curtaincolor_below', true );
	$std_cst_curtaincolor_above = get_post_meta( $product_id, 'std_cst_curtaincolor_above', true );

	$lmt_cst_curtaincolor_below = get_post_meta( $product_id, 'lmt_cst_curtaincolor_below', true );
	$lmt_cst_curtaincolor_above = get_post_meta( $product_id, 'lmt_cst_curtaincolor_above', true );

	$spc_cst_curtaincolor_below = get_post_meta( $product_id, 'spc_cst_curtaincolor_below', true );
	$spc_cst_curtaincolor_above = get_post_meta( $product_id, 'spc_cst_curtaincolor_above', true );
	$white_cst_curtaincolor_below = get_post_meta( $product_id, 'white_cst_curtaincolor_below', true );
	
	$white_cst_curtaincolor_above = get_post_meta( $product_id, 'white_cst_curtaincolor_above', true );
	
	
    if($closhwidth<3500 && $colorkey=='cst_dynamic_color_attr'){

	   $_SESSION["curtain_product_color_price"] = intval($std_cst_curtaincolor_below);

   }

   if($closhwidth>=3500 && $colorkey=='cst_dynamic_color_attr'){

	   $_SESSION["curtain_product_color_price"] = intval($std_cst_curtaincolor_above);

   }

   if($closhwidth<3500 && $colorkey=='special_painted_color_attr'){

	   $_SESSION["curtain_product_color_price"] = intval($spc_cst_curtaincolor_below);

   }

   if($closhwidth>=3500 && $colorkey=='special_painted_color_attr'){

	   $_SESSION["curtain_product_color_price"] = intval($spc_cst_curtaincolor_above);

   }

   

   if($closhwidth<3500 && $colorkey=='laminate_wood_color_attr'){

	   $_SESSION["curtain_product_color_price"] = intval($lmt_cst_curtaincolor_below);

   }

   if($closhwidth>=3500 && $colorkey=='laminate_wood_color_attr'){

	   $_SESSION["curtain_product_color_price"] =  intval($lmt_cst_curtaincolor_above);

   }
   
   //white color
   if($closhwidth<3500 && $colorkey=='white_dynamic_color_attr'){

	   $_SESSION["curtain_product_color_price"] = intval($white_cst_curtaincolor_below);

   }

   if($closhwidth>=3500 && $colorkey=='white_dynamic_color_attr'){

	   $_SESSION["curtain_product_color_price"] =  intval($white_cst_curtaincolor_above);

   }

  

	   $_SESSION["curtain_product_color_name"] = $color;

   
      
$_SESSION["fnlprice"] = intval($_SESSION["fnlprice"]) + intval($_SESSION["curtain_product_color_price"]);
	
$sessionprice = abs(intval($_SESSION["curtain_product_color_price"])+ intval($_SESSION["product_fcolor_price"]));
	
	if(isset($_SESSION["tempcurtain_product_color_price"]) && $_SESSION["tempcurtain_product_color_price"] !==""){
		$_SESSION['fnlprice'] = intval($_SESSION['fnlprice']) - intval($_SESSION["tempcurtain_product_color_price"]);
	}
	
	if(!isset($_SESSION['alrdadd'])){
	$_SESSION["fnlprice"] = intval($_SESSION["fnlprice"]) + intval($_SESSION['asscpprice']);
	$_SESSION['alrdaddcolor'] = $_SESSION['asscpprice'];
}
	
$pricettl = $_SESSION['fnlprice'];
	//echo  '<p>Total Price = '.$pricettl.'</p>';

	$gif_data = array(
            'BasePrice'  => get_woocommerce_currency_symbol().$price,
            'pricettl'  => get_woocommerce_currency_symbol().$pricettl,
            'ColorPrice' => get_woocommerce_currency_symbol().$sessionprice,
        );
		
	echo json_encode($gif_data);
	exit;

}

add_action('wp_ajax_product_fcolorprice_ajax_request',  'product_fcolorprice_ajax_request');

add_action('wp_ajax_nopriv_product_fcolorprice_ajax_request','product_fcolorprice_ajax_request');

function product_fcolorprice_ajax_request(){

	$color = isset( $_POST['color'] ) ? sanitize_text_field( $_POST['color'] ) : '';

	

	$colorkey = isset( $_POST['colorkey'] ) ? sanitize_text_field( $_POST['colorkey'] ) : '';

	

	$product_id = isset( $_POST['product_id'] ) ? sanitize_text_field( $_POST['product_id'] ) : '';

	

	if (!session_id()){

    session_start();

	}
$_SESSION["tempproduct_fcolor_price"] = $_SESSION["product_fcolor_price"];
unset($_SESSION["product_fcolor_price"]);
	if(isset($_SESSION['closhwidth']))

   {

	 $closhwidth = $_SESSION["closhwidth"];

     

   }

   if(isset($_SESSION['fnlprice']))

   {

	 $price = $_SESSION["fnlprice"];

     

   }

   $framestd_cst_curtaincolor_below = get_post_meta( $product_id, 'framestd_cst_curtaincolor_below', true );
	$framestd_cst_curtaincolor_above = get_post_meta( $product_id, 'framestd_cst_curtaincolor_above', true );

	$frame_laminatewoodgrain_below = get_post_meta( $product_id, 'frame_laminatewoodgrain_below', true );
	$frame_laminatewoodgrain_above = get_post_meta( $product_id, 'frame_laminatewoodgrain_above', true );

	$spc_fcst_framecolor_below = get_post_meta( $product_id, 'spc_fcst_framecolor_below', true );
	$spc_fcst_frame_above = get_post_meta( $product_id, 'spc_fcst_frame_above', true );
	
	$white_fcst_curtaincolor_below = get_post_meta( $product_id, 'white_fcst_curtaincolor_below', true );
	
	$white_fcst_curtaincolor_above = get_post_meta( $product_id, 'white_fcst_curtaincolor_above', true );

    if($closhwidth<2800 && $colorkey=='framecst_dynamic_color_attr'){

	   $_SESSION["product_fcolor_price"] = intval($framestd_cst_curtaincolor_below);

   }

   if($closhwidth>=2800 && $colorkey=='framecst_dynamic_color_attr'){

	  $_SESSION["product_fcolor_price"] = intval($framestd_cst_curtaincolor_above);

   }

   if($closhwidth<2800 && $colorkey=='frame_special_painted_color_attr'){

	   $_SESSION["product_fcolor_price"] = intval($spc_fcst_framecolor_below);

   }

   if($closhwidth>=2800 && $colorkey=='frame_special_painted_color_attr'){

	  $_SESSION["product_fcolor_price"] = intval($spc_fcst_frame_above);

   }

   

   if($closhwidth<2800 && $colorkey=='frame_laminatewoodgrain_color_attr'){

	   $_SESSION["product_fcolor_price"] = intval($frame_laminatewoodgrain_below);

   }

   if($closhwidth>=2800 && $colorkey=='frame_laminatewoodgrain_color_attr'){

	   $_SESSION["product_fcolor_price"] = intval($frame_laminatewoodgrain_above);

   }
   
   //white color
   if($closhwidth<2800 && $colorkey=='white_dynamic_color_attr'){

	   $_SESSION["product_fcolor_price"] = intval($white_fcst_curtaincolor_below);

   }

   if($closhwidth>=2800 && $colorkey=='white_dynamic_color_attr'){

	   $_SESSION["product_fcolor_price"] =  intval($white_fcst_curtaincolor_above);

   }

  

	   $_SESSION["product_fcolor_name"] = $color;

   $sessionprice = abs(intval($_SESSION["curtain_product_color_price"])+ intval($_SESSION["product_fcolor_price"]));
$_SESSION['fnlprice'] = intval($_SESSION['fnlprice']) + intval($_SESSION["product_fcolor_price"]);
if(isset($_SESSION["tempproduct_fcolor_price"]) && $_SESSION["tempproduct_fcolor_price"] !==""){
		$_SESSION['fnlprice'] = intval($_SESSION['fnlprice']) - intval($_SESSION["tempproduct_fcolor_price"]);
	}
if(!isset($_SESSION['alrdaddcolor'])){
	$_SESSION["fnlprice"] = intval($_SESSION["fnlprice"]) + intval($_SESSION['asscpprice']);
}
$pricettl = $_SESSION['fnlprice'];
	$gif_data = array(
            'BasePrice'  => get_woocommerce_currency_symbol().$price,
            'pricettl'  => get_woocommerce_currency_symbol().$pricettl,
            'ColorPrice' => get_woocommerce_currency_symbol().$sessionprice,
        );
	echo json_encode($gif_data);
	exit; 

}





add_action('wp_ajax_cst_save_val_session',  'cst_save_val_session');

add_action('wp_ajax_nopriv_cst_save_val_session','cst_save_val_session');

function cst_save_val_session(){
	if (!session_id()){
    session_start();
	}
	if(!isset($_SESSION['other_opts'])){
	$_SESSION['other_opts'] = array();
	}
	foreach($_POST as $key => $postvar){
		$_SESSION['other_opts'][$key] = $postvar;
	}
}

add_action('wp_ajax_product_changeprice_ajax_request',  'product_changeprice_ajax_request');

add_action('wp_ajax_nopriv_product_changeprice_ajax_request','product_changeprice_ajax_request');

function product_changeprice_ajax_request(){

	$width = isset( $_POST['width'] ) ? sanitize_text_field( $_POST['width'] ) : '';

	

	$height = isset( $_POST['height'] ) ? sanitize_text_field( $_POST['height'] ) : '';

	

	$product_id = isset( $_POST['product_id'] ) ? sanitize_text_field( $_POST['product_id'] ) : '';

	

	$metadata = get_post_meta( $product_id, 'cst_dynamic_pricing', true);

	

	if (!session_id()){

    session_start();

	}
$_SESSION['fortempfnl'] = $_SESSION['fnlprice'];

foreach($_SESSION as $key => $value){
	unset($_SESSION[$key]);
}
	$_SESSION['cur_cust_prod_id'] = $_POST['product_id'];
	/* unset($_SESSION['curtain_product_color_price']); */

	

	

	$findoorprice =0;

	$doorwidth = array();

	$doorheight = array();

	$doorprice = array();

	

	foreach($metadata as $meta){

		

	$doorwidth[] = $meta['doorwidth'];

	$doorheight[] = $meta['doorheight'];

	$doorprice[] = $meta['doorprice'];

	

	}

	

	$closhwidth = getClosest($width, $doorwidth);

	$closheight = getClosest($height, $doorheight);

	

	/* if($width<$closhwidth){

		$closhwidth = getClosestsmall($width, $doorwidth);

	}

	if($height<$closheight){

		$closheight = getClosestsmall($height, $doorheight);

	}
 */
	

	foreach($metadata as $meta){

		if($closhwidth==$meta['doorwidth'] && $closheight==$meta['doorheight']){

	    $findoorprice = $meta['doorprice'];

		break;

		}

	

	} 

	//echo  '<p>Base Price = '.$findoorprice.'<p>';
	

	//echo  '<p>Total Price = '.$findoorprice.'<p>';



	$_SESSION["fnlprice"] = $findoorprice;

	$sendarr = array('main'=> $findoorprice, 'ttl' => $findoorprice);
	
if(isset($_SESSION["curtain_product_color_price"])){
	$_SESSION["fnlprice"] = intval($_SESSION["fnlprice"]) + intval($_SESSION["curtain_product_color_price"]);
	$sendarr['ttl'] = $_SESSION["fnlprice"];
}
if(isset($_SESSION["product_installation_price"])){
	$_SESSION["fnlprice"] = intval($_SESSION["fnlprice"]) + intval($_SESSION["product_installation_price"]);
	$sendarr['ttl'] = $_SESSION["fnlprice"];
}		
if(isset($_SESSION["product_fcolor_price"])){
	$_SESSION["fnlprice"] = intval($_SESSION["fnlprice"]) + intval($_SESSION["product_fcolor_price"]);
	$sendarr['ttl'] = $_SESSION["fnlprice"];
	$_SESSION["alrdproduct_fcolor_price"] = $_SESSION["product_fcolor_price"];
}
if(isset($_SESSION['asscpprice'])){
	$_SESSION["fnlprice"] = intval($_SESSION["fnlprice"]) + intval($_SESSION['asscpprice']);
	$sendarr['ttl'] = $_SESSION["fnlprice"];
	$_SESSION["alrdadd"] = $_SESSION['asscpprice'];
}
echo json_encode($sendarr);

	$_SESSION["closhwidth"] = $closhwidth;

	$_SESSION["closheight"] = $closheight;
	$_SESSION["tempwidth"] = $width;
	$_SESSION["tempheight"] = $height;

	

	exit;

}

add_filter( 'woocommerce_product_get_price', 'pr_reseller_price', 10, 2 );

function pr_reseller_price( $price, $product ) {

if (!session_id()){

    session_start();

	}
	
if($product->get_id()==$_SESSION['cur_cust_prod_id']){
   
   if(isset($_SESSION['upfnlprice'])){
	   $price = $_SESSION['upfnlprice'];
   }
}
     return $price;  



}


function getClosest($search, $arr) {

 foreach ($arr as $i) {
    if($i>=$search){
        return $i;
    }
}

   return $closest;

}

function getClosestsmall($search, $arr) {

   $closest = null;

   

   foreach ($arr as $item) {

	   if ($closest === null || abs($search - $closest) > abs($item - $search)) 

		  {

			  if($search<=$item)
			  {
				  break;

			  }

			  else{

				 $closest = $item; 

			  }

			 

		  }

	  

   }

   

   return $closest; 

}


function cw_remove_quantity_fields( $return, $product ) {
$terms = get_the_terms( $product->get_id(), 'product_cat' );
foreach($terms as $term){
	
	if($term->slug=='roller-garage-doors')
	{
		return true;
		break;
	}
}
}
add_filter( 'woocommerce_is_sold_individually', 'cw_remove_quantity_fields', 10, 2 );

add_filter( 'woocommerce_add_to_cart_validation', 'remove_cart_item_before_add_to_cart', 20, 3 );

function remove_cart_item_before_add_to_cart( $passed, $product_id, $quantity ) {

    if( ! WC()->cart->is_empty())

        WC()->cart->empty_cart();

    return $passed;

}


add_filter( 'woocommerce_add_cart_item_data', 'add_custom_fields_cart_item_data', 10, 2 );
function add_custom_fields_cart_item_data( $cart_item_data, $product_id ){
   if (!session_id()){

    session_start();

	}
	if($product_id != $_SESSION['cur_cust_prod_id']){
		return;
	}
	$_SESSION['save_in_ordermeta']=array();
	
		
	$cart_item_data['cst_custom_data'][$product_id]['opening_width'] = $_SESSION["tempwidth"]." mm";
	$cart_item_data['cst_custom_data'][$product_id]['opening_height'] = $_SESSION["tempheight"]." mm";

		if(isset($_SESSION['other_opts'])){
			foreach($_SESSION['other_opts'] as $key=>$val){
				if($key == 'action'|| $key == 'mtrnxt'){
					continue;
				}
				$_SESSION['save_in_ordermeta'][$key] = $val;
					$cart_item_data['cst_custom_data'][$product_id][str_replace(" ", "_", strtolower($key))] = $val;
			}
			
		} 
	if(isset($_SESSION['curtain_product_color_name'])){
	$cart_item_data['cst_custom_data'][$product_id]['curtain'] = $_SESSION['curtain_product_color_name'];
	}
	if(isset($_SESSION['product_fcolor_name'])){
	$cart_item_data['cst_custom_data'][$product_id]['frame'] = $_SESSION['product_fcolor_name'];
	}
WC()->session->set( 'cst_custom_data', $cart_item_data['cst_custom_data'] );
    return $cart_item_data;
}

// Save values as Order item data and display them everywhere
add_action('woocommerce_checkout_create_order_line_item', 'save_custom_fields_as_order_item_meta', 20, 4);
function save_custom_fields_as_order_item_meta($item, $cart_item_key, $values, $order) {
		$product_id = $item->get_product_id();
	if( ! isset($values['cst_custom_data'][$product_id]) )
        return;

    $text_domain ='woocommerce';

    // Save values:
foreach($values['cst_custom_data'][$product_id] as $key=>$val){
	$item->update_meta_data( __(ucfirst(str_replace("_", " ", $key)), $text_domain), $val );
}

}

// Displaying the custom attributes in cart and checkout items

add_filter( 'woocommerce_get_item_data', 'customizing_cart_item_data', 10, 2 );

function customizing_cart_item_data( $cart_data, $cart_item ) {

    if (!session_id()){

    session_start();

	}
	
	if($cart_item['product_id'] == $_SESSION['cur_cust_prod_id']){
	
	$_SESSION['save_in_ordermeta']=array();
	
	if(isset($_SESSION['curtain_product_color_price']))

   {

	 $pcolor_price = $_SESSION["curtain_product_color_price"];

	 $pcolor_name = $_SESSION["curtain_product_color_name"];

     

   }



   /* $custom_items[] = array(

            'name'      => 'Color Name',

            'value'     => $pcolor_name,

        );

	$custom_items[] = array(

            'name'      => 'Color price',

            'value'     => $pcolor_price,

        ); */
		
	$custom_items[] = array(

            'name'      => 'Opening Width',

            'value'     => $_SESSION["tempwidth"]." mm",

        );
		$_SESSION['save_in_ordermeta']['opening_width'] = $_SESSION["tempwidth"]." mm";
	$custom_items[] = array(

            'name'      => 'Opening Height',

            'value'     => 	$_SESSION["tempheight"]." mm",

        );
		$_SESSION['save_in_ordermeta']['opening_height'] = $_SESSION["tempheight"]." mm";
		//var_dump($_SESSION['other_opts']);
		if(isset($_SESSION['other_opts'])){
			foreach($_SESSION['other_opts'] as $key=>$val){
				if($key == 'action'|| $key == 'mtrnxt'){
					continue;
				}
				$_SESSION['save_in_ordermeta'][$key] = $val;
					$custom_items[] = array(

					'name'      => ucFirst($key),

					'value'     => $val,

					);
			}
			
		} 
	if(isset($_SESSION['curtain_product_color_name'])){
	$custom_items[] = array(

            'name'      => 'Curtain',

            'value'     => $_SESSION['curtain_product_color_name'],

        );
			$_SESSION['save_in_ordermeta']['curtain'] = $_SESSION['curtain_product_color_name'];
	}
	if(isset($_SESSION['product_fcolor_name'])){
	$custom_items[] = array(

            'name'      => 'Frame',

            'value'     => $_SESSION['product_fcolor_name'],

        );
		$_SESSION['save_in_ordermeta']['frame'] = $_SESSION['product_fcolor_name'];
	}
	/* if(isset($_SESSION['accessories_for_'.$cart_item['product_id']])){
	foreach($_SESSION['accessories_for_'.$cart_item['product_id']] as $asscory){
		$product = wc_get_product( $asscory );		
		$_SESSION['save_in_ordermeta'][get_the_title($asscory)] = $product->get_price();
	$custom_items[] = array(

            'name'      => get_the_title($asscory),

            'value'     => $product->get_price(),

        );
	}
	} */
		
}
    return $custom_items;

}









function cloudways_save_extra_details( $post_id, $post ){

    update_post_meta($post_id, '_cloudways_text_field', 'myname');

    update_post_meta( $post_id, '_cloudways_dropdown', 'hi');

}

add_action( 'woocommerce_process_shop_order_meta', 'cloudways_save_extra_details', 45, 2 );

 

function cloudways_display_order_data_in_admin( $order ){  ?>

    <div class="order_data_column">
<?php 		
$in_ordermeta = get_post_meta($order->get_id(), 'cst_order_meta');
if($in_ordermeta){ 
?>
        <h4><?php _e( 'Additional Information', 'woocommerce' ); ?></h4>

        <div class="address">

        <?php

		//var_dump($in_ordermeta);
		foreach($in_ordermeta as $ordrmta){
		foreach($ordrmta as $key => $ordrmtaval){
			 echo '<p><strong>' . ucFirst(str_replace("_", ' ', $key )) . ':</strong>' . $ordrmtaval . '</p>';
		}
		}
?>
        </div>

       

    </div>
	

<?php }

}

add_action( 'woocommerce_admin_order_data_after_order_details', 'cloudways_display_order_data_in_admin' );

add_action('woocommerce_after_single_product_summary', 'cst_product_custom');
function cst_product_custom(){
	global $post;
$terms = wp_get_post_terms( $post->ID, 'product_cat' );
foreach ( $terms as $term ) $categories[] = $term->slug;

if ( in_array( 'roller-garage-doors', $categories ) ) {
	$product_id =  get_the_id();
	$product_dimensions_enabled = get_post_meta( $product_id, 'product_dimensions_enabled', true );
	$Fixing_info_attr_enabled = get_post_meta( $product_id, 'Fixing_info_attr_enabled', true );
	$LintelPosition_attr_enabled = get_post_meta( $product_id, 'LintelPosition_attr_enabled', true );
	$product_motorposition_enabled = get_post_meta( $product_id, 'product_motorposition_enabled', true );
	$white_dynamic_color_attr_enabled = get_post_meta( $product_id, 'white_dynamic_color_attr_enabled', true );
	$cst_dynamic_color_attr_enabled = get_post_meta( $product_id, 'cst_dynamic_color_attr_enabled', true );
    $special_painted_color_attr_enabled = get_post_meta( $product_id, 'special_painted_color_attr_enabled', true );
	$laminate_wood_color_attr_enabled = get_post_meta( $product_id, 'laminate_wood_color_attr_enabled', true );
    $framecst_dynamic_color_attr_enabled = get_post_meta( $product_id, 'framecst_dynamic_color_attr_enabled', true );
	$frame_special_painted_color_attr_enabled = get_post_meta( $product_id, 'frame_special_painted_color_attr_enabled', true );
	$frame_laminatewoodgrain_color_attr_enabled = get_post_meta( $product_id, 'frame_laminatewoodgrain_color_attr_enabled', true );
	$cst_supply_price_enable = get_post_meta( $product_id, 'cst_supply_price_enable', true );
	?>
	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	
  <div class="panel panel-default">
  
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a >
          Door Width & Height <span class="glyphicon glyphicon-minus"></span>
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
		 <h2 class="fs-title">Enter Door Width & Height</h2>
         <p>Calculate the price of your roller door for DIY or professional installation.</p>
		 
		 <p>To help find your dimensions, view our handy measuring guide <a href="https://www.rollerdoors.net/wp-content/uploads/2019/08/measuring-guide.pdf" target="_blank">here</a></p>
		 <p class="cst_error">All fields are mandatory</p>
		 <div class="row">
		 <div class="col-md-6">
		   <label  class="cst_labels">Opening Width (mm)</label>
				<input type="number" name="width" placeholder="2000mm - 5000mm" class="form-control width-feild minmaxwidth" min="2000" max="5000" value="" required="required">
				 <p class="minmaxwidth_er"></p>
			</div>
			<div class="col-md-6">			
            <label class="cst_labels">Opening Height</label>
			
			 <input type="number" name="width" placeholder="1900mm - 3000mm" class="form-control height-feild minmaxheight" min="1900" max="3000" value="" required="required">
			 <p class="minmaxheight_er"></p>
			 <input type="hidden" name="product_id" class="product_id" value="<?php echo $product_id; ?>" >
			 </div>
			 </div>
        <a class="btn btn-default cst_nxt firstnextcls">Next</a> 
		<?php
	
	if($product_dimensions_enabled){
	$collapse1 = 'collapseTwo';
	}
	else if($Fixing_info_attr_enabled){
		$collapse1 = 'collapseThree';
	}
	else if($LintelPosition_attr_enabled){
		$collapse1 = 'collapseFour';
	}
	else if($product_motorposition_enabled){
		$collapse1 = 'collapseFive';
	}
	else if($white_dynamic_color_attr_enabled || $cst_dynamic_color_attr_enabled || $special_painted_color_attr_enabled || $laminate_wood_color_attr_enabled){ 
	$collapse1 = 'collapseSix';
	}
	else if($white_dynamic_color_attr_enabled || $framecst_dynamic_color_attr_enabled || $frame_special_painted_color_attr_enabled || $frame_laminatewoodgrain_color_attr_enabled){ 
		$collapse1 = 'collapseSeven';
	}
	else{
		$collapse1 = 'collapseEight';
	}
		?>
		<a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $collapse1; ?>" aria-expanded="true" aria-controls="<?php echo $collapse1; ?>" class="btn btn-default visiblenone">Next</a> 
      </div>
    </div>
  </div>
  	<?php 		   

	if($product_dimensions_enabled){
		?>
  
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a>
          Dimensions <span class="glyphicon glyphicon-minus"></span>
        </a>
      </h4>
    </div>

    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
         <h2 class="fs-title">Dimensions</h2>
		 <?php 
		   $prodimnsn = get_post_meta( $product_id, 'product_dimensions', true );
		   if(!empty($prodimnsn)){
			   foreach($prodimnsn as $prodimn)
			   {
				  
				  echo'<p>'.$prodimn['dimensions_info'].'</p>';
			   }
			   
			   
		   }
		 
		 ?>
		  <p class="cst_error">All fields are mandatory</p>
		 <div class="row">
		  <div class="col-md-4">
            <label>Headroom (mm)</label>
				<input type="number" name="headroom" id="headroom" placeholder="" class="form-control width-feild" value="" required="required">
		  </div>
		  <div class="col-md-4">
            <label>Left Side Room (mm)</label>
			  <input type="number" name="leftside" id="leftside" placeholder="" class="form-control" value="" required="required">
		  </div>
		  <div class="col-md-4">
			  <label>Right Side Room (mm)</label>
			
			 <input type="number" name="rightside" id="rightside" placeholder="" class="form-control" value="" required="required">
		 </div>
			 
		</div>
		<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="btn btn-default">Previous</a>
		<a class="btn btn-default cst_nxt thirdnxt">Next</a> 
		<?php
		if($Fixing_info_attr_enabled){
		$collapse2 = 'collapseThree';
	}
	else if($LintelPosition_attr_enabled){
		$collapse2 = 'collapseFour';
	}
	else if($product_motorposition_enabled){
		$collapse2 = 'collapseFive';
	}
	else if($white_dynamic_color_attr_enabled || $cst_dynamic_color_attr_enabled || $special_painted_color_attr_enabled || $laminate_wood_color_attr_enabled){ 
	$collapse2 = 'collapseSix';
	}
	else if($white_dynamic_color_attr_enabled || $framecst_dynamic_color_attr_enabled || $frame_special_painted_color_attr_enabled || $frame_laminatewoodgrain_color_attr_enabled){ 
		$collapse2 = 'collapseSeven';
	}
	else{
		$collapse2 = 'collapseEight';
	}
		?>
		<a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $collapse2; ?>" aria-expanded="true" aria-controls="<?php echo $collapse2; ?>" class="btn btn-default visiblenone">Next</a> 
      </div>
    </div>
  </div>
  
	<? } ?>
  <?php 		   
	if($Fixing_info_attr_enabled){
		?>
  
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a >
          Fixing <span class="glyphicon glyphicon-minus"></span>
        </a>
      </h4>
    </div>

    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
         
           <?php 
			$product_id =  get_the_id();
			$Fixings = get_post_meta( $product_id, 'Fixing_info_attr', true );
				
            ?>
		   <p>How do you require your guide runners to be fitted?</p>
		   <?php 
		   if(!empty($Fixings)){
		   foreach($Fixings as $Fixing)
		   {
			  ?>
			  <p><strong><?php echo $Fixing['fixing_name'];?></strong><?php echo $Fixing['fixing_info'];?></p>
		   <?php 
		   }
		   ?>
		   	 <p class="cst_error">Select atleast one</p>
			 <div class="myclclsfixcvr">
		   <?php
		   foreach($Fixings as $Fixin)
		   {
			  ?>
			   <div class="myclcls myclclsfix">
			    <label>
			   <input type="radio" name="fixing" value="<?php echo $Fixin['fixing_name']; ?>" class="radiobtn form-control" colorkey="cst_dynamic_color_attr">
			   <img src="<?php echo $Fixin['cst_img_clorurl'];?>">
			    </label>
			   <span><?php echo $Fixin['fixing_name'];?></span> 
			   </div>
			   <?php
			   
			}
			?>
			</div>
			<?php
		   }
		   
		   ?>
		   
		   
			 <p class="minmaxheight_er"></p>
			  <?php 
		if($product_dimensions_enabled){
		$collapsep3 = 'collapseTwo';
	}
	else{
		$collapsep3 = 'collapseOne';
	}
		?>
			 <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $collapsep3; ?>" aria-expanded="true" aria-controls="<?php echo $collapsep3; ?>" class="btn btn-default">Previous</a>
        <a class="btn btn-default cst_nxt fxngnxt">Next</a> 
		<?php
		if($LintelPosition_attr_enabled){
		$collapse3 = 'collapseFour';
	}
	else if($product_motorposition_enabled){
		$collapse3 = 'collapseFive';
	}
	else if($white_dynamic_color_attr_enabled || $cst_dynamic_color_attr_enabled || $special_painted_color_attr_enabled || $laminate_wood_color_attr_enabled){ 
	$collapse3 = 'collapseSix';
	}
	else if($white_dynamic_color_attr_enabled || $framecst_dynamic_color_attr_enabled || $frame_special_painted_color_attr_enabled || $frame_laminatewoodgrain_color_attr_enabled){ 
		$collapse3 = 'collapseSeven';
	}
	else{
		$collapse3 = 'collapseEight';
	}
	?>
     <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $collapse3; ?>" aria-expanded="true" aria-controls="<?php echo $collapse3; ?>" class="btn btn-default visiblenone">Next</a> 
    </div>
  </div>
  
  </div>
	<?php } ?>
 
 
 	<?php 
	if($LintelPosition_attr_enabled){
 ?>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a >
          Lintel Position <span class="glyphicon glyphicon-minus"></span>
        </a>
      </h4>
    </div>
    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        
          <?php 
			$product_id =  get_the_id();
			$LintelPosition = get_post_meta( $product_id, 'LintelPosition_attr', true );
				
            ?>
		   <p>The lintel position determines where your top box is fitted. Please refer to our <a href="https://www.rollerdoors.net/wp-content/uploads/2019/08/measuring-guide.pdf" target="_blank">measuring guide here</a> for more information.</p>
		   <?php 
		   if(!empty($LintelPosition)){
		   foreach($LintelPosition as $LintelPos)
		   {
			  ?>
			  <p><strong><?php echo $LintelPos['LintelPosition_name'];?></strong><?php echo $LintelPos['LintelPosition_info'];?></p>
		   <?php 
		   }
		   ?>
			 <p class="cst_error">Select atleast one</p>
			<div class="row">
			<?php
		   foreach($LintelPosition as $LintelPos)
		   {
			  ?>
			  
			  <div class="col-md-4 intelpostn">
			    <label>
			   <input type="radio" name="lintel" value="<?php echo $LintelPos['LintelPosition_name']; ?>" class="radiobtn form-control" colorkey="cst_dynamic_color_attr">
			   <img src="<?php echo $LintelPos['LintelPositionurl'];?>">
			    </label>
			   <span><?php echo $LintelPos['LintelPosition_name'];?></span> 
			   
			   </div>
			   <?php
			   
			}
			?>
			</div>
			<?php
		   }
		   
		   ?>
		   
		   
			 <p class="minmaxheight_er"></p>
			  <?php 
		 if($Fixing_info_attr_enabled){
		$collapsep4 = 'collapseThree';
	}
	else if($product_dimensions_enabled){
		$collapsep4 = 'collapseTwo';
	}
	else{
		$collapsep4 = 'collapseOne';
	}

		?>
			  <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $collapsep4; ?>" aria-expanded="true" aria-controls="<?php echo $collapsep4; ?>" class="btn btn-default">Previous</a>
        <a class="btn btn-default cst_nxt lintel">Next</a> 
		<?php
		if($product_motorposition_enabled){
		$collapse4 = 'collapseFive';
	}
	else if($white_dynamic_color_attr_enabled || $cst_dynamic_color_attr_enabled || $special_painted_color_attr_enabled || $laminate_wood_color_attr_enabled){ 
	$collapse4 = 'collapseSix';
	}
	else if($white_dynamic_color_attr_enabled || $framecst_dynamic_color_attr_enabled || $frame_special_painted_color_attr_enabled || $frame_laminatewoodgrain_color_attr_enabled){ 
		$collapse4 = 'collapseSeven';
	}
	else{
		$collapse4 = 'collapseEight';
	}
		?>
	 <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $collapse4; ?>" aria-expanded="true" aria-controls="<?php echo $collapse4; ?>" class="btn btn-default visiblenone">Next</a> 
     
    </div>
  </div>
  
</div>
	<?php } ?>
 
 <?php 
 if($product_motorposition_enabled){
 ?>
 <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a >
          Motor Position<span class="glyphicon glyphicon-minus"></span>
        </a>
		
      </h4>
    </div>
    <div id="collapseFive" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        
           <?php 
			$product_id =  get_the_id();
			$motorposition = get_post_meta( $product_id, 'product_motorposition', true );
				
            ?>
		   
		   <?php 
		   if(!empty($motorposition)){
		   foreach($motorposition as $motorpos)
		   {
			  ?>
			  <p><?php echo $motorpos['motorposition_info'];?></p>
		   <?php 
		   }
		   }?>
		 <p class="cst_error">Select atleast one</p>
		   <div class="row">
		   <div class="col-md-6">
			  <input type="radio" name="motorposition" value="Left" class="radiobtn1 form-control"><span>Left</span>
		   </div>
		   <div class="col-md-6">
		     <input type="radio" name="motorposition" value="Right" class="radiobtn1 form-control"><span>Right</span>
		   </div>
		   </div>
		   
			 <p class="minmaxheight_er"></p>
			  <?php 
		if($LintelPosition_attr_enabled){
		$collapsep5 = 'collapseFour';
	}
	else if($Fixing_info_attr_enabled){
		$collapsep5 = 'collapseThree';
	}
	else if($product_dimensions_enabled){
		$collapsep5 = 'collapseTwo';
	}
	else{
		$collapsep5 = 'collapseOne';
	}

		?>
			 <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $collapsep5; ?>" aria-expanded="true" aria-controls="<?php echo $collapsep5; ?>" class="btn btn-default">Previous</a>
        <a class="btn btn-default cst_nxt mtrnxt">Next</a> 
		<?php
		if($white_dynamic_color_attr_enabled || $cst_dynamic_color_attr_enabled || $special_painted_color_attr_enabled || $laminate_wood_color_attr_enabled){ 
	$collapse5 = 'collapseSix';
	}
	else if($white_dynamic_color_attr_enabled || $framecst_dynamic_color_attr_enabled || $frame_special_painted_color_attr_enabled || $frame_laminatewoodgrain_color_attr_enabled){ 
		$collapse5 = 'collapseSeven';
	}
	else{
		$collapse5 = 'collapseEight';
	}
		?>
		 <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $collapse5; ?>" aria-expanded="true" aria-controls="<?php echo $collapse5; ?>" class="btn btn-default visiblenone">Next</a> 
     
      </div>
    </div>
  
   </div>
 <?php } ?>
<?php  if($white_dynamic_color_attr_enabled || $cst_dynamic_color_attr_enabled || $special_painted_color_attr_enabled || $laminate_wood_color_attr_enabled){ ?>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a class="collapsed">
          Select Curtain Colour <span class="glyphicon glyphicon-minus"></span>
        </a>
      </h4>
    </div>
    <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" >
      <div class="panel-body">
        <h3 class="fs-title">Select Colour</h3>
		 <p class="cst_error">Select atleast one</p>
		  <div class="row">
			<?php 
			$product_id =  get_the_id();
		   $allcolors = get_post_meta( $product_id, 'cst_dynamic_color_attr', true );
		   
		   $whitecolors = get_post_meta( $product_id, 'white_dynamic_color_attr', true );
	
 if($white_dynamic_color_attr_enabled){

		   if(!empty($whitecolors)){
		   foreach($whitecolors as $whitecolor)
		   {
			   ?>
			   <div class="myclcls">
			    <label>
			   <input type="radio" name="curtaincolor" value="<?php echo $whitecolor['white_clr_name']; ?>" class="radiobtn form-control" colorkey="white_dynamic_color_attr">
			   <img src="<?php echo $whitecolor['white_img_clorurl']; ?>">
			    </label>
			   <span><?php echo $whitecolor['white_clr_name']; ?></span> 
			   </div>
			   <?php
			   
			   }}
		       
 }
		
 if($cst_dynamic_color_attr_enabled){
		   if(!empty($allcolors)){
		   foreach($allcolors as $allcolor)
		   {
			   ?>
			   <div class="myclcls">
			    <label>
			   <input type="radio" name="curtaincolor" value="<?php echo $allcolor['cst_clr_name']; ?>" class="radiobtn form-control" colorkey="cst_dynamic_color_attr">
			   <img src="<?php echo $allcolor['cst_img_clorurl']; ?>">
			    </label>
			   <span><?php echo $allcolor['cst_clr_name']; ?></span> 
			   </div>
			   <?php
			   
			   
		       
		   }}
 }
		   
		   $allcolors = get_post_meta( $product_id, 'special_painted_color_attr', true );
		   if($special_painted_color_attr_enabled){
		   if(!empty($allcolors)){
		    foreach($allcolors as $allcolor)
		   {
			   ?>
			   <div class="myclcls">
			   <label>
			   <input type="radio" name="curtaincolor" value="<?php echo $allcolor['cst_clr_name']; ?>" class="radiobtn form-control" colorkey="special_painted_color_attr">
			   <img src="<?php echo $allcolor['cst_img_clorurl']; ?>">
			   </label>
			   <span><?php echo $allcolor['cst_clr_name']; ?></span> 
			   </div>
			   <?php
			   
			   
		       
		   }}
		   }
		   
		   
		   
		   
		   $allcolors = get_post_meta( $product_id, 'laminate_wood_color_attr', true );

		   if($laminate_wood_color_attr_enabled){
		   if(!empty($allcolors)){
		    foreach($allcolors as $allcolor)
		   {
			   ?>
			   <div class="myclcls">
			    <label>
			   <input type="radio" name="curtaincolor" value="<?php echo $allcolor['cst_clr_name']; ?>" class="radiobtn form-control" colorkey="laminate_wood_color_attr">
			   <img src="<?php echo $allcolor['cst_img_clorurl']; ?>">
			    </label>
			   <span><?php echo $allcolor['cst_clr_name']; ?></span> 
			   </div>
			   <?php
			   
			   
		       
		   }}
		   }
		    
		   
		   ?>
			
			</div>
        
           <p class="minmaxheight_erclr"></p> 
		   <?php 
		if($product_motorposition_enabled){ 
		$collapsep6 = 'collapseFive';
	}
	else if($LintelPosition_attr_enabled){
		$collapsep6 = 'collapseFour';
	}
	else if($Fixing_info_attr_enabled){
		$collapsep6 = 'collapseThree';
	}
	else if($product_dimensions_enabled){
		$collapsep6 = 'collapseTwo';
	}
	else{
		$collapsep6 = 'collapseOne';
	}

		?>
        <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $collapsep6; ?>" aria-expanded="true" aria-controls="<?php echo $collapsep6; ?>" class="btn btn-default">Previous</a>
        <a class="btn btn-default cst_nxt colornext">Next</a>
		<?php 
		if($white_dynamic_color_attr_enabled || $framecst_dynamic_color_attr_enabled || $frame_special_painted_color_attr_enabled || $frame_laminatewoodgrain_color_attr_enabled){ 
		$collapse6 = 'collapseSeven';
	}
	else{
		$collapse6 = 'collapseEight';
	}
		?>
		 <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $collapse6; ?>" aria-expanded="true" aria-controls="<?php echo $collapse6; ?>" class="btn btn-default visiblenone">Next</a> 
      </div>
    </div>
  </div>
<?php } ?>
<?php if($white_dynamic_color_attr_enabled || $framecst_dynamic_color_attr_enabled || $frame_special_painted_color_attr_enabled || $frame_laminatewoodgrain_color_attr_enabled){ ?>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a class="collapsed">
          Select Frame Colour <span class="glyphicon glyphicon-minus"></span>
        </a>
      </h4>
    </div>
    <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        <h3 class="fs-title">Select Colour</h3>
		 <p class="cst_error">Select atleast one</p>
		  <div class="row">
			<?php 
			$product_id =  get_the_id();
		   $allcolors = get_post_meta( $product_id, 'framecst_dynamic_color_attr', true );
		   $whitecolors = get_post_meta( $product_id, 'white_dynamic_color_attr', true );
		   
		   if($white_dynamic_color_attr_enabled){
		   if(!empty($whitecolors)){
		   foreach($whitecolors as $whitecolor)
		   {
			   ?>
			   <div class="myclcls">
			    <label>
			   <input type="radio" name="framecolor" value="<?php echo $whitecolor['white_clr_name']; ?>" class="radiobtn form-control" colorkey="white_dynamic_color_attr">
			   <img src="<?php echo $whitecolor['white_img_clorurl']; ?>">
			    </label>
			   <span><?php echo $whitecolor['white_clr_name']; ?></span> 
			   </div>
			   <?php
			   
			   }}
		   }
			   
			   
		   if($framecst_dynamic_color_attr_enabled){
		   if(!empty($allcolors)){
		   foreach($allcolors as $allcolor)
		   {
			   ?> 
			   <div class="myclcls">
			    <label>
			   <input type="radio" name="framecolor" value="<?php echo $allcolor['cst_clr_name']; ?>" class="radiobtn form-control" colorkey="framecst_dynamic_color_attr">
			   <img src="<?php echo $allcolor['cst_img_clorurl']; ?>">
			    </label>
			   <span><?php echo $allcolor['cst_clr_name']; ?></span> 
			   </div>
			   <?php
			   
			   
		       
		   }}
		   }
		   
		   $allcolors = get_post_meta( $product_id, 'frame_special_painted_color_attr', true );
		   
		   if($frame_special_painted_color_attr_enabled){
		   if(!empty($allcolors)){
		    foreach($allcolors as $allcolor)
		   {
			   ?>
			   <div class="myclcls">
			   <label>
			   <input type="radio" name="framecolor" value="<?php echo $allcolor['cst_clr_name']; ?>" class="radiobtn form-control" colorkey="frame_special_painted_color_attr">
			   <img src="<?php echo $allcolor['cst_img_clorurl']; ?>">
			   </label>
			   <span><?php echo $allcolor['cst_clr_name']; ?></span> 
			   </div>
			   <?php
			   
			   
		       
		   }}
		   }
		   
		   
		   
		   $allcolors = get_post_meta( $product_id, 'frame_laminatewoodgrain_color_attr', true );
		   
		   if($frame_laminatewoodgrain_color_attr_enabled){
		   if(!empty($allcolors)){
		    foreach($allcolors as $allcolor)
		   {
			   ?>
			   <div class="myclcls">
			    <label>
			   <input type="radio" name="framecolor" value="<?php echo $allcolor['cst_clr_name']; ?>" class="radiobtn form-control" colorkey="frame_laminatewoodgrain_color_attr">
			   <img src="<?php echo $allcolor['cst_img_clorurl']; ?>">
			    </label>
			   <span><?php echo $allcolor['cst_clr_name']; ?></span> 
			   </div>
			   <?php
			   
			   
		       
		   }}
		   }
		    
		   
		   ?>
			
			</div>
        
           <p class="minmaxheight_erclr"></p> 
		     <?php 
	if($white_dynamic_color_attr_enabled || $cst_dynamic_color_attr_enabled || $special_painted_color_attr_enabled || $laminate_wood_color_attr_enabled){ 
		$collapsep7 = 'collapseSix';
	}
	else if($product_motorposition_enabled){ 
		$collapsep7 = 'collapseFive';
	}
	else if($LintelPosition_attr_enabled){
		$collapsep7 = 'collapseFour';
	}
	else if($Fixing_info_attr_enabled){
		$collapsep7 = 'collapseThree';
	}
	else if($product_dimensions_enabled){
		$collapsep7 = 'collapseTwo';
	}
	else{
		$collapsep7 = 'collapseOne';
	}

		?>
        <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $collapsep7; ?>" aria-expanded="true" aria-controls="<?php echo $collapsep7; ?>" class="btn btn-default">Previous</a>
        <a class="btn btn-default cst_nxt fcolornext">Next</a>
		 <a data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="true" aria-controls="collapseEight" class="btn btn-default visiblenone">Next</a> 
      </div>
    </div>
  </div>
 
<?php } ?>
 
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a >
          Optional Extras <span class="glyphicon glyphicon-minus"></span>
        </a>
      </h4>
    </div>
    <div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
         <h2 class="fs-title">Choose Optional Extras</h2>
           
		   
		   
		   <div class="row">
			<?php 
			$product_id =  get_the_id();
			$cat_id = get_field( "productcat", $product_id );
			$products = get_field( "select_products", $product_id );
		
		   
		   if(!empty($products)){
			   ?>
			   <div class="myclclsfixcvr">
			   <?php
		   foreach($products as $product)
		   {
			   $catproid = $product->ID;
			   $productobj = wc_get_product( $catproid );
				$catproname =  $product->post_title;
				$postimgurl = get_the_post_thumbnail_url($catproid);
			   ?>
			   <div class="myclcls myclclsfix">
			    <label>
			   <input type="checkbox" name="extraacc" value="<?php echo $catproname; ?>" class="radiobtn form-control" cst-attr-id="<?php echo $catproid; ?>" cst-attr-ttl="<?php echo $catproname; ?>" cst-attr-prc="<?php echo $productobj->get_price(); ?>">
			   <img src="<?php echo $postimgurl; ?>" width="150" height="150">
			    </label>
			   <span><?php echo $catproname; ?> (<?php echo get_woocommerce_currency_symbol().$productobj->get_price(); ?>)</span> 
			   </div>
			   <?php
			   
			   
		       
		   }
		   ?>
		   </div>
		   <?php
		   }
		   
		   ?>
		   
		   
			 <p class="minmaxheight_er"></p>
       
      </div>
	     <?php 
	if($framecst_dynamic_color_attr_enabled || $frame_special_painted_color_attr_enabled || $frame_laminatewoodgrain_color_attr_enabled){ 
		$collapsep8 = 'collapseSeven';
	}
	else if($cst_dynamic_color_attr_enabled || $special_painted_color_attr_enabled || $laminate_wood_color_attr_enabled){
		 	$collapsep8 = 'collapseSix';
	 }
	else if($product_motorposition_enabled){ 
		$collapsep8 = 'collapseFive';
	}
	else if($LintelPosition_attr_enabled){
		$collapsep8 = 'collapseFour';
	}
	else if($Fixing_info_attr_enabled){
		$collapsep8 = 'collapseThree';
	}
	else if($product_dimensions_enabled){
		$collapsep8 = 'collapseTwo';
	}
	else{
		$collapsep8 = 'collapseOne';
	}

		?>
	     <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $collapsep8; ?>" aria-expanded="true" aria-controls="<?php echo $collapsep8; ?>" class="btn btn-default">Previous</a>
		 <?php  if($cst_supply_price_enable){ ?>
		 <a class="btn btn-default cst_nxt instaopt">Next</a>
		 <a data-toggle="collapse" data-parent="#accordion" href="#collapseNine" aria-expanded="true" aria-controls="collapseNine" class="btn btn-default visiblenone">Next</a> 
		 <?php } ?>
    </div>
  </div>
  
</div>
 <?php 
 
 if($cst_supply_price_enable){
 ?>
<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a >
          Installation Options<span class="glyphicon glyphicon-minus"></span>
        </a>
      </h4>
    </div>
    <div id="collapseNine" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
         <h2 class="fs-title">Choose Installation Option</h2>
		   <div class="row">
			
			   <div class="myclclsfixcvr">
			
			   <div class="myclcls myclclsfix installpricecst">
			   <input type="radio" name="installopts" value="cst_supply_price" class="radiobtn form-control nohid">
			   <span>Supply only (<?php echo get_woocommerce_currency_symbol().get_post_meta($product_id, 'cst_supply_price', true);?>)</span> 
			   </div>
			   <div class="myclcls myclclsfix installpricecst">
			   <input type="radio" name="installopts" value="cst_pe_2_8_lower" class="radiobtn form-control nohid">
			   <span>Professional installation (under 2.8m wide doors) <?php echo get_woocommerce_currency_symbol().get_post_meta($product_id, 'cst_pe_2_8_lower', true);?></span> 
			   </div>
			   <div class="myclcls myclclsfix installpricecst">
			   <input type="radio" name="installopts" value="cst_pe_2_8_upper" class="radiobtn form-control nohid">
			   <span>Professional installation (over 2.8m wide doors) <?php echo get_woocommerce_currency_symbol().get_post_meta($product_id, 'cst_pe_2_8_upper', true);?></span> 
			   </div>
			 <p class="minmaxheight_er"></p>
       
      </div>
    </div>
	     <a data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="true" aria-controls="collapseEight" class="btn btn-default">Previous</a>
  </div>
  
</div>
</div>
 <?php } ?>
</div>





<div class="calculator__price single_variation_wrap">
            <div class="calculator__order-info" id="specificationsPane">
                <h3 class="step-title">Your Quote</h3>
                <div class="product-info">
                    <h5>Door Choice</h5>
                    <p class="door-name"><?php echo get_the_title(); ?></p>
                    <p><b>Opening Width:</b> <span id="cstwmm">mm</span><br><b>Opening Height:</b> <span id="csthmm">mm</spn></p>

                </div>
                <div class="info" style="margin-top:10px;">

                    <div class="info__box">
                        <h5>Selected Options</h5>
                        <div class="options_opts">
                            <p class="options--none opton" style="display: none;">None Selected</p>
                            <p class="options--motor opton"><b>Motor:</b> <span>right</span></p>
                            <p class="options--headroom opton"></p>
                            <p class="options--leftside opton"></p>
                            <p class="options--rightside opton"></p>
                            <p class="options--fixing opton"></p>
                            <p class="options--lintel opton"></p>
                            <p class="options--curtain opton"></p>
                            <p class="options--frame opton"></p>
                            <p class="options--intalloptons opton"></p>
                        </div>
                    </div>

                    <div class="order-extras">
                        <h5>Extras</h5>
                        <div class="extras"></div>
                    </div>

                    <div class="order-price">
                        <h5>Door Price</h5>

                        <div class="price price--door">
                            <b>Door:</b> <span data-price="0.00">£0.00</span>
                        </div>

                        <div class="price price--options">
                            <b>Options</b> <span>£0.00</span>
                        </div>

                        <div class="price price--extras">
                            <b>Extras:</b> <span>£0.00</span>
                        </div>
						
						<div class="price price--instopt">
                            <b>Installation Option:</b> <span>£0.00</span>
                        </div>

                        <div class="price price--total">
                            <b>Total:</b> <span>£0.00</span>
                        </div>
                    </div>

                    <br>
                    <input type="hidden" name="door_price" value="0">
                    <p><button type="submit" class="button cst_addtocart" cst-addid="<?php echo get_the_ID(); ?>" disabled>Add To Basket</button></p>

                </div>
                                
            </div>
        </div>
	<?php
}
}

add_action('init', 'cst_unset_session');
function cst_unset_session(){
	if(!session_id()){
		session_start();
	}
	$_SESSION['upfnlprice'] = intval($_SESSION['fnlprice']);
}

add_action('wp_head', 'cst_unset_session_on_head');
function cst_unset_session_on_head(){
	if(!is_page( 'cart' ) && !is_page( 'checkout' )){
	unset($_SESSION["curtain_product_color_price"]);
	unset($_SESSION["product_fcolor_price"]);
	unset($_SESSION['alrdaddcolor']);
	unset($_SESSION["tempcurtain_product_color_price"]);
	unset($_SESSION["asscpprice"]);
	unset($_SESSION["alrdadd"]);
	$_SESSION['fnlprice'] = 0;
	}
}

add_action('wp_ajax_product_accss_ajax_request', 'wp_ajax_product_accss_ajax_request');
add_action('wp_ajax_nopriv_product_accss_ajax_request', 'wp_ajax_product_accss_ajax_request');
function wp_ajax_product_accss_ajax_request(){
	if(!session_id()){
		session_start();
	}
	global $woocommerce;
	$proid = $_POST['pro_id'];
	$_SESSION['accessories_for_'.$proid] = array();
	$fnlprc = $_POST['fnlprc'];
	$woocommerce->cart->empty_cart();
	foreach($_POST['idarr'] as $pstid){
		$_SESSION['accessories_for_'.$proid][] = $pstid;
		$woocommerce->cart->add_to_cart( intval($pstid), 1 );
	}
	$pricettl = intval($_SESSION['fnlprice']) + intval($fnlprc);
	//$_SESSION['fnlprice'] = $pricettl;
	$_SESSION['asscpprice'] = $fnlprc;
	echo $pricettl ; 
	exit();
}

/* add_action('woocommerce_thankyou', 'cst_save_ordermeta');
function cst_save_ordermeta($order_id){
	foreach($_SESSION['save_in_ordermeta'] as $key => $ordrmta){
	update)
	}
} */

add_action('woocommerce_checkout_update_order_meta', 'cst_save_ordermeta', 10, 2);
function cst_save_ordermeta( $order_id, $posted ) {
    $order = wc_get_order( $order_id );
	$order_meta = array();
	foreach($_SESSION['save_in_ordermeta'] as $key => $ordrmta){
	$order_meta[$key] = $ordrmta;
	}
    $order->update_meta_data( 'cst_order_meta', $order_meta );
    $order->save();
} 

add_action('wp_ajax_cst_addtocart', 'cst_addtocart');
add_action('wp_ajax_nopriv_cst_addtocart', 'cst_addtocart');
function cst_addtocart(){
	global $woocommerce;
	$pstid = $_POST['pro_id'];
	$woocommerce->cart->add_to_cart( intval($pstid), 1 );
}


/* remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price');

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart'); */

function cst_new_role() {  
 
    //add the new user role
    add_role(
        'trader',
        'Trader',
        array(
            'read'         => true,
            'delete_posts' => false
        )
    );
 
}
add_action('admin_init', 'cst_new_role');

add_action('woocommerce_cart_calculate_fees' , 'add_custom_fees');

/**
 * Add custom fee if more than three article
 * @param WC_Cart $cart
 */
function add_custom_fees( WC_Cart $cart ){
	$user = wp_get_current_user();
    $discount = get_option('woocommerce_custom_trade_discount', true);
if ( in_array( 'trader', (array) $user->roles ) && !empty($discount)) {
	 $discount = round($cart->get_subtotal() * ($discount/100), 2);
    $cart->add_fee( 'Trader discount has been added.', -$discount);
}

}


function add_trader_discount_setting( $settings ) {

  $updated_settings = array();

  foreach ( $settings as $section ) {

    // at the bottom of the General Options section
    if ( isset( $section['id'] ) && 'general_options' == $section['id'] &&
       isset( $section['type'] ) && 'sectionend' == $section['type'] ) {

      $updated_settings[] = array(
        'name'     => 'Trade Discount',
        'desc_tip' => 'Trade Discount',
        'id'       => 'woocommerce_custom_trade_discount',
        'type'     => 'number',
        'css'      => 'min-width:300px;',
        'std'      => '1',  // WC < 2.0
        'default'  => '1',  // WC >= 2.0
      );
    }

    $updated_settings[] = $section;
  }

  return $updated_settings;
}
add_filter( 'woocommerce_general_settings', 'add_trader_discount_setting' );

add_action('wp_ajax_product_instaopt_ajax_request', 'product_instaopt_ajax_request');
add_action('wp_ajax_nopriv_product_instaopt_ajax_request', 'product_instaopt_ajax_request');
function product_instaopt_ajax_request(){
	if(!session_id()){
		session_start();
	}
	$sentarr = array();
	$post_id = $_POST['product_id'];
	$key = $_POST['opt'];
	$val = get_post_meta($post_id, $key, true);
	
	if(isset($_SESSION["product_installation_price"])){
	$fnlprice = intval($_SESSION["fnlprice"]);
	$fnlprice = $fnlprice-$_SESSION["product_installation_price"];
	$_SESSION["fnlprice"] = $fnlprice;
    }

	$sentarr['ttlval'] = intval($_SESSION['fnlprice']) + intval($val) + intval($_SESSION['asscpprice']);
	
	$_SESSION['fnlprice'] = intval($_SESSION['fnlprice']) + intval($val);
	$sentarr['val'] = intval($val);
	$_SESSION['product_installation_price'] = intval($val);
	echo json_encode($sentarr);
	exit;
}



//remove add to cart
add_action( 'woocommerce_single_product_summary', 'conditionally_replacing_template_single_add_to_cart', 1, 0 );
function conditionally_replacing_template_single_add_to_cart() 
{
    global $product, $post;

    $terms = array( 'roller-garage-doors' );

    if( has_term( $terms, 'product_cat' ) ){

        
        if( $product->is_type( 'variable' ) ){
            
            remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );

            // Add back quantities without button
            add_action( 'woocommerce_single_variation', 'add_back_quantities_variable_products', 20 );
        }
        // For simple product types
        else if( $product->is_type( 'simple' ) )
        {
            // Removing add to cart button and quantities
            remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

            // Add back quantities without button
            add_action( 'woocommerce_single_product_summary', 'add_back_quantities_simple_products', 30 );
        }
    }
}
add_filter( 'woocommerce_states', 'wc_uk_counties_add_counties' );
function  wc_uk_counties_add_counties( $states ) {
    $states['GB'] = array(
                            'AV' => 'Avon',
                            'BE' => 'Bedfordshire',
                            'BK' => 'Berkshire',
							'BR' => 'Bristol',
                            'BU' => 'Buckinghamshire',
                            'CA' => 'Cambridgeshire',
                            'CH' => 'Cheshire',
                            'CL' => 'Cleveland',
                            'CO' => 'Cornwall',
                            'CD' => 'County Durham',
                            'CU' => 'Cumbria',
                            'DE' => 'Derbyshire',
                            'DV' => 'Devon',
                            'DO' => 'Dorset',
                            'ES' => 'East Sussex',
                            'EX' => 'Essex',
                            'GL' => 'Gloucestershire',
                            'HA' => 'Hampshire',
                            'HE' => 'Herefordshire',
                            'HT' => 'Hertfordshire',
							'HU' => 'Huntingdonshire',
                            'KE' => 'Kent',
                            'LA' => 'Lancashire',
                            'LE' => 'Leicestershire',
                            'LI' => 'Lincolnshire',
                            'LO' => 'London',
                            'ME' => 'Merseyside',
                            'MI' => 'Middlesex',
                            'NO' => 'Norfolk',
                            'NH' => 'North Humberside',
                            'NY' => 'North Yorkshire',
                            'NS' => 'Northamptonshire',
                            'NL' => 'Northumberland',
                            'NT' => 'Nottinghamshire',
                            'OX' => 'Oxfordshire',
							'RUT' => 'Rutland',
                            'SH' => 'Shropshire',
                            'SO' => 'Somerset',
                            'SM' => 'South Humberside',
                            'SY' => 'South Yorkshire',
                            'SF' => 'Staffordshire',
                            'SU' => 'Suffolk',
                            'SR' => 'Surrey',
                            'TW' => 'Tyne and Wear',
                            'WA' => 'Warwickshire',
                            'WM' => 'West Midlands',
                            'WS' => 'West Sussex',
                            'WY' => 'West Yorkshire',
                            'WI' => 'Wiltshire',
                            'WO' => 'Worcestershire',
                            'ABD' => 'Scotland / Aberdeenshire',
                            'ANS' => 'Scotland / Angus',
                            'ARL' => 'Scotland / Argyle & Bute',
                            'AYR' => 'Scotland / Ayrshire',
                            'CLK' => 'Scotland / Clackmannanshire',
                            'DGY' => 'Scotland / Dumfries & Galloway',
                            'DNB' => 'Scotland / Dunbartonshire',
                            'DDE' => 'Scotland / Dundee',
                            'ELN' => 'Scotland / East Lothian',
                            'EDB' => 'Scotland / Edinburgh',
                            'FIF' => 'Scotland / Fife',
                            'GGW' => 'Scotland / Glasgow',
                            'HLD' => 'Scotland / Highland',
                            'LKS' => 'Scotland / Lanarkshire',
                            'MLN' => 'Scotland / Midlothian',
                            'MOR' => 'Scotland / Moray',
                            'OKI' => 'Scotland / Orkney',
                            'PER' => 'Scotland / Perth and Kinross',
                            'RFW' => 'Scotland / Renfrewshire',
                            'SB' => 'Scotland / Scottish Borders',
                            'SHI' => 'Scotland / Shetland Isles',
                            'STI' => 'Scotland / Stirling',
                            'WLN' => 'Scotland / West Lothian',
                            'WIS' => 'Scotland / Western Isles',
                            'AGY' => 'Wales / Anglesey',
                            'GNT' => 'Wales / Blaenau Gwent',
                            'CP' => 'Wales / Caerphilly',
                            'CF' => 'Wales / Cardiff',
                            'CAE' => 'Wales / Carmarthenshire',
                            'CR' => 'Wales / Ceredigion',
                            'CW' => 'Wales / Conwy',
                            'DEN' => 'Wales / Denbighshire',
                            'FLN' => 'Wales / Flintshire',
                            'GLA' => 'Wales / Glamorgan',
                            'GWN' => 'Wales / Gwynedd',
                            'MT' => 'Wales / Merthyr Tydfil',
                            'MON' => 'Wales / Monmouthshire',
                            'PT' => 'Wales / Neath Port Talbot',
                            'NP' => 'Wales / Newport',
                            'PEM' => 'Wales / Pembrokeshire',
                            'POW' => 'Wales / Powys',
                            'RT' => 'Wales / Rhondda Cynon Taff',
                            'SS' => 'Wales / Swansea',
                            'TF' => 'Wales / Torfaen',
                            'WX' => 'Wales / Wrexham',
                           );
    return $states;
}
add_filter( 'woocommerce_package_rates', 'change_shipping_methods_label_names', 20, 2 );
function change_shipping_methods_label_names( $rates, $package ) {
if(!session_id())
	session_start();
if(isset($_SESSION["product_installation_price"]) && $_SESSION["product_installation_price"]!=0){
    foreach( $rates as $rate_key => $rate ) {

            $rates[$rate_key]->label = __( 'Free', 'woocommerce' ); // New label name
            $rates[$rate_key]->cost = 0; // New label name
    }
}

    return $rates;
}

function cst_require_wc_county_field( $fields ) {
    $fields['billing_state']['required'] = true;
    return $fields;
}
add_filter( 'woocommerce_billing_fields', 'cst_require_wc_county_field', 1000 );


add_action( 'wp_footer', 'aelia_checkout_shipping_filter_US_states' );
   
function aelia_checkout_shipping_filter_US_states() {
   if ( ! is_checkout() ) {
      return;
   }
   ?>
      
   <script>
   jQuery(document).ready(function($) {
 
      $(document.body).on('country_to_state_changed', function() {
 
            var $billing_state_field = $('#billing_state_field');
            $billing_state_field.addClass('validate-required');
            $billing_state_field.find('.optional').html('<abbr class="required" title="required">*</abbr>');
   
      });
 
   });  
   </script>
       
   <?php
}