<script setup>
import { Link } from '@inertiajs/vue3';
import { Button } from '@/Components/ui/button';
import { ChevronLeft, ChevronRight } from 'lucide-vue-next';

defineProps({
  links: {
    type: Array,
    required: true,
  },
});
</script>

<template>
  <nav v-if="links.length > 3" class="flex items-center space-x-2">
    <template v-for="(link, index) in links" :key="index">
      <Button
        v-if="index === 0"
        :as="link.url ? 'a' : 'button'"
        :href="link.url"
        :disabled="!link.url"
        variant="outline"
        size="icon"
        class="w-10 h-10"
      >
        <ChevronLeft class="h-4 w-4" />
      </Button>
      
      <Button
        v-else-if="index === links.length - 1"
        :as="link.url ? 'a' : 'button'"
        :href="link.url"
        :disabled="!link.url"
        variant="outline"
        size="icon"
        class="w-10 h-10"
      >
        <ChevronRight class="h-4 w-4" />
      </Button>

      <Button
        v-else
        :as="link.url ? 'a' : 'button'"
        :href="link.url"
        :disabled="!link.url || link.active"
        :class="{ 'bg-primary text-primary-foreground': link.active }"
        variant="outline"
        size="icon"
        class="w-10 h-10"
      >
        {{ link.label }}
      </Button>
    </template>
  </nav>
</template>
