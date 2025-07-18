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
  classes: {
    type: Array,
    required: true,
  },
  teachers: {
    type: Array,
    required: true,
  },
});

const form = useForm({
  day: '',
  start_time: '',
  end_time: '',
  subject: '',
  class_id: '',
  teacher_id: '',
});

const submit = () => {
  form.post(route('admin.schedules.store'));
};
</script>

<template>
  <Head title="Tambah Jadwal" />

  <AdminLayout>
    <div>
      <div class="mb-6">
        <h1 class="text-3xl font-bold">Tambah Jadwal Baru</h1>
        <p class="text-muted-foreground">Isi formulir di bawah ini untuk menambahkan jadwal baru.</p>
      </div>

      <Card>
        <CardHeader>
          <CardTitle>Formulir Jadwal</CardTitle>
        </CardHeader>
        <CardContent>
          <form @submit.prevent="submit">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <Label for="day">Hari</Label>
                <Select v-model="form.day" required>
                  <SelectTrigger>
                    <SelectValue placeholder="Pilih hari" />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectItem value="Senin">Senin</SelectItem>
                    <SelectItem value="Selasa">Selasa</SelectItem>
                    <SelectItem value="Rabu">Rabu</SelectItem>
                    <SelectItem value="Kamis">Kamis</SelectItem>
                    <SelectItem value="Jumat">Jumat</SelectItem>
                    <SelectItem value="Sabtu">Sabtu</SelectItem>
                  </SelectContent>
                </Select>
              </div>
              <div>
                <Label for="subject">Mata Pelajaran</Label>
                <Input id="subject" v-model="form.subject" required />
              </div>
              <div>
                <Label for="start_time">Jam Mulai</Label>
                <Input id="start_time" type="time" v-model="form.start_time" required />
              </div>
              <div>
                <Label for="end_time">Jam Selesai</Label>
                <Input id="end_time" type="time" v-model="form.end_time" required />
              </div>
              <div>
                <Label for="class_id">Kelas</Label>
                <Select v-model="form.class_id" required>
                  <SelectTrigger>
                    <SelectValue placeholder="Pilih kelas" />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectItem v-for="classItem in classes" :key="classItem.id" :value="classItem.id">
                      {{ classItem.name }}
                    </SelectItem>
                  </SelectContent>
                </Select>
              </div>
              <div>
                <Label for="teacher_id">Guru</Label>
                <Select v-model="form.teacher_id" required>
                  <SelectTrigger>
                    <SelectValue placeholder="Pilih guru" />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectItem v-for="teacher in teachers" :key="teacher.id" :value="teacher.id">
                      {{ teacher.name }}
                    </SelectItem>
                  </SelectContent>
                </Select>
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
