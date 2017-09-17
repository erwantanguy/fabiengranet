<?php

add_theme_support( 'post-thumbnails' );
//set_post_thumbnail_size( 50, 50, true );
set_post_thumbnail_size( 50, 50, array( 'center', 'center')  );
//wp_nav_menu( array( 'menu' => 'principal' ) );
add_theme_support( 'menus' );
add_shortcode('lang_en', 'votre_fonction');
function votre_fonction($param) {
  extract(
    shortcode_atts(
      array(
        'title' => '<img class="alignnone size-full wp-image-381 lang" src="http://www.ticoet.fr/drmgalerie/wp-content/themes/fabiengranet/images/lang_en.png" width="18" height="18" />'
      ),
      $param
    )
   );
   return $title;
 };

/*function register_button($buttons) { 
  $pos = array_search( 'wp_adv', $buttons, true ); 

  if ( $pos !== false ) { 

    $tmp_buttons = array_slice( $buttons, 0, $pos ); 
    array_push($tmp_buttons,'|', "slider", '|'); 
    $buttons = array_merge( $tmp_buttons, array_slice( $buttons, $pos ) ); 

  } 

  return $buttons; 
}*/
//add_filter('mce_buttons_2', 'cnsx_register_button');
add_action('init', 'mylink_button');
function mylink_button() {
 
   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
     return;
   }
 
   if ( get_user_option('rich_editing') == 'true' ) {
     add_filter( 'mce_external_plugins', 'add_plugin' );
     add_filter( 'mce_buttons', 'register_button' );
   }
 
}
function register_button( $buttons ) {
 array_push( $buttons, "|", "englishversion" );
 return $buttons;
}
function add_plugin( $plugin_array ) {
   $plugin_array['englishversion'] = get_bloginfo( 'template_url' ) . '/js/mybuttons.js';
   return $plugin_array;
}

/********** THEME ****************/
//add_options_page(__('All Settings'), __('All Settings'), 'administrator', 'options.php');
//add_theme_page('éléments supllémentaires', 'Options', 'edit_themes_options', 'options', array(10,'themeUi'));
function menu_options(){
	add_submenu_page("themes.php", "Options du thème", "Options du thème", 9, "options", "custom_theme_options");
}
function custom_theme_options(){
	//echo "<h2>Options du thème</h2>test et tout le reste";
	require_once ( get_template_directory() . '/theme-options.php' );
};
add_action("admin_menu", "menu_options");



//require_once ( get_template_directory() . '/options.php' );
//function add_custom_theme_options()  
//{  
    //add_theme_page('Theme Options', 'Theme Options', 'manage_options', 'options','custom_theme_options');
	/*function add_custom_theme_options()
	{
		//echo "<h2>Theme Options</h2>";
	}*/
//}
//add_action('admin_menu', 'add_custom_theme_options');

/*function add_custom_theme_options()
{
	//echo "<h2>Theme Options</h2>";
}*/
//require_once ( get_stylesheet_directory() . '/theme-options.php' );
//require_once ( get_template_directory() . '/theme-options.php' );
//add_theme_page('Options du thème', 'Options du thème', 'manage_options', 'theme-options','custom_theme_options');
/*function custom_theme_options(){
	echo "<h2>Options du thème</h2>test et tout le reste";
	require_once ( get_template_directory() . '/theme-options.php' );
};*/

/* MENU */


register_nav_menus(array(
	'premier' => 'Menu principale',
	'deuxieme' => 'Petit menu optionnel',
	'troisieme' => 'Menu pied de page',
	'oeuvres' => 'Menu pour les oeuvres quand il n\'y a pas d\'événements'
));


$args = array(
	'flex-width'    => true,
	'width'         => 1900,
	'flex-height'    => true,
	'height'        => 284,
	'default-image' => 'http://www.ticoet.fr/drmgalerie/wp-content/uploads/sites/12/2015/09/bandeau_defaut.png', //get_template_directory_uri() . 
	'uploads'       => true,
);
add_theme_support( 'custom-header', $args );


add_image_size( 'events', 300, 120, array( 'left', 'top' ) );
add_image_size( 'event', 300,120 );
add_image_size('mobile',768);
add_image_size('tablette',1000);
//add_image_size('vignette',225,225,array( 'left', 'top' ));
add_image_size('vignette',225,225,array( 'center', 'center' ));
add_image_size('vignetteAccueil',410,410,array( 'center', 'center' ));

class Bootstrap_Walker_Nav_Menu extends Walker_Nav_Menu {

   function start_lvl(&$output, $depth = 0, $args = array()) {
      $output .= "\n<ul class=\"dropdown-menu\">\n";
   }

