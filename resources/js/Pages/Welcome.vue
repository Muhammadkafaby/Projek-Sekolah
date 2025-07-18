<script setup>
import { Head } from '@inertiajs/vue3';
import LandingLayout from '@/Layouts/LandingLayout.vue';
import { Button } from '@/Components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card';
import { Carousel, CarouselContent, CarouselItem, CarouselNext, CarouselPrevious } from '@/Components/ui/carousel';
import { ArrowRight, CheckCircle } from 'lucide-vue-next';
import { computed } from 'vue';

const props = defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  settings: Object,
  announcements: Array,
});

// Parse settings from JSON, with fallbacks for safety
const heroTitle = computed(() => props.settings?.hero_title || 'Membentuk Generasi Unggul');
const heroSubtitle = computed(() => props.settings?.hero_subtitle || 'Menjadi sekolah unggul yang menghasilkan lulusan berkarakter, cerdas, dan kompetitif.');
const heroImage = computed(() => props.settings?.hero_image ? `/storage/${props.settings.hero_image}` : 'https://source.unsplash.com/random/1920x1080/?school,modern');
const aboutImage = computed(() => props.settings?.about_us_image ? `/storage/${props.settings.about_us_image}` : 'https://source.unsplash.com/random/600x400/?school,students');

const features = computed(() => {
  try {
    return JSON.parse(props.settings?.features || '[]');
  } catch (e) {
    return [
        { title: 'Kurikulum Modern', description: 'Kurikulum yang relevan dengan perkembangan zaman.' },
        { title: 'Fasilitas Lengkap', description: 'Laboratorium, perpustakaan, dan sarana olahraga.' },
        { title: 'Lingkungan Inspiratif', description: 'Mendukung siswa untuk berkembang secara akademis.' },
    ];
  }
});

const statistics = computed(() => {
  try {
    return JSON.parse(props.settings?.statistics || '[]');
  } catch (e) {
    return [
        { value: '500+', label: 'Siswa Berprestasi' },
        { value: '50+', label: 'Guru Profesional' },
        { value: '20+', label: 'Ruang Kelas Modern' },
    ];
  }
});

const galleryImages = computed(() => {
    try {
        const images = JSON.parse(props.settings?.gallery_images || '[]');
        return images.map(img => `/storage/${img}`);
    } catch(e) {
        return [
            'https://source.unsplash.com/random/1200x800/?school,building',
            'https://source.unsplash.com/random/1200x800/?students,learning',
            'https://source.unsplash.com/random/1200x800/?library,books',
        ];
    }
});

</script>

