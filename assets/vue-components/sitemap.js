export default {
  name: "Sitemap",
  data() {
    return {
      models: undefined,
      loading: false,
      allModelsFound: false,
      sites: [],
      dynamicSites: [],
      newSite: {
        _state: 1,
        loc: "",
        changefreq: "",
        priority: "",
        lastmod: "",
      },
      editItem: {},
    };
  },
  computed: {
    // Add computed properties here
  },
  methods: {
    load() {
      this.loading = true;

      App.utils.getContentModels().then((models) => {
        let sitesModel = Object.values(models)
          .filter((model) => {
            return `${model.name}` === "sitemappersites";
          })
          .pop();
        let dynamicSitesModel = Object.values(models)
          .filter((model) => {
            return `${model.name}` === "sitemapperdynamicsites";
          })
          .pop();

        if (sitesModel && dynamicSitesModel) {
          this.$request("/sitemap/get").then((items) => {
            this.sites = items;
          });

          this.$request("/sitemap/getDynamic").then((items) => {
            this.dynamicSites = items;
          });

          this.allModelsFound = true;

          this.models = sitesModel;
        }

        this.loading = false;
      });
    },

    createSitemapModel() {
      this.$request("/sitemap/create")
        .then((model) => {
          App.ui.notify("Model created!");
          this.load();
        })
        .catch((err) => {
          this.saving = false;
          App.ui.notify("Failed to create model", "negative");
        });
    },

    saveNewItem() {
      this.$request("/content/models/saveItem/sitemappersites", {
        item: this.newSite,
      });

      this.newSite = {
        _state: 1,
        loc: "",
        changefreq: "",
        priority: "",
        lastmod: "",
      };

      this.load();
    },

    saveEditItem() {
      this.$request("/content/models/saveItem/sitemappersites", {
        item: this.editItem,
      }).then(() => {
        this.editItem = {};

        this.load();
      });
    },

    editItemAction(item) {
      this.editItem = item;
    },

    deleteItem() {
      App.ui.confirm("Are you sure you want to delete this site?", () => {
        this.$request("/content/collection/remove/sitemappersites", {
          ids: [this.editItem._id],
        }).then(() => {
          this.editItem = {};

          this.load();
        });
      });
    },
  },
  mounted() {
    this.load();
  },
  template: /*html*/ `
  <app-loader class="kiss-margin-large" v-if="loading"></app-loader>

  <div
    class="animated fadeIn kiss-height-50vh kiss-flex kiss-flex-middle kiss-flex kiss-flex-column kiss-flex-center kiss-align-center kiss-color-muted kiss-margin-large"
    v-if="!loading && !allModelsFound">
    <p class="kiss-size-large kiss-margin-top">No Sitemap Model found.</p>
    <p class="kiss-size-large kiss-margin-top">Create a Sitemap Model to get started.</p>
    <app-button @click="createSitemapModel" class="kiss-button kiss-button-primary">Create Sitemap</app-button>
  </div>
  
  <div class="kiss-margin-large" v-if="!loading && allModelsFound">
    <p class="kiss-size-large kiss-margin-top">Sites</p>
  
    <div
      class="animated fadeIn kiss-height-50vh kiss-flex kiss-flex-middle kiss-flex-center kiss-align-center kiss-color-muted"
      v-if="!loading && !sites.length">
      <div>
        <p class="kiss-size-large kiss-text-bold kiss-margin-small-top">No Sites</p>
      </div>
    </div>
    <div class="table-scroll kiss-margin" ref="tblContainer" v-show="!loading">
      <table class="kiss-table animated fadeIn">
        <thead>
          <tr>
            <th fixed="left" class="kiss-align-center">
              <div class="kiss-flex kiss-flex-middle">
                <span class="kiss-margin-small-left">Location</span>
              </div>
            </th>
            <th fixed="left" class="kiss-align-center">
              <div class="kiss-flex kiss-flex-middle">
                <span class="kiss-margin-small-left">Change frequency</span>
              </div>
            </th>
            <th fixed="left" class="kiss-align-center">
              <div class="kiss-flex kiss-flex-middle">
                <span class="kiss-margin-small-left">Last modified</span>
              </div>
            </th>
            <th fixed="left" class="kiss-align-center">
              <div class="kiss-flex kiss-flex-middle">
                <span class="kiss-margin-small-left">Priority</span>
              </div>
            </th>
            <th fixed="right" class="kiss-align-center">
              <div class="kiss-flex kiss-flex-middle">
                <span class="kiss-margin-small-left">Edit</span>
              </div>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in sites">
            <td fixed="left" class="kiss-align-center" v-if="item._id !== editItem._id">
              <div class="kiss-flex kiss-flex-middle">
                {{ item.loc }}
              </div>
            </td>
            <td fixed="left" class="kiss-align-center" v-if="item._id !== editItem._id">
              <div class="kiss-flex kiss-flex-middle">
                {{ item.changefreq }}
              </div>
            </td>
            <td fixed="left" class="kiss-align-center" v-if="item._id !== editItem._id">
              <div class="kiss-flex kiss-flex-middle">
                {{ item.lastmod }}
              </div>
            </td>
            <td fixed="left" class="kiss-align-center" v-if="item._id !== editItem._id">
              <div class="kiss-flex kiss-flex-middle">
                {{ item.priority }}
              </div>
            </td>
            <td fixed="right" class="kiss-align-center" v-if="item._id !== editItem._id">
              <div class="kiss-flex kiss-flex-middle">
                <app-button @click="editItemAction(item)" class="kiss-button kiss-button-primary kiss-button-small">
                  <icon class="kiss-margin-small-right">edit</icon>
                </app-button>
              </div>
            </td>
  
            <td fixed="left" class="kiss-align-center" v-if="item._id === editItem._id">
              <div class="kiss-flex kiss-flex-middle">
                <input type="text" v-model="editItem.loc" placeholder="Location"
                  class="kiss-input kiss-input-primary kiss-width-100" />
              </div>
            </td>
            <td fixed="left" class="kiss-align-center" v-if="item._id === editItem._id">
              <div class="kiss-flex kiss-flex-middle">
                <input type="text" v-model="editItem.changefreq" placeholder="Change frequency"
                  class="kiss-input kiss-input-primary kiss-width-100" />
              </div>
            </td>
            <td fixed="left" class="kiss-align-center" v-if="item._id === editItem._id">
              <div class="kiss-flex kiss-flex-middle">
                <input type="text" v-model="editItem.lastmod" placeholder="Last Modified"
                  class="kiss-input kiss-input-primary kiss-width-100" />
              </div>
            </td>
            <td fixed="left" class="kiss-align-center" v-if="item._id === editItem._id">
              <div class="kiss-flex kiss-flex-middle">
                <input type="text" v-model="editItem.priority" placeholder="Priority"
                  class="kiss-input kiss-input-primary kiss-width-100" />
              </div>
            </td>
            <td fixed="left" class="kiss-align-center" v-if="item._id === editItem._id">
              <app-button @click="saveEditItem()" class="kiss-button kiss-button-primary kiss-button-small">
                <icon class="kiss-margin-small-right">save</icon>
              </app-button>
              <app-button @click="deleteItem()" class="kiss-button kiss-button-danger kiss-button-small">
                <icon class="kiss-margin-small-right">delete</icon>
              </app-button>
            </td>
          </tr>
          <tr>
            <td fixed="left" class="kiss-align-center">
              <div class="kiss-flex kiss-flex-middle">
                <input type="text" v-model="newSite.loc" placeholder="Location"
                  class="kiss-input kiss-input-primary kiss-width-100" />
              </div>
            </td>
            <td fixed="left" class="kiss-align-center">
              <div class="kiss-flex kiss-flex-middle">
                <input type="text" v-model="newSite.changefreq" placeholder="Change frequency"
                  class="kiss-input kiss-input-primary kiss-width-100" />
              </div>
            </td>
            <td fixed="left" class="kiss-align-center">
              <div class="kiss-flex kiss-flex-middle">
                <input type="text" v-model="newSite.lastmod" placeholder="Last Modified"
                  class="kiss-input kiss-input-primary kiss-width-100" />
              </div>
            </td>
            <td fixed="left" class="kiss-align-center">
              <div class="kiss-flex kiss-flex-middle">
                <input type="text" v-model="newSite.priority" placeholder="Priority"
                  class="kiss-input kiss-input-primary kiss-width-100" />
              </div>
            </td>
            <td fixed="left" class="kiss-align-center">
              <app-button @click="saveNewItem()" class="kiss-button kiss-button-primary kiss-button-small">
                <icon class="kiss-margin-small-right">save</icon>
              </app-button>
            </td>
          </tr>
        </tbody>
      </table>
  
      <div class="kiss-text-center">
        <p v-for="item in dynamicSites" class="kiss-text-center">
          {{ item.modelname }}
        </p>
      </div>
    </div>
  
  </div>
  `,
};
