
<?php
/**
 * @file
 * Hero section fields for the Nonprofit theme.
 */
?>

<section id="home" class="hero-pattern text-white overflow-hidden">
  <div class="max-w-7xl mx-auto px-5 py-16 lg:py-24 grid lg:grid-cols-2 gap-14 items-center">

    <!-- Hero content. -->
    <div>

      <?php if (!empty($fields['field_hero_label']->content)): ?>
        <span class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-xs font-bold mb-7">
          <span class="w-2 h-2 rounded-full bg-lime"></span>
          <?php print $fields['field_hero_label']->content; ?>
        </span>
      <?php endif; ?>

      <?php if (!empty($fields['body']->content)): ?>
        <div class="hero-body">
          <?php print $fields['body']->content; ?>
        </div>
      <?php endif; ?>

      <div class="flex flex-wrap gap-3">
        <?php if (!empty($fields['field_hero_primary_link']->content)): ?>
          <div class="hero-primary-link">
            <?php print $fields['field_hero_primary_link']->content; ?>
          </div>
        <?php endif; ?>

        <?php if (!empty($fields['field_hero_secondary_link']->content)): ?>
          <div class="hero-secondary-link">
            <?php print $fields['field_hero_secondary_link']->content; ?>
          </div>
        <?php endif; ?>
      </div>

    </div>

    <!-- Hero image. -->
    <div class="relative lg:pr-8">

      <div class="absolute -top-5 -left-5 w-32 h-32 rounded-full border-[22px] border-lime/30"></div>

      <?php if (!empty($fields['field_image']->content)): ?>
        <div class="hero-image relative">
          <?php print $fields['field_image']->content; ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($fields['field_hero_card_title']->content)): ?>
        <div class="absolute -bottom-7 right-[-12px] sm:right-[-25px] bg-white text-forest rounded-3xl p-5 sm:p-6 shadow-xl max-w-[235px]">

          <div class="text-3xl mb-2">✳</div>

          <strong class="block text-2xl">
            <?php print $fields['field_hero_card_title']->content; ?>
          </strong>

          <?php if (!empty($fields['field_hero_card_text']->content)): ?>
            <div class="text-xs leading-6 text-gray-500 mt-2">
              <?php print $fields['field_hero_card_text']->content; ?>
            </div>
          <?php endif; ?>

        </div>
      <?php endif; ?>

    </div>

  </div>
</section>
