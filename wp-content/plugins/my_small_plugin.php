<?php
/**
* Plugin Name: My Small Plugin
*/

class My_Small_Plugin {

	// コンストラクタ
	function __construct() {
		// wpアクションフックのコールバックに優先順位10でmy_wpメソッドを追加
		add_action( 'wp', array( $this, 'my_wp' ), 10 );
	}

	function my_wp() {
		// IDが1の個別の投稿ページのとき
		if ( is_single( 1 ) ) {
			// the_titleフィルターフックにmy_titleメソッドを優先順位10で追加
			add_filter( 'the_title', array( $this, 'my_title' ), 10 );
		}
	}

	function my_title( $title ) {
		$title = '- ' . $title . ' -';
		return $title;
	}

} // class end

// インスタンスの生成とコンストラクタの実行
new My_Small_Plugin();

