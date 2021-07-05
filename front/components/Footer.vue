<template>
  <footer class="footer-clean pb-0" style="background: url('/img/fondo.jpg')">
    <div class="bg-gray-dark pt-5" style="background: rgba(40, 40, 40, 0.51)">
      <div class="container mb-4 mt-3">
        <div class="row justify-content-center">
          <b-col sm="4" md="4" class="item">
            <h3>Contactanos</h3>
            <ul>
              <li>
                <a href="mailto:info@reddeventa.com"
                  ><i class="far fa-envelope" />&nbsp;info@mundialgrifo.com</a
                >
              </li>
              <li>
                <a href="tel:04123589229"
                  ><i class="fas fa-phone-alt" />&nbsp;04123589229</a
                >
              </li>
            </ul>
          </b-col>
          <b-col sm="4" md="4" class="item">
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
          <b-col sm="4" md="4" class="item">
            <h3>Descubre</h3>
            <ul>
              <li>
                <nuxt-link to="/registro"> Registrate </nuxt-link>
              </li>
              <li><a href="#">Condiciones</a></li>
            </ul>
          </b-col>
        </div>
        <div class="d-flex justify-content-center mt-4">
          <div class="d-flex align-items-center">
            <img
              class="ml-1"
              src="/icon-white.png"
              alt="Mundial Grifos"
              style="width: 63px"
            />
            <h1 class="p-1 d-flex flex-column">
              <span class="text-weight-sm text-2xl">MUNDIAL</span>
              <span class="text-weight-lg text-3xl letter-spacing-2">Grifos</span>
            </h1>
          </div>
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
        <p class="mb-0">© 2021, Mundial Grifos. All Rights Reserved</p>
      </div>
    </div>
  </footer>
</template>
