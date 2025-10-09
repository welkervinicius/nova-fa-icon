<template>
  <DefaultField
    :field="field"
    :errors="errors"
    :show-help-text="showHelpText"
    :full-width-content="fullWidthContent"
  >
    <template #field>
      <div class="flex items-center border border-gray-300 dark:border-gray-700 rounded-lg w-full focus-within:border-primary-500">
        <div class="px-3 bg-gray-50 dark:bg-gray-800 self-stretch flex items-center border-r border-gray-200 dark:border-gray-700 rounded-l-lg">
          <i :class="value" v-if="value" class="fa fa-fw"></i>
          <i class="fas fa-image fa-fw text-gray-400" v-else></i>
        </div>
        <input
          :id="field.attribute"
          type="text"
          class="flex-1 w-full form-control form-input border-none focus:ring-0"
          :class="errorClasses"
          :placeholder="field.name"
          v-model="value"
        />
        <button
          @click.prevent="openModal"
          type="button"
          class="px-3 h-9 flex-shrink-0 bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 border-l border-gray-200 dark:border-gray-700 rounded-r-lg"
          :title="__('Click to choose an icon')"
        >
          {{ field.translations.choose }}
        </button>
      </div>

      <div v-if="isModalOpen" class="modal-container">
        <div class="modal-content bg-white dark:bg-gray-800">
          <div class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-xl font-bold text-gray-400 dark:text-gray-500">{{ field.translations.icon_list }}</h2>
            <button @click="isModalOpen = false" class="text-2xl text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">&times;</button>
          </div>

          <div class="p-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
            <input type="text" v-model="searchQuery" :placeholder="field.translations.search" class="w-full form-control form-input form-input-bordered" />
          </div>

          <div class="icon-grid p-4" ref="iconGrid" @scroll="handleScroll">
            <div
              v-for="(iconClass, iconName) in icons"
              :key="iconName"
              class="icon-item text-gray-600 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700"
              @click="selectIcon(iconClass)"
            >
              <i :class="iconClass" class="fa-2x"></i>
              <span class="text-gray-400 dark:text-gray-500">{{ iconName }}</span>
            </div>
            <div v-if="isLoading" class="text-center col-span-full text-gray-500 dark:text-gray-400 py-4">
              {{ field.translations.loading }}
            </div>
          </div>
        </div>
      </div>
    </template>
  </DefaultField>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova';
import debounce from 'lodash/debounce';

export default {
  mixins: [FormField, HandlesValidationErrors],
  props: ['resourceName', 'resourceId', 'field'],
  data: () => ({
    isModalOpen: false,
    isLoading: false,
    searchQuery: '',
    icons: {},
    currentPage: 0,
    hasMorePages: true,
  }),
  watch: {
    searchQuery: debounce(function() {
      this.resetAndFetch();
    }, 300),
  },
  methods: {
    setInitialValue() { this.value = this.field.value || ''; },
    fill(formData) { formData.append(this.field.attribute, this.value || ''); },
    openModal() {
      this.isModalOpen = true;
      if (Object.keys(this.icons).length === 0) {
        this.fetchIcons();
      }
    },
    selectIcon(iconClass) {
      this.value = iconClass;
      this.isModalOpen = false;
    },
    resetAndFetch() {
      this.icons = {};
      this.currentPage = 0;
      this.hasMorePages = true;
      this.fetchIcons();
    },
    fetchIcons() {
      if (this.isLoading || !this.hasMorePages) return;
      this.isLoading = true;
      Nova.request()
        .get('/nova-vendor/nova-fa-icon/icons', {
          params: {
            search: this.searchQuery,
            page: this.currentPage,
            styles: this.field.fa_styles || null,
          }
        })
        .then(response => {
          this.icons = { ...this.icons, ...response.data.icons };
          this.hasMorePages = response.data.has_more_pages;
          this.currentPage++;
          this.isLoading = false;
        })
        .catch(error => {
          Nova.error('Error fetching icons list. Please publish the assets and try again with your own fontawesome files.');
          this.isLoading = false;
        });
    },
    handleScroll() {
      const grid = this.$refs.iconGrid;
      if (grid && grid.scrollTop + grid.clientHeight >= grid.scrollHeight - 50) {
        this.fetchIcons();
      }
    },
  },
};
</script>

<style scoped>
/* Estilos essenciais para a estrutura do modal e da grade */
.modal-container {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 50; /* Z-index padrão do Nova para modais */
}
.modal-content {
  border-radius: 0.5rem;
  width: 80%;
  max-width: 900px;
  max-height: 80vh;
  display: flex;
  flex-direction: column;
  overflow: hidden; /* Evita que o conteúdo vaze */
}
.icon-grid {
  overflow-y: auto; /* Permite o scroll apenas na grade */
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
  gap: 1rem;
}
.col-span-full {
  grid-column: 1 / -1;
}
.icon-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  cursor: pointer;
  padding: 10px;
  border-radius: 4px;
  transition: background 0.2s;
}
.icon-item span {
  margin-top: 8px;
  font-size: 12px;
  text-align: center;
  word-break: break-all;
}
</style>
