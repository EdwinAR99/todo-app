<script>
    export default {
        name: 'NoteEdit'
    }
</script>

<script setup>
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import NoteForm from '@/Components/Notes/Form.vue';


const props = defineProps({
    note: {
        type: Object,
        required: true
    },
    tags: {
        type: Object,
        required: true
    }
})

const form = useForm({
    title: props.note.title,
    description: props.note.description,
    creation_date: props.note.creation_date,
    expiration_date: props.note.expiration_date,
    image_uri: props.note.image_uri,
    user_id: props.note.user_id,
    tag_id: props.note.tag_id
});

</script>

<template>
    <AppLayout title="Actualizar Tarea">
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">Actualizar una tarea</h1>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <NoteForm :updating="true" :form="form" :tags="tags" @submit="form.put(route('notes.update', note.id))" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
