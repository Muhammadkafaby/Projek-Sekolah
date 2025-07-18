<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card';

const props = defineProps({
  document: {
    type: Object,
    required: true,
  },
});

const form = useForm({
  title: props.document.title,
  file: null,
});

const submit = () => {
  form.post(route('admin.documents.update', props.document.id));
};
</script>

<template>
  <Head title="Edit Dokumen" />

  <AdminLayout>
    <div>
      <div class="mb-6">
        <h1 class="text-3xl font-bold">Edit Dokumen</h1>
        <p class="text-muted-foreground">Perbarui formulir di bawah ini untuk mengedit dokumen.</p>
      </div>

      <Card>
        <CardHeader>
          <CardTitle>Formulir Edit Dokumen</CardTitle>
        </CardHeader>
        <CardContent>
          <form @submit.prevent="submit">
            <div class="space-y-4">
              <div>
                <Label for="title">Judul</Label>
                <Input id="title" v-model="form.title" required />
              </div>
              <div>
                <Label for="file">File (Kosongkan jika tidak ingin diubah)</Label>
                <Input id="file" type="file" @input="form.file = $event.target.files[0]" />
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
