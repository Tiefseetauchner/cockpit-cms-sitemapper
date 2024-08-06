<?php

$this->bindClass('SiteMapper\\Controller\\SiteMapper', '/sitemap');

$this->on(
    'app.layout.init', function () {
        $this->helper('menus')->addLink(
            'modules', [
            'label'  => 'Sitemap',
            'icon'   => 'sitemap:icon.svg',
            'route'  => '/sitemap',
            'active' => false,
            'group'  => 'Content',
            'prio'   => 3
            ]
        );
    }
);

$this->on(
    'app.permissions.collect', function ($permissions) {
        $permissions['Content'] = [
        'component' => 'ContentModelSettings',
        'src' => 'content:assets/vue-components/content-model-permissions.js',
        'props' => [
          'models' => $this->module('content')->models()
        ]
        ];
    }
);

