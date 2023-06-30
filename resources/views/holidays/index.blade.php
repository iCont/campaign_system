@extends('layouts.app')
@section('name')
    <div class="container prueba">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="text-uppercase">Campañas</h1>
            </div>
        </div>
        <hr>
        <div class="row prueba">
            <div class="col-4 prueba">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h4>Registro de fechas</h4>
                            </div>
                            <form action=""></form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8 prueba">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
    @push('scripts')
    @endsection
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locales: 'es',
                events: @json($holidays)
            });
            calendar.render();
        });
    </script>
@endpush
