<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card';
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/Components/ui/select';

const props = defineProps({
  teachers: {
    type: Array,
    required: true,
  },
});

const form = useForm({
  name: '',
  teacher_id: '',
  year: '',
});

const submit = () => {
  form.post(route('admin.classes.store'));
};
</script>

<template>
  <Head title="Tambah Kelas" />

  <AdminLayout>
    <div>
      <div class="mb-6">
        <h1 class="text-3xl font-bold">Tambah Kelas Baru</h1>
        <p class="text-muted-foreground">Isi formulir di bawah ini untuk menambahkan kelas baru.</p>
      </div>

      <Card>
        <CardHeader>
          <CardTitle>Formulir Kelas</CardTitle>
        </CardHeader>
        <CardContent>
          <form @submit.prevent="submit">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <Label for="name">Nama Kelas</Label>
                <Input id="name" v-model="form.name" required />
              </div>
              <div>
                <Label for="teacher_id">Wali Kelas</Label>
                <Select v-model="form.teacher_id" required>
                  <SelectTrigger>
                    <SelectValue placeholder="Pilih wali kelas" />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectItem v-for="teacher in teachers" :key="teacher.id" :value="teacher.id">
                      {{ teacher.name }}
                    </SelectItem>
                  </SelectContent>
                </Select>
              </div>
              <div>
                <Label for="year">Tahun Ajaran</Label>
                <Input id="year" v-model="form.year" required />
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
