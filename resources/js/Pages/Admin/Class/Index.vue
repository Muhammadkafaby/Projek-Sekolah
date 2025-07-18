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
  classes: {
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
  router.get(route('admin.classes.index'), { search: value }, {
    preserveState: true,
    replace: true,
  });
}, 300));

</script>

<template>
  <Head title="Manajemen Kelas" />

  <AdminLayout>
    <div>
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-3xl font-bold">Manajemen Kelas</h1>
                <p class="text-muted-foreground">Kelola data kelas di sekolah Anda.</p>
            </div>
            <Button as-child>
            <Link :href="route('admin.classes.create')">
                <PlusCircle class="mr-2 h-4 w-4" />
                Tambah Kelas
            </Link>
            </Button>
        </div>

        <Card>
            <CardHeader>
                <div class="flex items-center justify-between">
                    <CardTitle>Daftar Kelas</CardTitle>
                    <div class="relative w-full max-w-sm">
                        <Input type="text" placeholder="Cari kelas..." class="pl-10" v-model="search" />
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
                        <TableHead>Nama Kelas</TableHead>
                        <TableHead>Wali Kelas</TableHead>
                        <TableHead>Tahun Ajaran</TableHead>
                        <TableHead>Jumlah Siswa</TableHead>
                        <TableHead class="text-right">Aksi</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <template v-if="classes.data.length > 0">
                            <TableRow v-for="classItem in classes.data" :key="classItem.id">
                                <TableCell class="font-medium">{{ classItem.name }}</TableCell>
                                <TableCell>{{ classItem.teacher.name }}</TableCell>
                                <TableCell>
                                    <Badge variant="outline">{{ classItem.year }}</Badge>
                                </TableCell>
                                <TableCell>
                                    <Badge>{{ classItem.students_count }} Siswa</Badge>
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
                                                <Link :href="route('admin.classes.edit', classItem.id)">
                                                    <Pencil class="mr-2 h-4 w-4" /> Edit
                                                </Link>
                                            </DropdownMenuItem>
                                            <DropdownMenuItem @click="() => router.delete(route('admin.classes.destroy', classItem.id))" class="text-destructive">
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
                                    Tidak ada data kelas.
                                </TableCell>
                            </TableRow>
                        </template>
                    </TableBody>
                    </Table>
                </div>
                <!-- Pagination -->
                <div class="flex justify-between items-center mt-6">
                    <p class="text-sm text-muted-foreground">
                        Menampilkan {{ classes.from || 0 }} sampai {{ classes.to || 0 }} dari {{ classes.total }} hasil
                    </p>
                    <Pagination :links="classes.links" />
                </div>
            </CardContent>
        </Card>
    </div>
  </AdminLayout>
</template>
