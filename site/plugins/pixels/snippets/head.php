
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?= $site->titel() ?></title>

<?= css('assets/css/index.css') ?>
<?= css($plugin->asset('css/pixels.css')) ?>
<?= css($plugin->asset('css/toolbar.css')) ?>
<?= css($plugin->asset('css/canvas.css')) ?>

<link rel="icon" type="image/png" href="<?= url('/assets/images/favicon.png') ?>">
<link rel="icon" type="image/svg+xml" href="<?= url('/assets/images/favicon.svg') ?>">

<meta name="description" content="<?= $site->description() ?>">
<meta property="og:site_name" content="<?= $site->titel() ?>">
<meta property="og:url" content="<?= $site->url() ?>">
<meta property="og:type" content="website">
<meta property="og:title" content="<?= $site->titel() ?>">
<meta property="og:description" content="<?= $site->description() ?>">
<meta property="og:image" content="<?= url('assets/images/ogimage.png') ?>">
