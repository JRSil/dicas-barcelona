<?php
global $post;

// pin button shape
$button_shape = isset($attr['shape']) ? $attr['shape']: 'rectangular'; //round or rectangular
// small or large
$button_size = isset($attr['size']) ? $attr['size'] : 'large'; // small or large
$data_pin_save='true';

$post_title = $post->post_title;
$post_url   = get_permalink(); //$this->curPageURL();

$save_pin_type = isset($attr['type']) ? $attr['type'] : 'any-image'; //one-image or any-image
if ($save_pin_type == "one-image"){
	$url = isset($attr['save_url']) ? $attr['save_url'] : $post_url;
	$pin_image =  isset($attr['save_image']) ? $attr['save_image'] : '';
	$image_description = isset($attr['image_description']) ? $attr['image_description'] : $post_title;
	
	$data_pin_count= isset($attr['count_position']) ? $attr['count_position'] : '';
	$href="https://www.pinterest.com/pin/create/button/?url=$url&media=$pin_image&description=$image_description";
	$data_pin_do = "buttonPin";
?>

<a data-pin-do="<?php echo $data_pin_do; ?>" <?php if($button_shape=='round'){ ?>  data-pin-round="true" data-pin-save="false" <?php } ?> <?php if($button_size == 'large'){ ?> data-pin-tall="true" <?php } ?> <?php if($data_pin_count=='beside' || $data_pin_count=='above' ){ ?> data-pin-count="<?php echo $data_pin_count; ?>" <?php } ?>  data-pin-save="<?php echo $data_pin_save; ?>" href="<?php echo $href; ?>"></a>
<?php
}else if($save_pin_type == "any-image"){
	$href="https://www.pinterest.com/pin/create/button/";
	$data_pin_do = "buttonBookmark";
	?>
<a data-pin-do="<?php echo $data_pin_do; ?>" <?php if($button_shape=='round'){ ?>  data-pin-round="true" data-pin-save="false" <?php }else{ ?> data-pin-save="true" <?php } ?> <?php if($button_size == 'large'){ ?> data-pin-tall="true" <?php } ?> href="<?php echo $href; ?>"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_round_red_16.png" /></a>
<?php } ?>
