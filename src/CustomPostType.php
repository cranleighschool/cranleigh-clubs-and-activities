<?php


	namespace CranleighSchool\CranleighClubsAndActivities;

class CustomPostType {

	private $post_type_key;
	private $slug = 'our-school/co-curricular/clubs-and-activities';

	public function __construct( string $post_type_key ) {
		$this->post_type_key = $post_type_key;

	}

	public static function register( string $post_type_key ) {
		$register = new static( $post_type_key );
		add_action( 'init', array( $register, 'custom_post_type' ), 0 );
	}

	/**
	 * sport_custom_post_type function.
	 *
	 * @access public
	 * @return void
	 */
	function custom_post_type() {
		$labels = array(
			'name'           => _x( 'Activities', 'Post Type General Name', 'cranleigh-2016' ),
			'singular_name'  => _x( 'Activity', 'Post Type Singular Name', 'cranleigh-2016' ),
			'menu_name'      => __( 'Activities', 'cranleigh-2016' ),
			'name_admin_bar' => __( 'Activity', 'cranleigh-2016' ),
			'archives'       => __( 'Clubs and Activities', 'cranleigh-2016' ),
			'all_items'      => __( 'All Clubs and Activities', 'cranleigh-2016' ),
			'add_new_item'   => __( 'Add New Club / Activity', 'cranleigh-2016' ),

		);

		$args = array(
			'label'        => __( 'Activities', 'cranleigh-2016' ),
			'description'  => __( 'All the Clubs and Activities', 'cranleigh-2016' ),
			'labels'       => array_merge( $this->default_labels(), $labels ),
			'rewrite'      => $this->rewrite( $this->slug ),
			'menu_icon'    => 'dashicons-palmtree',
			'capabilities' => array(
				'edit_post'          => 'edit_activity',
				'edit_posts'         => 'edit_activities',
				'edit_others_posts'  => 'edit_other_activities',
				'publish_posts'      => 'publish_activities',
				'read_post'          => 'read_activity',
				'read_private_posts' => 'read_private_activities',
				'delete_posts'       => 'delete_activity',
			),
			// as pointed out by iEmanuele, adding map_meta_cap will map the meta correctly
			'map_meta_cap' => false,
		);

		register_post_type( $this->post_type_key, array_merge( $this->default_args(), $args ) );
	}

	/**
	 * default_labels function.
	 *
	 * These get merged into the functions above...
	 *
	 * @access public
	 * @return void
	 */
	function default_labels() {
		 $labels = array(
			 'parent_item_colon'     => __( 'Parent Page:', 'cranleigh-2016' ),
			 'add_new'               => __( 'Add New', 'cranleigh-2016' ),
			 'new_item'              => __( 'New Activity', 'cranleigh-2016' ),
			 'edit_item'             => __( 'Edit Activity', 'cranleigh-2016' ),
			 'update_item'           => __( 'Update Activity', 'cranleigh-2016' ),
			 'view_item'             => __( 'View Activity', 'cranleigh-2016' ),
			 'search_items'          => __( 'Search', 'cranleigh-2016' ),
			 'not_found'             => __( 'Not found', 'cranleigh-2016' ),
			 'not_found_in_trash'    => __( 'Not found in Trash', 'cranleigh-2016' ),
			 'insert_into_item'      => __( 'Insert into page', 'cranleigh-2016' ),
			 'uploaded_to_this_item' => __( 'Uploaded to this page', 'cranleigh-2016' ),
			 'items_list'            => __( 'Items list', 'cranleigh-2016' ),
			 'items_list_navigation' => __( 'Items list navigation', 'cranleigh-2016' ),
			 'filter_items_list'     => __( 'Filter items list', 'cranleigh-2016' ),
		 );

		 return $labels;
	}

	/**
	 * rewrite function.
	 *
	 * This gets written into the $args
	 *
	 * @access public
	 *
	 * @param mixed $slug
	 *
	 * @return void
	 */
	function rewrite( $slug ) {
		 return array(
			 'slug'       => $slug,
			 'with_front' => false,
			 'pages'      => true,
			 'feeds'      => true,
		 );
	}

	/**
	 * default_args function.
	 *
	 * These get merged into the functions above...
	 *
	 * @access public
	 * @return void
	 */
	function default_args() {
		$args = array(
			'supports'            => array( 'page-attributes', 'title', 'editor', 'author', 'revisions', 'thumbnail' ),
			'taxonomies'          => array(),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 27,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
		);

		return $args;
	}

}
