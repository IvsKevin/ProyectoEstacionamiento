<!--Incluimos el header de la pagina-->
<?php include_once "components/header_2.php"; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $_SESSION['username'] = $_POST['username'];
  $_SESSION['email'] = $_POST['email'];
  $_SESSION['password'] = $_POST['password'];
}
?>

<main class="mt-10 h-max relative">
  <div class="flex-auto absolute top-0 w-full h-full bg-gray-900"></div>
  <div class="flex-auto container mx-auto px-4 h-full">
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

          <div class="flex-auto px-4 lg:px-10 py-5 pt-0">

            <!--Aqui comienza el formulario-->
            <form method="post" action="membership.php" class="relative mt-8 mb-8">
              <div class="relative w-full mb-3"> <!--Nombre de la empresa-->
                <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="grid-password">Nombre de la empresa</label>
                <input name="empresa" pattern="[A-Za-zé0-9.-]" required minlength="3" maxlength="20" type="text" class="border-0 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full" placeholder="Coca-Cola" style="transition: all 0.15s ease 0s;" />
              </div> <!--Termina el nombre de la empresa-->

              <div class="relative w-full mb-3"> <!--Correo electronico de la empresa-->
                <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="grid-password">Email de la empresa</label>
                <input name="email" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" required type="email" class="border-0 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full" placeholder="Email" style="transition: all 0.15s ease 0s;" />
              </div> <!--Termina el correo electronico de la empresa-->

              <div class="relative w-full mb-3"> <!--Direccion de la empresa-->
                <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="grid-password">Direccion de la empresa</label>
                <input name="direccion" pattern="[A-Za-zé0-9-.()]" maxlength="50" required type="text" class="border-0 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full" placeholder="Tecate-Libre 22253" style="transition: all 0.15s ease 0s;" />
              </div> <!--Termina la direccion de la empresa-->

              <div class="relative w-full mb-3"> <!--Pais de la empresa-->
                <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="grid-password">Pais</label>
                <input name="pais" maxlength="20" minlength="3" pattern="[A-Za-z\sáéíóúÁÉÍÓÚñÑüÜ]+" required type="text" class="border-0 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full" placeholder="Mexico" style="transition: all 0.15s ease 0s;" />
              </div> <!--Termina la pais de la empresa-->

              <div class="relative w-full mb-3"> <!--Estado de la empresa-->
                <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="grid-password">Estado</label>
                <input name="estado" maxlength="20" minlength="3" pattern="[A-Za-z\sáéíóúÁÉÍÓÚñÑüÜ]+" required type="text" class="border-0 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full" placeholder="Baja California" style="transition: all 0.15s ease 0s;" />
              </div> <!--Termina la Estado de la empresa-->

              <div class="relative w-full mb-3"> <!--Ciudad de la empresa-->
                <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="grid-password">Ciudad</label>
                <input name="ciudad" maxlength="30" minlength="3" pattern="[A-Za-z\sáéíóúÁÉÍÓÚñÑüÜ]+" required type="text" class="border-0 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full" placeholder="Tijuana" style="transition: all 0.15s ease 0s;" />
              </div> <!--Termina la Ciudad de la empresa-->

              <div class="relative w-full mb-3"> <!--Codigo postal de la empresa-->
                <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="grid-password">Codigo postal</label>
                <input name="postal" maxlength="5" max="99999" minlength="4" required type="number" class="border-0 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full" placeholder="22253" style="transition: all 0.15s ease 0s;" />
              </div> <!--Termina la Codigo postal de la empresa-->

              <div class="relative w-full mb-3"> <!--Telefono de la empresa-->
                <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="grid-password">Telefono</label>
                <input name="tel" maxlength="15" minlength="10" required type="tel" pattern="(\d{3}[\s-]?\d{3}[\s-]?\d{4}|\d{10})" pattern="" class="border-0 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full" placeholder="664 921 9211" style="transition: all 0.15s ease 0s;" />
              </div> <!--Termina la Telefono de la empresa-->

              <div>
                <label class="inline-flex items-center cursor-pointer">
                  <input id="customCheckLogin" type="checkbox" class="form-checkbox border-0 rounded text-gray-800 ml-1 w-5 h-5" style="transition: all 0.15s ease 0s;" /><span class="ml-2 text-sm font-semibold text-gray-700">Remember me</span></label>
              </div>
              <div class="text-center mt-6 cursor-pointer">
                <input class="cursor-pointer bg-gray-900 text-white active:bg-gray-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full" style="transition: all 0.15s ease 0s;" value="Siguiente" type="submit"></input>
              </div>

              <div class="mt-5"><a href="register.php">Volver atras</a></div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<!--Inclumos los footers de los logins-->
<?php include_once "components/footer_2.php"; ?>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    var footer = document.getElementById("footer");
    footer.classList.remove("absolute"); // Eliminamos la clase 'absolute' del footer
  });
</script>
