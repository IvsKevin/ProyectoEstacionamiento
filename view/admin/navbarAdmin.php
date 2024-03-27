<!DOCTYPE html>
<html>
<?php include_once (__DIR__.'/../../app/session.php'); ?>
<?php if(!isset($_SESSION['client_id'])) {
  header('Location:../../index.php');
}?>


<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <link rel="stylesheet" href="../../css/output.css">
  <title>Dashboard | Parking Manager</title>
</head>

<body class="bg-gris-clarito antialiased">
  <div id="root">
    <nav class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-col md:flex-nowrap md:overflow-hidden bg-gris-oscurito flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6">
      <div class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto">
        <button class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent" type="button" onclick="toggleNavbar('example-collapse-sidebar')">
          <i class="fas fa-bars"></i></button>
        <a class="md:block text-left md:pb-2 text-blueGray-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0" href="javascript:void(0)">
          Parking Manager
        </a>

        <div class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded hidden" id="example-collapse-sidebar">
          <ul class="md:flex-col md:min-w-full flex flex-col list-none">
            <li class="items-center rounded-xl pl-4 pr-4 hover:bg-gris-clarito">
              <a href="dashboard.php" id="dashboardLink" class="hover:text-gray-100 text-xs uppercase py-3 font-bold block"><i class="fas fa-tv opacity-75 mr-2 text-sm"></i>
                Dashboard</a>
            </li>
            <li id="clientesContainer" class="items-center rounded-xl pl-4 pr-4 hover:bg-gris-clarito">
              <a href="clientes.php" id="clientesLink" class="hover:text-gray-100 text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block"><i class="fas fa-newspaper text-blueGray-400 mr-2 text-sm"></i>
                Clientes</a>
            </li>
            <li id="gananciasContainer" class="items-center rounded-xl pl-4 pr-4 hover:bg-gris-clarito">
              <a href="ganancias.php" id="gananciasLink" class="hover:text-gray-100 text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block"><i class="fas fa-user-circle text-blueGray-400 mr-2 text-sm"></i>
                Ganancias</a>
            </li>
            <li id="historialContainer" class="items-center rounded-xl pl-4 pr-4 hover:bg-gris-clarito">
              <a href="historial.php" id="historialLink" class="hover:text-gray-100 text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block"><i class="fas fa-fingerprint text-blueGray-400 mr-2 text-sm"></i>
                  Historial</a>
            </li>
            <li id="membresiasContainer" class="items-center rounded-xl pl-4 pr-4 hover:bg-gris-clarito">
              <a href="membresias.php" id="membresiasLink" class="hover:text-gray-100 text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block"><i class="fas fa-fingerprint text-blueGray-400 mr-2 text-sm"></i>
                Membresias</a>
            </li>
          </ul>
          <hr class="my-4 md:min-w-full" />
          <h6 class="md:min-w-full text-blueGray-500 text-xs uppercase font-bold block pt-1 pb-4 no-underline">            
          </h6 >
          <ul class="md:flex-col md:min-w-full flex flex-col list-none md:mb-4">
            <li class="items-center rounded-xl pl-4 pr-4 hover:bg-gris-clarito">
              <?php include_once "../components/modals.php"; ?>
              <button onclick="cerrarSesion()" class="hover:text-gray-100 text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block"><i class="fas fa-fingerprint text-blueGray-400 mr-2 text-sm"></i>
                Logout</button>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="relative md:ml-64 bg-blueGray-50 min-h-screen">
      <!-- Aquí va el contenido de tu página -->
    </div>
  </div>
</body>
</html>
