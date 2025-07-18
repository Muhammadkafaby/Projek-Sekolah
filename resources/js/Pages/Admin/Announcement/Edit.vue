<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';
import { Textarea } from '@/Components/ui/textarea';
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card';

const props = defineProps({
  announcement: {
    type: Object,
    required: true,
  },
});

const form = useForm({
  title: props.announcement.title,
  content: props.announcement.content,
});

const submit = () => {
  form.put(route('admin.announcements.update', props.announcement.id));
};
</script>

<template>
  <Head title="Edit Pengumuman" />

  <AdminLayout>
    <div>
      <div class="mb-6">
        <h1 class="text-3xl font-bold">Edit Pengumuman</h1>
        <p class="text-muted-foreground">Perbarui formulir di bawah ini untuk mengedit pengumuman.</p>
      </div>

      <Card>
        <CardHeader>
          <CardTitle>Formulir Edit Pengumuman</CardTitle>
        </CardHeader>
        <CardContent>
          <form @submit.prevent="submit">
            <div class="space-y-4">
              <div>
                <Label for="title">Judul</Label>
                <Input id="title" v-model="form.title" required />
              </div>
              <div>
                <Label for="content">Isi Pengumuman</Label>
                <Textarea id="content" v-model="form.content" required rows="10" />
              </div>
            </div>
            <div class="flex justify-end mt-6">
              <Button type="submit" :disabled="form.processing">Simpan Perubahan</Button>
            </div>
          </form>
        </CardContent>
      </Card>
    </div>
  </AdminLayout>
</template>
