<?php
/**
 * The admin-specific Accordian Ajax functionality of the plugin.
 *
 * Accordian Specific Ajax Data
 * @package    Dg_Accordian
 * @subpackage Dg_Accordian/admin
 * @author     Dinesh Ghimire <developer.dinesh1@gmail.com>
 */
class DG_Accordian_Ajax{

    /**
     * Accordian Data of this plugin.
     *
     * @since    1.1.0
     * @access   private
     * @var      string    $accordian_data    Accordian Data of this plugin.
     */
    private $accordian_data;

    /**
     * Constructor for Ajax for the admin area.
     *
     * @since    1.1.0
     */
    function __construct(){

        add_action( 'wp_ajax_dg_accordian_widget', [$this, 'accordian_widget'] );

    }

    /**
     * Set data to $accordian_data variable
     *
     * @since    1.1.0
     */
    function set_accordian_data(){

    }

    /**
     * Get data to $accordian_data variable
     *
     * @since    1.1.0
     */
    function get_accordian_data(){

    }

    /**
     * This function return Accordian Data to Widget area
     *
     * @since    1.1.0
     */
    public function accordian_widget(){

        if( ! (isset( $_POST['action']) && $_POST['action']=='dg_accordian_widget' )  ){
            die();
        }

        $data_type = $_POST['data']['data_type'];
        $data_value = $_POST['data']['data_value'];
        $data = array();
        switch($data_type){
            case 'post_type':
                $all_taxonomy = get_object_taxonomies($data_value, 'objects');
                if(count($all_taxonomy)){
                    foreach($all_taxonomy as $taxonomy_key=>$taxonomy_value){
                        $data[]=array(
                            'slug'=>$taxonomy_key,
                            'name'=>$taxonomy_value->label
                        );
                    }
                }
                break;
            case 'taxonomy':
                
                $args = array(
                    'taxonomy' => $data_value,
                    'hide_empty' => false,
                );
                
                $all_terms = get_terms($args);
                
                if( is_array($all_terms) ):
                    $data = $all_terms;
                endif;
                
                break;
            default:
                $data = array();
                break;
        }

        echo json_encode($data);
        die();

    }

    /**
     * @since    1.1.0
     */
    function __destruct(){

    }

}

new DG_Accordian_Ajax();