
<?php
/**
 * @file
 * About section for the Nonprofit theme.
 */

// Load referenced statistics from the current Hero node.
$cards = array();

if (!empty($row->nid)) {
  $hero = node_load($row->nid);

  if ($hero && !empty($hero->field_hero_statistics[LANGUAGE_NONE])) {
    foreach ($hero->field_hero_statistics[LANGUAGE_NONE] as $item) {
      if (!empty($item['target_id'])) {
        $stat = node_load($item['target_id']);

        if ($stat) {
          $cards[] = array(
            'title' => $stat->title,
            'text' => !empty($stat->field_stat_number[LANGUAGE_NONE][0]['value'])
              ? $stat->field_stat_number[LANGUAGE_NONE][0]['value']
              : '',
          );
        }
      }
    }
  }
}
?>

<section id="about" class="py-20">
  <div class="max-w-7xl mx-auto px-5 grid lg:grid-cols-2 gap-14 items-center">

    <div class="relative">
      <?php if (!empty($fields['field_image']->content)): ?>
        <div class="about-image">
          <?php print $fields['field_image']->content; ?>
        </div>
      <?php endif; ?>
    </div>

    <div>
      <?php if (!empty($fields['field_hero_label']->content)): ?>
        <span class="text-[#5b8b57] font-extrabold text-sm section-label">
          <?php print $fields['field_hero_label']->content; ?>
        </span>
      <?php endif; ?>

      <?php if (!empty($fields['body']->content)): ?>
        <div class="about-body">
          <?php print $fields['body']->content; ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($cards)): ?>
        <div class="grid sm:grid-cols-2 gap-5 mb-9">
          <?php foreach ($cards as $index => $card): ?>
            <div class="bg-white rounded-2xl border border-gray-100 p-5">
              <span class="text-3xl about-card-icon">
                <?php print $index === 0 ? '◎' : '✦'; ?>
              </span>

              <h3 class="about-card-title font-extrabold mt-3 mb-2">
                <?php print check_plain($card['title']); ?>
              </h3>

              <p class="text-sm leading-7 text-gray-500">
                <?php print check_plain($card['text']); ?>
              </p>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($fields['field_hero_primary_link']->content)): ?>
        <div class="about-link">
          <?php print $fields['field_hero_primary_link']->content; ?>
        </div>
      <?php endif; ?>
    </div>

  </div>
</section>
