<?php
// Register Custom Post Type

function custom_dealer_post_type() {

    $labels = array(
        'name'                  => _x( 'Dealers', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Dealer', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Dealers', 'text_domain' ),
        'name_admin_bar'        => __( 'Dealer', 'text_domain' ),
        'archives'              => __( 'Dealer Archives', 'text_domain' ),
        'attributes'            => __( 'Dealer Attributes', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Dealer:', 'text_domain' ),
        'all_items'             => __( 'All Dealers', 'text_domain' ),
        'add_new_item'          => __( 'Add New Dealer', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Dealer', 'text_domain' ),
        'edit_item'             => __( 'Edit Dealer', 'text_domain' ),
        'update_item'           => __( 'Update Dealer', 'text_domain' ),
        'view_item'             => __( 'View Dealer', 'text_domain' ),
        'view_items'            => __( 'View Dealers', 'text_domain' ),
        'search_items'          => __( 'Search Dealer', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into Dealer', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Dealer', 'text_domain' ),
        'items_list'            => __( 'Dealers list', 'text_domain' ),
        'items_list_navigation' => __( 'Dealers list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter Dealers list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Dealer', 'text_domain' ),
        'description'           => __( 'Dealer information and locations', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'post_tag' ), // Added 'post_tag' support
        'taxonomies'            => array( 'dealer_location' ), // Added 'post_tag' taxonomy
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type( 'dealer', $args );

}
add_action( 'init', 'custom_dealer_post_type', 0 );

// Register Custom Taxonomy
function custom_dealer_location_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Locations', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Location', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Locations', 'text_domain' ),
        'all_items'                  => __( 'All Locations', 'text_domain' ),
        'parent_item'                => __( 'Parent Location', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Location:', 'text_domain' ),
        'new_item_name'              => __( 'New Location Name', 'text_domain' ),
        'add_new_item'               => __( 'Add New Location', 'text_domain' ),
        'edit_item'                  => __( 'Edit Location', 'text_domain' ),
        'update_item'                => __( 'Update Location', 'text_domain' ),
        'view_item'                  => __( 'View Location', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate locations with commas', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or remove locations', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
        'popular_items'              => __( 'Popular Locations', 'text_domain' ),
        'search_items'               => __( 'Search Locations', 'text_domain' ),
        'not_found'                  => __( 'Not Found', 'text_domain' ),
        'no_terms'                   => __( 'No locations', 'text_domain' ),
        'items_list'                 => __( 'Locations list', 'text_domain' ),
        'items_list_navigation'      => __( 'Locations list navigation', 'text_domain' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'dealer_location', array( 'dealer' ), $args );

    $labels_tag = array(
        'name'                       => _x( 'Tags', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Tag', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Tags', 'text_domain' ),
        // Add other labels as needed...
    );
    $args_tag = array(
        'labels'                     => $labels_tag,
        'hierarchical'               => false,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'dealer_tag', array( 'dealer' ), $args_tag );

}
add_action( 'init', 'custom_dealer_location_taxonomy', 0 );

function custom_meta_box() {
    add_meta_box(
        'custom-meta-box',
        'Dealer Information',
        'render_custom_meta_box',
        'dealer',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'custom_meta_box');

// Render meta box content
function render_custom_meta_box($post) {
    // Retrieve existing values for address and number fields
    $address_values = get_post_meta($post->ID, '_address', true);
    $number_values = get_post_meta($post->ID, '_number', true);

    // Nonce to verify data when saving
    wp_nonce_field('custom_meta_box_nonce', 'meta_box_nonce');
    ?>

    <label for="address">Address</label>
    <ul id="address-list">
        <?php if (!empty($address_values) && is_array($address_values)) : ?>
            <?php foreach ($address_values as $index => $address) : ?>
                <li>
                    <input type="text" name="address[]" value="<?php echo esc_attr($address); ?>" />
                    <button type="button" class="remove-field" data-field-type="address" data-index="<?php echo $index; ?>">Remove</button>
                </li>
            <?php endforeach; ?>
        <?php else : ?>
            <li><input type="text" name="address[]" /></li>
        <?php endif; ?>
    </ul>

    <label for="number">Number</label>
    <ul id="number-list">
        <?php if (!empty($number_values) && is_array($number_values)) : ?>
            <?php foreach ($number_values as $index => $number) : ?>
                <li>
                    <input type="text" name="number[]" value="<?php echo esc_attr($number); ?>" />
                    <button type="button" class="remove-field" data-field-type="number" data-index="<?php echo $index; ?>">Remove</button>
                </li>
            <?php endforeach; ?>
        <?php else : ?>
            <li><input type="text" name="number[]" /></li>
        <?php endif; ?>
    </ul>

    <button type="button" class="button" id="add-address">Add Address</button>
    <button type="button" class="button" id="add-number">Add Number</button>

    <script>
        // JavaScript to handle adding and removing fields dynamically
        jQuery(document).ready(function ($) {
            jQuery('#add-address').click(function () {
                jQuery('#address-list').append('<li><input type="text" name="address[]" /><button type="button" class="remove-field" data-field-type="address">Remove</button></li>');
            });

            jQuery('#add-number').click(function () {
                jQuery('#number-list').append('<li><input type="text" name="number[]" /><button type="button" class="remove-field" data-field-type="number">Remove</button></li>');
            });

            // Handle removal of dynamically added fields
            jQuery(document).on('click', '.remove-field', function () {
                var fieldType = jQuery(this).data('field-type');
                if (confirm('Are you sure you want to remove this ' + fieldType + ' field?')) {
                    jQuery(this).closest('li').remove();
                }
            });
        });
    </script>
    <?php
}

// Save meta box data
function save_custom_meta_box($post_id) {
    // Verify nonce
    if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'custom_meta_box_nonce')) {
        return $post_id;
    }

    // Check if it's an autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // Check post type
    if ('dealer' !== $_POST['post_type']) {
        return $post_id;
    }

    // Save address and number fields
    if (isset($_POST['address'])) {
        update_post_meta($post_id, '_address', array_map('sanitize_text_field', $_POST['address']));
    }

    if (isset($_POST['number'])) {
        update_post_meta($post_id, '_number', array_map('sanitize_text_field', $_POST['number']));
    }
}
add_action('save_post', 'save_custom_meta_box');

function category_ajax_post_filter_shortcode() {
    ob_start();
    ?>
<div class="join-div">
        <?php
        $categories = get_terms('dealer_location');
        ?>
        <div class="button-group">
        <label>Find a city</label>
        <select class="category-dropdown" id="city-dropdown">
        <option value="" selected>All city</option>
           <?php $categories = get_terms('dealer_location'); ?>
            <?php foreach ($categories as $category) { ?>
                <option value="<?php echo esc_attr($category->slug); ?>">
                    <?php echo esc_html($category->name); ?>
                </option>
            <?php } ?>
        </select>
      </div>
        <div class="select-dealer">
            <label for="dealer">Find a Dealer</label>
            <select name="dealer" id="dealer">
            <option value="" selected>Find a Dealer</option>
                <?php
                $args = array(
                    'post_type'      => 'dealer',
                    'posts_per_page' => -1,
                    'orderby'        => 'title',
                    'order'          => 'ASC',
                   

                );
                $dealers = get_posts($args);
                
                foreach ($dealers as $dealer) {
                    setup_postdata($dealer);
                    $dealer_title = esc_html($dealer->post_title);
                    $dealer_id = $dealer->ID
                   
                    ?>
                    
                    <option value="<?php echo $dealer_title; ?>"><?php echo $dealer_title; ?></option>
                    <?php
                }
                wp_reset_postdata();
                ?>
            </select>
        </div>

    <div class="select-tag">
       <label for="dealer">Tags</label>
      <select class="tags-dropdown" id="tags-dropdown">
        <option value="" selected>All Tags</option>
        <?php $post_tags = get_terms('dealer_tag'); ?>
        <?php foreach ($post_tags as $tag) { ?>
            <option value="<?php echo esc_attr($tag->slug); ?>">
                <?php echo esc_html($tag->name); ?>
            </option>
        <?php } ?>
      </select>
   </div>

 
  

</div>
<div class="loader" style="display: none;">
    <img src="https://bostonsash.com/wp-content/uploads/2024/01/34338d26023e5515f6cc8969aa027bca.gif" alt="Loader">
   </div>
<input type="submit" id="sub-btn" name="sub-btn">


    <?php
    return ob_get_clean();
    
}

add_shortcode('category_ajax_post_filters', 'category_ajax_post_filter_shortcode');

add_shortcode('filter_content','filter_content');
function filter_content(){
ob_start();
?>

<div class="filter-content">
    <?php
     $args = array(
        'post_type'      => 'dealer', 
        'posts_per_page' => 7, 
        'orderby'        => 'date', 
        'order'          => 'DESC', 
        'paged' => 1,
    );
 $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
$query = new WP_Query($args);

if ($query->have_posts()) {
    echo '<div class="dealer-post-type">';
    echo '<table class="dealer-table">';
    echo'<tr class="dealer-table-inner">';
    echo'<th>Dealer Name</th>';
    echo'<th>Dealer Adress & Number </th>';
    echo'<th>Website</th>';
    echo'</tr>';
    echo'<tr class="dealer-table-inner-mob"><th>Dealer information</th></tr>';
    while ($query->have_posts()) {
        $query->the_post();
        echo '<tr class="dealer-post-type-item">';
        echo '<td class="dealer-post-type-title">' . get_the_title() . '</td>';

        $addresses = get_post_meta(get_the_ID(), '_address', true);
        $numbers   = get_post_meta(get_the_ID(), '_number', true);
        $website   = get_post_meta(get_the_ID(), 'website', true);

        echo '<td class="dealer-main">';
        if (!empty($addresses) && is_array($addresses) && !empty($numbers) && is_array($numbers)) {
            echo '<table class="dealer-info-table">';

            // Assuming both arrays have the same length
            $count = min(count($addresses), count($numbers));

            for ($i = 0; $i < $count; $i++) {
                echo '<tr class="dealer-item">';
                echo '<td class="dealer-address">  ' . esc_html($addresses[$i]) . '</td>';
                echo '<td class="dealer-number"> <a href="tel:' . esc_html($numbers[$i]) . '">' . esc_html($numbers[$i]) . '</a></td>';

                echo '</tr>';
            }

            echo '</table>';
        }
        echo '</td>';

        echo '<td class="dealer-website">';
        if ($website) {
            echo ' <a href="' . esc_url($website) . '" target="_blank">' . esc_html($website) . '</a>';
        }
        echo '</td>';

        echo '</tr>';
    }

    echo '</table>';
    echo '</div>';
    $total_pages = $query->max_num_pages;
	if ($total_pages > 1) {
	  echo '<div class="pagination">';
	  global $wp_query;
			$big = 999999999; // need an unlikely integer
			echo paginate_links( array(
			'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		   'current' => $paged,
	   'prev_text'    => __('<'),
		   'next_text'    => __('>'),
	   'prev_next'   => TRUE,
		   'total'   => $query->max_num_pages
			) );
	  echo '</div>';
	}
   
} else {
    echo '<p>No posts found.</p>';
}
wp_reset_postdata();
?>
</div>

<?php
return ob_get_clean();

}

add_action('wp_ajax_filter_content', 'filter_content_function');
add_action('wp_ajax_nopriv_filter_content', 'filter_content_function');

function filter_content_function() {
    ob_start();
    $city   = isset($_POST['city']) ? sanitize_text_field($_POST['city']) : '';
    $dealer = isset($_POST['dealer']) ? sanitize_text_field($_POST['dealer']) : '';
    $tag    = isset($_POST['tag']) ? sanitize_text_field($_POST['tag']) : '';
    $currentPage = isset($_POST['currentPage']) ? $_POST['currentPage'] : 1;

    $args = array(
        'post_type'      => 'dealer', 
        'posts_per_page' => 7, 
        'orderby'        => 'date', 
        'order'          => 'DESC',
        'paged' => $currentPage, 
    );

    // Check if a title is provided
    if (!empty($dealer)) {
        $args['s'] = $dealer; 
    }

    // Check if a custom taxonomy term is provided
    if (!empty($city)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'dealer_location', 
            'field'    => 'slug', 
            'terms'    => $city,
        );
    }

    // Check if a custom post tag is provided
    if (!empty($tag)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'dealer_tag', 
            'field'    => 'slug', 
            'terms'    => $tag,
        );
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
echo '<div class="dealer-post-type">';

    echo '<table class="dealer-table">';
    echo'<tr class="dealer-table-inner">';
    echo'<th>Dealer Name</th>';
    echo'<th>Dealer Adress & Number </th>';
    echo'<th>Website</th>';
    echo'</tr>';
    echo'<tr class="dealer-table-inner-mob"><th>Dealer information</th></tr>';
    while ($query->have_posts()) {
        $query->the_post();
        echo '<tr class="dealer-post-type-item">';
        echo '<td class="dealer-post-type-title">' . get_the_title() . '</td>';

        $addresses = get_post_meta(get_the_ID(), '_address', true);
        $numbers   = get_post_meta(get_the_ID(), '_number', true);
        $website   = get_post_meta(get_the_ID(), 'website', true);

        echo '<td class="dealer-main">';
        if (!empty($addresses) && is_array($addresses) && !empty($numbers) && is_array($numbers)) {
            echo '<table class="dealer-info-table">';

            // Assuming both arrays have the same length
            $count = min(count($addresses), count($numbers));

            for ($i = 0; $i < $count; $i++) {
                echo '<tr class="dealer-item">';
                echo '<td class="dealer-address"> ' . esc_html($addresses[$i]) . '</td>';
                echo '<td class="dealer-number"> <a href="tel:' . esc_html($numbers[$i]) . '">' . esc_html($numbers[$i]) . '</a></td>';

                echo '</tr>';
            }

            echo '</table>';
        }
        echo '</td>';

        echo '<td class="dealer-website">';
        if ($website) {
            echo '<a href="' . esc_url($website) . '" target="_blank">' . esc_html($website) . '</a>';
        }
        echo '</td>';

        echo '</tr>';
    }

    echo '</table>';
    echo '</div>';
        $total_pages = $query->max_num_pages;
        if ($total_pages > 1) {
          echo '<div class="pagination">';
          global $wp_query;
                $big = 999999999; // need an unlikely integer
                echo paginate_links( array(
                'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
               'current' => $currentPage,
           'prev_text'    => __('<'),
               'next_text'    => __('>'),
           'prev_next'   => TRUE,
               'total'   => $query->max_num_pages
                ) );
          echo '</div>';
        }
      
       
        
    } else {
        echo '<p>No posts found.</p>';
    }
    wp_reset_postdata();
    die();
    ob_get_clean();
   
}



?>