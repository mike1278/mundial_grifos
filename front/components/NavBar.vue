<template>
  <div
    class="navigations position-relative"
    style="background: url('/img/fondo.jpg')"
  >
    <b-navbar
      toggleable="lg"
      class="p-0 pt-2 pb-2"
      style="background: rgba(40, 40, 40, 0.71)"
    >
      <b-navbar-toggle target="sidebar-navbar" class="icon-white ml-1 border-0">
        <template #default="{ expanded }">
          <font-awesome-icon v-show="expanded" icon="times" />
          <font-awesome-icon v-show="!expanded" icon="bars" />
        </template>
      </b-navbar-toggle>
      <b-navbar-brand to="/" class="d-flex d-flex-row">
        <img class="ml-1 h-100" src="/icon-white.png" alt="Mundial Grifos" />
        <h1 class="p-1 d-flex flex-column">
          <span class="text-weight-sm text-2xl">MUNDIAL</span>
          <span class="text-weight-lg text-3xl letter-spacing-2">Grifos</span>
        </h1>
      </b-navbar-brand>
      <b-navbar-nav class="mx-auto d-none d-lg-flex justify-content-center">
        <b-nav-item class="nav-item nav-link text-xl text-weight-md" to="/"
          >Inicio</b-nav-item
        >
        <b-nav-item
          class="nav-item nav-link pl-4 text-xl text-weight-md"
          to="/productos"
        >
          Productos
        </b-nav-item>
        <b-nav-item
          class="nav-item nav-link pl-4 text-xl text-weight-md"
          to="/nosotros"
        >
          Nosotros
        </b-nav-item>
      </b-navbar-nav>

      <b-navbar-nav class="mr-4">
        <b-nav-item
          class="nav-item nav-link text-xl text-weight-md"
          to="/carrito"
        >
          <font-awesome-icon icon="shopping-cart" />
        </b-nav-item>
        <b-nav-item-dropdown class="border-0 d-flex align-items-center" right>
          <template #button-content>
            <font-awesome-icon icon="user" />
            <span v-if="$auth.loggedIn">
              {{ $auth.user.name }}
            </span>
          </template>
          <span v-if="$auth.loggedIn">
            <b-dropdown-item
              v-if="hasRole(['admin', 'root'])"
              :href="
                $config.backUrl + '/front/auth/' + $auth.strategy.token.get()
              "
              >Panel Administrativo</b-dropdown-item
            >
            <b-dropdown-item to="/perfil">Perfil</b-dropdown-item>
            <b-dropdown-item @click.prevent="logout">
              Cerrar Sesión
            </b-dropdown-item>
          </span>
          <span v-if="!$auth.loggedIn">
            <b-dropdown-item to="/login">Iniciar Sesión</b-dropdown-item>
            <b-dropdown-item to="/registro">Registrate</b-dropdown-item>
          </span>
        </b-nav-item-dropdown>
      </b-navbar-nav>
    </b-navbar>

    <!--    <b-sidebar
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
    </b-sidebar> -->
  </div>
</template>
<script>
export default {
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
