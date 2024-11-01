<?php
/**
 * Register post types
 *
 * @package vn_links_widget
 * @author codetot
 * @since 0.0.1
 */

class Vn_Links_Post_Types {
	/**
	 * Singleton instance
	 *
	 * @var Vn_Links_Post_Types
	 */
	private static $instance;

	/**
	 * Get singleton instance.
	 *
	 * @return Vn_Links_Post_Types
	 */
	public final static function instance()
	{
		if (is_null(self::$instance)) {
		self::$instance = new self();
		}
		return self::$instance;
	}

	public function __construct() {
		$this->metabox_url_id = 'links_url';

		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( 'add_meta_boxes', array( $this, 'links_metabox') );
		add_action( 'save_post', array( $this, 'save_metabox' ), 10, 2 );
	}

	public function register_post_type() {
		$labels = [
			"name" => __( "Links", "vn-links" ),
			"singular_name" => __( "Link", "vn-links" ),
			"menu_name" => __( "Links", "vn-links" ),
			"all_items" => __( "All Links", "vn-links" ),
			"add_new" => __( "Add new", "vn-links" ),
			"add_new_item" => __( "Add new Link", "vn-links" ),
			"edit_item" => __( "Edit Link", "vn-links" ),
			"new_item" => __( "New Link", "vn-links" ),
			"view_item" => __( "View Link", "vn-links" ),
			"view_items" => __( "View Links", "vn-links" ),
			"search_items" => __( "Search Links", "vn-links" ),
			"not_found" => __( "No Links found", "vn-links" ),
			"not_found_in_trash" => __( "No Links found in trash", "vn-links" ),
			"parent" => __( "Parent Link:", "vn-links" ),
			"featured_image" => __( "Featured image for this Link", "vn-links" ),
			"set_featured_image" => __( "Set featured image for this Link", "vn-links" ),
			"remove_featured_image" => __( "Remove featured image for this Link", "vn-links" ),
			"use_featured_image" => __( "Use as featured image for this Link", "vn-links" ),
			"archives" => __( "Link archives", "vn-links" ),
			"insert_into_item" => __( "Insert into Link", "vn-links" ),
			"uploaded_to_this_item" => __( "Upload to this Link", "vn-links" ),
			"filter_items_list" => __( "Filter Links list", "vn-links" ),
			"items_list_navigation" => __( "Links list navigation", "vn-links" ),
			"items_list" => __( "Links list", "vn-links" ),
			"attributes" => __( "Links attributes", "vn-links" ),
			"name_admin_bar" => __( "Link", "vn-links" ),
			"item_published" => __( "Link published", "vn-links" ),
			"item_published_privately" => __( "Link published privately.", "vn-links" ),
			"item_reverted_to_draft" => __( "Link reverted to draft.", "vn-links" ),
			"item_scheduled" => __( "Link scheduled", "vn-links" ),
			"item_updated" => __( "Link updated.", "vn-links" ),
			"parent_item_colon" => __( "Parent Link:", "vn-links" ),
		];

		$args = [
			"label" => __( "Links", "vn-links" ),
			"labels" => $labels,
			"description" => "",
			"public" => true,
			"publicly_queryable" => false,
			"show_ui" => true,
			"show_in_rest" => false,
			"rest_base" => "",
			"rest_controller_class" => "WP_REST_Posts_Controller",
			"has_archive" => false,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"delete_with_user" => false,
			"exclude_from_search" => false,
			"capability_type" => "post",
			"map_meta_cap" => true,
			"hierarchical" => false,
			"rewrite" => false,
			"query_var" => false,
			"menu_icon" => "dashicons-admin-links",
			"supports" => [ "title" ],
			"show_in_graphql" => false,
		];

		register_post_type( "vn-links", $args );
	}

	public function links_metabox() {
		add_meta_box(
			'vn-links-url',
			esc_html__( 'URL', 'vn-links' ),
			array( $this, 'render_metabox' ),
			array( 'vn-links' )
		);
	}

	public function render_metabox( $post ) {
		$existing_url = get_post_meta( $post->ID, '_' . $this->metabox_url_id, true );
		?>
		<p class="vn-links__metabox">
			<label class="vn-links__metabox__label" for="<?php echo esc_attr( $this->metabox_url_id ); ?>" class="screen-reader-text"><?php esc_html_e( 'URL', 'vn-links' ); ?></label>
			<input
				type="url"
				class="vn-links__metabox__input"
				value="<?php echo sanitize_text_field( $existing_url ); ?>"
				placeholder="<?php echo esc_html( 'https://' ); ?>"
				name="<?php echo esc_attr( $this->metabox_url_id ); ?>"
				id="<?php echo esc_attr( $this->metabox_url_id ); ?>"
			>
		</p>
		<?php
	}

	public function save_metabox( $post_id, $post ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( isset( $_POST[$this->metabox_url_id] ) ) {
			update_post_meta( $post_id, '_' . $this->metabox_url_id, sanitize_text_field( $_POST[$this->metabox_url_id] ) );
		}
	}
}
