<script setup>
import { CollapsibleRoot } from 'radix-vue'

const props = defineProps({
  asChild: { type: Boolean, required: false },
  as: { type: null, required: false },
  defaultOpen: { type: Boolean, required: false },
  open: { type: Boolean, required: false },
  disabled: { type: Boolean, required: false },
})
</script>

<template>
  <CollapsibleRoot v-bind="props">
    <slot />
  </CollapsibleRoot>
</template>
