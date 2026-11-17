<?php
/**
 * @file
 * Display site information such as logo, name, and slogan.
 */
?>

<div class="max-w-7xl mx-auto px-5 h-20 flex items-center justify-between gap-5">
<?php if ($site_name || $site_slogan || $logo): ?>
  <a href="<?php print $front_page; ?>"
     title="<?php print t('Home'); ?>"
     rel="home"
     class="flex items-center gap-3">

    <?php if ($logo): ?>
      <span class="w-11 h-11 bg-forest text-lime rounded-2xl grid place-items-center overflow-hidden">
        <img src="<?php print $logo; ?>"
             alt="<?php print t('Home'); ?>"
             class="w-full h-full object-contain"
             <?php print backdrop_attributes($logo_attributes); ?> />
      </span>
    <?php else: ?>
      <span class="w-11 h-11 bg-forest text-lime rounded-2xl grid place-items-center text-2xl font-bold">
        ✳&#65038;
      </span>
    <?php endif; ?>

    <span class="leading-tight">
      <?php if ($site_name): ?>
        <strong class="block text-2xl text-ink">
          <?php print $site_name; ?><span class="text-[#78a94b]">.</span>
        </strong>
      <?php endif; ?>

      <?php if ($site_slogan): ?>
        <small class="block text-[10px] text-gray-500">
          <?php print $site_slogan; ?>
        </small>
      <?php endif; ?>
    </span>

  </a>
<?php endif; ?>

</div>