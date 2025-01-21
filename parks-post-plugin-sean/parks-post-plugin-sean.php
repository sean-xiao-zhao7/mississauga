<?php

/** 
 * Plugin Name: Parks Post Plugin (Sean)
 * Description: A plugin that registers the parks custom post type.
 * Author: Sean Xiao
 * Version: 1.0.0
 * Text Domain: parks-post-plugin-sean
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Parks_Post_Plugin_Sean
{

    /**
     * Static property to hold our singleton instance
     *
     */
    private static $instance = false;

    /**
     * This is our constructor
     *
     * @return void
     */
    private function __construct()
    {
        add_action('init', [$this, 'ppps_create_post_type']);
        // add_action('', [$this, 'add_custom_metabox']);
        add_action('wp_enqueue_scripts', [$this, 'ppps_load_assets']);
        add_shortcode('show-parks-list', [$this, 'ppps_show_parks_list']);
    }

    /**
     * If an instance exists, this returns it.  If not, it creates one and
     * retuns it.
     *
     * @return Parks_Post_Plugin_Sean
     */
    public static function getInstance()
    {
        if (!self::$instance)
            self::$instance = new self;
        return self::$instance;
    }

    public function add_custom_metabox()
    {
        add_meta_box(
            'custom_location_metabox',
            'Location',
            'render_custom_location_metabox',
            'parks_post_sean',
            'normal',
            'default'
        );
    }

    public function render_custom_location_metabox($post)
    {
        // Retrieve longitude and latitude values
        $location = get_post_meta($post->ID, 'location', true);
?>
        <label for="location">Location:</label>
        <input type="text" id="location" name="location" value="<?php echo esc_attr($location); ?>"><br>
    <?php
    }

    function save_custom_location($post_id)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

        // Save longitude and latitude values
        if (isset($_POST['location'])) {
            update_post_meta($post_id, 'longitude', sanitize_text_field($_POST['location']));
        }
    }


    public function ppps_create_post_type()
    {
        $args = [
            'public' => true,
            'has_archive' => true,
            'capability' => 'manage_options',
            'labels' => ['name' => 'Parks', 'singular_name' => 'Park'],
            'menu_icon' => 'dashicons-palmtree'
        ];

        register_post_type('parks_post_sean', $args);
    }


    public function ppps_load_assets()
    {
        wp_enqueue_style('parks_post_sean', plugin_dir_url(__FILE__) . 'styles/main.css', [], 1, 'all');
    }

    public function ppps_show_parks_list()
    {
    ?>
        <div id="parks-list-container">
            <h1>All Parks</h1>
            <table id="parks-list">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Hours (weekday, weekends)</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    ?>
                </tbody>
            </table>
        </div>
<?php
    }
}

// Instantiate our class
$Parks_Post_Plugin_Sean = Parks_Post_Plugin_Sean::getInstance();
