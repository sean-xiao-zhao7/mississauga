<?php

/** 
 * Plugin Name: ParksPostPluginSean
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
    private function __construct()
    {
        add_action('init', [$this, 'ppps_create_post_type']);
        add_action('wp_enqueue_scripts', [$this, 'ppps_load_assets']);
        add_shortcode('show-parks-list', [$this, 'ppps_show_parks_list']);
    }

    public function ppps_create_post_type()
    {
        $args = [
            'public' => true,
            'has_archive' => true,
            'supports' => ['name', 'location', 'hours', 'description'],
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
new ParksPostPluginSean;
