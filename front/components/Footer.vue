<template>
  <footer class="footer-clean pb-0" style="background: url('/img/fondo.jpg')">
    <div class="bg-gray-dark pt-5" style="background: rgba(40, 40, 40, 0.51)">
      <div class="container mb-4 mt-3">
        <div class="row justify-content-center">
          <b-col cols="12" sm="6" md="3" class="item mt-3">
            <h3>Contactanos</h3>
            <ul>
              <li>
                <a href="mailto:info@reddeventa.com"
                  ><font-awesome-icon
                    :icon="['fas', 'envelope']"
                  />&nbsp;info@mundialgrifo.com</a
                >
              </li>
              <li>
                <a href="tel:04123589229"
                  ><font-awesome-icon
                    :icon="['fas', 'phone-alt']"
                  />&nbsp;04123589229</a
                >
              </li>
            </ul>
          </b-col>
          <b-col cols="12" sm="6" md="3" class="item mt-3">
            <h3>Redes Sociales</h3>
            <ul>
              <li>
                <a href="#"
                  ><font-awesome-icon
                    :icon="['fab', 'facebook']"
                  />&nbsp;Facebook</a
                >
              </li>
              <li>
                <a href="#"
                  ><font-awesome-icon
                    :icon="['fab', 'instagram']"
                  />&nbsp;Instagram</a
                >
              </li>
            </ul>
          </b-col>
          <b-col cols="12" sm="6" md="3" class="item mt-3">
            <h3>Nosotros</h3>
            <ul>
              <li>
                <a href="/politicas de privacidad.pdf" target="_blank"
                  >Políticas de Privacidad</a
                >
              </li>
              <li>
                <a href="/Terminos y condiciones" target="_blank"
                  >Términos y Condiciones</a
                >
              </li>
              <!-- <li><a href="#">Preguntas frecuentes</a></li> -->
            </ul>
          </b-col>
          <b-col cols="12" sm="6" md="3" class="item mt-3">
            <h3>Descubre</h3>
            <ul>
              <li>
                <nuxt-link to="/registro"> Registrate </nuxt-link>
              </li>
              <li><a href="#">Condiciones</a></li>
            </ul>
          </b-col>
        </div>
        <div class="d-flex flex-column align-items-center mt-4">
          <div class="d-flex align-items-center">
            <img
              class="ml-1"
              src="/icon-white.png"
              alt="Mundial Grifos"
              style="width: 63px"
            />
            <h1 class="p-1 d-flex flex-column">
              <span class="text-weight-sm text-2xl">MUNDIAL</span>
              <span class="text-weight-lg text-3xl letter-spacing-2"
                >Grifos</span
              >
            </h1>
          </div>
          <p class="text-white px-2 py-1 mt-1 mb-0">J-31056697-6</p>
          <!--        <b-col sm="10" md="10" class="contactanos">-->
          <!--          <h2>Registrate Ahora</h2>-->
          <!--          <h4>y descubre la cantidad de productos que tenemos para tí</h4>-->
          <!--          <div>-->
          <!--            <b-form-input placeholder="Ingrese su correo"></b-form-input>-->
          <!--          </div>-->
          <!--        </b-col>-->
        </div>
      </div>
      <div
        class="copyright d-flex justify-content-center py-2"
        style="background: rgba(40, 40, 40, 0.71)"
      >
        <p class="mb-0">
          © 2021, Mundial Grifos. Todos los derechos reservados a Unimar &
          Roberto Micheletti
        </p>
      </div>
    </div>
  </footer>
</template>
