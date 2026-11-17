
<?php
/**
 * @file
 * Home news card for the Nonprofit theme.
 *
 * Displays a horizontal news card using Views fields.
 */
?>

<article class="news-card flex bg-white rounded-2xl overflow-hidden border border-gray-100 h-full">

  <?php if (!empty($fields['field_image']->content)): ?>
    <div class="news-image">
      <?php print $fields['field_image']->content; ?>
    </div>
  <?php endif; ?>

  <div class="news-content flex flex-col justify-center flex-1 p-6">

    <div class="news-meta flex flex-wrap items-center gap-2 mb-3">

      <?php if (!empty($fields['created']->content)): ?>
        <span class="news-date text-xs text-gray-400">
          <?php print $fields['created']->content; ?>
        </span>
      <?php endif; ?>

      <?php if (!empty($fields['field_news_categories']->content)): ?>
        <span class="news-category text-xs font-bold text-[#5b8b57]">
          <?php print $fields['field_news_categories']->content; ?>
        </span>
      <?php endif; ?>

    </div>

    <?php if (!empty($fields['title']->content)): ?>
      <h3 class="news-title text-lg font-extrabold text-forest leading-7 mb-3">
        <?php print $fields['title']->content; ?>
      </h3>
    <?php endif; ?>

    <?php if (!empty($fields['view_node']->content)): ?>
      <div class="news-link mt-auto text-sm font-bold">
        <?php print $fields['view_node']->content; ?>
      </div>
    <?php endif; ?>

  </div>

</article>
