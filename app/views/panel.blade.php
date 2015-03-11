<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>
        @section('web-titulo')

        @show
    </title>
    <meta name="author" content="" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="application-name" content="" />
    <meta http-equiv="refresh" content="600">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Force IE9 to render in normla mode -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Le styles -->
    <!-- Use new way for google web fonts
    http://www.smashingmagazine.com/2012/07/11/avoiding-faux-weights-styles-google-web-fonts -->
    <!-- Headings -->
    <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css' />  -->
    <!-- Text -->
    <!-- <link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css' /> -->
    <!--[if lt IE 9]>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:700" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Droid+Sans:400" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Droid+Sans:700" rel="stylesheet" type="text/css" />
    <![endif]-->

    <!-- Core stylesheets do not remove -->
    <link id="bootstrap" href="{{URL::to('/')}}/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL::to('/')}}/css/bootstrap/bootstrap-theme.css" rel="stylesheet" type="text/css" />
    <link href="{{URL::to('/')}}/css/supr-theme/jquery.ui.supr.css" rel="stylesheet" type="text/css"/>
    <link href="{{URL::to('/')}}/css/icons.css" rel="stylesheet" type="text/css" />

    <!-- Plugin stylesheets -->
    <link href="plugins/misc/qtip/jquery.qtip.css" rel="stylesheet" type="text/css" />
    <link href="plugins/forms/uniform/uniform.default.css" type="text/css" rel="stylesheet" />

    <!-- Main stylesheets -->
    <link href="{{URL::to('/')}}/css/main.css" rel="stylesheet" type="text/css" />

    <!-- Custom stylesheets ( Put your own changes here ) -->
    <link href="{{URL::to('/')}}/css/custom.css" rel="stylesheet" type="text/css" />

    <!--[if IE 8]><link href="{{URL::to('/')}}/css/ie8.css" rel="stylesheet" type="text/css" /><![endif]-->

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script type="text/javascript" src="{{URL::to('/')}}/js/libs/excanvas.min.js"></script>
      <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <script type="text/javascript" src="{{URL::to('/')}}/js/libs/respond.min.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="images/favicon.ico" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/apple-touch-icon-144-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/apple-touch-icon-114-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/apple-touch-icon-72-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" href="images/apple-touch-icon-57-precomposed.png" />

    <!-- Windows8 touch icon ( http://www.buildmypinnedsite.com/ )-->
    <meta name="application-name" content="Supr"/>
    <meta name="msapplication-TileColor" content="#3399cc"/>

    <!-- Load modernizr first -->
    <script type="text/javascript" src="{{URL::to('/')}}/js/libs/modernizr.js"></script>

    <style>
        @media screen and (min-width: 1000px) {
          .modal-dialog {
            width: 900px;
            padding-top: 30px;
            padding-bottom: 30px;
          }
          .modal-content {
            -webkit-box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
                    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
          }
        }

        .ui-timepicker-hour-cell, .ui-timepicker-minute-cell {
            cursor: pointer;
        }
  </style>
    <link href="{{URL::to('/')}}/css/ui.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
    <!-- loading animation -->
    <div id="qLoverlay"></div>
    <div id="qLbar"></div>

    <div id="header">
        <nav class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{URL::to('/')}}">MundoApuesta<span class="slogan">365</span></a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">

                <ul class="nav navbar-right usernav">
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle avatar" data-toggle="dropdown">
                            <img src="{{URL::to('/')}}/images/a{{Auth::user()->rol}}.png" alt="" class="image" />
                            <span class="txt">
                            {{Auth::user()->nombre}} {{Auth::user()->apellido}}
                            <b>({{User::getRol(Auth::user()->rol)}})</b>
                            </span>
                    </a>
                    </li>
                    <li><a href="{{URL::to('/logout')}}"><span class="icon16 icomoon-icon-exit"></span><span class="txt"> Cerrar Sesion</span></a></li>
                </ul>
            </div><!-- /.nav-collapse -->
        </nav><!-- /navbar -->

    </div><!-- End #header -->

    <div id="wrapper">

        <!--Responsive navigation button-->
        <div class="resBtn">
            <a href="#"><span class="icon16 minia-icon-list-3"></span></a>
        </div>


        <!--Sidebar background-->
        <div id="sidebarbg"></div>
        <!--Sidebar content-->
        <div id="sidebar">

            <div class="shortcuts">
                @include('extras.navigationBarTop')
            </div><!-- End search -->

            <div class="sidenav">

                <div class="sidebar-widget" style="margin: -1px 0 0 0;">
                    <h5 class="title" style="margin-bottom:0">Navegacion</h5>
                </div><!-- End .sidenav-widget -->

            @include('extras.navigation')
            </div><!-- End sidenav -->


        </div><!-- End #sidebar -->

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">


                        @if(Session::get('successMsj') == null)
                            <h3>
                                @section('mod-titulo')
                                @show
                            </h3>
                        @else
                            <h3> <span class="icon16 icomoon-icon-info"></span> {{Session::get('successMsj')}}</h3>
                        @endif


                    <div class="resBtnSearch">
                        <a href="#"><span class="icon16 icomoon-icon-search-3"></span></a>
                    </div>

                    <ul class="breadcrumb">
                        <li></li>
                        <li>
                            <a href="{{URL::to('/')}}" class="tip" title="Ir a inicio">
                                <span class="icon16 icomoon-icon-screen-2"></span>
                            </a>
                            <span class="divider">
                                <span class="icon16 icomoon-icon-arrow-right-3"></span>
                            </span>
                        </li>
                        <li class="active">
                            @section('web-titulo')
                            @show
                        </li>
                    </ul>

                </div><!-- End .heading-->

                <!-- Build page from here: -->
                <div class="row">
                    @yield('web-contenido')
                </div><!-- End .row -->
                <!--End page -->

            </div><!-- End contentwrapper -->
        </div><!-- End #content -->

    </div><!-- End #wrapper -->

    <!-- Le javascript
    ================================================== -->
    <!-- Important plugins put in all pages -->
    <script  type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/js/bootstrap/bootstrap.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/js/jquery.mousewheel.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/js/libs/jRespond.min.js"></script>

    <!-- Charts plugins -->
    <script type="text/javascript" src="{{URL::to('/')}}/plugins/charts/sparkline/jquery.sparkline.min.js"></script><!-- Sparkline plugin -->

    <!-- Misc plugins -->
    <script type="text/javascript" src="{{URL::to('/')}}/plugins/misc/qtip/jquery.qtip.min.js"></script><!-- Custom tooltip plugin -->
    <script type="text/javascript" src="{{URL::to('/')}}/plugins/misc/totop/jquery.ui.totop.min.js"></script>

    <!-- Search plugin -->
    <script type="text/javascript" src="{{URL::to('/')}}/plugins/misc/search/tipuesearch_set.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/plugins/misc/search/tipuesearch_data.js"></script><!-- JSON for searched results -->
    <script type="text/javascript" src="{{URL::to('/')}}/plugins/misc/search/tipuesearch.js"></script>

    <!-- Form plugins -->
    <script type="text/javascript" src="{{URL::to('/')}}/plugins/forms/uniform/jquery.uniform.min.js"></script>

    <!-- Init plugins -->
    <script type="text/javascript" src="{{URL::to('/')}}/js/main.js"></script><!-- Core js functions -->
    <script type="text/javascript" src="{{URL::to('/')}}/js/empty.js"></script><!-- Init plugins only for page -->


    <!-- Table plugins -->
    <script type="text/javascript" src="{{URL::to('/')}}/plugins/tables/dataTables/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/plugins/tables/dataTables/TableTools.min.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/plugins/tables/dataTables/ZeroClipboard.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/plugins/tables/responsive-tables/responsive-tables.js"></script><!-- Make tables responsive -->


    <script src="{{URL::to('/')}}/js/ui.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/js/jquery.ui.timepicker.js"></script>


    <script>
      $(function() {
        $(".fecha").datepicker({
          changeMonth: true,
          changeYear: true
        });

        $("#fecha2").datepicker({
          changeMonth: true,
          changeYear: true
        });

        $(".hora").timepicker({
            showPeriod: true,
            showLeadingZero: true
        });

        $(".hora2").timepicker({
            showPeriod: true,
            showLeadingZero: true
        });

      });
    </script>

    @if(Session::get('modalName') != null)
        <script>
            $('{{Session::get('modalName')}}').modal('show');
        </script>
    @endif

    @if(Session::get('alertOn') != null)
        <script>
           alert("{{Session::get('alertOn')}} {{$errors->first()}}");
        </script>
    @endif

    @if(Session::get('redirect') != null)
        <script>
            window.location="{{Session::get('redirect')}}";
        </script>
    @endif



    </body>
</html>
