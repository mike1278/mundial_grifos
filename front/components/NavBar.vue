<template>
  <div>
    <b-navbar class="px-2">
      <b-navbar-toggle
        target="sidebar-navbar"
        class="d-block icon-white ml-1 border-0"
      >
        <template #default="{ expanded }">
          <font-awesome-icon v-show="expanded" icon="times" />
          <font-awesome-icon v-show="!expanded" icon="bars" />
        </template>
      </b-navbar-toggle>
      <b-navbar-brand to="/" class="d-flex d-flex-row">
        <h1 class="p-1 mb-0 text-2xl text-gray-700">Mundial Grifos</h1>
      </b-navbar-brand>
      <b-navbar-nav class="ml-auto d-none d-md-flex">
        <b-nav-item-dropdown
          v-if="$auth.loggedIn"
          :text="$auth.user.name"
          style="border: none"
          right
        >
          <b-dropdown-item
            v-for="(link, i) in links"
            :key="i + 'links-users'"
            :to="link.link"
          >
            {{ link.text }}
          </b-dropdown-item>
          <b-dropdown-item @click.prevent="logout">
            Cerrar Sesión
          </b-dropdown-item>
        </b-nav-item-dropdown>
      </b-navbar-nav>
    </b-navbar>
    <b-sidebar
      id="sidebar-navbar"
      :title="$auth.loggedIn ? $auth.user.name : 'Bienvenido'"
      backdrop-variant="dark"
      backdrop
      shadow
    >
      <nav class="mb-3">
        <b-nav vertical>
          <b-nav-item
            :link-classes="{ active: active('index'), 'text-secondary': true }"
            to="/"
            >Inicio</b-nav-item
          >
          <b-nav-item
            :link-classes="{
              active: active('productos'),
              'text-secondary': true,
            }"
            to="/productos"
            >Productos</b-nav-item
          >
          <b-nav-item
            :link-classes="{
              active: active('carrito'),
              'text-secondary': true,
            }"
            to="/carrito"
          >
            <font-awesome-icon icon="shopping-cart" />
            Carrito
          </b-nav-item>
          <b-nav-item v-b-modal.contact link-classes="text-secondary"
            >Contactanos</b-nav-item
          >
          <div
            v-if="$auth.loggedIn"
            class="mt-1"
            style="border-top: 1px solid rgba(0, 0, 0, 0.1)"
          >
            <b-nav-item
              v-for="(link, i) in links"
              :key="i + 'links-users'"
              :to="link.link"
              :link-classes="{
                active: active(link.link),
                'text-secondary': true,
              }"
            >
              {{ link.text }}
            </b-nav-item>
            <b-nav-item link-classes="text-secondary" @click.prevent="logout"
              >Cerrar Sesión</b-nav-item
            >
          </div>
          <div
            v-if="!$auth.loggedIn"
            class="mt-1"
            style="border-top: 1px solid rgba(0, 0, 0, 0.1)"
          >
            <b-nav-item
              :link-classes="{
                active: active('login'),
                'text-secondary': true,
              }"
              to="/login"
              >Iniciar Sesión</b-nav-item
            >
            <b-nav-item
              :link-classes="{
                active: active('registro'),
                'text-secondary': true,
              }"
              to="/registro"
              >Regístrate</b-nav-item
            >
          </div>
        </b-nav>
      </nav>
    </b-sidebar>
  </div>
</template>
<script>
export default {
  computed: {
    links() {
      return [
        {
          text: 'Perfil',
          link: '/',
        },
      ]
    },
  },
  methods: {
    active(link) {
      return this.$route.name.split('-')[0] === link
    },
    async logout() {
      await this.$auth
        .logout('laravelPassport')
        .then(() => this.$router.push('/'))
        .catch((e) => this.processError(e))
    },
  },
}
</script>
