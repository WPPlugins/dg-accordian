<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://projects.dinesh-ghimire.com.np/
 * @since      1.0.0
 *
 * @package    Dg_Accordian
 * @subpackage Dg_Accordian/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Dg_Accordian
 * @subpackage Dg_Accordian/admin
 * @author     Dinesh Ghimire <developer.dinesh1@gmail.com>
 */
class Dg_Accordian_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		/*
		 * @since    1.1.0
		 */
		$this->accordian_dependencies();

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Dg_Accordian_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Dg_Accordian_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/dg-accordian-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Dg_Accordian_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Dg_Accordian_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/dg-accordian-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add Dependencies to Admin Area
	 *
	 * @since    1.1.0
	 */
	public function accordian_dependencies(){

		if(!is_admin()){
			return;
		}

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-dg-accordian-ajax.php';

	}

}
