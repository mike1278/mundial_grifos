<template>
  <div>
    <b-navbar class="px-2">
      <b-navbar-brand to="/" class="d-flex d-flex-row">
        <img class="ml-1" src="/img/logo.png" alt="Red de Venta" />
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
        <b-navbar-toggle
          target="sidebar-navbar"
          class="d-block icon-white ml-1"
        >
          <template #default="{ expanded }">
            <font-awesome-icon v-show="expanded" icon="times" />
            <font-awesome-icon v-show="!expanded" icon="bars" />
          </template>
        </b-navbar-toggle>
      </b-navbar-nav>
    </b-navbar>
    <b-sidebar
      id="sidebar-navbar"
      :title="$auth.loggedIn ? $auth.user.name : 'Bienvenido'"
      backdrop-variant="dark"
      backdrop
      shadow
    >
      <nav class="mb-3" style="border-top: 1px solid rgba(0, 0, 0, 0.1)">
        <b-nav vertical>
          <b-nav-item to="/">Inicio</b-nav-item>
          <b-nav-item to="/categorias">Categorías</b-nav-item>
          <b-nav-item to="/buscar/productos">Buscar Productos</b-nav-item>
          <b-nav-item to="/carrito">
            <font-awesome-icon icon="shopping-cart" />
            Carrito
          </b-nav-item>
          <b-nav-item v-b-modal.contact>Contactanos</b-nav-item>
          <div
            v-if="$auth.loggedIn"
            class="mt-1"
            style="border-top: 1px solid rgba(0, 0, 0, 0.1)"
          >
            <b-nav-item
              v-for="(link, i) in links"
              :key="i + 'links-users'"
              :to="link.link"
            >
              {{ link.text }}
            </b-nav-item>
            <b-nav-item @click.prevent="logout">Cerrar Sesión</b-nav-item>
          </div>
          <div
            v-if="!$auth.loggedIn"
            class="mt-1"
            style="border-top: 1px solid rgba(0, 0, 0, 0.1)"
          >
            <b-nav-item to="/login">Iniciar Sesión</b-nav-item>
            <b-nav-item to="/registro">Regístrate</b-nav-item>
          </div>
        </b-nav>
      </nav>
    </b-sidebar>
  </div>
</template>
<script lang="ts">
import Vue from 'vue'

export default Vue.extend({
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
    async logout() {
      await this.$auth
        .logout('laravelPassport')
        .then(() => this.$router.push('/'))
        .catch((e) => this.processError(e))
    },
  },
})
</script>
