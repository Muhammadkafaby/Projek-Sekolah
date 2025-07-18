<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
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
import { RadioGroup, RadioGroupItem } from '@/Components/ui/radio-group';
import { ref, watch, computed } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
  classes: {
    type: Array,
    required: true,
  },
  students: {
    type: Array,
    required: true,
  },
});

const selectedClass = ref(null);
const studentsInClass = computed(() => {
    if (!selectedClass.value) return [];
    return props.students.filter(student => student.class_id === selectedClass.value);
});

const form = useForm({
  date: new Date().toISOString().slice(0, 10),
  attendances: {},
});

watch(studentsInClass, (newStudents) => {
    const newAttendances = {};
    newStudents.forEach(student => {
        newAttendances[student.id] = 'Hadir';
    });
    form.attendances = newAttendances;
});

const submit = () => {
  router.post(route('admin.attendances.store'), {
    date: form.date,
    class_id: selectedClass.value,
    attendances: form.attendances,
  });
};
</script>

<template>
  <Head title="Input Absensi" />

  <AdminLayout>
    <div>
      <div class="mb-6">
        <h1 class="text-3xl font-bold">Input Absensi Siswa</h1>
        <p class="text-muted-foreground">Pilih tanggal dan kelas untuk memulai input absensi.</p>
      </div>

      <Card>
        <CardHeader>
          <CardTitle>Formulir Absensi</CardTitle>
        </CardHeader>
        <CardContent>
          <form @submit.prevent="submit">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
              <div>
                <Label for="date">Tanggal</Label>
                <Input id="date" type="date" v-model="form.date" required />
              </div>
              <div>
                <Label for="class_id">Kelas</Label>
                <Select v-model="selectedClass" required>
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
            </div>

            <div v-if="studentsInClass.length > 0">
              <div v-for="student in studentsInClass" :key="student.id" class="flex items-center justify-between py-3 border-b">
                <p>{{ student.name }}</p>
                <RadioGroup v-model="form.attendances[student.id]" class="flex space-x-4">
                  <div class="flex items-center space-x-2">
                    <RadioGroupItem :id="`hadir-${student.id}`" value="Hadir" />
                    <Label :for="`hadir-${student.id}`">Hadir</Label>
                  </div>
                  <div class="flex items-center space-x-2">
                    <RadioGroupItem :id="`izin-${student.id}`" value="Izin" />
                    <Label :for="`izin-${student.id}`">Izin</Label>
                  </div>
                  <div class="flex items-center space-x-2">
                    <RadioGroupItem :id="`sakit-${student.id}`" value="Sakit" />
                    <Label :for="`sakit-${student.id}`">Sakit</Label>
                  </div>
                  <div class="flex items-center space-x-2">
                    <RadioGroupItem :id="`alpa-${student.id}`" value="Alpa" />
                    <Label :for="`alpa-${student.id}`">Alpa</Label>
                  </div>
                </RadioGroup>
              </div>
            </div>

            <div class="flex justify-end mt-6">
              <Button type="submit" :disabled="form.processing || studentsInClass.length === 0">Simpan Absensi</Button>
            </div>
          </form>
        </CardContent>
      </Card>
    </div>
  </AdminLayout>
</template>