   function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
       $element_html = '';
       parent::start_el($element_html, $item, $depth, $args);
       if ( $item->is_dropdown && $depth === 0 ) {
           $element_html = str_replace( '<a', '<a class="dropdown-toggle" data-toggle="dropdown"', $element_html );
           $element_html = str_replace( '</a>', ' <b class="caret"></b></a>', $element_html );
       }
       $output .= $element_html;
    }

    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
        if ( $element->current ) {
            $element->classes[] = 'active';
        }
        $element->is_dropdown = !empty( $children_elements[$element->ID] );
        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}


/* WIDGETS *************/

/*if ( function_exists('register_sidebar') ) {
register_sidebar(array(
        'name' => 'ma_sidebar',
		'before_widget' => '<div class="widget_sidebar">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
      ));
register_sidebar(array(
        'name' => 'barre_gauche_footer_artiste',
		'before_widget' => '<div class="widget_sidebar">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
      ));
register_sidebar(array(
        'name' => 'barre_droite_footer_artiste',
		'before_widget' => '<div class="widget_sidebar">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
      ));
register_sidebar(array(
        'name' => 'menu_artiste_event',
		'before_widget' => '<div class="widget_sidebar">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
      ));
	}
add_action('widgets_init', 'ma_sidebar');
add_action('widgets_init', 'barre_gauche_footer_artiste');
add_action('widgets_init', 'barre_droite_footer_artiste');
add_action('widgets_init', 'menu_artiste_event');*/
add_action( 'widgets_init', 'theme_slug_widgets_init' );
function theme_slug_widgets_init() {
    register_sidebar( array(
        'name' => 'ma_sidebar',
		'before_widget' => '<div class="widget_sidebar">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ) );
	register_sidebar(array(
        'name' => 'barre_gauche_footer_oeuvre',
		'before_widget' => '<div class="widget_sidebar">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
      ));
	  register_sidebar(array(
        'name' => 'barre_droite_footer_oeuvre',
		'before_widget' => '<div class="widget_sidebar">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
      ));
	  register_sidebar(array(
        'name' => 'menu_oeuvre_event',
		'before_widget' => '<div class="widget_sidebar">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
      ));
}

/************************* oeuvres ************************/


add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'oeuvre',
    array(
      'labels' => array(
        'name' => __( 'Oeuvres' ),
        'singular_name' => __( 'Oeuvre' ),
        'all_items' => 'Toutes les oeuvres',
      'add_new_item' => 'Ajouter une oeuvre',
      'edit_item' => 'Éditer l\'oeuvre',
      'new_item' => 'Nouvelle oeuvre',
      'view_item' => 'Voir l\'oeuvre',
      'search_items' => 'Rechercher parmi les oeuvres',
      'not_found' => 'Pas d\'oeuvre trouvée',
      'not_found_in_trash'=> 'Pas d\'oeuvre dans la corbeille'
      ),
      'public' => true,
      
      /*'publicly_queryable' => true,
	  'show_ui'            => true,
	  'show_in_menu'       => true,
	  'query_var'          => true,
      'show_in_nav_menus' => true,*/
	  
      /*'show_in_admin_bar' => true,*/
      'supports'=>array('title','editor','thumbnail','excerpt','revisions'),
	  'taxonomies'=>array('post_tag'),
	  'query_var' => true,
      'rewrite' => true,
      'capability_type' => 'post',
    )
  );
}


add_action('add_meta_boxes','init_metabox');
function init_metabox(){
  add_meta_box('homepage', 'Accueil', 'home_page', 'oeuvre', 'side');
}

function home_page($post){
  $dispo = get_post_meta($post->ID,'_home_page',true);
  echo '<label for="home_page_meta">Mise en avant de l\'oeuvre sur la page d\'accueil :</label>';
  echo '<select name="home_page">';
  echo '<option ' . selected( 'oui', $dispo, false ) . ' value="oui">Oui</option>';
  echo '<option ' . selected( 'non', $dispo, false ) . ' value="non">Non</option>';
  echo '</select>';

}

add_action('save_post','save_metabox');
function save_metabox($post_id){
if(isset($_POST['home_page']))
  update_post_meta($post_id, '_home_page', $_POST['home_page']);
}


/**************************** JS *****************************/
    add_action('init', 'gkp_insert_js_in_footer');
    function gkp_insert_js_in_footer() {
     
    // On verifie si on est pas dans l'admin
    if( !is_admin() ) :
     
        // On annule jQuery installer par WordPress (version 1.4.4
        wp_deregister_script( 'jquery' );
     
        // On declare un nouveau jQuery dernière version grace au CDN de Google
        wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js','',false,true);
        wp_enqueue_script( 'jquery' );
     
        // On insere le fichier de ses propres fonctions javascript
        wp_register_script('functions', get_bloginfo( 'template_directory' ).'/js/bootstrap.min.js','',false,true);
		wp_enqueue_script( 'functions' );
		wp_register_script('docs', get_bloginfo( 'template_directory' ).'/js/docs.min.js','',false,true);
		wp_enqueue_script( 'docs' );
		wp_register_script('collapse', get_bloginfo( 'template_directory' ).'/js/collapse.js','',false,true);
		wp_enqueue_script( 'collapse' );
		wp_register_script('carousel', get_bloginfo( 'template_directory' ).'/js/carousel.js','',false,true);
        wp_enqueue_script( 'carousel' );
		wp_register_script('tab', get_bloginfo( 'template_directory' ).'/js/tab.js','',false,true);
        wp_enqueue_script( 'tab' );
		/*wp_register_script('masonry', get_bloginfo( 'template_directory' ).'/js/masonry.js','',false,true);
        wp_enqueue_script( 'masonry' );
		wp_register_script('myMasonry', get_bloginfo( 'template_directory' ).'/js/my-masonry.js','',false,true);
        wp_enqueue_script( 'myMasonry' );*/
     
    endif;
    }



