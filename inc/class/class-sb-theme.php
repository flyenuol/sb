<?php
class SB_Theme {
	public static function header() {
		include SB_TEMPLATE_PATH . "/template-theme-header.php";
	}
	
	public static function footer() {
		include SB_TEMPLATE_PATH . "/template-theme-footer.php";
	}
	
	public static function logo() {
		include SB_TEMPLATE_PATH . "/template-theme-logo.php";
	}
	
	public static function title() {
		if(is_home()) {
			echo get_bloginfo('name') . ' - ' . get_bloginfo('description');
		} elseif(is_post_type_archive('product')) {
			echo 'Danh sách sản phẩm';
		} elseif(is_tax()) {
			single_term_title();
		} else {
			wp_title('');
		}
	}

    public static function breadcrumb() {
        if ( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb('<div class="breadcrumb">', '</div>');
        }
    }

    public static function open_center() {
        echo '<div class="wrap container-fluid"><div class="row">';
    }

    public static function close_center() {
        echo '</div></div>';
    }

    public static function menu($args = null) {
        $defaults = array(
            'theme_location'	=> '',
            'menu_class'		=> ''
        );
        $args = wp_parse_args($args, $defaults);
        extract($args, EXTR_SKIP);
        $menu_class .= ' sf-menu '.$theme_location;
        $menu_class = trim($menu_class);
        wp_nav_menu(array('theme_location' => $theme_location, 'menu_class' => $menu_class));
    }

    public static function head_title_bar($title) {
        ?>
        <div class="page-head-bar">
            <div class="page-head-inner">
                <span class="page-head-title"><?php echo $title; ?></span>
            </div>
        </div>
    <?php
    }

    public static function spinner_loading_full() {
        ?>
        <div class="spinner-loading-full spinner">
            <div id="circularG">
                <div id="circularG_1" class="circularG"></div>
                <div id="circularG_2" class="circularG"></div>
                <div id="circularG_3" class="circularG"></div>
                <div id="circularG_4" class="circularG"></div>
                <div id="circularG_5" class="circularG"></div>
                <div id="circularG_6" class="circularG"></div>
                <div id="circularG_7" class="circularG"></div>
                <div id="circularG_8" class="circularG"></div>
            </div>
        </div>
    <?php
    }

    public static function search_form($args = array()) {
        $defaults = array(
            'label_text'		=> 'Tìm kiếm:',
            'placeholder_text'	=> 'Nhập từ khóa...',
            'submit_text'		=> 'Tìm kiếm',
            'form_class'		=> ''
        );
        $args = wp_parse_args($args, $defaults);
        extract($args, EXTR_SKIP);
        $form_class = trim($form_class.' search-form');
        ?>
        <form role="search" method="get" class="<?php echo $form_class; ?>" action="<?php echo esc_url(home_url('/')); ?>">
            <label>
                <span class="screen-reader-text"><?php echo $label_text; ?></span>
                <input type="search" class="search-field" placeholder="<?php echo $placeholder_text; ?>" value="" name="s">
            </label>
            <input type="submit" class="search-submit" value="<?php echo $submit_text; ?>">
        </form>
    <?php
    }

    public static function feed_form($args = array()) {
        self::feedburner_form($args);
    }

    public static function feedburner_form($args = array()) {
        $defaults = array(
            'name'				=> '',
            'label_text'		=> 'Nhập địa chỉ email:',
            'placeholder_text'	=> 'Nhập email...',
            'submit_text'		=> 'Gửi',
            'form_class'		=> ''
        );
        $args = wp_parse_args($args, $defaults);
        extract($args, EXTR_SKIP);
        $form_class = trim($form_class.' feed-form');
        do_action('sbwp_before_feed_form');
        ?>
        <form class="<?php echo $form_class; ?>" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $name; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
            <?php do_action('sbwp_inside_feed_form'); ?>
            <p class="email-line">
                <label for="email"><?php echo $label_text; ?></label>
                <input class="feed-email" placeholder="<?php echo $placeholder_text; ?>" type="email" name="email"/>
            </p>
            <input type="hidden" value="<?php echo $name; ?>" name="uri"/>
            <input type="hidden" name="loc" value="en_US"/>
            <p class="submit-line">
                <input type="submit" value="<?php echo $submit_text; ?>" />
            </p>
        </form>
        <?php
        do_action('sbwp_after_feed_form');
    }
	
	public static function created_by() {
		echo 'Giao diện được tạo bởi <a href="http://sauhi.com">SB Team</a>';
	}
	
	public static function author_box() {
		$author = new SB_Author();
		$description = $author->get_description();
		if(!empty($description)) :
	?>
		<div class="author-wrap">
			<div class="author-gravatar">
				<?php echo $author->get_avatar( 100 ); ?>
			</div>
			<div class="author-info">
				<div class="vcard author author-title">
					<span class="fn">
						<a target="_blank" class="ext-link" href="<?php echo $author->get_url(); ?>" title="Ghé thăm website của <?php echo $author->get_username(); ?>" rel="author external nofollow"><?php echo $author->get_display_name(); ?></a>
					</span>
				</div>
				<div class="author-description"><?php echo $description; ?></div>
				<ul>
					<li class="first">
						<a href="<?php echo $author->get_post_url(); ?>">Xem tất cả bài viết của <?php echo $author->get_username(); ?> <span class="meta-nav">→</span></a>
					</li>
					<li class="website">
						<a target="_blank" class="ext-link" rel="external nofollow" href="<?php echo $author->get_url(); ?>" title="Ghé thăm trang chủ của <?php echo $author->get_username(); ?>">Blog</a>
					</li>

					<li class="facebook">
						<a target="_blank" class="ext-link" href="<?php echo $author->get_facebook_url(); ?>" title="Theo dõi <?php echo $author->get_username(); ?> trên Facebook" rel="external nofollow">Facebook</a>
					</li>
					<li class="googleplus">
						<a target="_blank" class="ext-link" href="<?php echo $author->get_gplus_url(); ?>" title="Theo dõi <?php echo $author->get_username(); ?> trên Goolge Plus" rel="external nofollow">Google Plus</a>
					</li>
					<li class="twitter"><a rel="external" title="Theo dõi <?php echo $author->get_username(); ?> trên Twitter" href="<?php echo $author->get_twitter_url(); ?>">Twitter</a></li>
				</ul>
			</div>
		</div>
	<?php
		endif;
	}
}
?>