<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>MundoApuesta365</title>
    <meta name="author" content="" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="application-name" content="" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Force IE9 to render in normla mode -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Le styles -->
    <link href="{{URL::to('/')}}/css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="{{URL::to('/')}}/css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
    <link href="{{URL::to('/')}}/css/supr-theme/jquery.ui.supr.css" rel="stylesheet" type="text/css"/>
    <link href="{{URL::to('/')}}/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="{{URL::to('/')}}/plugins/forms/uniform/uniform.default.css" type="text/css" rel="stylesheet" />

    <!-- Main stylesheets -->
    <link href="{{URL::to('/')}}/css/main.css" rel="stylesheet" type="text/css" />

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

    <script type="text/javascript" src="{{URL::to('/')}}/js/libs/modernizr.js"></script>

    </head>

    <body class="loginPage">

    <div class="container">

        <div id="header">

            <div class="row">

                <div class="navbar">
                    <div class="container">
                        <a class="navbar-brand" href="{{URL::to('/')}}">MundoApuesta<span class="slogan">365</span></a>
                    </div>
                </div><!-- /navbar -->

            </div><!-- End .row -->

        </div><!-- End #header -->

    </div><!-- End .container -->

    <div class="container">

        <div class="loginContainer">

            {{Form::open(['url' => 'login', 'method' => 'POST',
            'class'=>'form-horizontal','id'=>'loginForm','role'=>'form'])}}

                <div class="form-group">
                    <label class="col-lg-12 control-label" for="username">Nombre de usuario:</label>
                    <div class="col-lg-12">
                        {{Form::text('username', '', [
                            'id' => 'username',
                            'class' => 'form-control',
                            'placeholder' => 'Ingresa tu nombre de usuario aqui ...'
                        ])}}

                        <span class="icon16 icomoon-icon-user right gray marginR10"></span>
                    </div>
                </div><!-- End .form-group  -->
                <div class="form-group">
                    <label class="col-lg-12 control-label" for="password">Clave de acceso:</label>
                    <div class="col-lg-12">
                        {{Form::password('password', [
                            'class' => 'form-control',
                            'placeholder' => '********'
                        ])}}

                        <span class="icon16 icomoon-icon-lock right gray marginR10"></span>
                    </div>
                </div><!-- End .form-group  -->
                @if (Session::has('error_login'))
                    <br />
                    <div class="text-danger"><b>Usuario o contraseña incorrectos.</b></div>
                    <br />
                @endif


                <div class="form-group">
                    <div class="col-lg-12 clearfix form-actions">
                        <button type="submit" class="btn btn-info right" id="loginBtn"><span class="icon16 icomoon-icon-enter white"></span> Iniciar Sesion</button>

                    </div>
                </div><!-- End .form-group  -->
            {{Form::close()}}


        </div>

    </div><!-- End .container -->

    <!-- Le javascript
    ================================================== -->
    <script  type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/js/bootstrap/bootstrap.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/plugins/forms/validate/jquery.validate.min.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/plugins/forms/uniform/jquery.uniform.min.js"></script>

     <script type="text/javascript">
        // document ready function
        $(document).ready(function() {
            //------------- Options for Supr - admin tempalte -------------//
            var supr_Options = {
                rtl:false//activate rtl version with true
            }
            //rtl version
            if(supr_Options.rtl) {
                localStorage.setItem('rtl', 1);
                $('#bootstrap').attr('href', 'css/bootstrap/bootstrap.rtl.min.css');
                $('#bootstrap-responsive').attr('href', 'css/bootstrap/bootstrap-responsive.rtl.min.css');
                $('body').addClass('rtl');
                $('#sidebar').attr('id', 'sidebar-right');
                $('#sidebarbg').attr('id', 'sidebarbg-right');
                $('.collapseBtn').addClass('rightbar').removeClass('leftbar');
                $('#content').attr('id', 'content-one')
            } else {localStorage.setItem('rtl', 0);}

            $("input, textarea, select").not('.nostyle').uniform();
            $("#loginForm").validate({
                rules: {
                    username: {
                        required: true,
                        minlength: 4
                    },
                    password: {
                        required: true,
                        minlength: 6
                    }
                },
                messages: {
                    username: {
                        required: "Este campo no puede quedar vacio",
                        minlength: "Ingresastes un nombre de usuario muy corto"
                    },
                    password: {
                        required: "Este campo no puede quedar vacio",
                        minlength: "Ingresastes un nombre de usuario muy corto"
                    }
                }
            });
        });
    </script>
      @if(Session::get('alertOn') != null)
        <script>
           alert("{{Session::get('alertOn')}} {{$errors->first()}}");
        </script>
    @endif

    </body>
</html>
