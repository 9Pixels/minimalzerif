<?php
/**
 *	The template for displaying the Front Page.
 *
 *	@package WordPress
 *	@subpackage MinimalZerif
 */
?>
<?php get_header(); ?>
<?php
if ( get_option( 'show_on_front' ) == 'page' ) {
    ?>
	<div class="clear"></div>
	</header> <!-- / END HOME SECTION  -->
		<div id="content" class="site-content">
	<div class="container">
	<div class="content-left-wrap col-md-9">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
			<?php if ( have_posts() ) : ?>
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>
				<?php endwhile; ?>
				<?php zerif_paging_nav(); ?>
			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>
			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- .content-left-wrap -->
	<div class="sidebar-wrap col-md-3 content-left-wrap">
		<?php get_sidebar(); ?>
	</div><!-- .sidebar-wrap -->
	</div><!-- .container -->
	<?php
}else {
	if(isset($_POST['submitted'])) :
			/* recaptcha */
			$zerif_contactus_sitekey = get_theme_mod('zerif_contactus_sitekey');
			$zerif_contactus_secretkey = get_theme_mod('zerif_contactus_secretkey');
			$zerif_contactus_recaptcha_show = get_theme_mod('zerif_contactus_recaptcha_show');
			if( isset($zerif_contactus_recaptcha_show) && $zerif_contactus_recaptcha_show != 1 && !empty($zerif_contactus_sitekey) && !empty($zerif_contactus_secretkey) ) :
		        $captcha;
		        if( isset($_POST['g-recaptcha-response']) ){
		          $captcha=$_POST['g-recaptcha-response'];
		        }
		        if( !$captcha ){
		          $hasError = true;    
		        }
		        $response = wp_remote_get( "https://www.google.com/recaptcha/api/siteverify?secret=".$zerif_contactus_secretkey."&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR'] );
		        if($response['body'].success==false) {
		        	$hasError = true;
		        }
	        endif;

			/* name */
			if(trim($_POST['myname']) === ''):
				$nameError = __('* Please enter your name.','minimalzerif');
				$hasError = true;
			else:
				$name = trim($_POST['myname']);
			endif;

			/* email */
			if(trim($_POST['myemail']) === ''):
				$emailError = __('* Please enter your email address.','minimalzerif');
				$hasError = true;
			elseif (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['myemail']))) :
				$emailError = __('* You entered an invalid email address.','minimalzerif');
				$hasError = true;
			else:
				$email = trim($_POST['myemail']);
			endif;

			/* subject */
			if(trim($_POST['mysubject']) === ''):
				$subjectError = __('* Please enter a subject.','minimalzerif');
				$hasError = true;
			else:
				$subject = trim($_POST['mysubject']);
			endif;

			/* message */
			if(trim($_POST['mymessage']) === ''):
				$messageError = __('* Please enter a message.','minimalzerif');
				$hasError = true;
			else:
				$message = stripslashes(trim($_POST['mymessage']));
			endif;

			/* send the email */
			if(!isset($hasError)):
				$zerif_contactus_email = get_theme_mod('zerif_contactus_email');
				if( empty($zerif_contactus_email) ):
					$emailTo = get_theme_mod('zerif_email');
				else:
					$emailTo = $zerif_contactus_email;
				endif;

				if(isset($emailTo) && $emailTo != ""):
					if( empty($subject) ):
						$subject = 'From '.$name;
					endif;
					$body = "Name: $name \n\nEmail: $email \n\n Subject: $subject \n\n Message: $message";
					$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
					wp_mail($emailTo, $subject, $body, $headers);
					$emailSent = true;
				else:
					$emailSent = false;
				endif;
			endif;
		endif;

	$zerif_bigtitle_show = get_theme_mod('zerif_bigtitle_show');
	if( isset($zerif_bigtitle_show) && $zerif_bigtitle_show != 1 ):
		include get_template_directory() . "/sections/big_title.php";
	endif;


?>

</header> <!-- / END HOME SECTION  -->
<div id="content" class="site-content">

<?php
/* OUR FOCUS SECTION */
$zerif_ourfocus_show = get_theme_mod('zerif_ourfocus_show');

if( isset($zerif_ourfocus_show) && $zerif_ourfocus_show != 1 ):
	include get_template_directory() . "/sections/our_focus.php";
endif;

/* OUR TEAM */
$zerif_ourteam_show = get_theme_mod('zerif_ourteam_show');
if( isset($zerif_ourteam_show) && $zerif_ourteam_show != 1 ):
	include get_template_directory() . "/sections/our_team.php";
endif;

/* TESTIMONIALS */
$zerif_testimonials_show = get_theme_mod('zerif_testimonials_show');
if( isset($zerif_testimonials_show) && $zerif_testimonials_show != 1 ):
	include get_template_directory() . "/sections/testimonials.php";
endif;
}
?>
<?php get_footer(); ?>