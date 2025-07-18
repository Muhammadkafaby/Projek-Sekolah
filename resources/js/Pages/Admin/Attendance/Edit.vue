<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Button } from '@/Components/ui/button';
import { Label } from '@/Components/ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card';
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/Components/ui/select';
import { Input } from '@/Components/ui/input';

const props = defineProps({
  attendance: {
    type: Object,
    required: true,
  },
  classes: {
    type: Array,
    required: true,
  },
  students: {
    type: Array,
    required: true,
  },
});

const form = useForm({
  date: props.attendance.date,
  class_id: props.attendance.class_id,
  student_id: props.attendance.student_id,
  status: props.attendance.status,
});

const submit = () => {
  form.put(route('admin.attendances.update', props.attendance.id));
};
</script>

<template>
  <Head title="Edit Absensi" />

  <AdminLayout>
    <div>
      <div class="mb-6">
        <h1 class="text-3xl font-bold">Edit Absensi Siswa</h1>
        <p class="text-muted-foreground">Perbarui formulir di bawah ini untuk mengedit absensi.</p>
      </div>

      <Card>
        <CardHeader>
          <CardTitle>Formulir Edit Absensi</CardTitle>
        </CardHeader>
        <CardContent>
          <form @submit.prevent="submit">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <Label for="date">Tanggal</Label>
                <Input id="date" type="date" v-model="form.date" required />
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
                <Label for="student_id">Siswa</Label>
                <Select v-model="form.student_id" required>
                  <SelectTrigger>
                    <SelectValue placeholder="Pilih siswa" />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectItem v-for="student in students" :key="student.id" :value="student.id">
                      {{ student.name }}
                    </SelectItem>
                  </SelectContent>
                </Select>
              </div>
              <div>
                <Label for="status">Status</Label>
                <Select v-model="form.status" required>
                  <SelectTrigger>
                    <SelectValue placeholder="Pilih status" />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectItem value="Hadir">Hadir</SelectItem>
                    <SelectItem value="Izin">Izin</SelectItem>
                    <SelectItem value="Sakit">Sakit</SelectItem>
                    <SelectItem value="Alpa">Alpa</SelectItem>
                  </SelectContent>
                </Select>
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
