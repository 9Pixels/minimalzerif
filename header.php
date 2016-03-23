<?php
/**
 *	The template for displaying the Header.
 *
 *	@package WordPress
 *	@subpackage MinimalZerif
 */
?>
<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>

<?php if(function_exists('zerif_top_head_trigger')) { zerif_top_head_trigger(); } ?>

<meta charset="<?php bloginfo( 'charset' ); ?>">

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="profile" href="http://gmpg.org/xfn/11">

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php
	$zerif_google_anaytics = get_theme_mod('zerif_google_anaytics');
	if( !empty($zerif_google_anaytics) ):
		echo $zerif_google_anaytics;
	endif;
?>

<!--[if lt IE 9]>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/ie.css" type="text/css">
<![endif]-->

<?php 
if ( ! function_exists( '_wp_render_title_tag' ) ) {
    function zerif_pro_old_render_title() {
		?>
		<title><?php wp_title( '-', true, 'right' ); ?></title>
		<?php
    }
    add_action( 'wp_head', 'zerif_pro_old_render_title' );
}
wp_head();
?>

<?php if(function_exists('zerif_bottom_head_trigger')) { zerif_bottom_head_trigger(); } ?>

</head>

<?php if(isset($_POST['scrollPosition'])): ?>

		<body <?php body_class(); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage" onLoad="window.scrollTo(0,<?php echo intval($_POST['scrollPosition']); ?>)">

<?php else: ?>
		<?php
		if( !is_home() ):
			$home_class = 'menu-color';
		else:
			$home_class = '';
		endif;
		?>

		<body <?php body_class($home_class); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">

<?php endif;

if(function_exists('zerif_top_body_trigger')) { zerif_top_body_trigger(); }

$minimalzerif_parent_theme = get_template();

