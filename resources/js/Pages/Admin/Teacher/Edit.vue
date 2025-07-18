<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card';

const props = defineProps({
  teacher: {
    type: Object,
    required: true,
  },
});

const form = useForm({
  nip: props.teacher.nip,
  name: props.teacher.name,
  position: props.teacher.position,
  subject: props.teacher.subject,
});

const submit = () => {
  form.put(route('admin.teachers.update', props.teacher.id));
};
</script>

<template>
  <Head title="Edit Guru" />

  <AdminLayout>
    <div>
      <div class="mb-6">
        <h1 class="text-3xl font-bold">Edit Data Guru</h1>
        <p class="text-muted-foreground">Perbarui formulir di bawah ini untuk mengedit data guru.</p>
      </div>

      <Card>
        <CardHeader>
          <CardTitle>Formulir Edit Guru</CardTitle>
        </CardHeader>
        <CardContent>
          <form @submit.prevent="submit">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <Label for="nip">NIP</Label>
                <Input id="nip" v-model="form.nip" required />
              </div>
              <div>
                <Label for="name">Nama Lengkap</Label>
                <Input id="name" v-model="form.name" required />
              </div>
              <div>
                <Label for="position">Jabatan</Label>
                <Input id="position" v-model="form.position" required />
              </div>
              <div>
                <Label for="subject">Mata Pelajaran</Label>
                <Input id="subject" v-model="form.subject" required />
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
