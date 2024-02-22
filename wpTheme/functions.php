<?php
// 別の管理ファイルを読み込む
require(get_theme_file_path('/inc/admin_menu.php'));

function my_setup()
{
	add_theme_support('post-thumbnails'); // アイキャッチ画像を有効化
	add_theme_support('automatic-feed-links'); // 投稿とコメントのRSSフィードのリンクを有効化
	add_theme_support('title-tag'); // タイトルタグ自動生成
	add_theme_support(
		'html5',
		array( // HTML5でマークアップ
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);
}
add_action('after_setup_theme', 'my_setup');

/**
 * CSSとJavaScriptの読み込み
 */
function my_script_init()
{ // WordPress提供のjquery.jsを読み込まない
	wp_deregister_script('jquery');
	wp_deregister_script('jquery');
	// テーマのJavaScript
	wp_enqueue_script('theme-js', get_theme_file_uri('/assets/js/script.js'), array(), filemtime(get_theme_file_path('/assets/js/script.js')), true);
	// テーマのCSS
	wp_enqueue_style('theme-css', get_theme_file_uri('/assets/css/style.css'), array(), filemtime(get_theme_file_path('/assets/css/style.css')));
	// jQueryの読み込み
	// wp_enqueue_script('jquery', '//code.jquery.com/jquery-3.6.1.min.js', "", "1.0.1", true);
	// Google Fonts(2つ以上ある場合は1つずつ書く)
	// wp_enqueue_style('NotoSans', '//fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500&display=swap');
	// wp_enqueue_style('Lexend', '//fonts.googleapis.com/css2?family=Lexend+Deca:wght@400;500&display=swap');
	// google maps
	// wp_enqueue_script('map', '//maps.googleapis.com/maps/api/js?key=APIキーを入れます', "", "1.0.1", false);
}
add_action('wp_enqueue_scripts', 'my_script_init');
//記事表示時の整形無効
remove_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');
// ビジュアルエディタ(TinyMCE)の整形無効
add_filter(
	'tiny_mce_before_init',
	function ($init_array) {
		global $allowedposttags;
		$init_array['valid_elements']          = '*[*]';
		$init_array['extended_valid_elements'] = '*[*]';
		$init_array['valid_children']          = '+a[' . implode('|', array_keys($allowedposttags)) . ']';
		$init_array['indent']                  = true;
		$init_array['wpautop']                 = false;
		$init_array['force_p_newlines']        = false;
		return $init_array;
	}
);

/**
 * 投稿名の変更
 */
function Change_menulabel()
{
	global $menu;
	global $submenu;
	$name = 'ブログ';
	$menu[5][0] = $name;
	$submenu['edit.php'][5][0] = $name . '一覧';
	$submenu['edit.php'][10][0] = '新しい' . $name;
}
function Change_objectlabel()
{
	global $wp_post_types;
	$name = '変更名を入力';
	$labels = &$wp_post_types['post']->labels;
	$labels->name = $name;
	$labels->singular_name = $name;
	$labels->add_new = _x('追加', $name);
	$labels->add_new_item = $name . 'の新規追加';
	$labels->edit_item = $name . 'の編集';
	$labels->new_item = '新規' . $name;
	$labels->view_item = $name . 'を表示';
	$labels->search_items = $name . 'を検索';
	$labels->not_found = $name . 'が見つかりませんでした';
	$labels->not_found_in_trash = 'ゴミ箱に' . $name . 'は見つかりませんでした';
}
add_action('init', 'Change_objectlabel');
add_action('admin_menu', 'Change_menulabel');

/**
 * 投稿ページのパーマリンクカスタマイズ
 */
function add_article_post_permalink($permalink)
{
	$permalink = '/blog' . $permalink;
	return $permalink;
}
add_filter('pre_post_link', 'add_article_post_permalink');

/**
 * 投稿ページのパーマリンクのカスタマイズ
 * @param array $post_rewrite
 * @return array
 */
function add_article_post_rewrite_rules($post_rewrite)
{
	$return_rule = array();
	foreach ($post_rewrite as $regex => $rewrite) {
		$return_rule['blog/' . $regex] = $rewrite;
	}
	return $return_rule;
}
add_filter('post_rewrite_rules', 'add_article_post_rewrite_rules');
