<?php

// Checkbox Meta
add_action("admin_init", "featured_checkbox_metabox");

function featured_checkbox_metabox()
{
    add_meta_box("checkbox", "Featured Post", "feature_checkbox", "post", "normal", "high");
}

function feature_checkbox()
{
    global $post;

    $custom = get_post_custom($post->ID);
    $field_id = $custom["is_featured_post"][0];

    $html = "<label for=\"is_featured_post\">Make Feature</label>";

    $field_id_value = get_post_meta($post->ID, 'is_featured_post', true);

    if ($field_id_value) {
        $field_id_checked = "checked";
    }

    $html .= "<input style=\"margin:0px;margin-left:10px;\" type=\"checkbox\" name=\"is_featured_post\" id=\"is_featured_post\" value=\"1\" {$field_id_checked}>";

    echo $html;
}

// Save Meta Details
add_action('save_post', 'save_details');

function save_details()
{
    global $post;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post->ID;
    }

    update_post_meta($post->ID, "is_featured_post", $_POST["is_featured_post"]);
}