<?php session_start(); ?>
<?php include_once __DIR__ . "/app/session.php"; ?>
<?php include_once "view/components/header.php"; ?>

<!--Aqui comienza el cuerpo-->
<main>
  <div class="relative pt-16 pb-32 flex content-center items-center justify-center" style="min-height: 75vh;">
  <div class="absolute top-0 w-full h-full bg-center bg-cover" style='background-image: url("./assets/img/est.jpg?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1000&amp;q=80");'>
      <span id="blackOverlay" class="w-full h-full absolute opacity-75 bg-black"></span>
    </div>
    <div class="container relative mx-auto">
      <div class="items-center flex flex-wrap">
        <div class="w-full lg:w-6/12 px-4 ml-auto mr-auto text-center">
          <div class="pr-12">
            <h1 class="text-white font-semibold text-5xl">
            Administra tu propio estacionamiento
            </h1>
            <p class="mt-4 text-lg text-gray-300">
            El equipo creó un software personalizado para empresas con visión de futuro, asistiéndolas en la aceleración de su crecimiento y en su camino para convertirse en líderes tecnológicos.
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden" style="height: 70px;">
      <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
        <polygon class="text-gray-300 fill-current" points="2560 0 2560 100 0 100"></polygon>
      </svg>
    </div>
  </div>
  <section class="pb-20 bg-gray-300 -mt-24">
    <div class="container mx-auto px-4">
      <div class="flex flex-wrap">
        <div class="lg:pt-12 pt-6 w-full md:w-4/12 px-4 text-center">
          <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg">
            <div class="px-4 py-5 flex-auto">
              <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-red-400">
                <i class="fas fa-award"></i>
              </div>
              <h6 class="text-xl font-semibold">Software Premiado</h6>
              <p class="mt-2 mb-4 text-gray-600">
                Divide los detalles sobre la gestión de tu estacionamiento libremente.
              </p>
            </div>
          </div>
        </div>
        <div class="w-full md:w-4/12 px-4 text-center">
          <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg">
            <div class="px-4 py-5 flex-auto">
              <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-blue-400">
                <i class="fas fa-retweet"></i>
              </div>
              <h6 class="text-xl font-semibold">Asesoría gratuita</h6>
              <p class="mt-2 mb-4 text-gray-600">
                Parking Manager cuenta con una buena atención al cliente las 24 horas del día
                y los 7 días de la semana.
              </p>
            </div>
          </div>
        </div>
        <div class="pt-6 w-full md:w-4/12 px-4 text-center">
          <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg">
            <div class="px-4 py-5 flex-auto">
              <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-green-400">
                <i class="fas fa-fingerprint"></i>
              </div>
              <h6 class="text-xl font-semibold">Compañía verificada</h6>
              <p class="mt-2 mb-4 text-gray-600">
                Contamos con todas las verificaciones necesarias para asegurar
                que nuestros usuarios se sientan seguros.
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="flex flex-wrap items-center mt-32">
        <div class="w-full md:w-5/12 px-4 mr-auto ml-auto">
          <div class="text-gray-600 p-3 text-center inline-flex items-center justify-center w-16 h-16 mb-6 shadow-lg rounded-full bg-gray-100">
            <i class="fas fa-user-friends text-xl"></i>
          </div>
          <h3 class="text-3xl mb-2 font-semibold leading-normal">
            Utilizar Parking Manager te facilitará la gestión de tus estacionamientos.
          </h3>
          <p class="text-lg font-light leading-relaxed mt-4 mb-4 text-gray-700">
            Miles de usuarios confían en Parking Manager para simplificar la gestión de estacionamientos. Nuestra plataforma ofrece reservas en línea, seguimiento de ocupación en tiempo real y notificaciones automáticas, garantizando comodidad y eficiencia. </p>
          <p class="text-lg font-light leading-relaxed mt-0 mb-4 text-gray-700">
            Además, contamos con membresías que ofrecen beneficios exclusivos, como descuentos en reservas, acceso prioritario y más. Únete a nuestra comunidad y descubre una nueva forma de gestionar tus espacios de estacionamiento.
          </p>
          <a href="https://www.creative-tim.com/learning-lab/tailwind-starter-kit#/presentation" class="font-bold text-gray-800 mt-8">Consigue ya tu membresia!</a>
        </div>
        <div class="w-full md:w-4/12 px-4 mr-auto ml-auto">
          <div class="relative flex flex-col min-w-0 break-words  w-full mb-6 shadow-lg rounded-lg bg-pink-600">
            <img alt="..." src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1051&amp;q=80" class="w-full align-middle rounded-t-lg" />
            <blockquote class="relative p-8 mb-4">
              <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 583 95" class="absolute left-0 w-full block" style="height: 95px; top: -94px;">
                <polygon points="-30,95 583,95 583,65" class="text-pink-600 fill-current"></polygon>
              </svg>
              <h4 class="text-xl font-bold text-white">
                Somos el equipo de trabajo Parking Manager
              </h4>
              <p class="text-md font-light mt-2 text-white">
                En Parking Manager, nos esforzamos por brindar un servicio de gestión de estacionamientos eficiente y fácil de usar. Nuestro equipo se dedica a proporcionar una plataforma innovadora que simplifica la experiencia tanto para los propietarios de estacionamientos como para los usuarios.
              </p>
            </blockquote>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="relative py-20">
    <div class="bottom-auto top-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden -mt-20" style="height: 80px;">
      <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
        <polygon class="text-white fill-current" points="2560 0 2560 100 0 100"></polygon>
      </svg>
    </div>
    <div class="container mx-auto px-4">
      <div class="items-center flex flex-wrap">
        <div class="w-full md:w-4/12 ml-auto mr-auto px-4">
          <img alt="..." class="max-w-full rounded-lg shadow-lg" src="https://images.unsplash.com/photo-1555212697-194d092e3b8f?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=634&amp;q=80" />
        </div>
        <div class="w-full md:w-5/12 ml-auto mr-auto px-4">
          <div class="md:pr-12">
            <div class="text-pink-600 p-3 text-center inline-flex items-center justify-center w-16 h-16 mb-6 shadow-lg rounded-full bg-blue-400">
              <i class="fas fa-rocket text-xl"></i>
            </div>
            <h3 class="text-3xl font-semibold text-gray-300">Una compañia en crecimiento</h3>
            <p class="mt-4 text-lg leading-relaxed text-gray-400">
              "En Parking Manager, somos una compañía en crecimiento dedicada a simplificar la gestión de estacionamientos. Con una visión innovadora y un compromiso con la excelencia, estamos expandiendo constantemente nuestra presencia y mejorando nuestros servicios. Estamos emocionados de seguir creciendo y ofreciendo soluciones cada vez mejores para nuestros usuarios. Únete a nosotros en esta emocionante jornada y sé parte de nuestro éxito en el futuro.
            </p>
            <ul class="list-none mt-6">
              <li class="py-2">
                <div class="flex items-center">
                  <div>
                    <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-pink-600 bg-blue-400 mr-3"><i class="fas fa-fingerprint"></i></span>
                  </div>
                  <div>
                    <h4 class="text-gray-400">
                      Tus estacionamientos siempre seguros
                    </h4>
                  </div>
                </div>
              </li>
              <li class="py-2">
                <div class="flex items-center">
                  <div>
                    <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-pink-600 bg-blue-400 mr-3"><i class="fab fa-html5"></i></span>
                  </div>
                  <div>
                    <h4 class="text-gray-400">Un ambiente mas controlado</h4>
                  </div>
                </div>
              </li>
              <li class="py-2">
                <div class="flex items-center">
                  <div>
                    <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-pink-600 bg-blue-400 mr-3"><i class="far fa-paper-plane"></i></span>
                  </div>
                  <div>
                    <h4 class="text-gray-400">Interfaces intuitivas</h4>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="pt-20 pb-48">
    <div class="container mx-auto px-4">
      <div class="flex flex-wrap justify-center text-center mb-24">
        <div class="w-full lg:w-6/12 px-4">
          <h2 class="text-4xl font-semibold text-gray-300">Conoce al equipo detras de Parking Manager</h2>
          <p class="text-lg leading-relaxed m-4 text-gray-400">
            En Parking Manager nos esforzamos por brindarte la mejor experiencia posible en la administración de tus espacios de estacionamiento.
          </p>
        </div>
      </div>
      <div class="flex flex-wrap">
        <div class="w-full md:w-6/12 lg:w-3/12 lg:mb-0 mb-12 px-4">
          <div class="px-6">
            <img alt="..." src="./assets/img/bp.jpg" class="shadow-lg rounded-full max-w-full mx-auto" style="max-width: 120px;" />
            <div class="pt-6 text-center">
              <h5 class="text-xl font-bold text-gray-300">Perdomo Garcia Kevin Alberto</h5>
              <p class="mt-1 text-sm text-gray-400 uppercase font-semibold">
                Web Developer/UI Designer
              </p>
              <div class="mt-6">
                <button class="bg-blue-400 text-white w-8 h-8 rounded-full outline-none focus:outline-none mr-1 mb-1" type="button">
                  <i class="fab fa-twitter"></i></button><button class="bg-blue-600 text-white w-8 h-8 rounded-full outline-none focus:outline-none mr-1 mb-1" type="button">
                  <i class="fab fa-facebook-f"></i></button><button class="bg-pink-500 text-white w-8 h-8 rounded-full outline-none focus:outline-none mr-1 mb-1" type="button">
                  <i class="fab fa-dribbble"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="w-full md:w-6/12 lg:w-3/12 lg:mb-0 mb-12 px-4">
          <div class="px-6">
            <img alt="..." src="./assets/img/cano.jpg" class="shadow-lg rounded-full max-w-full mx-auto" style="max-width: 120px;" />
            <div class="pt-6 text-center">
              <h5 class="text-xl font-bold text-gray-300">Hernández González Alejandro</h5>
              <p class="mt-1 text-sm text-gray-400 uppercase font-semibold">
                Web Developer/UI Designer
              </p>
              <div class="mt-6">
                <button class="bg-red-600 text-white w-8 h-8 rounded-full outline-none focus:outline-none mr-1 mb-1" type="button">
                  <i class="fab fa-google"></i></button><button class="bg-blue-600 text-white w-8 h-8 rounded-full outline-none focus:outline-none mr-1 mb-1" type="button">
                  <i class="fab fa-facebook-f"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="w-full md:w-6/12 lg:w-3/12 lg:mb-0 mb-12 px-4">
          <div class="px-6">
            <img alt="..." src="./assets/img/jotorge.jpg" class="shadow-lg rounded-full max-w-full mx-auto" style="max-width: 120px;" />
            <div class="pt-6 text-center">
              <h5 class="text-xl font-bold text-gray-300">Robledo Ramirez Jorge Rafael</h5>
              <p class="mt-1 text-sm text-gray-400 uppercase font-semibold">
                Web Developer/UI Designer
              </p>
              <div class="mt-6">
                <button class="bg-red-600 text-white w-8 h-8 rounded-full outline-none focus:outline-none mr-1 mb-1" type="button">
                  <i class="fab fa-google"></i></button><button class="bg-blue-400 text-white w-8 h-8 rounded-full outline-none focus:outline-none mr-1 mb-1" type="button">
                  <i class="fab fa-twitter"></i></button><button class="bg-gray-800 text-white w-8 h-8 rounded-full outline-none focus:outline-none mr-1 mb-1" type="button">
                  <i class="fab fa-instagram"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="w-full md:w-6/12 lg:w-3/12 lg:mb-0 mb-12 px-4">
          <div class="px-6">
            <img alt="..." src="./assets/img/efra.jpg" class="shadow-lg rounded-full max-w-full mx-auto" style="max-width: 120px;" />
            <div class="pt-6 text-center">
              <h5 class="text-xl font-bold text-gray-300">Leyva Davila Jesus Efrain</h5>
              <p class="mt-1 text-sm text-gray-400 uppercase font-semibold">
                Web Developer/UI Designer
              </p>
              <div class="mt-6">
                <button class="bg-pink-500 text-white w-8 h-8 rounded-full outline-none focus:outline-none mr-1 mb-1" type="button">
                  <i class="fab fa-dribbble"></i></button><button class="bg-red-600 text-white w-8 h-8 rounded-full outline-none focus:outline-none mr-1 mb-1" type="button">
                  <i class="fab fa-google"></i></button><button class="bg-blue-400 text-white w-8 h-8 rounded-full outline-none focus:outline-none mr-1 mb-1" type="button">
                  <i class="fab fa-twitter"></i></button><button class="bg-gray-800 text-white w-8 h-8 rounded-full outline-none focus:outline-none mr-1 mb-1" type="button">
                  <i class="fab fa-instagram"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="pb-20 relative block bg-gray-900">
    <div class="bottom-auto top-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden -mt-20" style="height: 80px;">
      <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
        <polygon class="text-gray-900 fill-current" points="2560 0 2560 100 0 100"></polygon>
      </svg>
    </div>
    <div class="container mx-auto px-4 lg:pt-24 lg:pb-64">
      <div class="flex flex-wrap text-center justify-center">
        <div class="w-full lg:w-6/12 px-4">
          <h2 class="text-4xl font-semibold text-white">¡Gestiona tu estacionamiento con Parking Manager hoy!</h2>
          <p class="text-lg leading-relaxed mt-4 mb-4 text-gray-300">
            Gestiona tu estacionamiento fácilmente con Parking Manager. ¡Comienza ahora mismo y simplifica tu vida!
          </p>
        </div>
      </div>
      <div class="flex flex-wrap mt-12 justify-center">
        <div class="w-full lg:w-3/12 px-4 text-center">
          <div class="text-gray-900 p-3 w-12 h-12 shadow-lg rounded-full bg-blue-400 inline-flex items-center justify-center">
            <i class="fas fa-medal text-xl"></i>
          </div>
          <h6 class="text-xl mt-5 font-semibold text-white">
            Excelente Servicio
          </h6>
          <p class="mt-2 mb-4 text-gray-400">
            Parking Manager: Donde la excelencia es nuestra norma. Descubre cómo podemos elevar tu experiencia en la gestión de estacionamientos.
          </p>
        </div>
        <div class="w-full lg:w-3/12 px-4 text-center">
          <div class="text-gray-900 p-3 w-12 h-12 shadow-lg rounded-full bg-blue-600 inline-flex items-center justify-center">
            <i class="fas fa-poll text-xl"></i>
          </div>
          <h5 class="text-xl mt-5 font-semibold text-white">
            Haz de tus estacionamientos algo mejor
          </h5>
          <p class="mt-2 mb-4 text-gray-400">
            Haz de tus estacionamientos algo mejor con Parking Manager. Descubre cómo logramos este objetivo y optimizamos cada espacio para ti.
          </p>
        </div>
        <div class="w-full lg:w-3/12 px-4 text-center">
          <div class="text-gray-900 p-3 w-12 h-12 shadow-lg rounded-full bg-blue-400 inline-flex items-center justify-center">
            <i class="fas fa-lightbulb text-xl"></i>
          </div>
          <h5 class="text-xl mt-5 font-semibold text-white">Contamos con interfaces intuitivas</h5>
          <p class="mt-2 mb-4 text-gray-400">
            Nuestro sistema intuitivo facilita la gestión de tus espacios de manera eficiente y sencilla.
          </p>
        </div>
      </div>
    </div>
  </section>
  <section class="relative block py-24 lg:pt-0 bg-gray-900">
    <div class="container mx-auto px-4">
      <div class="flex flex-wrap justify-center lg:-mt-64 -mt-48">
        <div class="w-full lg:w-6/12 px-4">
          <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-300">
            <div class="flex-auto p-5 lg:p-10">
              <h4 class="text-2xl font-semibold">Tienes problemas? Envianos tus dudas.</h4>
              <p class="leading-relaxed mt-1 mb-4 text-gray-600">
                Llena este formulario y te responderemos en 24 horas.
              </p>
              <form method="POST" action="app/admin/clientes/comentarios/insertar_comentario.php" class="mt-6">
                <div class="relative w-full mb-3 mt-8">
                  <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="full-name">Nombre Completo</label>
                  <input type="text" name="nombre_completo" maxlength="70" minlength="1" class="border-0 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full" placeholder="Nombre completo" style="transition: all 0.15s ease 0s;" required>
                </div>
                <div class="relative w-full mb-3">
                  <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="email">Email</label>
                  <input type="email" name="email" maxlength="60" minlength="1" class="border-0 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full" placeholder="Email" style="transition: all 0.15s ease 0s;" required>
                </div>
                <div class="relative w-full mb-3">
                  <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="message">Mensaje</label>
                  <textarea name="mensaje" maxlength="250" minlength="1" rows="4" cols="80" class="border-0 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full" placeholder="Escribe un mensaje..." required></textarea>
                </div>
                <div class="text-center mt-6">
                  <button type="submit" class="bg-gray-900 text-white active:bg-gray-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1" style="transition: all 0.15s ease 0s;">
                    Enviar Mensaje
                  </button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
</main> <!--Aqui termina el cuerpo-->

<!--Incluimos el footer-->
<?php include_once "view/components/footer.php"; ?>