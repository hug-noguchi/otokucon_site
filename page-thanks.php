<?php get_header(); ?>
<div class="p-contact-thanks l-contact-thanks">
    <div class="p-contact-thanks__inner l-inner">
        <div class="p-contact-thanks__send">送信完了しました</div>
        <p class="p-contact-thanks__text">
            お問い合わせいただきありがとうございました。<br>折り返し、担当者よりご連絡いたしますので、<br class="u-mobile">恐れ入りますが、<br class="u-desktop">しばらくお待ちください。
        </p>
        <?php
        $url = $_SERVER['HTTP_REFERER'];
        if (strstr($url, 'family')) :
            echo do_shortcode('[mwform_formkey key="15"]');
        elseif (strstr($url, 'kyusyu')) :
            echo do_shortcode('[mwform_formkey key="13"]');
        elseif (strstr($url, 'sapporo')) :
            echo do_shortcode('[mwform_formkey key="87"]');
        elseif (strstr($url, 'tokai')) :
            echo do_shortcode('[mwform_formkey key="243"]');
        elseif (strstr($url, 'hokkaido')) :
            echo do_shortcode('[mwform_formkey key="14"]');
        else :
            echo do_shortcode('[mwform_formkey key="527"]');
        endif;
        ?>
    </div>
</div>
<?php get_footer(); ?>
