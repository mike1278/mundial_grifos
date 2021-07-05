import Vue from 'vue'

Vue.mixin({
  methods: {
    imageUrl(size = 'square-small') {
      return this.$config.backUrl + '/image/' + size + '/'
    },
    hasRole(role) {
      if (!Array.isArray(role)) role = [role]
      return this.$auth.user.roles.find((el) => {
        return role.includes(el)
      })
    },
    hasPermission(permission) {
      if (!Array.isArray(permission)) permission = [permission]
      return this.$auth.user.permissions.find((el) => {
        return permission.includes(el)
      })
    },
    processError(error) {
      if (error.response) {
        if (error.response.data.errors) {
          return this.$bvToast.toast(
            Object.values(error.response.data.errors)[0][0],
            {
              title: 'Error',
              variant: 'warning',
            }
          )
        }
        let toastMessage = {
          title: '',
          message: '',
        }
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
        return this.$bvToast.toast(toastMessage.message, {
          title: toastMessage.title,
          variant: 'warning',
        })
      }
      this.$bvToast.toast('Problemas de conexión, Reintente mas tarde', {
        title: 'Error',
        variant: 'warning',
      })
    },
  },
})
