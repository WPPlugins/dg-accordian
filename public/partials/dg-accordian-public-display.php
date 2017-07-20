<?php
/**
* Provide a public-facing view for the plugin
*
* This file is used to markup the public-facing aspects of the plugin.
*
* @link       http://dinesh-ghimire.com.np/
* @since      1.0.0
*
* @package    Dg_Accordian
* @subpackage Dg_Accordian/public/partials
*/
?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
$atts=array();
$atts = apply_filters('dg_accordian_args', $atts);
$query = new WP_Query($atts);
if($query->have_posts()):
?>
<div id="accordion">
	<?php while($query->have_posts()):$query->the_post(); ?>
		<h3 class="post-title"><?php the_title(); ?></h3>
		<div class="post-excerpt post-<?php echo get_the_ID(); ?> ">
			<?php the_excerpt(); ?>
		</div>
	<?php endwhile; ?>
</div>
<?php
endif;
?>