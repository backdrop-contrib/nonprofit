
<?php
/**
 * @file
 * Template for Statistic content.
 */
?>
<div class="p-6 border-l border-gray-200">
  <?php if (!empty($content['field_stat_number'])): ?>
    <strong class="block text-4xl font-extrabold text-forest">
      <?php print render($content['field_stat_number']); ?>
    </strong>
  <?php endif; ?>

  <p class="mt-2 text-gray-500 text-sm">
    <?php print check_plain($title); ?>
  </p>
</div>
