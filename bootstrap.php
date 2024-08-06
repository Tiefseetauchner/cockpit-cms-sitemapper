<?php

$this->helpers['content'] = 'Content\\Helper\\Content';
$this->helpers['content.model'] = 'Content\\Helper\\Model';

$this->on(
    'app.admin.init', function () {
        include __DIR__.'/admin.php';
    }
);

