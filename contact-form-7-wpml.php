<?php

/**
 * Plugin Name: WPML Contact Form 7
 * Plugin URI: https://github.com/JutGreg/contact-form-7-wpml
 * Description: Contact Form 7 Multilingual plugin
 * Author: JutGreg
 * Author URI: https://github.com/JutGreg
 * Version: 1.0.6
 * Text Domain: contact-form-7-wpml
 *
 * Copyright: (c) 2019 JutGreg. All rights reserved.
 *
 * License: MIT License
 * License URI: https://opensource.org/licenses/MIT
 *
 * @package   contact-form-7-wpml
 * @author    JutGreg
 * @category  Admin
 * @copyright Copyright (c) 2019 JutGreg. All rights reserved.
 * @license   MIT License
 *
 * Enables Contact Form 7 translation with WPML
 */

defined('ABSPATH') or exit;

function wpmlcf_init()
{
    if (!class_exists("SitePress") && class_exists("WPCF7"))
        return;

    add_filter("wpcf7_form_tag", "wpmlcf_tags");
}

function wpmlcf_tags($tags, $exec = null)
{
    foreach ($tags["values"] as $key => $val) {
        do_action("wpml_register_single_string", "contact-form-7-wpml", $val, $val);

        $tags["values"][$key] = apply_filters("wpml_translate_single_string", $val, "contact-form-7-wpml", $val);
    }

    return $tags;
}

add_action("init", "wpmlcf_init");
