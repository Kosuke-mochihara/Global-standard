<?php
/**
 * 管理画面からメインメニューを非表示にする
 * @return void
 */
function remove_menus()
{
	// remove_menu_page('index.php'); // ダッシュボード
	// remove_menu_page('edit.php'); // 投稿
	// remove_menu_page('edit.php?post_type=news'); //　カスタム投稿タイプnews
	// remove_menu_page('upload.php'); // メディア
	// remove_menu_page('edit.php?post_type=page'); // 固定ページ
	// remove_menu_page('edit-comments.php'); // コメント
	// remove_menu_page('themes.php'); // 外観
	// remove_menu_page('plugins.php'); // プラグイン
	// remove_menu_page('users.php'); // ユーザー
	// remove_menu_page('tools.php'); // ツール
	// remove_menu_page('options-general.php'); // 設定
}
add_action('admin_menu', 'remove_menus', 999);

/**
 * 管理画面からメインメニューを非表示にする
 * @return void
 */
function remove_sub_menus()
{
	// remove_submenu_page('index.php', 'index.php'); // ダッシュボード → ホーム
	// remove_submenu_page('index.php', 'update-core.php'); // ダッシュボード → 更新

	// remove_submenu_page('edit.php', 'edit.php'); // 投稿 → 投稿一覧
	// remove_submenu_page('edit.php', 'post-new.php'); // 投稿 → 新規追加
	// remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category'); // 投稿 → カテゴリー
	// remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag'); // 投稿 → タグ

	// remove_submenu_page('edit.php?post_type=news', 'post-new.php?post_type=news'); //カスタム投稿「news」 新規追加
	// remove_submenu_page('edit.php?post_type=news', 'edit-tags.php?taxonomy=news_cat&post_type=news'); //カスタム投稿newsのカスタムタクソノミーnews_cat

	// remove_submenu_page('upload.php', 'upload.php'); // メディア → ライブラリ
	// remove_submenu_page('upload.php', 'media-new.php'); // メディア → 新規追加

	// remove_submenu_page('edit.php?post_type=page', 'edit.php?post_type=page'); // 固定 → 固定ページ一
	// remove_submenu_page('edit.php?post_type=page', 'post-new.php?post_type=page'); // 固定 → 新規追加

	// remove_submenu_page('themes.php', 'themes.php'); // 外観 → テーマ
	// remove_submenu_page('themes.php', 'customize.php?return=' . rawurlencode($_SERVER['REQUEST_URI'])); // 外観 → カスタマイズ
	// remove_submenu_page('themes.php', 'nav-menus.php'); // 外観 → メニュー
	// remove_submenu_page('themes.php', 'widgets.php'); // 外観 → ウィジェット
	// remove_submenu_page('themes.php', 'theme-editor.php'); // 外観 → テーマエディタ

	// remove_submenu_page('plugins.php', 'plugins.php'); // プラグイン → インストール済みプラグイン
	// remove_submenu_page('plugins.php', 'plugin-install.php'); // プラグイン → 新規追加
	// remove_submenu_page('plugins.php', 'plugin-editor.php'); // プラグイン → プラグインエディタ

	// remove_submenu_page('users.php', 'users.php'); // ユーザー → ユーザー一覧
	// remove_submenu_page('users.php', 'user-new.php'); // ユーザー → 新規追加
	// remove_submenu_page('users.php', 'profile.php'); // ユーザー → あなたのプロフィール

	// remove_submenu_page('tools.php', 'tools.php'); // ツール → 利用可能なツール
	// remove_submenu_page('tools.php', 'import.php'); // ツール → インポート
	// remove_submenu_page('tools.php', 'export.php'); // ツール → エクスポート
	// remove_submenu_page('tools.php', 'site-health.php'); // ツール → サイトヘルス
	// remove_submenu_page('tools.php', 'export-personal-data.php'); // ツール → 個人データのエクスポート
	// remove_submenu_page('tools.php', 'erase-personal-data.php'); // ツール → 個人データの消去

	// remove_submenu_page('options-general.php', 'options-general.php'); // 設定 → 一般
	// remove_submenu_page('options-general.php', 'options-writing.php'); // 設定 → 投稿設定
	// remove_submenu_page('options-general.php', 'options-reading.php'); // 設定 → 表示設定
	// remove_submenu_page('options-general.php', 'options-discussion.php'); // 設定 → ディスカッション
	// remove_submenu_page('options-general.php', 'options-media.php'); // 設定 → メディア
	// remove_submenu_page('options-general.php', 'options-permalink.php'); // 設定 → パーマリンク
	// remove_submenu_page('options-general.php', 'privacy.php'); // 設定 → プライバシー
}
add_action('admin_menu', 'remove_sub_menus', 999);

/**
 * 管理画面からプラグインメニューを非表示にする
 * @return void
 */
function remove_plugins_menus()
{
	// remove_menu_page('wpcf7'); // Contact Form 7
	// remove_menu_page('cptui_main_menu'); // Custom Post Type UI
}
add_action('admin_menu', 'remove_plugins_menus');

/**
 * 管理画面からアドミンバーのメニューを非表示にする
 * @param WP_Admin_Bar $wp_admin_bar
 * @return void
 */
function remove_admin_bar_menus($wp_admin_bar)
{
	// $wp_admin_bar->remove_menu('wp-logo'); // ロゴ
	// $wp_admin_bar->remove_menu('about'); // ロゴ → WordPressについて
	// $wp_admin_bar->remove_menu('wporg'); // ロゴ → WordPress.org
	// $wp_admin_bar->remove_menu('documentation'); // ロゴ → ドキュメンテーション
	// $wp_admin_bar->remove_menu('support-forums'); // ロゴ → サポート
	// $wp_admin_bar->remove_menu('feedback'); // ロゴ → フィードバック
	// $wp_admin_bar->remove_menu('site-name'); // サイト名
	// $wp_admin_bar->remove_menu('comments'); // コメント
	// $wp_admin_bar->remove_menu('new-content'); // 新規
	// $wp_admin_bar->remove_menu('new-post'); // 新規 → 投稿
	// $wp_admin_bar->remove_menu('new-media'); // 新規 → メディア
	// $wp_admin_bar->remove_menu('new-page'); // 新規 → 固定
	// $wp_admin_bar->remove_menu('new-user'); // 新規 → ユーザー
	// $wp_admin_bar->remove_menu('customize'); // カスタマイズ
	// $wp_admin_bar->remove_menu('edit'); // 固定ページを編集
	// $wp_admin_bar->remove_menu('my-account'); //こんにちは、[ユーザー名]さん
	// $wp_admin_bar->remove_menu('user-info'); // ユーザー → [ユーザー名]
	// $wp_admin_bar->remove_menu('edit-profile'); //ユーザー → プロフィールを編集
	// $wp_admin_bar->remove_menu('logout'); //ユーザー → ログアウト
	// $wp_admin_bar->remove_menu('search'); //検索
}
add_action('admin_bar_menu', 'remove_admin_bar_menus', 999);
