<?php
/**
 * Register assets
 *
 * @package vn_links_widget
 * @author codetot
 * @since 0.0.1
 */

class Vn_Links_Shortcode
{
    /**
     * Singleton instance
     *
     * @var Vn_Links_Shortcode
     */
    private static $instance;

    /**
     * Get singleton instance.
     *
     * @return Vn_Links_Shortcode
     */
    final public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct()
    {
        add_action('init', array( $this, 'register_shortcodes' ));
    }

    public function register_shortcodes()
    {
        add_shortcode('vn-links', array($this, 'render_shortcode'));
    }

    public function render_shortcode()
    {
        $links_args = array(
            'post_type' => 'vn-links',
            'posts_per_page' => -1,
            'meta_key' => '_links_url'
        );

        $links = get_posts($links_args);

        ob_start();
        if (!empty($links)) : ?>
			<div class="vn-links" data-app="vn-links">
				<?php printf('<label for="vn-links" class="vn-links__label screen-reader-text">%s</label>', esc_html__('Click to redirect to another website', 'vn-links')); ?>
				<div class="vn-links__select-wrapper">
					<select class="vn-links__select js-select" id="vn-links">
						<?php
						printf('<option value="">%s</option>', esc_html__('Select website', 'vn-links'));
						foreach ($links as $link_post) :
							$link_value = get_post_meta($link_post->ID, '_links_url');
							printf('<option value="%1$s">%2$s</option>', esc_url($link_value[0]), esc_attr($link_post->post_title));
						endforeach; ?>
					</select>
					<span class="vn-links__icon"></span>
				</div>
			</div>
        <?php endif;

        return ob_get_clean();
    }
}
