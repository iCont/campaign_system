<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    {{-- datatable --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

    <!-- sweetalert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <div class="navTop"></div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('../img/mujerradiante-logo2.png') }}" class="logo" alt="Logo radiante">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item"
                                        href="{{ route('identification.show_id_modalentification_member', Auth::user()->id) }}">
                                        {{ __('Identificación') }}
                                        @if (Auth::user()->status != 0)
                                            <a class="dropdown-item"
                                                href="{{ route('user.modifyprofile', Auth::user()->id) }}">
                                                {{ __('Perfil') }}
                                            </a>
                                        @else
                                            {{-- <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown"> --}}
                                            <a class="dropdown-item"
                                                href="{{ route('user.editprofile', Auth::user()->id) }}">
                                                {{ __('Perfil') }}
                                            </a>
                                        @endif
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
            @extends('layouts.footer')
        </main>
    </div>
    {{-- ventana modal --}}
    <div class="modal" id="modal_events" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Registro de fechas</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <form class="form-content" action="{{ route('campaings.store') }}" method="POST">
                                    @csrf
                                    <input type="HIDDEN" class="form-control" id="id">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nombre de la campaña:</label>
                                        <input type="text" class="form-control" id="campaing_name_id_modal" name="campaing_name"
                                            placeholder="Día del padre">
                                    </div>
                                    <div class="mb-3">
                                        <label for="holiday_day" class="form-label">Fecha:</label>
                                        <input type="date" class="form-control" id="holiday_day_id_modal" name="holiday_day">
                                    </div>
                                    <div class="mb-3">
                                        <label for="holiday_type" class="form-label">Tipo de día festivo:</label>
                                        <select id="holiday_type_id_modal" name="holiday_type" class="form-control input_style">
                                            <option selected="selected" value="0">Tipo de día</option>
                                            @foreach ($holidaysType as $holidayType)
                                                <option value="{{ $holidayType->id }}">
                                                    {{ $holidayType->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="checkRepite_id_modal"
                                            name="is_repeat">
                                        <label class="form-check-label" for="checkRepite">Se repite?</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btn_save" class="btn btn-primary">Guardar</button>
                </form>
              <button type="button" id="btn_edit" class="btn btn-success">Editar</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    {{-- ventana modal --}}
</body>
<!-- JavaScript Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>

<script>
    $('#myTable').DataTable({
        responsive: true,
        autoWidth: false
    });
</script>
@stack('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            themeSystem: 'bootstrap5',
            locales: 'es',
            events:
                @json($holidays),
                dateClick:function(info){
                    limpiarFormulario();
                    $('#btn_save').show();
                    $('#btn_edit').hide();
                    if (info.allDay) {
                        $('#holiday_day_id_modal').val(info.dateStr)
                    } else {

                    }
                    $("#modal_events").modal('show');
                },
                eventClick:function(info){
                    $('#btn_save').hide();
                    $('#btn_edit').show();
                    $('#id').val(info.event.id);
                    $('#campaing_name_id_modal').val(info.event.title);
                    $('#holiday_day_id_modal').val(moment(info.event.start).format("YYYY-MM-DD"));
                    // console.log(info.event.extendedProps.is_repeat);
                    $('#holiday_type_id_modal').val(info.event.extendedProps.holiday_type_id);
                    if(info.event.extendedProps.is_repeat==1){
                        $('#checkRepite_id_modal').prop('checked', true);
                    }else{
                        $('#checkRepite_id_modal').prop('checked', false);
                    }
                    // $('#checkRepite_id_modal').val('');
                    $("#modal_events").modal('show');
                }

        });
        calendar.render();
    });
       // funciones que interactuan con el formularioEventos
       function limpiarFormulario(){
            $('#campaing_name_id_modal').val('');
            $('#holiday_day_id_modal').val('');
            $('#holiday_type_id_modal').val('');
            $('#checkRepite_id_modal').prop('checked', false);
        }
</script>
</html>
