<?php

/** 
 * Name: ParksPostPluginSean
 * Description: A plugin that registers the parks custom post type.
 * Author: Sean Xiao
 * Version: 1.0.0
 * Text Domain: parks-post-plugin-sean
 */

if (!defined('ABSPATH')) {
    exit;
}

class ParksPostPluginSean
{
    public function __construct()
    {
        add_action('init', [$this, 'create_post_type']);
    }

    public function create_post_type()
    {
        $args = [
            'public' => true,
            'has_archive' => true,
            'supports' => ['name', 'location', 'hours', 'description'],
            'capability' => 'manage_options',
            'labels' => ['name' => 'Parks', 'singular_name' => 'Park'],
            'menu_icon' => 'dashicons-palmtree'
        ];
    }
}

new ParksPostPluginSean;
