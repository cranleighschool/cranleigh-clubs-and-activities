<?php


	namespace CranleighSchool\CranleighClubsAndActivities\Shortcodes;

	use FredBradley\WordPressTraits\Traits\Shortcode;
	use WP_Query;

class ListClubs extends Shortcode {

	protected $tag    = 'list-clubs';
	protected $config = [];

	public function render( $atts, $content = null ) {
		$args = [
			'posts_per_page' => -1,
			'post_type'      => $this->config['post_type_key'],
			'orderby'        => 'post_title',
			'order'          => 'ASC',
		];

		$new_query = new WP_Query( $args );

		ob_start();

		if ( $new_query->have_posts() ) :
			echo '<div id="clubs-list">';
			echo '<ul>';
			while ( $new_query->have_posts() ) :
				$new_query->the_post();
				if ( strlen( get_the_content() ) ) :
					echo sprintf( "<li><a href='%s'>%s</a> %s</li>", get_permalink(), get_the_title(), $this->edit_post_link( 'Edit' ) );
					else :
						echo sprintf( '<li>%s %s</li>', get_the_title(), $this->edit_post_link( 'Create' ) );
						endif;
					endwhile;
			wp_reset_postdata();
			wp_reset_query();
			echo '</ul>';
			echo '</div>';
			echo "<div class='clear clearfix'>&nbsp;</div>";
			endif;

		$return = ob_get_contents();
		ob_clean();

		return $return;
	}

	private function edit_post_link( string $string ) {
		if (get_edit_post_link(get_the_ID())) {
			return '<a class="post-edit-link" href="' . get_edit_post_link(get_the_ID()) . '">' . $string . '</a>';
		}
	}
}
