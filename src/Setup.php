<?php

	namespace CranleighSchool\CranleighClubsAndActivities;

	/**
	 * Class Setup
	 *
	 * @package CranleighSchool\CranleighClubsAndActivities
	 */
	class Setup
	{
		/**
		 * @var string
		 */
		public $post_type_key = "clubs-and-activities";

		/**
		 * Setup constructor.
		 */
		function __construct()
		{
			CustomPostType::register($this->post_type_key);
			$this->loadShortcodes();

			if (is_admin()) {
				new Admin($this->post_type_key);
			}

			/** Shouldn't need these two, ad we have disabled the archive page. */
//			add_filter('get_the_archive_title', array($this, 'filter_title'), 4);
//			add_action('pre_get_posts', array($this, 'alter_main_query'));

		}

		/**
		 *
		 */
		public function loadShortcodes()
		{
			$list_clubs = new Shortcodes\ListClubs(['post_type_key' => $this->post_type_key]);
			$list_clubs->init();
		}


		/**
		 * @param $title
		 *
		 * @return mixed
		 * @deprecated
		 */
		public function filter_title($title)
		{
			if (is_post_type_archive($this->post_type_key)):
				return str_replace("Archives:", "", $title); //'The ' . $title . ' was filtered';
			endif;

			return $title;
		}

		/**
		 * @param $query
		 *
		 * @deprecated
		 */
		public function alter_main_query($query)
		{
			if (is_post_type_archive($this->post_type_key)) {
				if ($query->is_main_query()) {
					$query->set("orderby", "name");
					$query->set("order", "ASC");
					$query->set("nopaging", true);
					$query->set("post_parent", 0);
				}
			}
		}


	}
