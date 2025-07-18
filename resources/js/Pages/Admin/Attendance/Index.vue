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
import { PlusCircle, FileDown, Search, MoreHorizontal, Pencil, Trash2 } from 'lucide-vue-next';
import { Input } from '@/Components/ui/input';
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card';
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger } from '@/Components/ui/dropdown-menu';
import { Badge } from '@/Components/ui/badge';
import Pagination from '@/Components/Pagination.vue';
import { ref, watch } from 'vue';
import debounce from 'lodash/debounce';

const props = defineProps({
  attendances: {
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
  router.get(route('admin.attendances.index'), { search: value }, {
    preserveState: true,
    replace: true,
  });
}, 300));

const getStatusVariant = (status) => {
    switch (status) {
        case 'Hadir':
            return 'success';
        case 'Izin':
            return 'warning';
        case 'Sakit':
            return 'warning';
        case 'Alpa':
            return 'destructive';
        default:
            return 'secondary';
    }
}

</script>

<template>
  <Head title="Manajemen Absensi" />

  <AdminLayout>
    <div>
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-3xl font-bold">Manajemen Absensi</h1>
                <p class="text-muted-foreground">Kelola data absensi siswa di sekolah Anda.</p>
            </div>
            <div class="flex space-x-2">
                <Button variant="outline">
                <FileDown class="mr-2 h-4 w-4" />
                Export
                </Button>
                <Button as-child>
                <Link :href="route('admin.attendances.create')">
                    <PlusCircle class="mr-2 h-4 w-4" />
                    Input Absensi
                </Link>
                </Button>
            </div>
        </div>

        <Card>
            <CardHeader>
                <div class="flex items-center justify-between">
                    <CardTitle>Daftar Absensi</CardTitle>
                    <div class="flex items-center space-x-2">
                        <Input type="date" class="w-auto" />
                        <div class="relative w-full max-w-sm">
                            <Input type="text" placeholder="Cari absensi..." class="pl-10" v-model="search" />
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <Search class="h-5 w-5 text-gray-400" />
                            </div>
                        </div>
                    </div>
                </div>
            </CardHeader>
            <CardContent>
                <div class="overflow-x-auto">
                    <Table>
                    <TableHeader>
                        <TableRow>
                        <TableHead>Tanggal</TableHead>
                        <TableHead>Siswa</TableHead>
                        <TableHead>Kelas</TableHead>
                        <TableHead>Status</TableHead>
                        <TableHead class="text-right">Aksi</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <template v-if="attendances.data.length > 0">
                            <TableRow v-for="attendance in attendances.data" :key="attendance.id">
                                <TableCell>{{ new Date(attendance.date).toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }) }}</TableCell>
                                <TableCell>
                                    <div class="flex items-center space-x-3">
                                        <img :src="`https://ui-avatars.com/api/?name=${attendance.student.name}&background=random`" class="h-10 w-10 rounded-full" />
                                        <span class="font-medium">{{ attendance.student.name }}</span>
                                    </div>
                                </TableCell>
                                <TableCell>
                                    <Badge variant="outline">{{ attendance.class.name }}</Badge>
                                </TableCell>
                                <TableCell>
                                    <Badge :variant="getStatusVariant(attendance.status)">{{ attendance.status }}</Badge>
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
                                                <Link :href="route('admin.attendances.edit', attendance.id)">
                                                    <Pencil class="mr-2 h-4 w-4" /> Edit
                                                </Link>
                                            </DropdownMenuItem>
                                            <DropdownMenuItem @click="() => router.delete(route('admin.attendances.destroy', attendance.id))" class="text-destructive">
                                                <Trash2 class="mr-2 h-4 w-4" /> Hapus
                                            </DropdownMenuItem>
                                        </DropdownMenuContent>
                                    </DropdownMenu>
                                </TableCell>
                            </TableRow>
                        </template>
                        <template v-else>
                            <TableRow>
                                <TableCell colspan="5" class="h-24 text-center">
                                    Tidak ada data absensi.
                                </TableCell>
                            </TableRow>
                        </template>
                    </TableBody>
                    </Table>
                </div>
                <!-- Pagination -->
                <div class="flex justify-between items-center mt-6">
                    <p class="text-sm text-muted-foreground">
                        Menampilkan {{ attendances.from || 0 }} sampai {{ attendances.to || 0 }} dari {{ attendances.total }} hasil
                    </p>
                    <Pagination :links="attendances.links" />
                </div>
            </CardContent>
        </Card>
    </div>
  </AdminLayout>
</template>
