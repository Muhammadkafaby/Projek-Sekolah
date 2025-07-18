<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { Button } from '@/Components/ui/button';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/Components/ui/card';
import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';
import { Textarea } from '@/Components/ui/textarea';
import { ref } from 'vue';

const props = defineProps({
  settings: {
    type: Object,
    required: true,
  },
});

const form = useForm({
  school_name: props.settings.school_name,
  school_logo: null,
  school_address: props.settings.school_address,
  school_phone: props.settings.school_phone,
  school_email: props.settings.school_email,
  school_vision: props.settings.school_vision,
  school_mission: props.settings.school_mission,
});

const logoPreview = ref(props.settings.school_logo_url);

const onFileChange = (event) => {
    const file = event.target.files[0];
    form.school_logo = file;
    if (file) {
        logoPreview.value = URL.createObjectURL(file);
    }
};

const submit = () => {
  form.post(route('admin.settings.store'), {
    preserveScroll: true,
  });
};
</script>

<template>
  <Head title="Pengaturan Website" />

  <AdminLayout>
    <div>
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-3xl font-bold">Pengaturan Website</h1>
                <p class="text-muted-foreground">Sesuaikan informasi dan tampilan website sekolah Anda.</p>
            </div>
        </div>

        <form @submit.prevent="submit">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <Card>
                        <CardHeader>
                            <CardTitle>Informasi Umum</CardTitle>
                            <CardDescription>Informasi dasar mengenai sekolah Anda.</CardDescription>
                        </CardHeader>
                        <CardContent class="space-y-4">
                            <div>
                                <Label for="school_name">Nama Sekolah</Label>
                                <Input id="school_name" v-model="form.school_name" />
                            </div>
                            <div>
                                <Label for="school_address">Alamat Sekolah</Label>
                                <Textarea id="school_address" v-model="form.school_address" />
                            </div>
                        </CardContent>
                    </Card>
                    <Card>
                        <CardHeader>
                            <CardTitle>Kontak</CardTitle>
                            <CardDescription>Informasi kontak yang dapat dihubungi.</CardDescription>
                        </CardHeader>
                        <CardContent class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <Label for="school_phone">Telepon</Label>
                                <Input id="school_phone" v-model="form.school_phone" />
                            </div>
                            <div>
                                <Label for="school_email">Email</Label>
                                <Input id="school_email" type="email" v-model="form.school_email" />
                            </div>
                        </CardContent>
                    </Card>
                    <Card>
                        <CardHeader>
                            <CardTitle>Visi & Misi</CardTitle>
                            <CardDescription>Visi dan Misi sekolah Anda.</CardDescription>
                        </CardHeader>
                        <CardContent class="space-y-4">
                            <div>
                                <Label for="school_vision">Visi</Label>
                                <Textarea id="school_vision" v-model="form.school_vision" rows="3" />
                            </div>
                            <div>
                                <Label for="school_mission">Misi</Label>
                                <Textarea id="school_mission" v-model="form.school_mission" rows="5" />
                            </div>
                        </CardContent>
                    </Card>
                </div>
                <div class="lg:col-span-1 space-y-6">
                    <Card>
                        <CardHeader>
                            <CardTitle>Logo Sekolah</CardTitle>
                        </CardHeader>
                        <CardContent class="flex flex-col items-center space-y-4">
                            <img v-if="logoPreview" :src="logoPreview" class="h-32 w-32 rounded-full object-cover border-4 border-primary/10" />
                            <div v-else class="h-32 w-32 rounded-full bg-muted flex items-center justify-center text-muted-foreground">
                                No Logo
                            </div>
                            <Input id="school_logo" type="file" @change="onFileChange" class="text-sm" />
                        </CardContent>
                    </Card>
                </div>
            </div>
            <div class="mt-6 flex justify-end">
                <Button type="submit" :disabled="form.processing">
                    <span v-if="form.processing">Menyimpan...</span>
                    <span v-else>Simpan Perubahan</span>
                </Button>
            </div>
        </form>
    </div>
  </AdminLayout>
</template>
