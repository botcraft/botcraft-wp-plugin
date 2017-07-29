<?php
/*
Plugin Name: BotCraft
Plugin URI: https://botcraft.co
Description: Embed clever chatbots into your Wordpress site quickly and simply.
Author: Tom Hallam
Version: 1.0
Author URI: https://botcraft.co
*/

function botcraft_shortcode_init()
{
    function botcraft_shortcode($atts = [], $content = null)
    {
      $atts = array_change_key_case((array)$atts, CASE_LOWER);

      $botcrafter_atts = shortcode_atts([
        'title' => 'BotCraft',
        'embedid' => null,
        'height' => 400
      ], $atts);

      if (!$botcrafter_atts['embedid']) {
        return 'You must set an embedId!';
      }

      $o = '<div class="botcraft-embed">';
        $o .= '<iframe style="min-height: ' . ($botcrafter_atts['height'] ? $botcrafter_atts['height'] : 200) . 'px" src="https://botcraft.co/client/' . $botcrafter_atts['embedid'] . '">You must have iframes enabled to view this content.</iframe>';
      $o .= '</div>';

      return $o;

    }
    add_shortcode('botcraft', 'botcraft_shortcode');
}

function botcraft_styles_init()
{
    wp_register_style('botcraft', plugins_url('botcraft/css/plugin.css'));
    wp_enqueue_style('botcraft');
}

add_action('init', 'botcraft_shortcode_init');
add_action('wp_enqueue_scripts', 'botcraft_styles_init');
