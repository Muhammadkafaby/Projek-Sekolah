<script setup>
import { computed } from 'vue'
import { SelectLabel } from 'radix-vue'
import { cn } from '@/lib/utils'

const props = defineProps({
  for: { type: String, required: false },
  asChild: { type: Boolean, required: false },
  as: { type: null, required: false },
  class: { type: String, required: false, default: '' },
})

const delegatedProps = computed(() => {
  const { class: _, ...delegated } = props
  return delegated
})
</script>

<template>
  <SelectLabel :class="cn('py-1.5 pl-8 pr-2 text-sm font-semibold', props.class)" v-bind="delegatedProps">
    <slot />
  </SelectLabel>
</template>
