<?php
/**
* @package post-publish-count
* @version 1.4
*/
/*
Plugin Name:post-publish-count
Plugin URI:
Description: WordPressの公開済みの投稿件数をカウントして表示します。
Author: Yukinobu Asakawa
Version: 1.4
Author URI:https://easytouse.jp/
License:GPLv2
*/

//公開済みの投稿件数をカウントして出力する。
function post_publish_count_plugin(){
$publish_count_posts = wp_count_posts();
$publish_posts = $publish_count_posts->publish;
echo '<p>現在の記事数は'.$publish_posts.'件です。</p>';
}

//管理画面に表示する。
add_action('admin_notices', 'post_publish_count_plugin');

//ウェイジェットに表示する。
class publish_count_widget extends WP_Widget {
function __construct() {
	parent::__construct(false, '公開済みの投稿数表示');
	}

	//公開側での表示するための処理
	function widget($args, $instance) {
    post_publish_count_plugin();
	}

	function update($new_instance, $old_instance) {}

	function form($instance) {}
	}
//ウィジェットを登録する。
add_action('widgets_init', create_function('', 'return register_widget("publish_count_widget");'));
?>
