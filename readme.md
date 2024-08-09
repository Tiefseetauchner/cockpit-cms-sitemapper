# SiteMapper
Basically trying to replace my abysmal sitemap.php on [lukechriswalker.at](https://www.lukechriswalker.at)

## Ideas
- [ ] Create and remove Sites with links
- [ ] Add magic that allows mapping from content collections to items
- [ ] ???
- [ ] Profit [Gib fibsh plz](https://buymeacoffee.com/tiefseetauchner)

## TODOs
If you're a programmer who really likes my addon, you can expand it. I have the following TODOs that I may or may not get to:
- [ ] Mapping collections to sites
- [ ] Don't do PHP magic anymore
  - We should use REST tbh, and make the sitemap independent of how you host your cockpit cms

## Installation
Unlike my other addons, this is a bit more involved to install, so I'll have a section here.

First of all, this relies on some... hacky things I did to my cockpit cms. Namely, I extracted everything but the last line of index.php into a start.php. It looks something like this now:

```php
<?php

require __DIR__ . '/start.php';

// run app
$app->trigger(APP_API_REQUEST ? 'app.api.request':'app.admin.request', [$request])->run($request->route, $request);
```
If you want to use the addon, you'll have to do that too. For now. Until we figured out a better way to do this.

Now, once that works you can add a `sitemap.php` to your website root that looks like this:

```php
<?php
include __DIR__ . '/COCKPIT/modules/SiteMapper/sitemap.php';
```
Where you replace COCKPIT with the name of your cockpit folder. Now obviously this only works if you're hosting your webpage in the same folder as your cockpit, which granted you might not. But as this is primarily to cover my usecase with being helpful to others more of an afterthought, we'll have to live with this.

Lastly, you have to redirect `sitemap.xml` to `sitemap.php`. For example for apache:

```
# .htaccess
RewriteEngine on

RewriteCond %{REQUEST_URI} ^/sitemap.xml
RewriteRule ^(.*)$ /sitemap.php [L]
```
