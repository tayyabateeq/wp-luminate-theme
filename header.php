<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Luminate
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'luminate' ); ?></a>
	<header id="masthead" class="site-header">
		<div class="site-branding">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 col-md-6 positiva-logo">
						<?php
						if (has_custom_logo()) {
							the_custom_logo();
						} else {
							// Display your default logo here
							echo '<img src="/wp-content/uploads/2023/04/LOGO-POSITIVA.png" alt="Default Logo">';
						}
						?>
					</div>
					<div class="col-sm-6 col-md-6">
						<?php echo my_theme_display_header_images(); ?>
					</div>
				</div>
			</div>
			<?php
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$luminate_description = get_bloginfo( 'description', 'display' );
			if ( $luminate_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $luminate_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
			
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			// Display Search Form.
			?>
			<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
				<div class="input-group rounded">
					<input type="search" class="form-control rounded" placeholder="<?php echo esc_attr_x('Búsqueda', 'placeholder', 'your-theme-domain'); ?>" value="<?php echo get_search_query(); ?>" name="s" aria-label="Search" aria-describedby="search-addon" />
					<span class="input-group-text border-0" id="search-addon" onclick="submitSearchForm()">
						<i class="fas fa-search"></i>
					</span>
				</div>
			</form>

			<script>
				function submitSearchForm() {
					document.querySelector('.search-form').submit();
				}
			</script>

		</nav><!-- #site-navigation -->
		
	</header><!-- #masthead -->