<kiss-container class="kiss-margin-small">

  <ul class="kiss-breadcrumbs">
    <li><a href="<?php echo $this->route('/sitemap') ?>"><?php echo t('Sitemap') ?></a></li>
  </ul>

  <vue-view>

    <template>
        <sitemap></sitemap>
    </template>

    <script type="module">

        export default {

            components: {
                sitemap: 'sitemapper:assets/vue-components/sitemap.js'
            }
        }

    </script>

</vue-view>

</kiss-container>