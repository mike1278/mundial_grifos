import Vue from 'vue'

Vue.mixin({
  methods: {
    toast(title, body, variant = null) {
      this.$bvToast.toast(body, {
        title,
        variant,
        solid: true,
      })
    },
    imageUrl(size = 'square-small') {
      return process.env.BACK_DOMAIN + 'image/' + size + '/'
    },
    processError(error) {
      if (error.response) {
        if (error.response.data.errors) {
          return this.toast(
            'Error',
            Object.values(error.response.data.errors)[0][0],
            'danger'
          )
        }
        let toastMessage = {}
        switch (error.response.status) {
          case 401:
            toastMessage = {
              title: 'Error 401',
              message: 'Sin autenticación, recargue la pagina',
            }
            break
          case 403:
            toastMessage = {
              title: 'Error 403',
              message: error.response.data.message,
            }
            break
          case 404:
            toastMessage = {
              title: 'Error 404',
              message: 'No se encontró la ruta',
            }
            break
          case 429:
            toastMessage = {
              title: 'Error 429',
              message: 'Demasiados intentos, espere',
            }
            break
          default:
            toastMessage = {
              title: 'Error',
              message: error.response.data.message,
            }
            break
        }
        return this.toast(toastMessage.title, toastMessage.message, 'danger')
      }
      this.toast(
        'Error',
        'Problemas de conexión, Reintente mas tarde',
        'warning'
      )
    },
  },
})
