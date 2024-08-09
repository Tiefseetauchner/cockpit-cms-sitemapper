# SiteMapper
Basically trying to replace my abysmal sitemap.php on [lukechriswalker.at](https://www.lukechriswalker.at)

## Ideas
- [x] Create and remove Sites with links
- [x] Add magic that allows mapping from content collections to items
- [ ] ???
- [ ] Profit [Gib fibsh plz](https://buymeacoffee.com/tiefseetauchner)

## TODOs
If you're a programmer who really likes my addon, you can expand it. I have the following TODOs that I may or may not get to:
- [x] Mapping collections to sites
- [ ] ~~Don't do PHP magic anymore~~
  - ~~We should use REST tbh, and make the sitemap independent of how you host your cockpit cms~~
  - The painful magic was solved thanks to aheinze! :)

## Installation
Unlike my other addons, this is a bit more involved to install, so I'll have a section here.

Once you have installed the addon and verified it works you can add a `sitemap.php` to your website root that looks like this:

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
