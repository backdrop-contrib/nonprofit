<?php
// In your theme's theme-settings.php file

function nonprofit_form_system_theme_settings_alter(&$form, &$form_state) {

  // Load Portfolio setup configuration.
  $config = config('nonprofit.settings');

  // 1. Create vertical tabs container
  $form['nonprofit_tabs'] = array(
    '#type' => 'vertical_tabs',
    '#default_tab' => 'edit-background-options', // (Optional) Default selected tab
    '#prefix' => '<h2><small>' . t('nonprofit Settings') . '</small></h2>',
    '#weight' => -10,    
  );

  // 2. Background settings tab
  $form['background_options'] = array(
    '#type' => 'fieldset',
    '#title' => t('Background settings'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#group' => 'nonprofit_tabs', // Key: Link to tabs container
  );

  // Background field (supports gradients and multiple colors)
  $form['background_options']['site_background'] = array(
    '#type' => 'textfield',
    '#title' => t('Site background classes (< body >)'),
    '#default_value' => theme_get_setting('site_background', 'nonprofit'),
    '#description' => t('Enter Tailwind background classes. Examples:<br>
      <code>bg-white dark:bg-gray-900</code><br>
      <code>bg-gradient-to-b from-sky-100 via-slate-100 to-white</code>'),
    '#size' => 60, // Field width approximately
    '#maxlength' => 255, // Maximum number of characters

  );
    // ... (after site_background field) ...

  // Header background
  $form['background_options']['header_background'] = array(
    '#type' => 'textfield',
    '#title' => t('Site Header classes (< header >)'),
    '#default_value' => theme_get_setting('header_background', 'nonprofit'),
    '#description' => t('Examples : <code>bg-white dark:bg-gray-800</code>'),
    '#size' => 60,
  );

  // Footer background
  $form['background_options']['footer_background'] = array(
    '#type' => 'textfield',
    '#title' => t('Site Footer classes (< footer >)'),
    '#default_value' => theme_get_setting('footer_background', 'nonprofit'),
    '#description' => t('Examples : <code>bg-gray-900 text-white</code>'),
    '#size' => 60,
  );
  
  // 3. Breadcrumb settings tab
  $form['dark_mode'] = array(
    '#type' => 'fieldset',
    '#title' => t('Dark Mode settings'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#group' => 'nonprofit_tabs', // Key: Link to the same tabs container
  );
  // Dark mode activation option
  $form['dark_mode']['toggle_dark_mode'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable Dark Mode'),
    // 1. Added 'nonprofit' here to fetch the value from the correct theme settings table
    '#default_value' => theme_get_setting('toggle_dark_mode', 'nonprofit'),
    '#description' => t('When enabled, dark mode will be applied site-wide using Tailwind classes.'),
  );

  // 3. Breadcrumb settings tab
  $form['breadcrumb_options'] = array(
    '#type' => 'fieldset',
    '#title' => t('Breadcrumb settings'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#group' => 'nonprofit_tabs', // Key: Link to the same tabs container
  );

  // 1. Option to show/hide breadcrumbs entirely
  $form['breadcrumb_options']['toggle_breadcrumb'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show breadcrumbs'),
    '#default_value' => theme_get_setting('toggle_breadcrumb', 'nonprofit'),
    '#description' => t('When unchecked, breadcrumbs will be hidden from all site pages.'),
  );

  // 2. Option to hide the home page link only
  $form['breadcrumb_options']['hide_home_breadcrumb'] = array(
    '#type' => 'checkbox',
    '#title' => t('Hide "Home" link from breadcrumb'),
    '#default_value' => theme_get_setting('hide_home_breadcrumb', 'nonprofit'),
    '#description' => t('Removes the Home link from the beginning of the breadcrumb trail while keeping the remaining links.'),
    '#states' => array(
      'visible' => array(
        ':input[name="toggle_breadcrumb"]' => array('checked' => TRUE),
      ),
    ),
  );

  $form['theme_setup'] = array(
    '#type' => 'fieldset',
    '#title' => t('Theme Setup'),
    '#group' => 'nonprofit_tabs',
  );  
  $form['theme_setup']['enable_modules'] = array(
  '#type' => 'checkbox',
  '#title' => t('Enable required modules'),
  '#description' => t('Enable modules defined in modules.json.'),
  '#default_value' => 0,
  );

  $form['theme_setup']['import_fields'] = array(
    '#type' => 'checkbox',
    '#title' => t('Import field configurations'),
    '#description' => t('Import field configurations using Backdrop CMI.'),
    '#default_value' => 0,
  );

  // Import taxonomy terms.
  $form['theme_setup']['import_terms'] = array(
    '#type' => 'checkbox',
    '#title' => t('Import Main Categories'),
    '#description' => t('Import the default Projects and Articles categories for the Portfolio theme.'),
    '#parents' => array('import_terms'),
  );

  // Import default content.
  $form['theme_setup']['import_content'] = array(
    '#type' => 'checkbox',
    '#title' => t('Import Sample Content'),
    '#description' => t('Import sample content using the fields provided by the Portfolio theme.'),
    '#parents' => array('import_content'),
  );

  // Import menu links.
  $form['theme_setup']['import_menu_links'] = array(
    '#type' => 'checkbox',
    '#title' => t('Import Menu Links'),
    '#description' => t('Add site page links to the main menu.'),
    '#parents' => array('import_menu_links'),
  );
  $form['theme_setup']['layout_settings'] = array(
    '#type' => 'checkbox',
    '#title' => t('Apply layout settings'),
    '#description' => t('Configure existing layouts using settings.json.'),
    '#default_value' => 0,
  );
  $form['theme_setup']['layout_blocks'] = array(
    '#type' => 'checkbox',
    '#title' => t('Configure layout blocks'),
    '#description' => t('Add, remove, and configure blocks using blocks.json.'),
    '#default_value' => 0,
  );
  // Custom submit handler.
  $form['#submit'][] = 'nonprofit_theme_setup_submit';
}

/**
 * Submit handler for theme setup settings.
 */
function nonprofit_theme_setup_submit($form, &$form_state) {
  $enable_modules = !empty($form_state['values']['enable_modules']);
  $import_fields = !empty($form_state['values']['import_fields']);
  $import_terms = !empty($form_state['values']['import_terms']);
  $import_content = !empty($form_state['values']['import_content']);
  $import_menu_links = !empty($form_state['values']['import_menu_links']);
  $update_views_filters = !empty($form_state['values']['update_views_filters']);
  $apply_layout_settings = !empty($form_state['values']['layout_settings']);
  $configure_layout_blocks = !empty($form_state['values']['layout_blocks']);

  // Get the selected image styles.
  $styles = array();

  if (!empty($form_state['values']['flush_image_styles']) &&
      is_array($form_state['values']['flush_image_styles'])) {
    $styles = array_values(array_filter(
      $form_state['values']['flush_image_styles']
    ));
  }

  // Do not persist setup actions in theme settings.
  unset(
    $form_state['values']['import_fields'],
    $form_state['values']['enable_modules'],
    $form_state['values']['import_terms'],
    $form_state['values']['import_content'],
    $form_state['values']['import_menu_links'],
    $form_state['values']['update_views_filters'],
    $form_state['values']['layout_settings'],
    $form_state['values']['layout_blocks'],
    $form_state['values']['flush_image_styles']
  );

  // Stop if no setup option was selected.
  if (!$enable_modules && 
      !$import_fields && 
      !$import_terms &&
      !$import_content &&
      !$import_menu_links &&
      !$update_views_filters &&
      !$apply_layout_settings &&
      !$configure_layout_blocks &&
      empty($styles)) {
    return;
  }

  $theme = 'nonprofit';
  $file = backdrop_get_path('theme', $theme) . '/includes/theme-setup.inc';

  if (!is_file($file)) {
    backdrop_set_message(t('Theme setup library not found.'), 'error');
    return;
  }

  require_once $file;

  // Enable required modules before importing field configurations.
  if ($enable_modules) {
    if (theme_setup_enable_modules($theme)) {
      backdrop_set_message(t('Required modules enabled successfully.'));
    }
    else {
      backdrop_set_message(t('Failed to enable required modules.'), 'error');
      return;
    }
  }

  // Import field configurations after enabling required modules.
  if ($import_fields) {
    if (theme_setup_import_fields($theme)) {
      backdrop_set_message(t('Field configurations imported successfully.'));
    }
    else {
      backdrop_set_message(t('Failed to import field configurations.'), 'error');
      return;
    }
  }

  // Import taxonomy terms.
  if ($import_terms) {
    if (theme_setup_import_terms($theme)) {
      backdrop_set_message(t('Taxonomy terms imported successfully.'));
    }
    else {
      backdrop_set_message(t('Some taxonomy terms could not be imported.'), 'warning');
    }
  }

  // Import sample content.
  if ($import_content) {
    if (theme_setup_import_content($theme)) {
      backdrop_set_message(t('Sample content imported successfully.'));
    }
    else {
      backdrop_set_message(t('Some sample content could not be imported.'), 'warning');
    }
  }

  // Import menu links.
  if ($import_menu_links) {
    if (theme_setup_import_menu_links($theme)) {
      backdrop_set_message(t('Menu links imported successfully.'));
    }
    else {
      backdrop_set_message(t('Some menu links could not be imported.'), 'warning');
    }
  }

  // Update taxonomy term IDs in Views filters.
  if ($update_views_filters) {
    if (theme_setup_update_views_filters($theme)) {
      backdrop_set_message(t('Views taxonomy filters updated successfully.'));
    }
    else {
      backdrop_set_message(t('Some Views taxonomy filters could not be updated.'), 'warning');
    }
  }

  // Apply layout settings.
  if ($apply_layout_settings) {
    if (theme_setup_apply_layout_settings($theme)) {
      backdrop_set_message(t('Layout settings applied successfully.'));
    }
    else {
      backdrop_set_message(t('Some layout settings could not be applied.'), 'warning');
    }
  }

  // Configure layout blocks.
  if ($configure_layout_blocks) {
    if (theme_setup_configure_layout_blocks($theme)) {
      backdrop_set_message(t('Layout blocks configured successfully.'));
    }
    else {
      backdrop_set_message(t('Some layout blocks could not be configured.'), 'warning');
    }
  }

  // Flush only the selected image styles.
  if (!empty($styles)) {
    if (theme_setup_flush_image_styles($styles)) {
      backdrop_set_message(t('Selected image styles have been flushed.'));
    }
    else {
      backdrop_set_message(t('Some image styles could not be flushed.'), 'warning');
    }
  }

  // Rebuild caches after completing theme setup.
  backdrop_flush_all_caches();  
}
