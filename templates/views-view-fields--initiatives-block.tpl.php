
<?php
/**
 * @file
 * Initiative card for the Nonprofit theme.
 */
?>

<article class="initiative-card bg-white rounded-2xl overflow-hidden border border-gray-100 h-full flex flex-col">

  <?php if (!empty($fields['field_image']->content)): ?>
    <div class="initiative-image overflow-hidden">
      <?php print $fields['field_image']->content; ?>
    </div>
  <?php endif; ?>

  <div class="p-6 flex flex-col flex-grow">

    <?php if (!empty($fields['field_initiative_category']->content)): ?>
      <div class="initiative-category text-sm font-bold text-[#5b8b57] mb-3">
        <?php print $fields['field_initiative_category']->content; ?>
      </div>
    <?php endif; ?>

    <?php if (!empty($fields['title']->content)): ?>
      <h3 class="text-xl font-extrabold text-forest mb-3">
        <?php print $fields['title']->content; ?>
      </h3>
    <?php endif; ?>

    <?php if (!empty($fields['body']->content)): ?>
      <div class="initiative-description text-sm leading-7 text-gray-500 mb-5">
        <?php print $fields['body']->content; ?>
      </div>
    <?php endif; ?>

    <?php if (!empty($fields['view_node']->content)): ?>
      <div class="initiative-link mt-auto">
        <?php print $fields['view_node']->content; ?>
      </div>
    <?php endif; ?>

  </div>
</article>
