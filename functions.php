<?php

/**
 * Functions
 */

/**
 * WordPress標準機能
 *
 * @codex https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/add_theme_support
 */
function my_setup()
{
	add_theme_support('post-thumbnails'); /* アイキャッチ */
	add_theme_support('automatic-feed-links'); /* RSSフィード */
	add_theme_support('title-tag'); /* タイトルタグ自動生成 */
	add_theme_support(
		'html5',
		array( /* HTML5のタグで出力 */
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);
}
add_action('after_setup_theme', 'my_setup');


function Change_menulabel()
{
	global $menu;
	global $submenu;
	$name = 'お知らせ';
	$menu[5][0] = $name;
	$submenu['edit.php'][5][0] = $name . '一覧';
	$submenu['edit.php'][10][0] = '新しい' . $name;
}
function Change_objectlabel()
{
	global $wp_post_types;
	$name = 'お知らせ';
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
//add_action('init', 'Change_objectlabel');
//add_action('admin_menu', 'Change_menulabel');

/**
 * CSSとJavaScriptの読み込み
 *
 * @codex https://wpdocs.osdn.jp/%E3%83%8A%E3%83%93%E3%82%B2%E3%83%BC%E3%82%B7%E3%83%A7%E3%83%B3%E3%83%A1%E3%83%8B%E3%83%A5%E3%83%BC
 */
function my_script_init()
{
	wp_enqueue_style('swiper', get_template_directory_uri() . '/assets/css/swiper.min.css', array(), '1.0.1', 'all');
	wp_enqueue_style('my', get_template_directory_uri() . '/assets/css/styles.css', array(), '1.0.1', 'all');

	wp_enqueue_script('swiper', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array('jquery'), '1.0.1', true);
	wp_enqueue_script('my', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), '1.0.1', true);
}
add_action('wp_enqueue_scripts', 'my_script_init');




/**
 * メニューの登録
 *
 * @codex https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/register_nav_menus
 */
// function my_menu_init() {
// 	register_nav_menus(
// 		array(
// 			'global'  => 'ヘッダーメニュー',
// 			'utility' => 'ユーティリティメニュー',
// 			'drawer'  => 'ドロワーメニュー',
// 		)
// 	);
// }
// add_action( 'init', 'my_menu_init' );
/**
 * メニューの登録
 *
 * 参考：https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/register_nav_menus
 */


/**
 * ウィジェットの登録
 *
 * @codex http://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/register_sidebar
 */
// function my_widget_init() {
// 	register_sidebar(
// 		array(
// 			'name'          => 'サイドバー',
// 			'id'            => 'sidebar',
// 			'before_widget' => '<div id="%1$s" class="p-widget %2$s">',
// 			'after_widget'  => '</div>',
// 			'before_title'  => '<div class="p-widget__title">',
// 			'after_title'   => '</div>',
// 		)
// 	);
// }
// add_action( 'widgets_init', 'my_widget_init' );


/**
 * アーカイブタイトル書き換え
 *
 * @param string $title 書き換え前のタイトル.
 * @return string $title 書き換え後のタイトル.
 */
function my_archive_title($title)
{

	if (is_home()) { /* ホームの場合 */
		$title = 'ブログ';
	} elseif (is_category()) { /* カテゴリーアーカイブの場合 */
		$title = '' . single_cat_title('', false) . '';
	} elseif (is_tag()) { /* タグアーカイブの場合 */
		$title = '' . single_tag_title('', false) . '';
	} elseif (is_post_type_archive()) { /* 投稿タイプのアーカイブの場合 */
		$title = '' . post_type_archive_title('', false) . '';
	} elseif (is_tax()) { /* タームアーカイブの場合 */
		$title = '' . single_term_title('', false);
	} elseif (is_search()) { /* 検索結果アーカイブの場合 */
		$title = '「' . esc_html(get_query_var('s')) . '」の検索結果';
	} elseif (is_author()) { /* 作者アーカイブの場合 */
		$title = '' . get_the_author() . '';
	} elseif (is_date()) { /* 日付アーカイブの場合 */
		$title = '';
		if (get_query_var('year')) {
			$title .= get_query_var('year') . '年';
		}
		if (get_query_var('monthnum')) {
			$title .= get_query_var('monthnum') . '月';
		}
		if (get_query_var('day')) {
			$title .= get_query_var('day') . '日';
		}
	}
	return $title;
};
add_filter('get_the_archive_title', 'my_archive_title');


/**
 * 抜粋文の文字数の変更
 *
 * @param int $length 変更前の文字数.
 * @return int $length 変更後の文字数.
 */
function my_excerpt_length($length)
{
	return 80;
}
add_filter('excerpt_length', 'my_excerpt_length', 999);


/**
 * 抜粋文の省略記法の変更
 *
 * @param string $more 変更前の省略記法.
 * @return string $more 変更後の省略記法.
 */
function my_excerpt_more($more)
{
	return '...';
}
add_filter('excerpt_more', 'my_excerpt_more');


//知人の紹介チェック時の必須振り分け
function add_mwform_validation_rule($Validation, $data)
{
	if (isset($data['check-name']['data']) && is_array($data['check-name']['data'])) {
		if (in_array('知人の紹介', $data['check-name']['data'])) {
			$Validation->set_rule('text_req', 'noEmpty', array('message' => '未入力です。'));
		}
	}
	return $Validation;
}
add_filter('mwform_validation_mw-wp-form-13', 'add_mwform_validation_rule', 10, 2);
add_filter('mwform_validation_mw-wp-form-14', 'add_mwform_validation_rule', 10, 2);
add_filter('mwform_validation_mw-wp-form-15', 'add_mwform_validation_rule', 10, 2);

//タグ挿入無効
function mvwpform_autop_filter()
{
	if (class_exists('MW_WP_Form_Admin')) {
		$mw_wp_form_admin = new MW_WP_Form_Admin();
		$forms = $mw_wp_form_admin->get_forms();
		foreach ($forms as $form) {
			add_filter('mwform_content_wpautop_mw-wp-form-' . $form->ID, '__return_false');
		}
	}
}
mvwpform_autop_filter();


//全国、パパママ婚用メールアドレス振り分け
function autoback_my_mail_common($Mail_raw, $values, $Data)
{
	if ($Data->get('radio-name') == 'ガーデンテラス東山') {
		$Mail_raw->to = 'miura@bellco.co.jp,garden-terrace@gt-higashiyama.jp';
		$Mail_raw->cc = 'ebisawa@hershe.co.jp,mayu@hershe.co.jp,higa_sa@hershe.jp,morito@hershe.co.jp';
	} else if ($Data->get('radio-name') == 'アールベルアンジェ四日市') {
		$Mail_raw->to = 'miura@bellco.co.jp,ueda@bellclassic.co.jp,yokkaichi@bellclassic.co.jp';
		$Mail_raw->cc = 'ebisawa@hershe.co.jp,mayu@hershe.co.jp,higa_sa@hershe.jp,morito@hershe.co.jp';
	} else if ($Data->get('radio-name') == 'ベルクラシック神戸') {
		$Mail_raw->to = 'miura@bellco.co.jp,kobe@bellclassic.co.jp,shimonaka@bellclassic.co.jp';
		$Mail_raw->cc = 'ebisawa@hershe.co.jp,mayu@hershe.co.jp,higa_sa@hershe.jp,morito@hershe.co.jp';
	} else if ($Data->get('radio-name') == 'ベルクラシック姫路') {
		$Mail_raw->to = 'miura@bellco.co.jp,yamamoto@bellclassic.co.jp,kondo@bellclassic.co.jp,himeji@bellclassic.co.jp';
		$Mail_raw->cc = 'ebisawa@hershe.co.jp,mayu@hershe.co.jp,higa_sa@hershe.jp,morito@hershe.co.jp';
	} else if ($Data->get('radio-name') == 'ザ・ロイヤルクラシック姫路') {
		$Mail_raw->to = 'miura@bellco.co.jp,kondo@bellclassic.co.jp,royal-himeji@bellclassic.co.jp';
		$Mail_raw->cc = 'ebisawa@hershe.co.jp,mayu@hershe.co.jp,higa_sa@hershe.jp,morito@hershe.co.jp';
	} else if ($Data->get('radio-name') == 'アール・ベル・アンジェ奈良') {
		$Mail_raw->to = 'miura@bellco.co.jp,nara@bellclassic.co.jp,honjo@bellclassic.co.jp';
		$Mail_raw->cc = 'ebisawa@hershe.co.jp,mayu@hershe.co.jp,higa_sa@hershe.jp,morito@hershe.co.jp';
	} else if ($Data->get('radio-name') == 'アール・ベル・アンジェ チャペル嵯峨野') {
		$Mail_raw->to = 'miura@bellco.co.jp,sagano@bellclassic.co.jp,ozaki@bellclassic.co.jp';
		$Mail_raw->cc = 'ebisawa@hershe.co.jp,mayu@hershe.co.jp,higa_sa@hershe.jp,morito@hershe.co.jp';
	} else if ($Data->get('radio-name') == 'ベルクラシック空港') {
		$Mail_raw->to = 'miura@bellco.co.jp,kamiryo@bellclassic.co.jp,kuko@bellclassic.co.jp';
		$Mail_raw->cc = 'ebisawa@hershe.co.jp,mayu@hershe.co.jp,higa_sa@hershe.jp,morito@hershe.co.jp';
	} else if ($Data->get('radio-name') == 'アール・ベル・アンジェ堺') {
		$Mail_raw->to = 'miura@bellco.co.jp,urakami@bellclassic.co.jp,sakai@bellclassic.co.jp';
		$Mail_raw->cc = 'ebisawa@hershe.co.jp,mayu@hershe.co.jp,higa_sa@hershe.jp,morito@hershe.co.jp';
	} else if ($Data->get('radio-name') == 'ベルクラシック大阪') {
		$Mail_raw->to = 'miura@bellco.co.jp,osaka@bellclassic.co.jp,tanioka@bellclassic.co.jp';
		$Mail_raw->cc = 'ebisawa@hershe.co.jp,mayu@hershe.co.jp,higa_sa@hershe.jp,morito@hershe.co.jp';
	}
	return $Mail_raw;

}
add_filter('mwform_admin_mail_mw-wp-form-15', 'autoback_my_mail_common', 10, 3);


//九州婚用メールアドレス振り分け　
function autoback_my_mail_kyusyu($Mail_raw, $values, $Data)
{
	if ($Data->get('radio-name') == 'ベルクラシック小倉') {
		$Mail_raw->to = 'miura@bellco.co.jp,okino@bellclassic.co.jp,kokura@bellclassic.co.jp';
		$Mail_raw->cc = 'ebisawa@hershe.co.jp,mayu@hershe.co.jp,higa_sa@hershe.jp,morito@hershe.co.jp';
	} else if ($Data->get('radio-name') == 'マリアージュ下関') {
		$Mail_raw->to = 'miura@bellco.co.jp,aida@bellclassic.co.jp,shimonoseki@bellclassic.co.jp';
		$Mail_raw->cc = 'ebisawa@hershe.co.jp,mayu@hershe.co.jp,higa_sa@hershe.jp,morito@hershe.co.jp';
	} else if ($Data->get('radio-name') == 'アール・ベル・アンジェ山口') {
		$Mail_raw->to = 'miura@bellco.co.jp,hirai@bellclassic.co.jp,yamaguchi@bellclassic.co.jp';
		$Mail_raw->cc = 'ebisawa@hershe.co.jp,mayu@hershe.co.jp,higa_sa@hershe.jp,morito@hershe.co.jp';
	} else if ($Data->get('radio-name') == 'ベルクラシック防府') {
		$Mail_raw->to = 'miura@bellco.co.jp,okamura@bellclassic.co.jp,hofu@bellclassic.co.jp';
		$Mail_raw->cc = 'ebisawa@hershe.co.jp,mayu@hershe.co.jp,higa_sa@hershe.jp,morito@hershe.co.jp';
	}
	return $Mail_raw;
}
add_filter('mwform_admin_mail_mw-wp-form-13', 'autoback_my_mail_kyusyu', 10, 3);


//北海道婚用メールアドレス振り分け　
function autoback_my_mail_hokkaido($Mail_raw, $values, $Data)
{
	if ($Data->get('radio-name') == 'アール・ベル・アンジェ室蘭') {
		$Mail_raw->to = 'miura@bellco.co.jp,maeda@bellclassic.co.jp,muroran@bellclassic.co.jp';
		$Mail_raw->cc = 'ebisawa@hershe.co.jp,mayu@hershe.co.jp,higa_sa@hershe.jp,morito@hershe.co.jp';
	} else if ($Data->get('radio-name') == 'ベルクラシック函館') {
		$Mail_raw->to = 'miura@bellco.co.jp,sato@bellclassic.co.jp,hakodate@bellclassic.co.jp';
		$Mail_raw->cc = 'ebisawa@hershe.co.jp,mayu@hershe.co.jp,higa_sa@hershe.jp,morito@hershe.co.jp';
	} else if ($Data->get('radio-name') == 'アールベルアンジェ苫小牧') {
		$Mail_raw->to = 'miura@bellco.co.jp,hatanaka@bellclassic.co.jp,whitepark@tea.ocn.ne.jp,tomakomai@bellclassic.co.jp';
		$Mail_raw->cc = 'ebisawa@hershe.co.jp,mayu@hershe.co.jp,higa_sa@hershe.jp,morito@hershe.co.jp';
	} else if ($Data->get('radio-name') == 'アールベルアンジェ札幌') {
		$Mail_raw->to = 'miura@bellco.co.jp,mogi@bellclassic.co.jp';
		$Mail_raw->cc = 'ebisawa@hershe.co.jp,mayu@hershe.co.jp,higa_sa@hershe.jp,morito@hershe.co.jp';
	}
	return $Mail_raw;
}
add_filter('mwform_admin_mail_mw-wp-form-14', 'autoback_my_mail_hokkaido', 10, 3);


function my_mail( $mail_raw, $values, $data ) {
	if ( empty( $values['text_req'] ) ) {
		$mail_raw->body = str_replace( '紹介者のお名前：{text_req}'."\r\n", '', $mail_raw->body );
	}
	return $mail_raw;
}

add_filter( 'mwform_auto_mail_raw_mw-wp-form-13', 'my_mail', 10, 3 );
add_filter( 'mwform_admin_mail_raw_mw-wp-form-13', 'my_mail', 10, 3 );
add_filter( 'mwform_auto_mail_raw_mw-wp-form-14', 'my_mail', 10, 3 );
add_filter( 'mwform_admin_mail_raw_mw-wp-form-14', 'my_mail', 10, 3 );
add_filter( 'mwform_auto_mail_raw_mw-wp-form-15', 'my_mail', 10, 3 );
add_filter( 'mwform_admin_mail_raw_mw-wp-form-15', 'my_mail', 10, 3 );
