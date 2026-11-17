
<?php
/**
 * @file
 * Service card fields for the Nonprofit theme.
 */
?>

<div class="bg-white rounded-2xl p-6 shadow-sm h-full flex flex-col">

  <?php if (!empty($fields['field_card_icon']->content)): ?>
    <div class="service-icon w-14 h-14 rounded-xl bg-mint flex items-center justify-center mb-5 text-2xl text-forest">
      <?php print $fields['field_card_icon']->content; ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($fields['title']->content)): ?>
    <h3 class="text-xl font-extrabold text-forest mb-3">
      <?php print $fields['title']->content; ?>
    </h3>
  <?php endif; ?>

  <?php if (!empty($fields['body']->content)): ?>
    <div class="service-description text-sm leading-7 text-gray-500 mb-6">
      <?php print $fields['body']->content; ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($fields['field_card_link']->content)): ?>
    <div class="service-link mt-auto">
      <?php print $fields['field_card_link']->content; ?>
    </div>
  <?php endif; ?>

</div>
