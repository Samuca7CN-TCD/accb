<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>ACCB</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
        <link rel="icon" type="imagem/png" href="storage/imagens/fixas/accb-logo.png" />

        <style type="text/css">
            header{
                height: 300px;
                background-image: url('storage/imagens/fixas/header-background-image-teste.jpg');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
            }

            header .gradiente{
                background-image: linear-gradient(
                    rgba(52, 58, 64, 0),
                    rgba(52, 58, 64, 0),
                    rgba(52, 58, 64, 0),
                    rgba(52, 58, 64, 0),
                    rgba(52, 58, 64, 0),
                    rgba(52, 58, 64, 0),
                    rgba(52, 58, 64, 0),
                    rgba(52, 58, 64, 0),
                    rgba(52, 58, 64, 0),    
                    rgba(52, 58, 64, 0.5),
                    rgba(52, 58, 64, 0.75),
                    rgba(52, 58, 64, 1.0)
                );
            }

            header .titulos{
                text-align: center;
                text-shadow: 0px 0px 5px black;
                word-wrap: break-word;
                width: 100%;
                height: 100%;
                display: table;
            }

            header .titulos div{
                text-align: center;
                vertical-align:middle;
                display:table-cell;
            }

            nav{
                z-index: 10000;
                font-size: 20px;
            }

            .footer-span {
                line-height: 50px;
            }

        </style>
    </head>
    <body>
        <div class="container-fluid">

            <header class="row justify-content-md-center">
                <div class="col-12 gradiente">
                    <div id="header_titulos" class="titulos">
                        <div>
                            <h1 class="text-light">Boletim ACCB/UESC</h1>
                            <h2 class="text-light">ISSN 2763-8936</h2>
                        </div>
                    </div>
                </div>
            </header>

                @component('components.component_navbar', ["current" => $current])
                @endcomponent

            <main class="row" role="main">
                @hasSection('body')
                    @yield('body')
                @endif
            </main>

            <foooter class="row text-center bg-dark text-light">
                <div class="col-12">
                    <span class="footer-span align-middle">Copyright ©2009 - {{ date('Y') }}  Departamento de Ciências Econômicas da UESC - DCEC. Todos os direitos reservados.</span>
                </div>
            </foooter>
        </div>

        <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

        <script type="text/javascript">

        function verticalAlign(obj){
            var parentHeight = $(obj).parent().height();
            var height = $(obj).height();
            var marginTop = (parentHeight - height) / 2;
            $(obj).css("margin-top", marginTop + "px");
        }

        function positionNav(){
            if($(document).scrollTop() >= 300){
                $("#navbar_principal").css("position", "fixed");
                $("#navbar_principal").css("top", "0px");
                $("#navbar_principal").css("width", "100%");
                $("#navbar_principal").css("box-shadow", "0px 5px 15px rgb(52, 58, 64)");
                $("#navbar_principal").css("transition", "linear 0.1s");
                
                $("header").css("margin-bottom", "60px");
            }else{
                $("#navbar_principal").css("position", "relative");
                $("#navbar_principal").css("top", "");
                $("#navbar_principal").css("width", "");
                $("#navbar_principal").css("box-shadow", "none");
                
                $("header").css("margin-bottom", "0px");
            }
        }

        $(window).resize(function(){
            verticalAlign($("#header_titulos"));
        });

        $(window).scroll(function(){
            positionNav();
        });

        $(function(){
            //verticalAlign($("#header_titulos"));
            positionNav();
        });

        </script>

        @hasSection('javascript')
            @yield('javascript')
        @endif

    </body>
</html>
