<?php


	namespace CranleighSchool\CranleighClubsAndActivities;


	class Admin
	{
		private $post_type_key;

		public function __construct(string $post_type_key)
		{
			$this->post_type_key = $post_type_key;
			add_action('admin_menu', array($this, 'move_attributes_box'), 5);

		}

		/**
		 * move_attributes_box function.
		 *
		 * This will move the box where you set the parent page higher on the side bar.
		 *
		 * @access public
		 * @return void
		 */
		function move_attributes_box()
		{
			remove_meta_box('pageparentdiv', $this->post_type_key, 'side');
			add_meta_box('pageparentdiv', 'Page Attributes', array($this, 'default_page_atts_meta_box'), $this->post_type_key, 'side', 'high');
		}

		/**
		 * default_page_atts_meta_box function.
		 *
		 * @access public
		 * @return The original Wordpress written 'page_attributes_meta_box()' function.
		 */
		function default_page_atts_meta_box()
		{
			global $post;

			return page_attributes_meta_box($post);
		}
	}
