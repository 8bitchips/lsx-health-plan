<?php
/**
 * Template used to display post content on single pages.
 *
 * @package lsx-health-plan
 */

global $shortcode_args;
$meal = \lsx_health_plan\functions\get_option( 'endpoint_meal', false );
if ( false === $meal ) {
	$meal = 'meal';
}
$connected_post_type = $meal . '_connected_team_member';
$connected_members = get_post_meta( get_the_ID(), $connected_post_type, true );

?>

<?php lsx_entry_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php lsx_entry_top(); ?>

	<div class="entry-meta">
		<?php lsx_post_meta_single_bottom(); ?>
	</div><!-- .entry-meta -->

	<div class="entry-content">
		<div class="single-plan-inner meal-content">
			<?php
			if ( is_singular( 'meal' ) ) { ?>
				<div class="single-plan-section-title meal-plan title-lined">
					<?php lsx_get_svg_icon( 'meal.svg' ); ?>
					<h2><?php the_title(); ?></h2>

				</div>
			<?php } else { ?>
				<div class="single-plan-section-title meal-plan title-lined">
					<?php lsx_get_svg_icon( 'meal.svg' ); ?>
					<h2><?php esc_html_e( 'My Meal Plan', 'lsx-health-plan' ); ?> <?php the_title(); ?></h2>
				</div>
			<?php } ?>

			<?php require LSX_HEALTH_PLAN_PATH . 'templates/partials/meal-plans.php'; ?>
			<?php echo wp_kses_post( lsx_hp_member_connected( $connected_members, $meal ) ); ?>
		</div>

	</div><!-- .entry-content -->
	<?php if ( null === $shortcode_args ) { ?>
		<div class="tip-row extras-box">
			<?php if ( post_type_exists( 'tip' ) && lsx_health_plan_has_tips() ) { ?>
				<div class="tip-right">
					<?php echo do_shortcode( '[lsx_health_plan_featured_tips_block tab="' . $meal . '"]' ); ?>
				</div>
			<?php } ?>
		</div>
	<?php } ?>

	<?php lsx_entry_bottom(); ?>

</article><!-- #post-## -->

<?php
lsx_entry_after();
