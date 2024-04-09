<!--Incluimos el header de la pagina-->
<?php include_once "components/header_2.php"; ?>

<main>
  <section class="absolute w-full h-full">
    <div class="absolute top-0 w-full h-full bg-gray-900"></div>
    <div class="container mx-auto px-4 h-full">
      <div class="flex content-center items-center justify-center h-full">
        <div class="w-full lg:w-4/12 px-4">
          <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-300 border-0">
            <div class="rounded-t mb-0 px-6 py-6">
              <div class="text-center mb-3 ">
                <h6 class="text-gray-600 text-sm font-bold uppercase">
                  Registrate para comenzar
                </h6>
              </div>

              <hr class="mt-6 border-b-1 border-gray-400" />
            </div>

            <div class="flex-auto px-4 lg:px-10 py-10 pt-0">

              <!--Aqui comienza el formulario-->
              <form method="post" action="registerCompany.php">
                <div class="relative w-full mb-3"> <!--Username-->
                  <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="grid-password">Usuario</label>
                  <input name="username" pattern="[A-Za-zé' 0-9]+" maxlength="15" minlength="5" required type="text" class="border-0 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full" placeholder="Pepe123" style="transition: all 0.15s ease 0s;" />
                </div> <!--Termina el username-->

                <div class="relative w-full mb-3"> <!--Email-->
                  <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="grid-password">Email</label>
                  <input name="email" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" required type="email" class="border-0 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full" placeholder="pepe123@gmail.com" style="transition: all 0.15s ease 0s;" />
                </div> <!--Termina el email-->

                <span id="errorCorreo" style="color: red;" class="mb-2"></span>

                <div class="relative w-full mb-3"> <!--Password-->
                  <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="grid-password">Contraseña</label>
                  <input id="password" name="password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$" minlength="4" oninput="validarPassword()" required type="password" class="border-0 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full" placeholder="******" style="transition: all 0.15s ease 0s;" />
                  <button type="button" id="toggleVisibility" onclick="mostrarPassword()">Mostrar/ocultar contraseña</button>
                </div> <!--Termina el password-->

                <!--Este span es el contenedor del cuerpo del script-->
                <span id="mensajeError" style="color: red;" class="mb-2"></span>

                <div>
                  <label class="inline-flex items-center cursor-pointer mt-2">
                    <input id="customCheckLogin" type="checkbox" class="form-checkbox border-0 rounded text-gray-800 ml-1 w-5 h-5" style="transition: all 0.15s ease 0s;" /> <span class="ml-2 text-sm font-semibold text-gray-700">Remember me</span></label>
                </div>

                <div class="text-center mt-6">
                  <input class="bg-gray-900 cursor-pointer text-white active:bg-gray-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full" type="submit" value="Siguiente" style="transition: all 0.15s ease 0s;" href="./registerCompany.php">
                  </input>
                </div>

                <div class="mt-5">
                  <a href="login.php">Volver atras</a>
                </div>

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
  </section>
</main>

<script src="../js/validarCorreo.js"></script>
<script src="../js/validarPassword.js"></script>

<!--Inclumos los footers de los logins-->
<?php include_once "components/footer_2.php"; ?>