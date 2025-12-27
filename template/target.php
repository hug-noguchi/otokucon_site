<!-- sp -->
<a href="#contact" class="p-target">
  <div class="p-target__inner">
    <p class="p-target__head"><span><img src="<?php echo get_template_directory_uri(); ?>/assets/images/present-icon.png" alt="キャンペーンに応募する"></span> キャンペーンに<br class="u-desktop">応募する</p>
    <p class="p-target__foot">期間限定<br class="u-desktop"><span>：</span>
      <?php if (strtotime(date('Y-m-d H:i')) < strtotime('2025-12-31 15:00')) { ?>
        2025.12.31
      <?php } else { ?>
        2026.1.31
      <?php } ?></p>
  </div>
</a>
