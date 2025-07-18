<script setup>
import { Link } from '@inertiajs/vue3';
import { Menu, X, Facebook, Twitter, Instagram } from 'lucide-vue-next';
import { ref, onMounted, onUnmounted } from 'vue';
import { Button } from '@/Components/ui/button';


const isMenuOpen = ref(false);
const isScrolled = ref(false);

const handleScroll = () => {
  isScrolled.value = window.scrollY > 50;
};

onMounted(() => {
  window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll);
});

const navLinks = [
  { href: '#features', text: 'Keunggulan' },
  { href: '#about', text: 'Tentang Kami' },
  { href: '#announcements', text: 'Pengumuman' },
  { href: '#gallery', text: 'Galeri' },
];

const smoothScroll = (target) => {
    isMenuOpen.value = false;
    document.querySelector(target).scrollIntoView({
        behavior: 'smooth'
    });
};
</script>

<template>
  <div class="text-foreground min-h-screen font-sans">
    <!-- Header -->
    <header 
      class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
      :class="{ 'bg-card/80 backdrop-blur-lg shadow-md': isScrolled, 'bg-transparent': !isScrolled }"
    >
      <div class="container mx-auto px-6 py-4">
        <div class="flex justify-between items-center">
          <Link :href="route('welcome')" class="flex items-center space-x-3">
            <img :src="$page.props.settings.school_logo || 'https://api.iconify.design/ph:student-bold.svg?color=%234f46e5'" alt="School Logo" class="h-10 w-10 rounded-full bg-primary p-1">
            <h1 class="text-2xl font-bold text-foreground">{{ $page.props.settings.school_name }}</h1>
          </Link>
          
          <!-- Desktop Navigation -->
          <nav class="hidden md:flex items-center space-x-6">
            <a v-for="link in navLinks" :key="link.href" :href="link.href" @click.prevent="smoothScroll(link.href)" class="text-gray-600 hover:text-primary transition-colors font-medium">
              {{ link.text }}
            </a>
          </nav>

          <div class="hidden md:flex items-center space-x-4">
            <template v-if="$page.props.auth.user">
              <Button as-child>
                <Link :href="route('dashboard')">Dashboard</Link>
              </Button>
            </template>
            <template v-else>
              <Button as-child variant="ghost">
                <Link :href="route('login')">Log in</Link>
              </Button>
              <Button as-child v-if="$page.props.canRegister">
                <Link :href="route('register')">Register</Link>
              </Button>
            </template>
          </div>

          <!-- Mobile Menu Button -->
          <div class="md:hidden">
            <Button @click="isMenuOpen = !isMenuOpen" variant="ghost" size="icon">
              <Menu v-if="!isMenuOpen" class="h-6 w-6" />
              <X v-else class="h-6 w-6" />
            </Button>
          </div>
        </div>
      </div>

      <!-- Mobile Navigation -->
      <div v-if="isMenuOpen" class="md:hidden bg-card pb-4">
        <nav class="flex flex-col items-center space-y-4">
          <a v-for="link in navLinks" :key="link.href" :href="link.href" @click.prevent="smoothScroll(link.href)" class="text-gray-600 hover:text-primary transition-colors font-medium">
            {{ link.text }}
          </a>
          <div class="flex flex-col items-center space-y-4 pt-4 border-t border-border w-full px-6">
            <template v-if="$page.props.auth.user">
              <Button as-child class="w-full">
                <Link :href="route('dashboard')">Dashboard</Link>
              </Button>
            </template>
            <template v-else>
              <Button as-child variant="ghost" class="w-full">
                <Link :href="route('login')">Log in</Link>
              </Button>
              <Button as-child v-if="$page.props.canRegister" class="w-full">
                <Link :href="route('register')">Register</Link>
              </Button>
            </template>
          </div>
        </nav>
      </div>
    </header>

    <!-- Main Content -->
    <main>
      <slot />
    </main>

    <!-- Footer -->
    <footer class="bg-card border-t border-border/50">
      <div class="container mx-auto px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <!-- About School -->
          <div class="space-y-4">
            <div class="flex items-center space-x-3">
              <img :src="$page.props.settings.school_logo || 'https://api.iconify.design/ph:student-bold.svg?color=%234f46e5'" alt="School Logo" class="h-10 w-10 rounded-full bg-primary p-1">
              <h2 class="text-xl font-bold">{{ $page.props.settings.school_name }}</h2>
            </div>
            <p class="text-gray-600">{{ $page.props.settings.school_vision }}</p>
          </div>
          
          <!-- Quick Links -->
          <div>
            <h3 class="text-lg font-semibold mb-4">Tautan Cepat</h3>
            <ul class="space-y-2">
              <li v-for="link in navLinks" :key="link.href">
                <a :href="link.href" @click.prevent="smoothScroll(link.href)" class="hover:text-primary transition-colors">{{ link.text }}</a>
              </li>
            </ul>
          </div>

          <!-- Contact & Socials -->
          <div>
            <h3 class="text-lg font-semibold mb-4">Hubungi Kami</h3>
            <p class="text-gray-600 mb-4">
              {{ $page.props.settings.school_address || 'Jalan Pendidikan No. 1, Kota Pelajar' }}
            </p>
            <div class="flex space-x-4">
              <a href="#" class="text-gray-500 hover:text-primary"><Facebook class="h-6 w-6" /></a>
              <a href="#" class="text-gray-500 hover:text-primary"><Twitter class="h-6 w-6" /></a>
              <a href="#" class="text-gray-500 hover:text-primary"><Instagram class="h-6 w-6" /></a>
            </div>
          </div>
        </div>
        <div class="mt-12 border-t border-gray-200 pt-8 text-center text-gray-500">
          <p>&copy; {{ new Date().getFullYear() }} {{ $page.props.settings.school_name }}. All rights reserved. Dibuat dengan ❤️</p>
        </div>
      </div>
    </footer>
  </div>
</template>
