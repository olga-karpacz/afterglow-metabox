<?php
/*
Plugin Name: Afterglow Metabox
Description: Plugin adding simple metabox
Version: 1.0
Author: Studio Afterglow
Author URI: https://studioafterglow.pl/
*/ 

/* ADDING METABOX */

function afterglow_metabox() {
    $screens = [ 'post', 'page'];
    foreach ( $screens as $screen ) {
        add_meta_box(
            'afterglow_metabox', //unique name
            'Nowy metabox', //title of metabox, name visible for user
            'afterglow_metabox_html',  //function with metabox content
            $screen, //type of post
            'side' //metabox location
        );
    }
}

add_action( 'add_meta_boxes', 'afterglow_metabox' );

/* METABOX CONTENT */

function afterglow_metabox_html( $post ) {
    $text= get_post_meta( $post->ID, 'afterglow_text', true );
?>
<label class="howto" for="afterglow_text">Pole tekstowe</label>
<input type="text" id="afterglow_text" name="afterglow_text" value="<?php echo $text?>">
<br>
<label for="afterglow_check" class="selectit"><input type="checkbox" value="1" name="afterglow_check"<?php checked(1, get_post_meta($post->ID,'afterglow_check',true), true); ?>/>Chcesz zaznaczyć?</label>
<br>
<?php 
}

/* SAVING CUSTOM FIELDS VALUER */

function afterglow_metabox_save_postdata( $post_id ) {
    if ( array_key_exists( 'afterglow_text', $_POST ) ) {
        update_post_meta(
            $post_id,
            'afterglow_text',
            $_POST['afterglow_text']
        );
    }
    
    if ( array_key_exists( 'afterglow_check', $_POST ) ) {
        update_post_meta(
            $post_id,
            'afterglow_check',
            $_POST['afterglow_check']
        );
    }
    else{
        delete_post_meta($post_id, 'afterglow_check');
    }
}

add_action( 'save_post', 'afterglow_metabox_save_postdata' );

?>