<?
/** 
 * Sorting (blog posts), paging, next / previous and such.
 *
 * TODO - long desc (@link http://)
 *
 * PHP version 5.3
 *
 * LICENSE: TODO
 *
 * @package WP ezClasses
 * @author Mark Simchock <mark.simchock@alchemyunited.com>
 * @since 0.5.0
 * @license TODO
 */
 
 /*
 * == Change Log == 
 *
 * --- 
*/

/*
 * "global" properties inherited from wpezClassesMasterParent
 *
 * protected $_bool_ezc_log 			=> default: true 	- turns the log (wpezToolsClassesLog() on and off 
 * protected $_bool_ezc_validate		=> default: true; 	- turns off _validation methods
 * protected $_bool_ezc_apply_filters	=> default: false;	- if you want to use the filters then set this to true
*/

if ( !defined('ABSPATH') ) {
	header('HTTP/1.0 403 Forbidden');
    die();
}
// -- TODO -----
// -http://wordpressapi.com/2010/12/08/wordpress-pagination-style-wordpress-plugin/


if (! class_exists('Class_WP_ezClasses_ThemeUI_Pagination_Control_1') ) {
  class Class_WP_ezClasses_ThemeUI_Pagination_Control_1 extends Class_WP_ezClasses_Master_Singleton {

		protected $_bool_page_sort_validate;
		protected $_str_orderby_default;
		protected $_str_order_default;
		
		public function __construct() {
			parent::__construct();
		}
		
		public function ez__construct($arr_args = NULL){
			$this->theme_ui_controls_init($arr_args);
		}
		

		
		/**
		 * Blog paging: Older / Newer
		 */
		public function blog_paging_controls( $arr_args = NULL) {
			$str_return_source = 'Theme \ UI Controls :: blog_paging_controls()';

			$bool_echo = true;
			if ( isset($arr_args['echo']) && is_bool($arr_args['echo']) ){
				$bool_echo = $arr_args['echo'];
			}
			
			// TODO _validate - 
			if ( !is_array($arr_args) || empty($arr_args) ){
				$arr_args = $this->blog_paging_controls_defaults();
			} else {
				$arr_args = array_merge($this->blog_paging_controls_defaults(), $arr_args);
			}
			
			global $wp_query;
		
			$str_to_return = '';

			if ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) { // navigation links for home, archive, and search pages 
			
				$str_to_return .= '<ul class="pager">';
				if ( get_next_posts_link() ) { 
					$str_to_return .= '<li class="next">';
					$str_to_return .= get_next_posts_link( '<span class="meta-nav '. $arr_args['older_class'] .'"></span>' . $arr_args['older'] );
					$str_to_return .= '</li>';
				} 

				if ( get_previous_posts_link() ) {
					$str_to_return .= '<li class="previous">';
					$str_to_return .= get_previous_posts_link( $arr_args['newer'] . '<span class="meta-nav '. $arr_args['newer_class'] .'"></span>' );
					$str_to_return .= '</li>';
				} 
				$str_to_return .= '</ul>';
			} 
			
			if ( $bool_echo ) {
				echo $str_to_return;
			}
			return array('status' => true, 'msg' => 'success', 'source' => $str_return_source, 'str_to_return' => $str_to_return);
			
		} // wp_ezbs_functions_blog_paging_controls

		
		
		
	} // close class
} // close if class_exists()
?>