<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/Components/ui/table';
import { Button } from '@/Components/ui/button';
import { PlusCircle, FileDown, Search, MoreHorizontal, Pencil, Trash2, Eye } from 'lucide-vue-next';
import { Input } from '@/Components/ui/input';
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card';
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger } from '@/Components/ui/dropdown-menu';
import { Badge } from '@/Components/ui/badge';
import { ref, watch } from 'vue';
import debounce from 'lodash/debounce';

const props = defineProps({
  billings: {
    type: Object,
    required: true,
  },
  filters: {
    type: Object,
    default: () => ({}),
  },
});

const search = ref(props.filters.search);

watch(search, debounce((value) => {
  router.get(route('admin.payments.index'), { search: value }, {
    preserveState: true,
    replace: true,
  });
}, 300));

const formatCurrency = (value) => {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(value);
}

const getStatusVariant = (status) => {
    return status === 'paid' ? 'success' : 'destructive';
}

</script>

<template>
  <Head title="Manajemen Pembayaran" />

  <AdminLayout>
    <div>
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-3xl font-bold">Manajemen Pembayaran</h1>
                <p class="text-muted-foreground">Kelola data tagihan dan pembayaran siswa.</p>
            </div>
            <div class="flex space-x-2">
                <Button variant="outline">
                <FileDown class="mr-2 h-4 w-4" />
                Export
                </Button>
                <Button as-child>
                <Link :href="route('admin.billings.create')">
                    <PlusCircle class="mr-2 h-4 w-4" />
                    Tambah Tagihan
                </Link>
                </Button>
            </div>
        </div>

        <Card>
            <CardHeader>
                <div class="flex items-center justify-between">
                    <CardTitle>Daftar Tagihan</CardTitle>
                    <div class="relative w-full max-w-sm">
                        <Input type="text" placeholder="Cari tagihan..." class="pl-10" v-model="search" />
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <Search class="h-5 w-5 text-gray-400" />
                        </div>
                    </div>
                </div>
            </CardHeader>
            <CardContent>
                <div class="overflow-x-auto">
                    <Table>
                    <TableHeader>
                        <TableRow>
                        <TableHead>Siswa</TableHead>
                        <TableHead>Jenis Tagihan</TableHead>
                        <TableHead>Jumlah</TableHead>
                        <TableHead>Jatuh Tempo</TableHead>
                        <TableHead>Status</TableHead>
                        <TableHead class="text-right">Aksi</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="billing in billings.data" :key="billing.id">
                        <TableCell>
                            <div class="flex items-center space-x-3">
                                <img :src="`https://ui-avatars.com/api/?name=${billing.student.name}&background=random`" class="h-10 w-10 rounded-full" />
                                <span class="font-medium">{{ billing.student.name }}</span>
                            </div>
                        </TableCell>
                        <TableCell>{{ billing.payment_type.name }}</TableCell>
                        <TableCell>{{ formatCurrency(billing.amount) }}</TableCell>
                        <TableCell>{{ new Date(billing.due_date).toLocaleDateString('id-ID') }}</TableCell>
                        <TableCell>
                            <Badge :variant="getStatusVariant(billing.status)">
                            {{ billing.status === 'paid' ? 'Lunas' : 'Belum Lunas' }}
                            </Badge>
                        </TableCell>
                        <TableCell class="text-right">
                            <DropdownMenu>
                                <DropdownMenuTrigger as-child>
                                    <Button variant="ghost" size="icon">
                                        <MoreHorizontal class="h-4 w-4" />
                                    </Button>
                                </DropdownMenuTrigger>
                                <DropdownMenuContent align="end">
                                    <DropdownMenuItem as-child>
                                        <Link :href="route('admin.billings.show', billing.id)">
                                            <Eye class="mr-2 h-4 w-4" /> Detail
                                        </Link>
                                    </DropdownMenuItem>
                                    <DropdownMenuItem as-child>
                                        <Link :href="route('admin.billings.edit', billing.id)">
                                            <Pencil class="mr-2 h-4 w-4" /> Edit
                                        </Link>
                                    </DropdownMenuItem>
                                    <DropdownMenuItem @click="() => router.delete(route('admin.billings.destroy', billing.id))" class="text-destructive">
                                        <Trash2 class="mr-2 h-4 w-4" /> Hapus
                                    </DropdownMenuItem>
                                </DropdownMenuContent>
                            </DropdownMenu>
                        </TableCell>
                        </TableRow>
                    </TableBody>
                    </Table>
                </div>
                <!-- Pagination -->
                <div class="flex justify-between items-center mt-6">
                    <p class="text-sm text-muted-foreground">
                        Menampilkan {{ billings.from }} sampai {{ billings.to }} dari {{ billings.total }} hasil
                    </p>
                    <div class="flex items-center space-x-2">
                        <Button
                            v-for="link in billings.links"
                            :key="link.label"
                            :href="link.url"
                            v-html="link.label"
                            :disabled="!link.url || link.active"
                            :class="{ 'bg-primary text-white': link.active }"
                            as="a"
                            size="sm"
                            variant="outline"
                        />
                    </div>
                </div>
            </CardContent>
        </Card>
    </div>
  </AdminLayout>
</template>
