<script>
export default {
    name: 'NotesIndex'
}
</script>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { PencilSquareIcon, TrashIcon, PlusCircleIcon } from '@heroicons/vue/24/solid';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    notes: {
        type: Object,
        required: true
    }
})

const deleteNote = id => {
    if (confirm('Estas seguro de eliminar??')) {
        Inertia.delete(route('notes.destroy', id))
    }
};

</script>

<style scoped>
.container_header {
    display: flex;
    justify-content: start;
}

.container_header-item {
    padding: 0.3rem;
    background-color: gainsboro;
    border-radius: 2px;
    margin-right: 0.3rem;
    margin-bottom: 0.3rem;
    cursor: pointer;
}
</style>

<template>

    <AppLayout title="Tareas">
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">Tareas</h1>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 bg-white border-b border-gray-200 rounded divide-y divide-gray-200">

                    <div class="flex justify-end">
                        <Link :href="route('notes.create')"
                            class="border border-green-700 hover:border-green-400 hover:bg-green-300 py-2 px-4 rounded">
                        <div class="flex justify-start">
                            Añadir Tarea
                            <PlusCircleIcon class="size-6 pl-1 text-green-700" />
                        </div>
                        </Link>
                    </div>

                    <!-- List taks -->
                    <div class="mt-4">
                        <ul role="list" class="divide-y divide-gray-200">
                            <li v-for="note in notes.data" :key="note.id" class="flex justify-between gap-x-6 py-5">
                                <div class="flex min-w-0 gap-x-4">
                                    <img v-if="note.image_uri != null"
                                        class="h-12 w-12 flex-none rounded-full bg-gray-50" :src="note.image_uri"
                                        alt="" />
                                    <div class="min-w-0 flex-auto">
                                        <p class="text-sm font-semibold leading-6 text-gray-900">{{ note.title }}</p>
                                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ note.description }}
                                        </p>
                                    </div>
                                </div>
                                <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                    <p class="text-sm leading-6 text-gray-900"> Fecha de creacion: {{ note.creation_date
                                        }}</p>
                                    <p v-if="note.expiration_date != null" class="mt-1 text-sm leading-5 text-gray-500">
                                        Fecha de vencimiento: <time :datetime="note.expiration_date">{{
                                            note.expiration_date
                                            }}</time></p>
                                    <div class="mt-1 flex items-center gap-x-1.5">
                                        <Link :href="route('notes.edit', note.id)">
                                        <PencilSquareIcon class="size-6 text-amber-500 hover:text-amber-300" />
                                        </Link>
                                        <Link @click="deleteNote(note.id)">
                                        <TrashIcon class="size-6 text-red-500 hover:text-red-300" />
                                        </Link>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Pagination -->
                    <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
                        <div class="flex flex-1 justify-between sm:hidden">
                            <Link v-if="notes.current_page > 1" :href="notes.prev_page_url"
                                class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                            <span class="sr-only">Anterior</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                    clip-rule="evenodd" />
                            </svg>
                            </Link>
                            <Link v-if="notes.current_page < notes.last_page" :href="notes.next_page_url"
                                class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                            <span class="sr-only">Siguiente</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                    clip-rule="evenodd" />
                            </svg>
                            </Link>
                        </div>
                        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Mostrando
                                    <span class="font-medium">{{ notes.from }}</span>
                                    a
                                    <span class="font-medium">{{ notes.to }}</span>
                                    de
                                    <span class="font-medium">{{ notes.total }}</span>
                                    resultados
                                </p>
                            </div>
                            <div>
                                <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm"
                                    aria-label="Pagination">
                                    <Link v-if="notes.current_page > 1" :href="notes.prev_page_url"
                                        class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                    <span class="sr-only">Anterior</span>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    </Link>
                                    <!-- Current: "z-10 bg-amber-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600", Default: "text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0" -->

                                    <Link
                                        class="relative z-10 inline-flex items-center bg-amber-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-600">
                                    {{ notes.current_page }} </Link>

                                    <Link v-if="notes.current_page < notes.last_page" :href="notes.next_page_url" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1
                                    ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                    <span class="sr-only">Siguiente</span>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    </Link>
                                </nav>
                            </div>
                        </div>
                    </div>



                </div>

            </div>
        </div>

    </AppLayout>
</template>
