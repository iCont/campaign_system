@extends('layouts.app')
@section('name')
    <div class="div_campaing">
        <div class="container ">
            <div class="row">
                <div class="col-xm-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h4 class="text-uppercase" id="title_form">Registro de fechas</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 div_form">
                                    <form class="form-content" action="{{ route('campaings.store') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Nombre de la campaña:</label>
                                            <input type="text" class="form-control" name="campaing_name"
                                                placeholder="Día del padre">
                                        </div>
                                        <div class="mb-3">
                                            <label for="holiday_day" class="form-label">Fecha:</label>
                                            <input type="date" class="form-control" name="holiday_day">
                                        </div>
                                        <div class="mb-3">
                                            <label for="holiday_type" class="form-label">Tipo de día festivo:</label>
                                            <select name="holiday_type" class="form-control input_style">
                                                <option selected="selected" value="0">Tipo de día</option>
                                                @foreach ($holidaysType as $holidayType)
                                                    <option value="{{ $holidayType->id }}">
                                                        {{ $holidayType->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" id="checkRepite"
                                                name="is_repeat">
                                            <label class="form-check-label" for="checkRepite">Se repite?</label>
                                        </div>
                                        <div class="text-center">
                                            <button class="btn btn-primary_1">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="separador" id="separador_div"></div>
                <div class="col-xm-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
    {{-- alerts visualizacion --}}
    @if (Session::has('success'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Campaña guardada',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @else
    @endif
    @push('scripts')
    @endsection
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                themeSystem: 'bootstrap5',
                locales: 'es',
                events: @json($holidays)
            });
            calendar.render();
        });
    </script>
@endpush
