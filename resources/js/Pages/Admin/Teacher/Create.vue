<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card';

const form = useForm({
  nip: '',
  name: '',
  position: '',
  subject: '',
});

const submit = () => {
  form.post(route('admin.teachers.store'));
};
</script>

<template>
  <Head title="Tambah Guru" />

  <AdminLayout>
    <div>
      <div class="mb-6">
        <h1 class="text-3xl font-bold">Tambah Guru Baru</h1>
        <p class="text-muted-foreground">Isi formulir di bawah ini untuk menambahkan guru baru.</p>
      </div>

      <Card>
        <CardHeader>
          <CardTitle>Formulir Guru</CardTitle>
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
              <Button type="submit" :disabled="form.processing">Simpan</Button>
            </div>
          </form>
        </CardContent>
      </Card>
    </div>
  </AdminLayout>
</template>
