<!--Incluimos el header de la pagina-->
<?php include_once "components/header_2.php"; ?>
<?php
  // require('../includes/app.php');
  // use App\User;

  //  // Implementar un método para obtener todas las propiedades
  //  $propiedades = User::all();
?>
<main>
  <section class="absolute w-full h-full">
    <div class="absolute top-0 w-full h-full bg-gray-900"></div>
    <div class="container mx-auto px-4 h-full">
      <div class="flex content-center items-center justify-center h-full">
        <div class="w-full lg:w-4/12 px-4">
          <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-300 border-0">
            <div class="rounded-t mb-0 px-6 py-6">
              <div class="text-center mb-3">
                <h6 class="text-gray-600 text-sm font-bold">
                  Sign in with
                </h6>
              </div>
              <div class="btn-wrapper text-center">
                <button class="bg-white active:bg-gray-100 text-gray-800 px-4 py-2 rounded outline-none focus:outline-none mr-2 mb-1 uppercase shadow hover:shadow-md inline-flex items-center font-bold text-xs" type="button" style="transition: all 0.15s ease 0s;">
                  <img alt="..." class="w-5 mr-1" src="../assets/img/github.svg" />Github</button><button class="bg-white active:bg-gray-100 text-gray-800 px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1 uppercase shadow hover:shadow-md inline-flex items-center font-bold text-xs" type="button" style="transition: all 0.15s ease 0s;">
                  <img alt="..." class="w-5 mr-1" src="../assets/img/google.svg" />Google
                </button>
              </div>
              <hr class="mt-6 border-b-1 border-gray-400" />
            </div>
            <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
              <div class="text-gray-500 text-center mb-3 font-bold">
                <small>Or sign in with credentials</small>
              </div>
              <form class="login-form" action="../app/login.php" method="post">
                <div class="relative w-full mb-3">
                  <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="grid-password">Usuario</label>
                  <input name="user" type="user" class="border-0 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full" placeholder="Usuario" style="transition: all 0.15s ease 0s;" />
                </div>
                <div class="relative w-full mb-3">
                  <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="grid-password">Contraseña</label>
                  <input id="password" name="password" type="password" class="border-0 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full" placeholder="Contraseña" style="transition: all 0.15s ease 0s;" />
                  <button type="button" id="toggleVisibility" onclick="mostrarPassword()">Mostrar/ocultar contraseña</button>
                </div>
                <div>
                  <label class="inline-flex items-center cursor-pointer"><input id="customCheckLogin" type="checkbox" class="form-checkbox border-0 rounded text-gray-800 ml-1 w-5 h-5" style="transition: all 0.15s ease 0s;" /><span class="ml-2 text-sm font-semibold text-gray-700">Remember me</span></label>
                </div>
                <div class="text-center mt-6">
                  <input value="Iniciar sesion" class="bg-gray-900 cursor-pointer text-white active:bg-gray-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full" type="submit" style="transition: all 0.15s ease 0s;">
                  </input>
                </div>
                <a href="./register.php">Aun no tengo cuenta</a>
              </form>
            </div>
          </div>
          <div class="flex flex-wrap mt-6">
            <div class="w-1/2">
              <a href="#pablo" class="text-gray-300"><small>Forgot password?</small></a>
            </div>
            <div class="w-1/2 text-right">
              <a href="#pablo" class="text-gray-300"><small>Create new account</small></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--Incluimos el cambio de visibilidad de la contraseña-->
    <script src="../js/validarPassword.js"></script>
    <!--Inclumos los modales-->
    <?php include_once "components/modals.php"; ?>
    <!--Inclumos los footers de los logins-->
    <?php include_once "components/footer_2.php"; ?>