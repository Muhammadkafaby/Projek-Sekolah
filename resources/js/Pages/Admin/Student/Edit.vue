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
  student: {
    type: Object,
    required: true,
  },
  classes: {
    type: Array,
    required: true,
  },
});

const form = useForm({
  nis: props.student.nis,
  name: props.student.name,
  gender: props.student.gender,
  date_of_birth: props.student.date_of_birth,
  class_id: props.student.class_id,
  photo: null,
  address: props.student.address,
  parent_name: props.student.parent_name,
  parent_phone: props.student.parent_phone,
});

const submit = () => {
  form.put(route('admin.students.update', props.student.id));
};
</script>

<template>
  <Head title="Edit Siswa" />

  <AdminLayout>
    <div>
      <div class="mb-6">
        <h1 class="text-3xl font-bold">Edit Data Siswa</h1>
        <p class="text-muted-foreground">Perbarui formulir di bawah ini untuk mengedit data siswa.</p>
      </div>

      <Card>
        <CardHeader>
          <CardTitle>Formulir Edit Siswa</CardTitle>
        </CardHeader>
        <CardContent>
          <form @submit.prevent="submit">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <Label for="nis">NIS</Label>
                <Input id="nis" v-model="form.nis" required />
              </div>
              <div>
                <Label for="name">Nama Lengkap</Label>
                <Input id="name" v-model="form.name" required />
              </div>
              <div>
                <Label for="gender">Jenis Kelamin</Label>
                <Select v-model="form.gender" required>
                  <SelectTrigger>
                    <SelectValue placeholder="Pilih jenis kelamin" />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectItem value="Laki-laki">Laki-laki</SelectItem>
                    <SelectItem value="Perempuan">Perempuan</SelectItem>
                  </SelectContent>
                </Select>
              </div>
              <div>
                <Label for="date_of_birth">Tanggal Lahir</Label>
                <Input id="date_of_birth" type="date" v-model="form.date_of_birth" required />
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
                <Label for="photo">Foto</Label>
                <Input id="photo" type="file" @input="form.photo = $event.target.files[0]" />
              </div>
              <div class="md:col-span-2">
                <Label for="address">Alamat</Label>
                <Input id="address" v-model="form.address" />
              </div>
              <div>
                <Label for="parent_name">Nama Orang Tua</Label>
                <Input id="parent_name" v-model="form.parent_name" />
              </div>
              <div>
                <Label for="parent_phone">Telepon Orang Tua</Label>
                <Input id="parent_phone" v-model="form.parent_phone" />
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
