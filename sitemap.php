<?php
require __DIR__ . '/../../start.php';

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
}

echo '</urlset>';