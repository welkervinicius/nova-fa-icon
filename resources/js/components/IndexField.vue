<template>
  <div class="text-center">
    <i v-if="field.value" :class="field.value" class="fa fa-fw text-xl"></i>
    <span v-else>&mdash;</span>
  </div>
</template>

<script>
export default {
  props: ['resourceName', 'field'],
}
</script>
