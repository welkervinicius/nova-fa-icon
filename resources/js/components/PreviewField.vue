<template>
  <div>
    <i v-if="field.value" :class="field.value" class="fa fa-fw"></i>
    <span v-else>&mdash;</span>
  </div>
</template>

<script>
export default {
  props: ['field'],
}
</script>
