<script>
export default {
    name: 'NoteForm'
}
</script>

<script setup>
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, usePage } from '@inertiajs/vue3';

const props = defineProps({
    form: {
        type: Object,
        required: true
    },
    updating: {
        type: Boolean,
        required: false,
        default: false
    },
    tags: {
        type: Object,
        required: true
    }
});

defineEmits(['submit']);

</script>

<template>
    <FormSection @submitted="$emit('submit')">
        <template #title>
            {{ updating ? 'Actualizar Tarea' : 'Añadir Tarea' }}
        </template>

        <template #description>
            {{ updating ? 'Actualizando la tarea seleccionada' : 'Creando una nueva tarea' }}
        </template>

        <template #form>

            <div class="col-span-6 sm:col-span-6">
                <InputLabel for="title" value="Titulo" />
                <TextInput id="title" v-model="form.title" type="text" autocomplete="title"
                    placeholder="Titulo de tarea" class="mt-1 block w-full" />
                <InputError :message="$page.props.errors.title" class="mt-2" />

                <InputLabel for="description" value="Descripcion" />
                <TextInput id="description" v-model="form.description" type="text" autocomplete="description"
                    class="mt-1 block w-full" />
                <InputError :message="$page.props.errors.description" class="mt-2" />
                <p class="mt-1 md-2 text-sm leading-6 text-gray-600">Escribe una descripcion para la tarea.</p>

                <InputLabel for="image_uri" value="Subir imagen" />
                <SecondaryButton class="mt-2 bg-amber-600 hover:bg-amber-500" type="button">Upload image</SecondaryButton>
                <InputError :message="$page.props.errors.image_uri" class="mt-2" />

                <h2 class="text-base mt-4 font-semibold leading-7 text-gray-900">Tiempo de tarea</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Determina el tiempo de la tarea ingresando la fecha
                    de inicio y de vencimiento.</p>
                <div class="sm:col-span-6">
                    <InputLabel for="creation_date" value="Fecha de inicio" />
                    <div class="mt-2">
                        <input id="creation_date" type="datetime-local" v-model="form.creation_date"
                            autocomplete="creation_date">
                        <InputError :message="$page.props.errors.creation_date" class="mt-2" />
                    </div>
                </div>
                <div class="sm:col-span-6">
                    <InputLabel for="expiration_date" value="Fecha de vencimiento" />
                    <div class="mt-2">
                        <input id="expiration_date" type="datetime-local" v-model="form.expiration_date"
                            autocomplete="expiration_date">
                        <InputError :message="$page.props.errors.expiration_date" class="mt-2" />
                    </div>
                </div>

                <InputLabel for="tag_id" value="Etiqueta (Tipo)" />
                <div class="mt-2">
                    <select id="tag_id" name="tag" v-model="form.tag_id" autocomplete="tag_id"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-amber-600 sm:max-w-xs sm:text-sm sm:leading-6">
                        <option v-for="tag in tags " :value="tag.id">{{ tag.name }}</option>
                    </select>
                    <InputError :message="$page.props.errors.tag_id" class="mt-2" />
                </div>

                <InputError :message="$page.props.errors.user_id" class="mt-2" />
            </div>

        </template>

        <template #actions>
            <div class="mr-3">
                <Link :href="route('notes.show', usePage().props.auth.user.id)">
                <SecondaryButton>
                    Cancelar
                </SecondaryButton>
                </Link>
            </div>
            <PrimaryButton>
                {{ updating ? 'Actualizar' : 'Añadir' }}
            </PrimaryButton>
        </template>
    </FormSection>
</template>
