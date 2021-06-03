<template>
  <div class="footer-clean">
    <footer>
      <div class="container">
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
                  >Politícas de Privacidad</a
                >
              </li>
              <li>
                <a
                  href="/Terminos y condiciones"
                  target="_blank"
                  >Terminos y Condiciones</a
                >
              </li>
              <!-- <li><a href="#">Preguntas frecuentes</a></li> -->
            </ul>
          </b-col>
          <b-col sm="4" md="4" class="item">
            <h3>Eres un negocio</h3>
            <ul>
              <li>
                <nuxt-link to="/registro/negocio"> Registrate </nuxt-link>
              </li>
              <li><a href="#">Condiciones</a></li>
              <li>
                <nuxt-link to="/registro/negocio">Como funciona</nuxt-link>
              </li>
            </ul>
          </b-col>
        </div>
        <div class="row justify-content-center sub">
          <b-col sm="10" md="10" class="contactanos">
            <h2>Registrate Ahora</h2>
            <h4>y descubre la cantidad de productos que tenemos para tí</h4>
            <div>
              <b-form-input
                placeholder="Ingrese su correo"
              ></b-form-input>
            </div>  
          </b-col>
        </div>
      </div>
    </footer>
  </div>
</template>

<style lang="sass">
@import "~/assets/css/components/footer.scss"
</style>