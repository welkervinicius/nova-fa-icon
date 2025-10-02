<template>
  <PanelItem :index="index" :field="field">
    <template #value>
      <div v-if="field.value" class="flex items-center">
        <i :class="field.value" class="fa fa-fw mr-2 text-xl"></i>
        <code>{{ field.value }}</code>
      </div>
      <span v-else>&mdash;</span>
    </template>
  </PanelItem>
</template>

<script>
export default {
  props: ['index', 'resource', 'resourceName', 'resourceId', 'field'],
}
</script>
