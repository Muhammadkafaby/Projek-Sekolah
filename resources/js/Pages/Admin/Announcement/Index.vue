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
  announcements: {
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
  router.get(route('admin.announcements.index'), { search: value }, {
    preserveState: true,
    replace: true,
  });
}, 300));

</script>

<template>
  <Head title="Manajemen Pengumuman" />

  <AdminLayout>
    <div>
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-3xl font-bold">Manajemen Pengumuman</h1>
                <p class="text-muted-foreground">Kelola pengumuman dan berita sekolah.</p>
            </div>
            <Button as-child>
            <Link :href="route('admin.announcements.create')">
                <PlusCircle class="mr-2 h-4 w-4" />
                Tambah Pengumuman
            </Link>
            </Button>
        </div>

        <Card>
            <CardHeader>
                <div class="flex items-center justify-between">
                    <CardTitle>Daftar Pengumuman</CardTitle>
                    <div class="relative w-full max-w-sm">
                        <Input type="text" placeholder="Cari pengumuman..." class="pl-10" v-model="search" />
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
                        <TableHead>Judul</TableHead>
                        <TableHead>Isi</TableHead>
                        <TableHead>Tanggal Dibuat</TableHead>
                        <TableHead class="text-right">Aksi</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="announcement in announcements.data" :key="announcement.id">
                        <TableCell class="font-medium">{{ announcement.title }}</TableCell>
                        <TableCell class="max-w-sm">
                            <p class="truncate">{{ announcement.content }}</p>
                        </TableCell>
                        <TableCell>
                            <Badge variant="outline">{{ new Date(announcement.created_at).toLocaleDateString('id-ID') }}</Badge>
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
                                        <Link :href="route('admin.announcements.edit', announcement.id)">
                                            <Pencil class="mr-2 h-4 w-4" /> Edit
                                        </Link>
                                    </DropdownMenuItem>
                                    <DropdownMenuItem @click="() => router.delete(route('admin.announcements.destroy', announcement.id))" class="text-destructive">
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
                        Menampilkan {{ announcements.from }} sampai {{ announcements.to }} dari {{ announcements.total }} hasil
                    </p>
                    <div class="flex items-center space-x-2">
                        <Button
                            v-for="link in announcements.links"
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
