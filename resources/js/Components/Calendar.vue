<script>
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import timeGrid from '@fullcalendar/timegrid';
import { router, usePage } from '@inertiajs/vue3';

import '../../css/app.css';

fetch(route('notes.show', usePage().props.auth.user.id), {
    method: 'GET',
    headers: {
        'X-Requested-With': 'XMLHttpRequest', // Asegura que se identifique como petición AJAX
        'Content-Type': 'application/json',
    },
}).then(response => response.json()).then(data => {
    // Transformamos las notas en eventos para FullCalendar
    const events = data.notes.data.map(note => ({
        title: note.title,        // Usa el título de la nota
        start: note.creation_date,   // La fecha de inicio de la nota
        end: note.expiration_date,       // La fecha de fin de la nota
        allDay: true              // Puedes ajustar según tu necesidad
    }));;  // Aquí recibes los datos de la respuesta
}).catch(error => {
    console.error('Error:', error);  // Aquí manejas los errores en caso de que ocurran
})

export default {
    components: {
        FullCalendar // make the <FullCalendar> tag available
    },
    data() {
        return {
            calendarOptions: {
                plugins: [dayGridPlugin, interactionPlugin, timeGrid],
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'today,prev,next',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                allDaySlot: false,
                locale: 'es',
                events: [], // Aquí asignamos los eventos cuando estén disponibles
            }
        }
    },
    mounted() {
        // Llamada fetch para obtener las notas y transformarlas en eventos
        fetch(route('notes.show', usePage().props.auth.user.id), {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest', // Asegura que se identifique como petición AJAX
                'Content-Type': 'application/json',
            },
        })
            .then((response) => response.json())
            .then((data) => {
                // Transformamos las notas en eventos para FullCalendar
                const events = data.notes.data.map((note) => ({
                    title: note.title,
                    start: note.creation_date, // La fecha de inicio de la nota
                    end: note.expiration_date, // Ajuste según tu necesidad
                    backgroundColor: '#FFB300',  // Color de fondo personalizado (puedes definirlo en tus datos)
                    borderColor: '#FFB300',      // Color del borde personalizado
                    textColor: '#000000'
                }));

                // Asignamos los eventos al calendario
                this.calendarOptions.events = events;
            })
            .catch((error) => {
                console.error('Error:', error); // Manejo de errores
            });
    },
}
</script>

<template>
    <FullCalendar :options="calendarOptions" />
</template>
