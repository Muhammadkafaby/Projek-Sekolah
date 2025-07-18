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
  billing: {
    type: Object,
    required: true,
  },
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
  student_id: props.billing.student_id,
  payment_type_id: props.billing.payment_type_id,
  amount: props.billing.amount,
  due_date: props.billing.due_date,
  status: props.billing.status,
});

const submit = () => {
  form.put(route('admin.payments.update', props.billing.id));
};
</script>

<template>
  <Head title="Edit Tagihan" />

  <AdminLayout>
    <div>
      <div class="mb-6">
        <h1 class="text-3xl font-bold">Edit Tagihan</h1>
        <p class="text-muted-foreground">Perbarui formulir di bawah ini untuk mengedit tagihan.</p>
      </div>

      <Card>
        <CardHeader>
          <CardTitle>Formulir Edit Tagihan</CardTitle>
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
              <div>
                <Label for="status">Status</Label>
                <Select v-model="form.status" required>
                  <SelectTrigger>
                    <SelectValue placeholder="Pilih status" />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectItem value="paid">Lunas</SelectItem>
                    <SelectItem value="unpaid">Belum Lunas</SelectItem>
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
