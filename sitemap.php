<?php
// Include this file in your sitemap.php file to enable the sitemapper addon

require __DIR__ . '/../../bootstrap.php';

$app = Cockpit::instance();

header('Content-type: application/xml');

echo '<?xml version="1.0" encoding="UTF-8"?>';

echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

// Get static sites
if($app->helper('content.model')->exists('sitemappersites') != null)
{
  $items = $app->module('content')->items('sitemappersites');

  foreach($items as $item)
  {
    echo '<url>';
    echo '<loc>'. $item['loc']. '</loc>';
    echo '<changefreq>'. $item['changefreq']. '</changefreq>';
    echo '<priority>'. $item['priority']. '</priority>';
    echo '<lastmod>'. $item['lastmod']. '</lastmod>';
    echo '</url>';
  }

  // Get dynamic sites
  $dynamicSiteModels = $app->module('content')->items('sitemapperdynamicsites');

  foreach($dynamicSiteModels as $dynamicSiteModel)
  {
    $items = $app->module('content')->items($dynamicSiteModel['modelname']);

    foreach($items as $item)
    {
      $url = str_replace(
        ['{_id}'],
        [$item['_id']],
        $dynamicSiteModel['urltemplate']
      );

      echo '<url>';
      echo '<loc>'. $url. '</loc>';
      echo '<changefreq>'. $dynamicSiteModel['changefreq']. '</changefreq>';
      echo '<lastmod>'. $item['_modified']. '</lastmod>';
      echo '</url>';
    }
  }
}

echo '</urlset>';