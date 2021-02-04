<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section
 *
 * @link     https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package  Businext
 * @since    1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php Businext::body_attributes(); ?>>

<?php Businext_Templates::pre_loader(); ?>

<div id="page" class="site">
	<div class="content-wrapper">
		<?php
		if(!is_page_template('page-clientportal.php')){
			Businext_Templates::slider( 'above' );
			Businext_Templates::top_bar();
			Businext_Templates::header();
			Businext_Templates::slider( 'below' );
		}
		else{
			get_template_part('header', 'clientportal');
		}
		?>