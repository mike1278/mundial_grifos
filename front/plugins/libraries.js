import Vue from 'vue'
import VueAwesomeSwiper from 'vue-awesome-swiper'
import 'swiper/css/swiper.css'

Vue.use(VueAwesomeSwiper)

// eslint-disable-next-line @typescript-eslint/no-unused-vars
export default function (context, inject) {
  inject('Gmaps', {
    loaded: false,
    google: null,
  })
}
