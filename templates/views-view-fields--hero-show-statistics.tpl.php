
<?php
/**
 * @file
 * Statistics section for the Nonprofit theme.
 */
?>
<section class="home-statistics max-w-7xl mx-auto px-5 pt-20 pb-14">
  <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
    <?php if (!empty($fields['field_hero_statistics']->content)): ?>
      <?php print $fields['field_hero_statistics']->content; ?>
    <?php endif; ?>
  </div>
</section>