if( !empty($minimalzerif_parent_theme) && ($minimalzerif_parent_theme == 'zerif-pro') ) {
	
	/*************************************************/
	/**************  Background settings *************/
	/*************************************************/
	$zerif_background_settings = get_theme_mod('zerif_background_settings');
	/* Default case when no setting is checked or Slider is selected */
	if( empty($zerif_background_settings) || ($zerif_background_settings == 'zerif-background-slider') ):
		/* Background slider */
		$zerif_slides_array = array();
		for ($i=1; $i<=3; $i++){
			$zerif_bgslider = get_theme_mod('zerif_bgslider_'.$i);
			array_push($zerif_slides_array, $zerif_bgslider);
		}
		$count_slides = 0;
		if( !empty($zerif_slides_array) && is_home() ):
			echo '<div class="zerif_full_site_wrap">';
			echo '<div class="fadein-slider">';
			foreach( $zerif_slides_array as $key => $zerif_slide ):
				if ( !empty($zerif_slide) ):
					$keyx = $key+1;
					$zerif_vpos = get_theme_mod('zerif_vposition_bgslider_'.$keyx,'top');
					$zerif_hpos = get_theme_mod('zerif_hposition_bgslider_'.$keyx,'left');
					$zerif_bgsize = get_theme_mod('zerif_bgsize_bgslider_'.$keyx,'cover');
					if ($zerif_bgsize=='width'):
						$zerif_bgsize = '100% auto';
					elseif ($zerif_bgsize=='height'):
						$zerif_bgsize = 'auto 100%';
					endif;
					$zerif_slide_style ='background-repeat:no-repeat;background-position:'.$zerif_hpos.' '.$zerif_vpos.';background-size:'.$zerif_bgsize;
					echo '<div class="slide-item" style="background-image:url('.$zerif_slide.');'.$zerif_slide_style.'"></div>';
				endif;
			endforeach;
			echo '</div>';
			echo '<div class="zerif_full_site">';
		endif;
	elseif( $zerif_background_settings == 'zerif-background-video' ):
		/* Video background */
		$zerif_background_video = get_theme_mod('zerif_background_video');
		
		$zerif_enable_video_sound = get_theme_mod('zerif_enable_video_sound');
		
		/* enable video sound */
		if( isset($zerif_enable_video_sound) && ($zerif_enable_video_sound == 1)) {
			$zerif_video_sound = '';
		} else {
			$zerif_video_sound = ' muted';
		}
		
		if( !empty($zerif_background_video) && is_home() ):
			$zerif_background_video_thumbnail = get_theme_mod('zerif_background_video_thumbnail');
			if( !wp_is_mobile() ) {
				if( !empty($zerif_background_video_thumbnail) ):
					echo '<video class="zerif_video_background" loop autoplay preload="auto" controls="true" poster="'.$zerif_background_video_thumbnail.'" '.$zerif_video_sound.'>';
				else:
					echo '<video class="zerif_video_background" loop autoplay preload="auto" controls="true" '.$zerif_video_sound.'>';
				endif;
				echo '<source src="'.$zerif_background_video.'" type="video/mp4" />';
				echo '</video>';
			} else {
				echo '<div class="zerif_full_site_wrap">';
				echo '<div class="fadein-slider">';
				if( !empty($zerif_background_video_thumbnail) ) {
					echo '<div class="slide-item" style="background-image:url('.$zerif_background_video_thumbnail.')"></div>';
				} else {
					$page_bg_image_url = get_background_image();
					if ( !empty( $page_bg_image_url ) ) {
						$page_bg_image_url = get_background_image();
						echo '<div class="slide-item" style="background-image:url('.$page_bg_image_url.')"></div>';
					}
				}
				echo '</div>';
				echo '<div class="zerif_full_site">';
			}
		endif;
	else:
	?>

	<?php if( is_home() ): ?>
		
	<div id="mobile-bg-responsive" class="zerif-mobile-bg-helper-wrap-all">
		<div class="zerif-mobile-bg-helper-bg"><div class="zerif-mobile-bg-helper-bg-inside"></div></div>
		<div class="zerif-mobile-bg-helper-content">

	<?php endif; ?>

	<?php
	endif;

} else {
	?>
	<div id="mobilebgfix">
	<div class="mobile-bg-fix-img-wrap">
		<div class="mobile-bg-fix-img"></div>
	</div>
	<div class="mobile-bg-fix-whole-site">
	<?php
}
?>
		<!-- =========================
		   PRE LOADER       
		============================== -->
		<?php
			
		 global $wp_customize;
		 if(is_front_page() && !isset( $wp_customize )): 
		 
			$zerif_disable_preloader = get_theme_mod('zerif_disable_preloader');
			
			if( isset($zerif_disable_preloader) && ($zerif_disable_preloader != 1)):
				 
				echo '<div class="preloader">';
					echo '<div class="status">&nbsp;</div>';
				echo '</div>';
				
			endif;	
		endif; ?>


		<header id="home" class="header">
			<div class="top-navigation">
				<div class="container">
					<?php if( get_theme_mod( 'minimalzerif_disable_logoimage' ) != 1 ): ?>
						<div class="logo-text">
							<a href="<?php echo esc_url( get_site_url() ); ?>" class="logo-name" title="<?php bloginfo( 'name' ); ?>">
								<?php bloginfo( 'name' ); ?>
							</a><!--/.logo-name-->
							<div class="logo-description">
								<?php bloginfo( 'description' ); ?>
							</div><!--/.logo-description-->
						</div><!--/.logo-text-->
					<?php else: ?>
						<a class="logo-image" href="<?php echo esc_url( get_site_url() ); ?>" title="<?php bloginfo( 'title' ); ?>">
						</a><!--/.a-->
					<?php endif; ?>
					<?php if( has_nav_menu( 'primary' ) ): ?>
						<div class="hambuger-menu">
							<i class="fa fa-bars"></i>
							<span><?php _e( 'Menu', 'minimalzerif' ); ?></span>
						</div><!--/.hambuger-menu-->
						<nav class="header-menu">
							<?php
							$wp_nav_menu_args = array(
								'theme_location'	=> 'primary',
								'container'			=> false,
								'menu_class'		=> 'clearfix',
								'fallback_cb'		=> ''
							);
							wp_nav_menu( $wp_nav_menu_args );
							?>
						</nav><!--/.header-menu-->
					<?php endif; ?>
				</div><!--/.container-->
			</div><!--/.top-navigation-->