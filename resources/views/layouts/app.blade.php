<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" href="images/3747logo2.ico">

        <title>Clínica</title>

        <!-- Switchery css -->
        <!--<link href="{{ asset('theme/uplon-admin/plugins/morris/morris.css') }}" rel="stylesheet">-->

        <!-- Switchery css -->
        <link href="{{ asset('theme/uplon-admin/plugins/switchery/switchery.min.css') }}" rel="stylesheet">

        <!-- Bootstrap CSS -->
        <link href="{{ asset('theme/uplon-admin/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- App CSS -->
        <link href="{{ asset('theme/uplon-admin/css/style.css') }}" rel="stylesheet">

        <!-- Jquery filer css -->
        <link href="{{ asset('theme/uplon-admin/plugins/jquery.filer/css/jquery.filer.css') }}" rel="stylesheet">
        <link href="{{ asset('theme/uplon-admin/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css') }}"
              rel="stylesheet">

        <!-- Modernizr js -->
        <script src="{{ asset('theme/uplon-admin/js/modernizr.min.js') }}"></script>

        <!--Select2-->
        <link href="{{ asset('theme/uplon-admin/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

        <link href="{{ asset('theme/uplon-admin/plugins/custombox/css/custombox.min.css') }}" rel="stylesheet">

        <!-- DataTables -->
        <link href="{{ asset('theme/uplon-admin/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
        <link href="{{ asset('theme/uplon-admin/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet">
        <link href="{{ asset('theme/uplon-admin/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}"
              rel="stylesheet">

        <script src="{{ asset('theme/uplon-admin/js/jquery.min.js') }}"></script>
        <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

        <script src="{{ asset('theme/uplon-admin/js/bootstrap.min.js') }}"></script>


    </head>

    <body class="fixed-left">


        <div id="wrapper">
            <div id="app" style='display:none'>
                @if (!Auth::guest())


                <div class="topbar">

                    <div class="topbar-left">
                        <a href="" class="logo">
                            <span><i class='fa fa-hospital-o'></i> Clínica</span></a>
                    </div>

                    <nav class="navbar-custom">

                        <ul class="list-inline float-right mb-0">
                            <slot></slot>

                            <li class="list-inline-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown"
                                   href="#" role="button"
                                   aria-haspopup="false" aria-expanded="false">
                                    <img src="{{url('images/perfil',Auth::user()->img)}}" alt="user" class="rounded-circle">

                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                                    <!-- item-->
                                    <div class="dropdown-item noti-title">
                                        <h5 class="text-overflow">
                                            <small>Olá ! {{ Auth::user()->name }} </small>
                                        </h5>
                                    </div>

                                    <a href="/perfil" class="dropdown-item notify-item">
                                        <i class="zmdi zmdi-account-circle"></i> <span>Profile</span>
                                    </a>

                                    <a href="/logout" class="dropdown-item notify-item">
                                        <i class="zmdi zmdi-power"></i> <span>Sair</span>
                                    </a>
                                </div>
                            </li>
                        </ul>

                        <ul class="list-inline menu-left mb-0">
                            <li class="float-left">
                                <button class="button-menu-mobile open-left waves-light waves-effect">
                                    <i class="zmdi zmdi-menu"></i>
                                </button>
                            </li>

                        </ul>

                    </nav>
                </div>

                <menudefault>

                    <li class="has_sub">
                        <a href="/admin" class="waves-effect"><i class="zmdi zmdi-view-dashboard"></i><span> Geral </span>
                        </a>
                    </li>

                    <li class="has_sub">
                        <a href="/agendamentos" class="waves-effect"><i class="fa fa-calendar"></i><span> Agendamentos </span>
                        </a>
                    </li>

                    <li class="has_sub">
                        <a href="/especialidades" class="waves-effect"><i class="fa fa-list-alt"></i><span> Especialidades </span>
                        </a>
                    </li>

                    <li class="has_sub">
                        <a href="/medicos" class="waves-effect"><i class="fa fa-user-md"></i><span> Médicos </span>
                        </a>
                    </li>

                    <li class="has_sub">
                        <a href="/pacientes" class="waves-effect"><i class="fa fa-user"></i><span> Pacientes </span>
                        </a>
                    </li>

                    <li class="has_sub">
                        <a href="/planos" class="waves-effect"><i class="fa fa-list-alt"></i><span> Planos </span>
                        </a>
                    </li>



                </menudefault>

                <page>

                    @yield('content')
                </page>

            </div>
            <footer class="footer text-right">
                Desenvolvido por Jonathan Cruz - <a href="email:jonathansc92@gmail.com">jonathansc92@gmail.com</a>
            </footer>
            @endif
        </div>

        <!-- Scripts  vuejs-->
        <script src="{{ asset('js/app.js') }}"></script>
        <script>
        var resizefunc = [];
        </script>

        <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
        <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
        <script>
        $('textarea').ckeditor();
        // $('.textarea').ckeditor(); // if class is prefered.
        </script>

        <!-- JQuery -->
        <script src="{{ asset('theme/uplon-admin/js/tether.min.js') }}"></script>
        <script src="{{ asset('theme/uplon-admin/js/detect.js') }}"></script>
        <script src="{{ asset('theme/uplon-admin/js/fastclick.js') }}"></script>
        <script src="{{ asset('theme/uplon-admin/js/jquery.blockUI.js') }}"></script>
        <script src="{{ asset('theme/uplon-admin/js/waves.js') }}"></script>
        <script src="{{ asset('theme/uplon-admin/js/jquery.nicescroll.js') }}"></script>
        <script src="{{ asset('theme/uplon-admin/js/jquery.scrollTo.min.js') }}"></script>
        <script src="{{ asset('theme/uplon-admin/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('theme/uplon-admin/plugins/switchery/switchery.min.js') }}"></script>

        <!-- Required datatable js -->
        <script src="{{ asset('theme/uplon-admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('theme/uplon-admin/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

        <!-- Jquery filer js -->
        <script src="{{ asset('theme/uplon-admin/plugins/jquery.filer/js/jquery.filer.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('theme/uplon-admin/js/jquery.core.js') }}"></script>
        <script src="{{ asset('theme/uplon-admin/js/jquery.app.js') }}"></script>

        <!-- page specific js -->
        <script src="{{ asset('theme/uplon-admin/pages/jquery.fileuploads.init.js') }}"></script>

        <!-- Page specific js -->
        <!--<script src="{{ asset('theme/uplon-admin/pages/jquery.dashboard.js') }}"></script>-->


        <!--Select2-->
        <script src="{{ asset('theme/uplon-admin/plugins/select2/js/select2.full.min.js') }}"></script>

        <!-- Modal-Effect -->
        <script src="{{ asset('theme/uplon-admin/plugins/custombox/js/custombox.min.js') }}"></script>
        <script src="{{ asset('theme/uplon-admin/plugins/custombox/js/legacy.min.js') }}"></script>

        <script src="{{ asset('theme/uplon-admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

        <script>
        $('#flash-overlay-modal').modal();
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
        </script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        {!! Toastr::render() !!}

        @include('components.modal')
    </body>
</html>
