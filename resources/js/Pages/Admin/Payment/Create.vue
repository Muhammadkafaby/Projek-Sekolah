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
  students: {
    type: Array,
    required: true,
  },
  paymentTypes: {
    type: Array,
    required: true,
  },
});

const form = useForm({
  student_id: '',
  payment_type_id: '',
  amount: '',
  due_date: '',
  status: 'unpaid',
});

const submit = () => {
  form.post(route('admin.payments.store'));
};
</script>

<template>
  <Head title="Tambah Tagihan" />

  <AdminLayout>
    <div>
      <div class="mb-6">
        <h1 class="text-3xl font-bold">Tambah Tagihan Baru</h1>
        <p class="text-muted-foreground">Isi formulir di bawah ini untuk menambahkan tagihan baru.</p>
      </div>

      <Card>
        <CardHeader>
          <CardTitle>Formulir Tagihan</CardTitle>
        </CardHeader>
        <CardContent>
          <form @submit.prevent="submit">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                <Label for="payment_type_id">Jenis Pembayaran</Label>
                <Select v-model="form.payment_type_id" required>
                  <SelectTrigger>
                    <SelectValue placeholder="Pilih jenis pembayaran" />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectItem v-for="paymentType in paymentTypes" :key="paymentType.id" :value="paymentType.id">
                      {{ paymentType.name }}
                    </SelectItem>
                  </SelectContent>
                </Select>
              </div>
              <div>
                <Label for="amount">Jumlah</Label>
                <Input id="amount" type="number" v-model="form.amount" required />
              </div>
              <div>
                <Label for="due_date">Jatuh Tempo</Label>
                <Input id="due_date" type="date" v-model="form.due_date" required />
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
