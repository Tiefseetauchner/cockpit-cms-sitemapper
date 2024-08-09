<?php

$this->bindClass('SiteMapper\\Controller\\SiteMapper', '/sitemap');

$this->on(
    'app.layout.init', function () {
        $this->helper('menus')->addLink(
            'modules', [
            'label'  => 'Sitemap',
            'icon'   => 'sitemapper:icon.svg',
            'route'  => '/sitemap',
            'active' => false,
            'group'  => 'Content',
            'prio'   => 0
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

