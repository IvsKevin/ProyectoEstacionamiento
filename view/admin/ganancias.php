<!--Incluimos el navbar-->
<?php include_once "navbarAdmin.php"; ?>

<?php
//Agregamos la clase del empleados.
include_once(__DIR__ . "/../../data/class/payment.php");

//Creamos un objeto que sea de nuestro cliente para obtener todos sus valores.
$payment = new Payment();
$payments = $payment->getAllPayments();

$sum = new Payment();
$suma = $sum -> sumPayment();

?>
<?php if ($payments != "error") { ?>
    <nav class="absolute top-0 left-0 w-full z-10 bg-transparent md:flex-row md:flex-nowrap md:justify-start flex items-center p-4">
          <div class="w-full mx-autp items-center flex justify-between md:flex-nowrap flex-wrap md:px-10 px-4">
            <a class="text-white text-3xl uppercase hidden lg:inline-block font-semibold">Ganancias</a>
            <form class="md:flex hidden flex-row flex-wrap items-center lg:ml-auto mr-3">
              <div class="relative flex w-full flex-wrap items-stretch">
                <span class="z-10 h-full leading-snug font-normal text-center text-blueGray-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3"><i class="fas fa-search"></i></span>
                <input type="text" placeholder="Search here..." class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm shadow outline-none focus:outline-none focus:ring w-full pl-10" />
              </div>
            </form>
            <ul class="flex-col md:flex-row list-none items-center hidden md:flex">
              <a class="text-blueGray-500 block" href="#pablo" onclick="openDropdown(event,'user-dropdown')">
                <div class="items-center flex">
                  <span class="w-12 h-12 text-sm text-white bg-blueGray-200 inline-flex items-center justify-center rounded-full"><img alt="..." class="w-full rounded-full align-middle border-none shadow-lg" src="./assets/img/team-1-800x800.jpg" /></span>
                </div>
              </a>
              <div class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mt-1" style="min-width: 12rem;" id="user-dropdown">
                <a href="#pablo" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Action</a><a href="#pablo" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Another action</a><a href="#pablo" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Something else here</a>
                <div class="h-0 my-2 border border-solid border-blueGray-100"></div>
                <a href="#pablo" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Seprated link</a>
              </div>
            </ul>
          </div>
        </nav>
    <div>
        <div class="relative md:pt-32 pb-32 pt-12">
            <div class="px-4 md:px-10 mx-auto w-full">
                <div>
                    <section class=" w-full">
                    </section>
                    <div class="overflow-x-auto">
                        <table class="table bg-gray-600">
                            <!-- head -->
                            <thead>
                                <tr>
                                    <th class="text-white">ID</th>                              
                                    <th class="text-white">Monto</th>
                                    <th class="text-white">Descripcion</th>
                                    <th class="text-white">Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row 1 -->
                                <?php while ($row = mysqli_fetch_assoc($payments)) { ?>
                                    <tr>
                                        <td><?php echo $row['pk_payment'] ?></td>
                                        <td><?php echo $row['payment_amount'] ?></td>
                                        <td><?php echo $row['payment_description'] ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($row['payment_date'])); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <br>
                        <table class="table bg-gray-600">
                            <!-- head -->
                            <thead>
                                <tr>                           
                                    <th >Monto Total: <?php echo $suma; ?></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } ?>

</div>
</body>