<template>
  <Head title="Selamat Datang" />
  <LandingLayout>
    <!-- Hero Section -->
    <section class="relative bg-cover bg-center min-h-screen flex items-center" :style="{ backgroundImage: `url(${heroImage})` }">
      <div class="absolute inset-0 bg-gradient-to-t from-background via-background/80 to-transparent"></div>
      <div class="absolute inset-0 bg-black/30"></div>
      <div class="relative container mx-auto px-6 text-center text-white">
        <div class="max-w-4xl mx-auto">
          <h1 class="text-4xl md:text-7xl font-extrabold mb-4 !leading-tight tracking-tight">
            {{ heroTitle }} di <span class="text-primary">{{ settings.school_name }}</span>
          </h1>
          <p class="text-lg md:text-xl mb-8 text-gray-200 max-w-2xl mx-auto">{{ heroSubtitle }}</p>
          <Button size="lg" class="rounded-full px-8 py-6 text-lg group hover:scale-105 transition-transform duration-300">
            Pendaftaran Siswa Baru <ArrowRight class="ml-2 h-5 w-5 transform group-hover:translate-x-1 transition-transform" />
          </Button>
        </div>
      </div>
    </section>

    <!-- Main Content -->
    <main class="bg-background">
      <!-- Features Section -->
      <section id="features" class="py-24">
        <div class="container mx-auto px-6">
          <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold">Kenapa Memilih Kami?</h2>
            <p class="text-lg text-muted-foreground mt-4 max-w-2xl mx-auto">Keunggulan yang kami tawarkan untuk membentuk masa depan cerah putra-putri Anda.</p>
          </div>
          <div class="grid md:grid-cols-3 gap-8">
            <div v-for="(feature, index) in features" :key="index" class="text-center p-8">
              <div class="mx-auto bg-primary/10 text-primary rounded-full h-20 w-20 flex items-center justify-center mb-6 ring-8 ring-primary/5">
                 <CheckCircle class="h-10 w-10" />
              </div>
              <h3 class="text-2xl font-semibold">{{ feature.title }}</h3>
              <p class="text-muted-foreground mt-2">{{ feature.description }}</p>
            </div>
          </div>
        </div>
      </section>

      <!-- About Section -->
      <section id="about" class="py-24 bg-card border-y">
        <div class="container mx-auto px-6">
          <div class="grid md:grid-cols-2 gap-16 items-center">
            <div>
              <img :src="aboutImage" alt="Tentang Kami" class="rounded-2xl shadow-2xl w-full h-full object-cover">
            </div>
            <div>
              <div class="prose prose-lg dark:prose-invert max-w-none">
                <h2 class="text-4xl font-bold mb-4">Tentang {{ settings.school_name }}</h2>
                <div v-html="settings.school_mission"></div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Statistics Section -->
      <section id="stats" class="py-24">
        <div class="container mx-auto px-6">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div v-for="(stat, index) in statistics" :key="index" class="p-8">
                <h3 class="text-6xl font-bold text-primary">{{ stat.value }}</h3>
                <p class="text-xl text-muted-foreground mt-2">{{ stat.label }}</p>
            </div>
          </div>
        </div>
      </section>

      <!-- Announcements Section -->
      <section id="announcements" class="py-24 bg-card border-y">
        <div class="container mx-auto px-6">
          <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold">Pengumuman & Berita</h2>
            <p class="text-lg text-muted-foreground mt-4 max-w-2xl mx-auto">Ikuti terus informasi dan kegiatan terbaru dari lingkungan sekolah kami.</p>
          </div>
          <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <Card v-for="announcement in announcements" :key="announcement.id" class="overflow-hidden group transform hover:-translate-y-2 hover:shadow-2xl transition-all duration-300 flex flex-col">
              <div class="overflow-hidden">
                <img :src="announcement.image || 'https://source.unsplash.com/random/400x250/?news'" alt="Announcement Image" class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-500">
              </div>
              <div class="p-6 flex flex-col flex-grow">
                <CardHeader class="p-0">
                  <CardTitle class="text-xl font-semibold mb-2">{{ announcement.title }}</CardTitle>
                </CardHeader>
                <CardContent class="p-0 flex-grow">
                  <p class="text-muted-foreground line-clamp-3">{{ announcement.content }}</p>
                </CardContent>
                <div class="mt-4 pt-4 border-t">
                    <Button variant="link" class="p-0 text-primary">
                        Baca Selengkapnya <ArrowRight class="ml-2 h-4 w-4" />
                    </Button>
                </div>
              </div>
            </Card>
          </div>
        </div>
      </section>

      <!-- Gallery Section -->
      <section id="gallery" class="py-24">
        <div class="container mx-auto px-6">
          <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold">Galeri Sekolah</h2>
            <p class="text-lg text-muted-foreground mt-4 max-w-2xl mx-auto">Momen-momen berharga yang terekam di lingkungan sekolah kami.</p>
          </div>
          <Carousel :opts="{ loop: true, align: 'start' }" class="relative">
            <CarouselContent class="-ml-4">
              <CarouselItem v-for="(image, index) in galleryImages" :key="index" class="pl-4 md:basis-1/2 lg:basis-1/3">
                <div class="overflow-hidden rounded-2xl shadow-lg group aspect-w-4 aspect-h-3">
                  <img :src="image" alt="Gallery Image" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
              </CarouselItem>
            </CarouselContent>
            <CarouselPrevious class="absolute left-4 top-1/2 -translate-y-1/2" />
            <CarouselNext class="absolute right-4 top-1/2 -translate-y-1/2" />
          </Carousel>
        </div>
      </section>

      <!-- CTA Section -->
      <section id="cta" class="py-24 bg-primary text-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl md:text-5xl font-bold mb-4">Siap Bergabung Bersama Kami?</h2>
            <p class="text-lg text-primary-foreground/80 mb-8 max-w-3xl mx-auto">Mulailah perjalanan pendidikan ananda di lingkungan yang suportif dan inovatif. Daftar sekarang dan jadilah bagian dari keluarga besar {{ settings.school_name }}.</p>
            <Button size="lg" variant="secondary" class="rounded-full px-8 py-6 text-lg group hover:scale-105 transition-transform duration-300">
                Daftar Sekarang <ArrowRight class="ml-2 h-5 w-5 transform group-hover:translate-x-1 transition-transform" />
            </Button>
        </div>
      </section>
    </main>
  </LandingLayout>
</template>
