<?php get_header(); ?>
<div class="p-contact-confirm l-contact-confirm">
<div class="p-contact-confirm__img"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/confirm_ttl.png" alt="確認画面"></div>
    <div class="p-contact-confirm__inner l-inner">
        <?php
        $url = $_SERVER['HTTP_REFERER'];
        if (strstr($url, 'family')) :
            echo do_shortcode('[mwform_formkey key="15"]');
        elseif (strstr($url, 'kyusyu')) :
            echo do_shortcode('[mwform_formkey key="13"]');
        else :
            echo do_shortcode('[mwform_formkey key="14"]');
        endif;
        ?>
    </div>
</div>
<?php get_footer();