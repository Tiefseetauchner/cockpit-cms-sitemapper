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

    public function create() {
      if ($this->app->helper('content.model')->exists("sitemappersites")) {
          return;
      }

      $model = [
        'name' => 'sitemappersites',
        'label' => 'SiteMapper Sites',
        'info' => 'This is a predefined sitemap model by the SiteMapper addon. DO NOT CHANGE THIS! It will certainly break the addon!',
        'type' => 'collection',
        'fields' => [
            [
                'name' => 'loc',
                'type' => 'text',
                'label' => 'Location',
                'info' => 'INTERNAL FIELD DO NOT CHANGE!',
                'group' => '',
                'i18n' => false,
                'required' => false,
                'multiple' => false,
                'meta' => [],
                'opts' => [
                    'multiline' => false,
                    'showCount' => true,
                    'readonly' => false,
                    'placeholder' => null,
                    'minlength' => null,
                    'maxlength' => null,
                    'list' => null
                ]
            ],
            [
                'name' => 'changefreq',
                'type' => 'text',
                'label' => 'Change Frequency',
                'info' => 'INTERNAL FIELD DO NOT CHANGE!',
                'group' => '',
                'i18n' => false,
                'required' => false,
                'multiple' => false,
                'meta' => [],
                'opts' => [
                    'multiline' => false,
                    'showCount' => true,
                    'readonly' => false,
                    'placeholder' => null,
                    'minlength' => null,
                    'maxlength' => null,
                    'list' => null
                ]
            ],
            [
                'name' => 'lastmod',
                'type' => 'text',
                'label' => 'Last Modified',
                'info' => 'INTERNAL FIELD DO NOT CHANGE!',
                'group' => '',
                'i18n' => false,
                'required' => false,
                'multiple' => false,
                'meta' => [],
                'opts' => [
                    'multiline' => false,
                    'showCount' => true,
                    'readonly' => false,
                    'placeholder' => null,
                    'minlength' => null,
                    'maxlength' => null,
                    'list' => null
                ]
            ],
            [
                'name' => 'priority',
                'type' => 'text',
                'label' => 'Priority',
                'info' => 'INTERNAL FIELD DO NOT CHANGE!',
                'group' => '',
                'i18n' => false,
                'required' => false,
                'multiple' => false,
                'meta' => [],
                'opts' => [
                    'multiline' => false,
                    'showCount' => true,
                    'readonly' => false,
                    'placeholder' => null,
                    'minlength' => null,
                    'maxlength' => null,
                    'list' => null
                ]
            ]
        ],
        'preview' => [],
        'group' => '',
        'meta' => null,
        '_created' => 1723048290,
        '_modified' => 1723048290,
        'color' => '#e01b24',
        'revisions' => false
      ];

      if (!$this->isAllowed("content/:models/manage") && !$this->isAllowed("content/{$model}/manage")) {
          return $this->stop(401);
      }

      $model = $this->module('content')->saveModel("sitemappersites", $model);

      return $model;
    }

    public function get() {
      if (!$this->app->helper('content.model')->exists("sitemappersites")) {
        return;
      }
      
      $items = $this->module('content')->items("sitemappersites");

      return $items;
    }
}