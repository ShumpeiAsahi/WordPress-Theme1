<?php
add_theme_support('post-thumbnails');


register_nav_menus(
 array(
 'gloval-navigation' => 'グローバル', 
 'place_sidebar' => 'サイドメニュー',
 'footer-navigation' => 'フッター',
 )
); 

/*ウィジェット機能*/
function my_widgets_init() {

	register_sidebar( array(
		'name' => 'サイドバー',
		'id' => 'sidebar_widget01',
		'before_widget' => '<div class="container bg-white px-0 pb-3 mb-5">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="text-center py-2 mb-3 font-weight-bolder text-white bg-cyan">',
		'after_title' => '</h4>',
	) );
	register_sidebar( array(
		'name' => 'フッター About',
		'id' => 'footer_widget01',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="d-inline-block py-3 border-bottom border-info">',
		'after_title' => '</h4>',
	) );
	register_sidebar( array(
		'name' => 'フッター Twitter',
		'id' => 'footer_widget02',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="d-inline-block py-3 border-bottom border-info">',
		'after_title' => '</h4>',
	) );
}

add_action( 'widgets_init', 'my_widgets_init' );

/*画像をレスポンシブ化*/
add_filter('the_content', 'imgresponsive_replace');
function imgresponsive_replace ($content){
   global $post;
   $pattern = "/\"wp-image(.*?)\"/i";
   $replacement = 'img-fluid';
   $content = preg_replace($pattern, $replacement, $content);
   return $content;
}

// 記事IDを指定して抜粋文を取得
function ltl_get_the_excerpt($post_id){
global $post;
$post_bu = $post;
$post = get_post($post_id);
setup_postdata($post_id);
$output = get_the_excerpt();
$post = $post_bu;
return $output;
}

//ショートコード
function nlink_scode($atts) {
extract(shortcode_atts(array(
'url'=>"",
'title'=>"",
'excerpt'=>""
),$atts));

$id = url_to_postid($url);//URLから投稿IDを取得

$no_image = 'noimageに指定したい画像があればここにパス';//アイキャッチ画像がない場合の画像を指定

//タイトルを取得
if(empty($title)){
$title = esc_html(get_the_title($id));
}
//抜粋文を取得
if(empty($excerpt)){
$excerpt = esc_html(ltl_get_the_excerpt($id));
}


//アイキャッチ画像を取得
if(has_post_thumbnail($id)) {
$img = wp_get_attachment_image_src(get_post_thumbnail_id($id),'medium');
$img_tag = "<img src='" . $img[0] . "' alt='{$title}'/>";
}else{
$img_tag ='<img src="'.$no_image.'" alt="" width="'.$img_width.'" height="'.$img_height.'" />';
}

$nlink .='
<div class="blog-card">
<a href="'. $url .'">
<div class="blog-card-thumbnail">'. $img_tag .'</div>
<div class="blog-card-content">
<div class="blog-card-title">'. $title .' </div>
<div class="blog-card-excerpt">'. $excerpt .'</div>
</div>
<div class="clear"></div>
</a>
</div>';

return $nlink;
}

add_shortcode("nlink", "nlink_scode");


?>