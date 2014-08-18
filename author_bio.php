<?php
   /*
   Plugin Name: Author bio
   Plugin URI: http://www.ideaboxthemes.com
   Description: A plugin to display author bio
   Version: 1.0
   Author: Saumya Sharma
   Author URI: http://ideaboxthemes.com
   License: GPL2 or later
   License URI: http://www.gnu.org/licenses/gpl-2.0.html
   */
?>
<?php
function asc_enqueue_style(){
   wp_register_style( 'style', plugins_url( 'style.css', __FILE__ ) );
   wp_enqueue_style( 'style',plugins_url( 'style.css', __FILE__ ) );
}
add_action('wp_enqueue_scripts', 'asc_enqueue_style');

//author name
function ab_get_author_id( $post_id = 0 ){
    $post = get_post( $post_id );
    $auth_id=$post->post_author;
    echo '<a href="'.get_author_posts_url(get_the_author_meta( 'ID' )).'">'.get_the_author_meta( 'user_firstname', $auth_id)." ".get_the_author_meta( 'user_lastname', $auth_id).'</a>';
}
function ab_gravatar($user){
    echo "<div class='author-gravatar'>".get_avatar($user)."</div>";
}
//author description
function ab_get_author_details($post_id=0){
    $post = get_post( $post_id );
    $auth_id=$post->post_author;
    echo get_the_author_meta( 'description', $auth_id);   
}
//page link
function ab_link_page($page){
    echo '<a href="'.get_permalink($page).'">'.the_title('', '', false).'</a><br>';
}
//link text
function ab_ext_link($link){
    echo '<a href="'.get_author_posts_url(get_the_author_meta( 'ID' )).'">'.$link.'</a><br>';
}
//archive link
function ab_show_archive(){
    echo '<a href="'.get_author_posts_url(get_the_author_meta( 'ID' )).'">'."Link to archive".'</a>';
}
function ab_get_author_list($col,$noauth,$exc){
echo $exc;    
wp_list_authors(array('number'=>$noauth,'exclude'=> $exc,'style'=>'none'));
//    switch($col){
//    case 1:echo "<span class='col-sm-12'>";
//        wp_list_authors(array('number'=>$noauth,'exclude'=> $exc ));
//        echo "</span>";
//        break;
//    case 2:echo "<span class='col-sm-6'>";
//        
//        echo "</span>";
//        break;
//    case 3:echo "<div class='col-sm-4'>";
//        wp_list_authors(array('number'=>$noauth,'exclude'=>$userid));
//        echo "</div>";
//        break;    
//    default:echo "valure out of range";
//    }
}
include 'author_bio_widget.php';
include 'author_list.php';
add_action('widgets_init',create_function('', 'return register_widget("Author_Bio");'));
add_action('widgets_init',create_function('', 'return register_widget("Author_List");'));
