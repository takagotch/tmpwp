<?php
// 管理画面用のブートストラップをロードする
require_once( dirname( __FILE__ ) . '/admin.php' );

// ページのタイトルを設定する
$title = 'sample';

// 管理画面用のヘッダーをロードする
include( ABSPATH . 'wp-admin/admin-header.php' );

// ページコンテンツの記述
?>
  <h1>Sample Admin Content</h1>
<?php
// 管理画面用のフッターをロードする
include( ABSPATH . 'wp-admin/admin-footer.php' );

