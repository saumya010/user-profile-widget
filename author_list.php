<?php
class Author_List extends WP_Widget {
	// Controller
	function __construct() {
	$widget_ops = array('classname' => 'author_list', 'description' => __('Displays author list'));
	$control_ops = array('width' => 300, 'height' => 300);
	parent::WP_Widget(false, $name = __('Author List'), $widget_ops, $control_ops );

        }

function form($instance) { 
	$defaults=array('title' => __('Author List'),'exc'=>__('hello'),'col'=>__('1'),'noauth'=>__('50'));
	$instance = wp_parse_args( (array) $instance, $defaults ); 

	if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
	else {
			$title =$defaults['title'];
		}
         if ( isset( $instance[ 'col' ] ) ) {
			$col= $instance[ 'col' ];
		}
	else {
			$col=$defaults['col'];
		}
        if ( isset( $instance[ 'noauth' ] ) ) {
			$noauth= $instance[ 'noauth' ];
		}
	else {
			$noauth=$defaults['noauth'];
		}
        if ( isset( $instance[ 'exc' ] ) ) {
			$exc= $instance[ 'exc' ];
		}
	else {
			$exc=$defaults['exc'];
		}?>
	<p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'wp_widget_plugin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	</p>
        <p>            
            <label for="<?php echo $this->get_field_id('exc'); ?>"><?php _e('Exclude the user', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('exc'); ?>" name="<?php echo $this->get_field_name('exc'); ?>" type="text" value="<?php echo esc_attr($exc); ?>" />
        </p>

        <p>            
            <label for="<?php echo $this->get_field_id('col'); ?>"><?php _e('No of column:', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('col'); ?>" name="<?php echo $this->get_field_name('col'); ?>" type="number" max="3" min="1" value="<?php echo $col;?>" >
        </p>
        <p>                
            <label for="<?php echo $this->get_field_id('noauth'); ?>"><?php _e('No of author:', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('noauth'); ?>" name="<?php echo $this->get_field_name('noauth'); ?>" type="number" value="<?php echo $noauth;?>" >        
        </p>
        
<?php }
function update($new_instance,$old_instance){
    $instance = $old_instance;
    $instance['title'] = strip_tags( $new_instance['title'] );
    $instance['exc'] = strip_tags( $new_instance['exc'] );
    $instance['col']=strip_tags($new_instance['col']);
    $instance['noauth']=strip_tags($new_instance['noauth']);   
    return $instance;
}

function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);
        // Display the widget title
        echo "<div class='auth-wid widget'>";
            if ( $title ){
                echo "<h3 class='widget-title'>".$title."</h3>";
            }              
            ab_get_author_list($instance['col'],$instance['noauth'],$instance['exc']);	
            echo "</div>";
}
}
