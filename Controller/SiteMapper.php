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
      if (!$this->app->helper('content.model')->exists("sitemappersites")) {
        $sitemapperSitesModel = [
          'name' => 'sitemappersites',
          'label' => 'SiteMapper Sites',
          'info' => 'This is a predefined sitemap model by the SiteMapper addon. DO NOT CHANGE THIS! It will certainly break the addon!',
          'type' => 'collection',
          'fields' => [
              [
                  'name' => 'loc',
                  'type' => 'text',
                  'label' => 'Location',
                  'info' => 'INTERNAL FIELD DO NOT CHANGE! This is the location of the site.',
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
                  'info' => 'INTERNAL FIELD DO NOT CHANGE! This is the change frequency of the site.',
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
                  'info' => 'INTERNAL FIELD DO NOT CHANGE! This is the last modified date of the site.',
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
                  'info' => 'INTERNAL FIELD DO NOT CHANGE! This is the priority of the site.',
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
          'color' => '#e01b24',
          'revisions' => false
        ];

        if (!$this->isAllowed("content/:models/manage") && !$this->isAllowed("content/{$sitemapperSitesModel}/manage")) {
            return $this->stop(401);
        }

        $sitemapperSitesModel = $this->module('content')->saveModel("sitemappersites", $sitemapperSitesModel);
      }

      if (!$this->app->helper('content.model')->exists("sitemapperdynamicsites")) {
        $dynamicSitesModel = [
          'name' => 'sitemapperdynamicsites',
          'label' => 'Dynamic SiteMapper Sites',
          'info' => 'This is a predefined sitemap model by the SiteMapper addon. DO NOT CHANGE THIS! It will certainly break the addon!',
          'type' => 'collection',
          'fields' => [
              [
                  'name' => 'modelname',
                  'type' => 'text',
                  'label' => 'Model Name',
                  'info' => 'INTERNAL FIELD DO NOT CHANGE! This is the model name of the dynamic sites.',
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
                  'info' => 'INTERNAL FIELD DO NOT CHANGE! This is the change frequency of the site.',
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
                  'name' => 'urltemplate',
                  'type' => 'text',
                  'label' => 'Dynamic URL Template',
                  'info' => 'INTERNAL FIELD DO NOT CHANGE! This is the dynamic url template of the dynamic sites.',
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
          'color' => '#e01b24',
          'revisions' => false
        ];
        
        if (!$this->isAllowed("content/:models/manage") && !$this->isAllowed("content/{$dynamicSitesModel}/manage")) {
            return $this->stop(401);
        }

        $dynamicSitesModel = $this->module('content')->saveModel("sitemapperdynamicsites", $dynamicSitesModel);
      }

      return "OK";
    }

    public function get() {
      if (!$this->app->helper('content.model')->exists("sitemappersites")) {
        return;
      }
      
      $items = $this->module('content')->items("sitemappersites");

      return $items;
    }

    public function getDynamic() {
      if (!$this->app->helper('content.model')->exists("sitemapperdynamicsites")) {
        return;
      }
      
      $items = $this->module('content')->items("sitemapperdynamicsites");

      return $items;
    }
}