<?php
/**
* The class for accordian shortcode
*
* @link       http://dinesh-ghimire.com.np/
* @since      1.1.0
*
* @package    Dg_Accordian
* @subpackage Dg_Accordian/public
*/

class DG_Accordian_Widgets extends WP_Widget{

    /**
     * Sets up a new Accordian WIdget instance.
     *
     * @since 1.1.0
     * @access public
     */
    public function __construct() {
        $widget_ops = array(
            'classname' => 'dg_accordian_widget',
            'description' => __( 'Widget for Accordian' ),
            'customize_selective_refresh' => true,
        );
        $control_ops = array( 'width' => 300, 'height' => 350 );
        parent::__construct( 'dg_accordian_widget', __( 'Accordian Widget' ), $widget_ops, $control_ops );
    }

    /**
     * Outputs the content for the current Accordian widget instance.
     *
     * @since 1.1.0
     * @access public
     *
     * @param array $args     Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Accordian widget instance.
     */
    public function widget( $args, $instance ) {

        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

        $post_type = ! empty( $instance['post_type'] ) ? $instance['post_type'] : '';
        $taxonomy = ! empty( $instance['taxonomy'] ) ? $instance['taxonomy'] : '';
        $term = ! empty( $instance['term'] ) ? $instance['term'] : '';
        $no_of_post = ! empty( $instance['no_of_post'] ) ? $instance['no_of_post'] : '';

        echo $args['before_widget'];
        if ( ! empty( $title ) ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        $wp_args=array(
            'post_type' =>  $post_type,
            'tax_query'  =>array(
                array (
                    'taxonomy' => $taxonomy,
                    'field' => 'slug',
                    'terms' => $term,
                )    
            ),
            'posts_per_page' =>  $no_of_post,
        );
        $query = new WP_Query($wp_args);
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
        <?php endif; ?>
        <?php
        echo $args['after_widget'];
    }

    /**
     * Handles updating settings for the current Text widget instance.
     *
     * @since 1.1.0
     * @access public
     *
     * @param array $new_instance New settings for this instance as input by the user via
     *                            WP_Widget::form().
     * @param array $old_instance Old settings for this instance.
     * @return array Settings to save or bool false to cancel saving.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['post_type'] = sanitize_text_field( $new_instance['post_type'] );
        $instance['taxonomy'] = sanitize_text_field( $new_instance['taxonomy'] );
        $instance['term'] = sanitize_text_field( $new_instance['term'] );
        $instance['no_of_post'] = absint( $new_instance['no_of_post'] );
        return $instance;
    }

    /**
     * Outputs the Accordian widget settings form.
     *
     * @since 1.1.0
     * @access public
     *
     * @param array $instance Current settings.
     */
    public function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '','post_type' => '', 'taxonomy' => '', 'term' => '','no_of_post'=>'' ) );
        $title = sanitize_text_field( $instance['title'] );
        $post_type = sanitize_text_field($instance['post_type']);
        $taxonomy = sanitize_text_field($instance['taxonomy']);
        $term = sanitize_text_field($instance['term']);
        $no_of_post = absint($instance['no_of_post']);
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('post_type'); ?>"><?php _e('Post Type:'); ?></label>
            <?php
            $args = array(
                'public'=>true,
            );
            $all_post_types = get_post_types($args, 'objects');
            ?>
            <select class="widefat dg-widget-post-type" data-accordian-value="post_type" data-accordian-change-id="#<?php echo $this->get_field_id('taxonomy'); ?>" id="<?php echo $this->get_field_id('post_type'); ?>" name="<?php echo $this->get_field_name('post_type'); ?>" type="text" value="<?php echo esc_attr($post_type); ?>">
                <?php foreach($all_post_types as $post_type_key=>$post_type_value): ?>
                    <option <?php echo ($post_type_key==$post_type) ? 'selected="selected"' : ''; ?> value="<?php echo $post_type_key; ?>"><?php echo $post_type_value->label; ?></option>
                <?php endforeach; ?>
            </select></p>

        <p><label for="<?php echo $this->get_field_id('taxonomy'); ?>"><?php _e('Taxonomy:'); ?></label>
            <?php
            $all_object_taxonomies = get_object_taxonomies($post_type, 'objects');
            ?>
            <select class="widefat dg-widget-taxonomy" data-accordian-value="taxonomy" data-accordian-change-id="#<?php echo $this->get_field_id('term'); ?>" id="<?php echo $this->get_field_id('taxonomy'); ?>" name="<?php echo $this->get_field_name('taxonomy'); ?>" type="text" value="<?php echo esc_attr($taxonomy); ?>">
                <option <?php echo ($taxonomy) ? '' : 'selected="selected"'; ?> value="">No Filter</option>
                <?php foreach($all_object_taxonomies as $taxonomy_key=>$taxonomy_value): ?>
                    <option <?php echo ($taxonomy_key==$taxonomy) ? 'selected="selected"' : ''; ?> value="<?php echo $taxonomy_key; ?>"><?php echo $taxonomy_value->label; ?></option>
                <?php endforeach; ?>
            </select></p>

        <p><label for="<?php echo $this->get_field_id('term'); ?>"><?php _e('Term:'); ?></label>
            <?php
            $all_terms = get_terms(array(
                'taxonomy' => $taxonomy,
                'hide_empty' => false,
            ));
            ?>
            <select class="widefat"  id="<?php echo $this->get_field_id('term'); ?>" name="<?php echo $this->get_field_name('term'); ?>" type="text" value="<?php echo esc_attr($term); ?>">
                <option <?php echo ($term) ? '' : 'selected="selected"'; ?> value="">No Filter</option>
                <?php if( is_array($all_terms) ): ?>
                    <?php foreach($all_terms as $term_key=>$term_value): ?>
                        <option <?php echo ($term_value->slug==$term) ? 'selected="selected"' : ''; ?> value="<?php echo $term_value->slug; ?>"><?php echo $term_value->name; ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select></p>

        <p><label for="<?php echo $this->get_field_id('no_of_post'); ?>"><?php _e('Show no of post:'); ?></label>
            <input class="widefat" min="1" max="99" id="<?php echo $this->get_field_id('no_of_post'); ?>" name="<?php echo $this->get_field_name('no_of_post'); ?>" type="number" value="<?php echo $no_of_post; ?>" /></p>
        <?php
    }

}

register_widget( 'DG_Accordian_Widgets' );