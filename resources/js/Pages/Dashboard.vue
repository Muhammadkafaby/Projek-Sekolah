<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card';
import { Bar } from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js';
import { Users, Book, UserCheck, ArrowRight, PlusCircle } from 'lucide-vue-next';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale);

const page = usePage();
const user = computed(() => page.props.auth.user);

const props = defineProps({
  stats: {
    type: Object,
    required: true,
  },
});

const chartData = computed(() => ({
  labels: ['Siswa', 'Guru', 'Kelas'],
  datasets: [
    {
      label: 'Total',
      backgroundColor: 'hsl(var(--primary))',
      borderColor: 'hsl(var(--primary))',
      borderWidth: 1,
      hoverBackgroundColor: 'hsl(var(--primary) / 0.9)',
      hoverBorderColor: 'hsl(var(--primary))',
      data: [props.stats.students, props.stats.teachers, props.stats.classes],
      barThickness: 30,
    },
  ],
}));

const chartOptions = {
  responsive: true,
  maintainAspectRatio: false,
  plugins: {
    legend: {
      display: false,
    },
  },
  scales: {
    y: {
      beginAtZero: true,
      grid: {
        color: 'hsl(var(--border))',
      },
      ticks: {
        color: 'hsl(var(--muted-foreground))',
      },
    },
    x: {
      grid: {
        display: false,
      },
      ticks: {
        color: 'hsl(var(--muted-foreground))',
      },
    },
  },
};

const quickActions = [
    {
        label: 'Tambah Siswa',
        href: 'admin.students.create',
        icon: PlusCircle
    },
    {
        label: 'Tambah Guru',
        href: 'admin.teachers.create',
        icon: PlusCircle
    },
    {
        label: 'Tambah Kelas',
        href: 'admin.classes.create',
        icon: PlusCircle
    }
]
</script>

<template>
  <Head title="Dashboard" />

  <AdminLayout>
    <div class="space-y-8">
        <div>
            <h1 class="text-3xl font-bold">Selamat Datang Kembali, {{ user.name }}!</h1>
            <p class="text-muted-foreground">Berikut adalah ringkasan data sekolah Anda.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <Card class="group">
                <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
                    <CardTitle class="text-sm font-medium text-muted-foreground">Total Siswa</CardTitle>
                    <Users class="h-5 w-5 text-muted-foreground" />
                </CardHeader>
                <CardContent>
                    <div class="text-4xl font-bold">{{ stats.students }}</div>
                    <p class="text-xs text-muted-foreground">Siswa terdaftar di sekolah</p>
                </CardContent>
            </Card>
            <Card>
                <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
                    <CardTitle class="text-sm font-medium text-muted-foreground">Total Guru</CardTitle>
                    <UserCheck class="h-5 w-5 text-muted-foreground" />
                </CardHeader>
                <CardContent>
                    <div class="text-4xl font-bold">{{ stats.teachers }}</div>
                    <p class="text-xs text-muted-foreground">Guru & staff pengajar</p>
                </CardContent>
            </Card>
            <Card>
                <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
                    <CardTitle class="text-sm font-medium text-muted-foreground">Total Kelas</CardTitle>
                    <Book class="h-5 w-5 text-muted-foreground" />
                </CardHeader>
                <CardContent>
                    <div class="text-4xl font-bold">{{ stats.classes }}</div>
                    <p class="text-xs text-muted-foreground">Ruang kelas tersedia</p>
                </CardContent>
            </Card>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <Card class="lg:col-span-2">
                <CardHeader>
                    <CardTitle>Statistik Data</CardTitle>
                </CardHeader>
                <CardContent>
                    <div class="h-96">
                        <Bar :data="chartData" :options="chartOptions" />
                    </div>
                </CardContent>
            </Card>
            <Card>
                <CardHeader>
                    <CardTitle>Aksi Cepat</CardTitle>
                </CardHeader>
                <CardContent class="space-y-4">
                    <Link v-for="action in quickActions" :key="action.href" :href="route(action.href)" class="flex items-center justify-between p-4 rounded-lg bg-background hover:bg-muted/50 transition-colors border">
                        <div class="flex items-center">
                            <component :is="action.icon" class="h-5 w-5 mr-3 text-primary" />
                            <span class="font-medium">{{ action.label }}</span>
                        </div>
                        <ArrowRight class="h-5 w-5 text-muted-foreground" />
                    </Link>
                </CardContent>
            </Card>
        </div>
    </div>
  </AdminLayout>
</template>
