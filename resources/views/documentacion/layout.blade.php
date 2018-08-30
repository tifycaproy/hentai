<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hentai - Documentación APP</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('css/scrolling-nav.css')}}" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Hentai</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#services"></a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contact"></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <header class="bg-primary text-white">
      <div class="container text-center">
        <h1>Documentación</h1>
        <p class="lead">App Hentai</p>
      </div>
    </header>

    <section id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <h2>About this page</h2>
            <p class="lead">Este documento se desarrolló, con la finalidad de ofrecer documentación técnica basadas en todos los endpoints, creados para la APP</p>
            <ul>
              <li><a href="#registro">Registro de Usuario</a></li>
              <li><a href="#validar">Validar PIN</a></li>
              <li><a href="#iniciar">Iniciar Sesión</a></li>
              <li><a href="#perfil">Perfil</a></li>
              <li><a href="#reenviar">Reenviar Pin de Confirmación</a></li>
              <li><a href="#consultar">Consultar Videos</a></li>
              <li><a href="#crear">Crear Favoritos</a></li>
              <li><a href="#consultaf">Consultar Favoritos</a></li>
              <li><a href="#delete">Eliminar Favoritos</a></li>
              <li><a href="#descarga">Descarga</a></li>
              <li><a href="#historial">Historial</a></li>
              <li><a href="#ver">Ver más tarde</a></li>
              <li><a href="#const">Consultar Ver más tarde</a></li>
              <li><a href="#delt">Eliminar Ver más tarde</a></li>
              <li><a href="#bloqueo">Bloqueo</a></li>
              <li><a href="#cambiar">Cambiar Contraseña</a></li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <section id="services" class="bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <h2 id="registro">Registro de Usuarios</h2>
            <p class="lead">Nombre de Endpoint: Registro</p>
            <p class="lead">Ruta:/api/registro</p>
            <p class="lead">Método => "POST"</p>
            <p class="lead">Parámetros => array(
                "name" => "varchar(100) / requerido",
                "email" => "varchar(100) / requerido / único",
                "password" => "varchar(20) / requerido",),
                "Éxito" => "token, idusuario, codigo",
                "Falla" => array(
                "error" => array("Error en validación de datos", "El email ya se encuentra registrado")
        )</p>

          </div>
          <div class="col-lg-8 mx-auto">
            <h2 id="validar">Validar PIN</h2>
            <p class="lead">Nombre de Endpoint: Validar</p>
            <p class="lead">Ruta:/api/validar</p>
            <p class="lead">Método => "POST"</p>
            <p class="lead">Parámetros => array(
                "email" => "varchar(100) / requerido / único",
                "pin" => "varchar(4) / requerido",),
                "Éxito" => ["token", "idusuario", "codigo"],
                "Falla" => array(
                "error" => array("Error en validación de datos", "Usuario o PIN incorrectos")
           )</p>
          </div>

          <div class="col-lg-8 mx-auto">
            <h2 id="iniciar">Iniciar Sesion</h2>
            <p class="lead">Nombre de Endpoint: Ingresar</p>
            <p class="lead">Ruta:/api/ingresar</p>
            <p class="lead">Método => "POST"</p>
            <p class="lead">Parámetros => array(
                "email" => "varchar(100) / requerido / único",
                "password" => "varchar(20) / requerido",),
                "Éxito" => "token, idusuario, codigo",
                "Falla" => array(
                "error" => array("Error en validación de datos", "Usuario o password incorrectos")
            )</p>
          </div>

          <div class="col-lg-8 mx-auto">
            <h2 id="perfil">Consultar Perfil</h2>
            <p class="lead">Nombre de Endpoint: Perfil</p>
            <p class="lead">Ruta:/api/perfil</p>
            <p class="lead">Método => "GET"</p>
            <p class="lead">Parámetros => array(
                "token" => "varchar(200) / requerido / único",
                "Éxito" => "email, name",
                "Falla" => array(
                "error" => array("Error en validación de datos", "Usuario o password incorrectos")
            )</p>
          </div>

       <div class="col-lg-8 mx-auto">
            <h2 id="reenviar">Reenviar PIN de Confirmación</h2>
            <p class="lead">Nombre de Endpoint: reenviar_pin</p>
            <p class="lead">Ruta:/api/reenviar_pin</p>
            <p class="lead">Método => "POST"</p>
            <p class="lead">Parámetros => array(
                "email" => "varchar(100) / requerido / único"),
                "Éxito" => "token, idusuario, codigo",
                "Falla" => array(
                "error" => array("Error en validación de datos", "Usuario o password incorrectos")
            )</p>
          </div>          

          <div class="col-lg-8 mx-auto">
            <h2 id="videos">Videos</h2>
            <p class="lead">Nombre de Endpoint: consultar</p>
            <p class="lead">Ruta:/api/consulta_videos</p>
            <p class="lead">Método => "GET"</p>
            <p class="lead">Exito => array ('id', 'titulo',
                'descripcion', 'url','url2','img','capitulo', 'categoria:array['idc','name']')</p>
          </div>

          <div class="col-lg-8 mx-auto">
            <h2 id="crear">Crear Favorito</h2>
            <p class="lead">Nombre de Endpoint: add_favorito</p>
            <p class="lead">Ruta:/api/add_favorito</p>
           <p class="lead">Método => "POST"</p>
            <p class="lead">Parámetros => array(
                "codigo" => "integer/ requerido", "id" => "integer/ requerido"),
                "Éxito" => "token, idusuario, codigo",
                "Falla" => array(
                "error" => array("Error en validación de datos")
            )</p>
            <p>Nota: El codigo, es el id de usuario, cuando ingresas a la app, y el id se envia en el json de videos</p>
          </div>

       <div class="col-lg-8 mx-auto">
            <h2 id="consultaf">Consultar Favorito</h2>
            <p class="lead">Nombre de Endpoint: cons_favorito</p>
            <p class="lead">Ruta:/api/cons_favorito</p>
           <p class="lead">Método => "GET"</p>
            <p class="lead">Parámetros => array(
                "codigo" => "integer/ requerido"),
                "Éxito" => "id, titulo, idusuario",
                "Falla" => array(
                "error" => array("Error en validación de datos")
            )</p>
            <p>Nota: El codigo, es el id de usuario,  cuando ingresas a la app</p>
          </div>

         <div class="col-lg-8 mx-auto">
            <h2 id="delete">Eliminar Favorito</h2>
            <p class="lead">Nombre de Endpoint: del_favorito</p>
            <p class="lead">Ruta:/api/del_favorito</p>
           <p class="lead">Método => "GET"</p>
            <p class="lead">Parámetros => array(
                "codigo" => "integer/ requerido", "id" => "integer/ requerido"),
                "Éxito" => "token, idusuario, codigo",
                "Falla" => array(
                "error" => array("Error en validación de datos")
            )</p>
            <p>Nota: El codigo, es el id de usuario,  cuando ingresas a la app, y el id se envia en el json de videos</p>
          </div>

      <div class="col-lg-8 mx-auto">
            <h2 id="descarga">Descargar</h2>
            <p class="lead">Nombre de Endpoint: add_favorito</p>
            <p class="lead">Ruta:/api/add_dowl</p>
           <p class="lead">Método => "POST"</p>
            <p class="lead">Parámetros => array(
                "codigo" => "integer/ requerido", "id" => "integer/ requerido"),
                "Éxito" => "token, idusuario, codigo",
                "Falla" => array(
                "error" => array("Error en validación de datos")
            )</p>
            <p>Nota: El codigo, es el id de usuario, que se envia cuando ingresas a la app, y el id se envia en el json de videos</p>
          </div>

        <div class="col-lg-8 mx-auto">
            <h2 id="historial">Consultar Historial</h2>
            <p class="lead">Nombre de Endpoint: historial</p>
            <p class="lead">Ruta:/api/historial</p>
           <p class="lead">Método => "GET"</p>
            <p class="lead">Parámetros => array(
                "codigo" => "integer/ requerido"),
                "Éxito" => "id, titulo, idusuario",
                "Falla" => array(
                "error" => array("Error en validación de datos")
            )</p>
            <p>Nota: El codigo, es el id de usuario, que cuando ingresas a la app</p>
          </div>

          <div class="col-lg-8 mx-auto">
            <h2 id="ver">Ver más Tarde</h2>
            <p class="lead">Nombre de Endpoint: add_tarde</p>
            <p class="lead">Ruta:/api/add_tarde</p>
           <p class="lead">Método => "POST"</p>
            <p class="lead">Parámetros => array(
                "codigo" => "integer/ requerido", "id" => "integer/ requerido"),
                "Éxito" => "token, idusuario, codigo",
                "Falla" => array(
                "error" => array("Error en validación de datos")
            )</p>
            <p>Nota: El codigo, es el id de usuario, cuando ingresas a la app, y el id se envia en el json de videos</p>

          </div>
       <div class="col-lg-8 mx-auto">
            <h2 id="consultaf">Consultar Ver Más Tarde</h2>
            <p class="lead">Nombre de Endpoint: cons_tarde</p>
            <p class="lead">Ruta:/api/cons_tarde</p>
           <p class="lead">Método => "GET"</p>
            <p class="lead">Parámetros => array(
                "codigo" => "integer/ requerido"),
                "Éxito" => "id, titulo, idusuario",
                "Falla" => array(
                "error" => array("Error en validación de datos")
            )</p>
            <p>Nota: El codigo, es el id de usuario,  cuando ingresas a la app</p>
          </div>

         <div class="col-lg-8 mx-auto">
            <h2 id="delete">Eliminar Ver Más Tarde</h2>
            <p class="lead">Nombre de Endpoint: del_tarde</p>
            <p class="lead">Ruta:/api/del_tarde</p>
           <p class="lead">Método => "GET"</p>
            <p class="lead">Parámetros => array(
                "codigo" => "integer/ requerido", "id" => "integer/ requerido"),
                "Éxito" => "token, idusuario, codigo",
                "Falla" => array(
                "error" => array("Error en validación de datos")
            )</p>
            <p>Nota: El codigo, es el id de usuario,  cuando ingresas a la app, y el id se envia en el json de videos</p>
          </div>
          <div class="col-lg-8 mx-auto">
            <h2 id="ver">Bloqueo</h2>
            <p class="lead">Nombre de Endpoint: bloqueo</p>
            <p class="lead">Ruta:/api/bloqueo</p>
           <p class="lead">Método => "POST"</p>
            <p class="lead">Parámetros => array(
                "codigo" => "integer/ requerido", "pin_bloqueo" => "integer/ requerido"),
                "Éxito" => "token, idusuario, codigo",
                "Falla" => array(
                "error" => array("Error en validación de datos")
            )</p>
          </div>

      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <h2 id="cambiar">Cambiar contraseña</h2>
            <p class="lead">Nombre de Endpoint: Cambiar</p>
            <p class="lead">Ruta:/api/cambiar</p>
            <p class="lead">Método => "POST"</p>
            <p class="lead">Parámetros => array(
                "email" => "varchar(100) / requerido / único",
                "pass_old" => "varchar(20) / requerido",),
                "pass_new" => "varchar(20) / requerido",),
                "Éxito" => "token, idusuario, codigo",
                "Falla" => array(
                "error" => array("Error en validación de datos", "El email no se encuentra registrado, Password Incorrecto")
        )</p>

          </div>


        </div>
      </div>
    </section>


    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright -Hentai 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Plugin JavaScript -->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom JavaScript for this theme -->
    <script src="{{asset('js/scrolling-nav.js')}}"></script>

  </body>

</html>

















