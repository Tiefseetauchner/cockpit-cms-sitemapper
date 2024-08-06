<?php

namespace SiteMapper\Controller;

use App\Controller\App;
use ArrayObject;

class SiteMapper extends App
{
    public function index()
    {
        $this->helper('theme')->favicon('sitemapper:icon.svg');

        return $this->render('sitemapper:views/index.php');
    }
}