<script setup>
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import {
  Bell, Home, Users, Book, Calendar, FileText, DollarSign, Settings, Menu, X, ChevronDown, Search, LogOut, UserCircle, GraduationCap, Banknote, Megaphone, Folder, UserCheck, LayoutDashboard, Sun, Moon,
} from 'lucide-vue-next';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuLabel, DropdownMenuSeparator, DropdownMenuTrigger } from '@/Components/ui/dropdown-menu';
import { Collapsible, CollapsibleContent, CollapsibleTrigger } from '@/Components/ui/collapsible'

const sidebarOpen = ref(false);
const page = usePage();

const navLinks = [
    { name: 'Dashboard', href: 'dashboard', icon: Home, current: route().current('dashboard') },
    { 
        name: 'Akademik', 
        icon: GraduationCap,
        children: [
            { name: 'Siswa', href: 'admin.students.index', icon: Users, current: route().current('admin.students.index') },
            { name: 'Guru', href: 'admin.teachers.index', icon: UserCheck, current: route().current('admin.teachers.index') },
            { name: 'Kelas', href: 'admin.classes.index', icon: Book, current: route().current('admin.classes.index') },
            { name: 'Absensi', href: 'admin.attendances.index', icon: Calendar, current: route().current('admin.attendances.index') },
            { name: 'Jadwal', href: 'admin.schedules.index', icon: Calendar, current: route().current('admin.schedules.index') },
        ]
    },
    { 
        name: 'Konten', 
        icon: Megaphone,
        children: [
            { name: 'Pengumuman', href: 'admin.announcements.index', icon: FileText, current: route().current('admin.announcements.index') },
            { name: 'Dokumen', href: 'admin.documents.index', icon: Folder, current: route().current('admin.documents.index') },
        ]
    },
    { 
        name: 'Keuangan', 
        icon: Banknote,
        children: [
            { name: 'Pembayaran', href: 'admin.payments.index', icon: DollarSign, current: route().current('admin.payments.index') },
        ]
    },
    {
        name: 'Pengaturan',
        icon: Settings,
        children: [
            { name: 'Umum', href: 'admin.settings.index', icon: Settings, current: route().current('admin.settings.index') },
            { name: 'Halaman Depan', href: 'admin.settings.landing', icon: LayoutDashboard, current: route().current('admin.settings.landing') },
        ]
    },
];
</script>

<template>
  <div class="min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside
      :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
      class="fixed inset-y-0 left-0 z-40 w-64 bg-white border-r border-gray-200 transform transition-transform duration-300 ease-in-out md:translate-x-0"
    >
      <div class="flex items-center justify-center h-20 border-b px-4">
        <Link :href="route('dashboard')" class="flex items-center space-x-3">
            <img :src="$page.props.settings.school_logo || 'https://api.iconify.design/ph:student-bold.svg?color=%23ffffff'" alt="School Logo" class="h-10 w-10 rounded-full bg-primary p-1">
            <h1 class="text-xl font-bold text-gray-800">Admin Panel</h1>
        </Link>
      </div>
      <nav class="mt-4 flex-1 px-3 space-y-2">
        <template v-for="item in navLinks" :key="item.name">
            <Link v-if="!item.children" :href="route(item.href)"
                :class="[item.current ? 'bg-primary text-white' : 'text-gray-600 hover:bg-gray-100', 'flex items-center px-3 py-2.5 rounded-md text-sm font-medium transition-colors']">
                <component :is="item.icon" class="w-5 h-5 mr-3" />
                <span>{{ item.name }}</span>
            </Link>
            <div v-else>
                <div class="flex items-center justify-between px-3 py-2.5 rounded-md text-sm font-medium text-gray-600">
                    <div class="flex items-center">
                        <component :is="item.icon" class="w-5 h-5 mr-3" />
                        <span>{{ item.name }}</span>
                    </div>
                </div>
                <div class="mt-1 space-y-1">
                    <Link v-for="child in item.children" :key="child.name" :href="route(child.href)"
                        :class="[child.current ? 'bg-primary/10 text-primary' : 'text-gray-500 hover:bg-gray-100', 'flex items-center pl-11 pr-3 py-2 rounded-md text-sm font-medium transition-colors']">
                        <span>{{ child.name }}</span>
                    </Link>
                </div>
            </div>
        </template>
      </nav>
    </aside>

    <div class="flex-1 flex flex-col md:ml-64">
      <!-- Header -->
      <header class="sticky top-0 z-30 flex items-center justify-between px-6 py-4 bg-white/80 backdrop-blur-lg border-b border-gray-200">
        <div class="flex items-center">
          <Button @click="sidebarOpen = !sidebarOpen" variant="ghost" size="icon" class="text-gray-500 focus:outline-none md:hidden mr-4">
            <Menu v-if="!sidebarOpen" class="h-6 w-6" />
            <X v-else class="h-6 w-6" />
          </Button>
          <div class="relative hidden md:block">
            <Search class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-400" />
            <Input placeholder="Search..." class="pl-10 w-64" />
          </div>
        </div>

        <div class="flex items-center space-x-4">
          <DropdownMenu>
            <DropdownMenuTrigger as-child>
              <Button variant="ghost" size="icon" class="rounded-full">
                <Bell class="h-5 w-5" />
              </Button>
            </DropdownMenuTrigger>
            <DropdownMenuContent align="end" class="w-80 z-50">
              <DropdownMenuLabel>Notifikasi</DropdownMenuLabel>
              <DropdownMenuSeparator />
              <DropdownMenuItem>
                <div class="flex flex-col items-center justify-center text-center p-4">
                  <p class="text-sm text-gray-500">Tidak ada notifikasi baru.</p>
                </div>
              </DropdownMenuItem>
            </DropdownMenuContent>
          </DropdownMenu>

          <DropdownMenu>
            <DropdownMenuTrigger as-child>
              <Button variant="ghost" class="flex items-center space-x-2 rounded-full p-1">
                <img class="h-8 w-8 rounded-full" :src="$page.props.auth.user.avatar || `https://ui-avatars.com/api/?name=${$page.props.auth.user.name}&background=random`" alt="User" />
                <span class="hidden md:inline text-sm font-medium">{{ $page.props.auth.user.name }}</span>
                <ChevronDown class="h-4 w-4 hidden md:inline" />
              </Button>
            </DropdownMenuTrigger>
            <DropdownMenuContent align="end" class="w-48 z-50">
              <DropdownMenuLabel>Akun Saya</DropdownMenuLabel>
              <DropdownMenuSeparator />
              <DropdownMenuItem as-child>
                <Link :href="route('profile.edit')" class="flex items-center">
                    <UserCircle class="w-4 h-4 mr-2" /> Profile
                </Link>
              </DropdownMenuItem>
              <DropdownMenuSeparator />
              <DropdownMenuItem as-child>
                <Link :href="route('logout')" method="post" as="button" class="flex items-center w-full">
                    <LogOut class="w-4 h-4 mr-2" /> Log Out
                </Link>
              </DropdownMenuItem>
            </DropdownMenuContent>
          </DropdownMenu>
        </div>
      </header>

      <!-- Main content -->
      <main class="flex-1 overflow-y-auto">
        <div class="container mx-auto px-6 py-8">
          <slot />
        </div>
      </main>
    </div>
  </div>
</template>
