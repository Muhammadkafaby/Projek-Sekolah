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
import { ref, watch } from 'vue';
import debounce from 'lodash/debounce';

const props = defineProps({
  students: {
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
  router.get(route('admin.students.index'), { search: value }, {
    preserveState: true,
    replace: true,
  });
}, 300));

</script>

<template>
  <Head title="Manajemen Siswa" />

  <AdminLayout>
    <div>
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-3xl font-bold">Manajemen Siswa</h1>
                <p class="text-muted-foreground">Kelola data siswa di sekolah Anda.</p>
            </div>
            <div class="flex space-x-2">
                <Button variant="outline">
                <FileDown class="mr-2 h-4 w-4" />
                Export
                </Button>
                <Button as-child>
                <Link :href="route('admin.students.create')">
                    <PlusCircle class="mr-2 h-4 w-4" />
                    Tambah Siswa
                </Link>
                </Button>
            </div>
        </div>

        <Card>
            <CardHeader>
                <div class="flex items-center justify-between">
                    <CardTitle>Daftar Siswa</CardTitle>
                    <div class="relative w-full max-w-sm">
                        <Input type="text" placeholder="Cari siswa..." class="pl-10" v-model="search" />
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
                        <TableHead>Nama</TableHead>
                        <TableHead>NIS</TableHead>
                        <TableHead>Kelas</TableHead>
                        <TableHead>Jenis Kelamin</TableHead>
                        <TableHead class="text-right">Aksi</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="student in students.data" :key="student.id">
                        <TableCell>
                            <div class="flex items-center space-x-3">
                                <img :src="`https://ui-avatars.com/api/?name=${student.name}&background=random`" class="h-10 w-10 rounded-full" />
                                <span class="font-medium">{{ student.name }}</span>
                            </div>
                        </TableCell>
                        <TableCell>{{ student.nis }}</TableCell>
                        <TableCell>
                            <Badge variant="secondary">{{ student.class.name }}</Badge>
                        </TableCell>
                        <TableCell>{{ student.gender }}</TableCell>
                        <TableCell class="text-right">
                            <DropdownMenu>
                                <DropdownMenuTrigger as-child>
                                    <Button variant="ghost" size="icon">
                                        <MoreHorizontal class="h-4 w-4" />
                                    </Button>
                                </DropdownMenuTrigger>
                                <DropdownMenuContent align="end">
                                    <DropdownMenuItem as-child>
                                        <Link :href="route('admin.students.edit', student.id)">
                                            <Pencil class="mr-2 h-4 w-4" /> Edit
                                        </Link>
                                    </DropdownMenuItem>
                                    <DropdownMenuItem @click="() => router.delete(route('admin.students.destroy', student.id))" class="text-destructive">
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
                        Menampilkan {{ students.from }} sampai {{ students.to }} dari {{ students.total }} hasil
                    </p>
                    <div class="flex items-center space-x-2">
                        <Button
                            v-for="link in students.links"
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
