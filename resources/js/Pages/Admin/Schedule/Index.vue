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
  schedules: {
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
  router.get(route('admin.schedules.index'), { search: value }, {
    preserveState: true,
    replace: true,
  });
}, 300));

</script>

<template>
  <Head title="Manajemen Jadwal" />

  <AdminLayout>
    <div>
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-3xl font-bold">Manajemen Jadwal</h1>
                <p class="text-muted-foreground">Kelola data jadwal pelajaran di sekolah Anda.</p>
            </div>
            <Button as-child>
            <Link :href="route('admin.schedules.create')">
                <PlusCircle class="mr-2 h-4 w-4" />
                Tambah Jadwal
            </Link>
            </Button>
        </div>

        <Card>
            <CardHeader>
                <div class="flex items-center justify-between">
                    <CardTitle>Daftar Jadwal</CardTitle>
                    <div class="flex items-center space-x-2">
                        <Input type="text" placeholder="Cari jadwal..." class="pl-10" v-model="search" />
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
                        <TableHead>Hari</TableHead>
                        <TableHead>Jam</TableHead>
                        <TableHead>Mata Pelajaran</TableHead>
                        <TableHead>Kelas</TableHead>
                        <TableHead>Guru</TableHead>
                        <TableHead class="text-right">Aksi</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="schedule in schedules.data" :key="schedule.id">
                        <TableCell>
                            <Badge variant="secondary">{{ schedule.day }}</Badge>
                        </TableCell>
                        <TableCell>{{ schedule.start_time }} - {{ schedule.end_time }}</TableCell>
                        <TableCell class="font-medium">{{ schedule.subject }}</TableCell>
                        <TableCell>
                            <Badge variant="outline">{{ schedule.class.name }}</Badge>
                        </TableCell>
                        <TableCell>{{ schedule.teacher.name }}</TableCell>
                        <TableCell class="text-right">
                            <DropdownMenu>
                                <DropdownMenuTrigger as-child>
                                    <Button variant="ghost" size="icon">
                                        <MoreHorizontal class="h-4 w-4" />
                                    </Button>
                                </DropdownMenuTrigger>
                                <DropdownMenuContent align="end">
                                    <DropdownMenuItem as-child>
                                        <Link :href="route('admin.schedules.edit', schedule.id)">
                                            <Pencil class="mr-2 h-4 w-4" /> Edit
                                        </Link>
                                    </DropdownMenuItem>
                                    <DropdownMenuItem @click="() => router.delete(route('admin.schedules.destroy', schedule.id))" class="text-destructive">
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
                        Menampilkan {{ schedules.from }} sampai {{ schedules.to }} dari {{ schedules.total }} hasil
                    </p>
                    <div class="flex items-center space-x-2">
                        <Button
                            v-for="link in schedules.links"
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