/********************* ical **************/

// Changes the text labels for Google Calendar and iCal buttons on a single event page
remove_action('tribe_events_single_event_after_the_content', array('Tribe__Events__iCal', 'single_event_links'));
add_action('tribe_events_single_event_after_the_content', 'customized_tribe_single_event_links');
  
function customized_tribe_single_event_links()    {
    if (is_single() && post_password_required()) {
        return;
    }
  
    echo '<div class="tribe-events-cal-links">';
    echo '<a class="btn btn-default btn-xs" href="' . tribe_get_gcal_link() . '" title="' . __( 'Add to Google Calendar', 'tribe-events-calendar-pro' ) . '">Google Agenda</a>';
    echo ' <a class="btn btn-default btn-xs" href="' . tribe_get_single_ical_link() . '">Exporter vers iCal</a>';
    echo '</div><!-- .tribe-events-cal-links -->';
}

//+ Google Agenda+ Exporter vers iCal



/************* ROLES ****************/

/*
Objectif : Permettre à toutes les personnes du role "Editeur" de pouvoir manipuler le menu de son site Internet
            - Etape 1 : Ajouter au role Editeur l'accès à l'Apparence du site
            - Etape 2 : Retirer tous les sous menu du menu "Apparence" saus le sous menu "Menus"
*/
$roleObject = get_role( 'editor' );
if (!$roleObject->has_cap( 'edit_theme_options' ) ) {
    $roleObject->add_cap( 'edit_theme_options' );
}
 
function hide_menu() {
    // Si le role de l'utilisatieur ne lui permet pas d'ajouter des comptes (autrement dit si il n'est pas admin)
    if(!current_user_can('add_users')) {
      remove_submenu_page( 'themes.php', 'themes.php' ); // hide the theme selection submenu
      //remove_submenu_page( 'themes.php', 'widgets.php' ); // hide the widgets submenu
      remove_submenu_page( 'themes.php', 'theme-editor.php' ); // hide the editor menu
 
      // Le code suisant c'est juste poure retirer le sous menu "Personnaliser"
      $customize_url_arr = array();
      $customize_url_arr[] = 'customize.php'; // 3.x
      $customize_url = add_query_arg( 'return', urlencode( wp_unslash( $_SERVER['REQUEST_URI'] ) ), 'customize.php' );
      $customize_url_arr[] = $customize_url; // 4.0 & 4.1
      if ( current_theme_supports( 'custom-header' ) && current_user_can( 'customize') ) {
          $customize_url_arr[] = add_query_arg( 'autofocus[control]', 'header_image', $customize_url ); // 4.1
          $customize_url_arr[] = 'custom-header'; // 4.0
      }
      if ( current_theme_supports( 'custom-background' ) && current_user_can( 'customize') ) {
          $customize_url_arr[] = add_query_arg( 'autofocus[control]', 'background_image', $customize_url ); // 4.1
          $customize_url_arr[] = 'custom-background'; // 4.0
      }
      foreach ( $customize_url_arr as $customize_url ) {
          remove_submenu_page( 'themes.php', $customize_url );
      }
 
    }
 
}
add_action('admin_head', 'hide_menu');

/************* bar admin ****************/
function my_admin_bar_link() {
	global $wp_admin_bar;
	if ( !is_super_admin() || !is_admin_bar_showing() )
		return;
	$wp_admin_bar->add_menu( array(
	'id' => 'oeuvres',
	'parent' => 'site-name',
	'title' => __( 'Oeuvres'),
	'href' => admin_url( '/edit.php?post_type=oeuvre' )
	) );
}
add_action('admin_bar_menu', 'my_admin_bar_link', 1000);

function mes_options() {
	global $wp_admin_bar;
	if ( !is_super_admin() || !is_admin_bar_showing() )
		return;
	$wp_admin_bar->add_menu( array(
	'id' => 'options',
	'parent' => 'site-name',
	'title' => __( 'Mes options'),
	'href' => admin_url( '/themes.php?page=options' )
	) );
}
add_action('admin_bar_menu', 'mes_options', 1002);



?>