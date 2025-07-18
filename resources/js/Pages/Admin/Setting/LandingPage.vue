<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';
import { Textarea } from '@/Components/ui/textarea';
import { Card, CardContent, CardHeader, CardTitle, CardDescription } from '@/Components/ui/card';

const props = defineProps({
  settings: Object,
});

const form = useForm({
  hero_title: props.settings?.hero_title || '',
  hero_subtitle: props.settings?.hero_subtitle || '',
  hero_image: null,
  features: JSON.stringify(JSON.parse(props.settings?.features || '[]'), null, 2),
  about_us_image: null,
  statistics: JSON.stringify(JSON.parse(props.settings?.statistics || '[]'), null, 2),
  gallery_images: [],
});

const submit = () => {
  form.post(route('admin.settings.landing.update'), {
    preserveScroll: true,
    onSuccess: () => {
      // handle success
    },
  });
};
</script>

<template>
  <Head title="Pengaturan Halaman Landing" />

  <AdminLayout>
    <div class="max-w-4xl mx-auto py-10">
      <h1 class="text-3xl font-bold mb-6">Pengaturan Halaman Landing</h1>

      <form @submit.prevent="submit">
        <div class="space-y-8">
          <!-- Hero Section -->
          <Card>
            <CardHeader>
              <CardTitle>Hero Section</CardTitle>
              <CardDescription>Atur konten utama yang tampil di bagian atas halaman.</CardDescription>
            </CardHeader>
            <CardContent class="space-y-4">
              <div>
                <Label for="hero_title">Judul Utama</Label>
                <Input id="hero_title" v-model="form.hero_title" />
              </div>
              <div>
                <Label for="hero_subtitle">Subjudul</Label>
                <Textarea id="hero_subtitle" v-model="form.hero_subtitle" />
              </div>
              <div>
                <Label for="hero_image">Gambar Latar</Label>
                <Input id="hero_image" type="file" @input="form.hero_image = $event.target.files[0]" />
              </div>
            </CardContent>
          </Card>

          <!-- Features Section -->
          <Card>
            <CardHeader>
              <CardTitle>Fitur Unggulan</CardTitle>
              <CardDescription>Masukkan dalam format JSON. Setiap fitur harus memiliki "icon", "title", dan "description".</CardDescription>
            </CardHeader>
            <CardContent>
              <Textarea v-model="form.features" rows="10" />
            </CardContent>
          </Card>
          
          <!-- About Us Section -->
          <Card>
            <CardHeader>
              <CardTitle>Tentang Kami</CardTitle>
            </CardHeader>
            <CardContent>
                <Label for="about_us_image">Gambar "Tentang Kami"</Label>
                <Input id="about_us_image" type="file" @input="form.about_us_image = $event.target.files[0]" />
            </CardContent>
          </Card>

          <!-- Statistics Section -->
          <Card>
            <CardHeader>
              <CardTitle>Statistik</CardTitle>
              <CardDescription>Masukkan dalam format JSON. Setiap statistik harus memiliki "icon", "value", dan "label".</CardDescription>
            </CardHeader>
            <CardContent>
              <Textarea v-model="form.statistics" rows="10" />
            </CardContent>
          </Card>

          <!-- Gallery Section -->
          <Card>
            <CardHeader>
              <CardTitle>Galeri</CardTitle>
            </CardHeader>
            <CardContent>
                <Label for="gallery_images">Gambar Galeri (bisa pilih banyak)</Label>
                <Input id="gallery_images" type="file" multiple @input="form.gallery_images = $event.target.files" />
            </CardContent>
          </Card>

          <div class="flex justify-end">
            <Button type="submit" :disabled="form.processing">Simpan Pengaturan</Button>
          </div>
        </div>
      </form>
    </div>
  </AdminLayout>
</template>