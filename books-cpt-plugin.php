<?php
/*
Plugin Name: Books Custom Post Type
Plugin URI: https://yourwebsite.com/books-cpt
Description: Adds a custom post type "Books" with custom fields for Author, Genre, Publication Year, and ISBN.
Version: 1.0.0
Author: Muhammad Ali
Author URI: https://yourwebsite.com
License: GPL2
Text Domain: books-cpt
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Register the custom post type "Books"
function books_register_post_type() {
    $labels = array(
        'name'               => 'Books',
        'singular_name'      => 'Book',
        'menu_name'          => 'Books',
        'name_admin_bar'     => 'Book',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Book',
        'new_item'           => 'New Book',
        'edit_item'          => 'Edit Book',
        'view_item'          => 'View Book',
        'all_items'          => 'All Books',
        'search_items'       => 'Search Books',
        'not_found'          => 'No books found.',
        'not_found_in_trash' => 'No books found in Trash.'
    );
    
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'supports'           => array('title', 'editor', 'thumbnail'),
        'menu_position'      => 20,
        'menu_icon'          => 'dashicons-book',
        'show_in_rest'       => true,
    );
    
    register_post_type('book', $args);
}
add_action('init', 'books_register_post_type');

// Add custom fields (meta boxes) to "Books" post type
function books_add_custom_fields() {
    add_meta_box('books_details', 'Book Details', 'books_display_custom_fields', 'book', 'normal', 'high');
}
add_action('add_meta_boxes', 'books_add_custom_fields');

function books_display_custom_fields($post) {
    $author = get_post_meta($post->ID, 'book_author', true);
    $genre = get_post_meta($post->ID, 'book_genre', true);
    $year = get_post_meta($post->ID, 'book_year', true);
    $isbn = get_post_meta($post->ID, 'book_isbn', true);
    ?>
    <p><label for="book_author">Author: </label>
    <input type="text" id="book_author" name="book_author" value="<?php echo esc_attr($author); ?>" /></p>
    
    <p><label for="book_genre">Genre: </label>
    <input type="text" id="book_genre" name="book_genre" value="<?php echo esc_attr($genre); ?>" /></p>
    
    <p><label for="book_year">Publication Year: </label>
    <input type="number" id="book_year" name="book_year" value="<?php echo esc_attr($year); ?>" /></p>
    
    <p><label for="book_isbn">ISBN: </label>
    <input type="text" id="book_isbn" name="book_isbn" value="<?php echo esc_attr($isbn); ?>" /></p>
    <?php
}

// Save custom fields data
function books_save_custom_fields($post_id) {
    if (array_key_exists('book_author', $_POST)) {
        update_post_meta($post_id, 'book_author', sanitize_text_field($_POST['book_author']));
    }
    if (array_key_exists('book_genre', $_POST)) {
        update_post_meta($post_id, 'book_genre', sanitize_text_field($_POST['book_genre']));
    }
    if (array_key_exists('book_year', $_POST)) {
        update_post_meta($post_id, 'book_year', sanitize_text_field($_POST['book_year']));
    }
    if (array_key_exists('book_isbn', $_POST)) {
        update_post_meta($post_id, 'book_isbn', sanitize_text_field($_POST['book_isbn']));
    }
}
add_action('save_post', 'books_save_custom_fields');

// Shortcode to display books
function books_shortcode($atts) {
    $atts = shortcode_atts(array(
        'genre' => '',
        'author' => ''
    ), $atts, 'books');
    
    $args = array(
        'post_type' => 'book',
        'posts_per_page' => -1,
        'meta_query' => array()
    );

    if ($atts['genre']) {
        $args['meta_query'][] = array(
            'key' => 'book_genre',
            'value' => $atts['genre'],
            'compare' => '='
        );
    }

    if ($atts['author']) {
        $args['meta_query'][] = array(
            'key' => 'book_author',
            'value' => $atts['author'],
            'compare' => '='
        );
    }

    $books = new WP_Query($args);
    
    if ($books->have_posts()) {
        $output = '<ul>';
        while ($books->have_posts()) {
            $books->the_post();
            $output .= '<li>' . get_the_title() . ' by ' . get_post_meta(get_the_ID(), 'book_author', true) . '</li>';
        }
        $output .= '</ul>';
    } else {
        $output = 'No books found.';
    }

    wp_reset_postdata();

    return $output;
}
add_shortcode('books', 'books_shortcode');
