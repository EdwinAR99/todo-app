<script>
    export default {
        name: 'NoteCreate'
    }
</script>

<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import NoteForm from '@/Components/Notes/Form.vue';


defineProps({
    tags: {
        type: Object,
        required: true
    }
})

const form = useForm({
    title: '',
    description: '',
    creation_date: '',
    expiration_date: '',
    image_uri: '',
    user_id: usePage().props.auth.user.id,
    tag_id: ''
});

</script>

<template>
    <AppLayout title="Añadir tarea">
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">Añadir una tarea</h1>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <NoteForm :form="form" :tags="tags" @submit="form.post(route('notes.store'))" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
