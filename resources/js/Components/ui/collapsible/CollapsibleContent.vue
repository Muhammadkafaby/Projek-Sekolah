<script setup>
import { CollapsibleContent } from 'radix-vue'

const props = defineProps({
  asChild: { type: Boolean, required: false },
  as: { type: null, required: false },
})
</script>

<template>
  <CollapsibleContent v-bind="props">
    <slot />
  </CollapsibleContent>
</template>
