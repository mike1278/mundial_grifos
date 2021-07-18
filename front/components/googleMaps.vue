<template>
  <div class="gmap">
    <b-form-input
      id="autocomplete"
      placeholder="Ingrese ubicación"
      class="mb-2"
    />
    <div id="map" style="height: 400px"></div>
  </div>
</template>
<script>
import GoogleMapsApiLoader from 'google-maps-api-loader'
const axios = require('axios').default
export default {
  props: {
    options: {
      type: Object,
      default: () => {
        return {}
      },
    },
    language: {},
    zoom: {
      type: Number,
      default: 17,
    },
    center: {
      type: Object,
      default: () => {
        return {
          lat: 45.815,
          lng: 15.9819,
        }
      },
    },
  },
  data() {
    return {
      map: null,
      google: null,
      markers: null,
      geocoder: null,
    }
  },
  async mounted() {
    let google = null
    try {
      google = await GoogleMapsApiLoader({
        apiKey: this.$config.apiGoogleMaps,
        language: this.language,
        libraries: ['places', 'visualization'],
      })
      // this.$Gmaps.google = google
    } catch (e) {}
    this.google = google
    this.geocoder = google.maps.Geocoder()
    this.initMap()
    this.autocomplete()
    this.$emit('init', this.google)
    this.$emit('loaded', this.google)
  },
  beforeDestroy() {
    this.$GMaps.loaded = false
  },
  methods: {
    autocomplete() {
      const map = this.map
      const autocomplete = new google.maps.places.Autocomplete(
        document.querySelector('#autocomplete')
      )
      const marker = new google.maps.Marker({
        map,
        position: this.center,
      })
      marker.setVisible(true)
      this.markers = marker
      autocomplete.bindTo('bounds', map)
      autocomplete.addListener('place_changed', () => {
        const place = autocomplete.getPlace()
        if (!place.geometry) {
          this.toast('Error', "No hay detalles acerca de: '" + place.name + "'")
          // marker.setVisible(true);
          return
        }
        if (place.geometry.viewport) {
          map.fitBounds(place.geometry.viewport)
        } else {
          map.setCenter(place.geometry.location)
          map.setZoom(17)
        }
        this.$emit('ubication', {
          lat: place.geometry.location.lat(),
          lng: place.geometry.location.lng(),
        })
        marker.setPosition(place.geometry.location)
        // marker.setVisible(true);
        let address = ''
        if (place.address_components) {
          address = [
            (place.address_components[0] &&
              place.address_components[0].short_name) ||
              '',
            (place.address_components[1] &&
              place.address_components[1].short_name) ||
              '',
            (place.address_components[2] &&
              place.address_components[2].short_name) ||
              '',
          ].join(', ')
        }
        this.$emit('address', address)
      })
    },
    initMap() {
      this.map = new google.maps.Map(document.querySelector('#map'), {
        center: this.center,
        zoom: this.zoom,
        ...this.options,
      })
      this.map.addListener('click', (e) => {
        const location = {
          lat: e.latLng.lat(),
          lng: e.latLng.lng(),
        }
        this.markers.setPosition(location)
        this.$emit('location', location)
        this.map.setCenter(location)
        axios
          .get(
            `https://maps.googleapis.com/maps/api/geocode/json?latlng=${
              location.lat + ',' + location.lng
            }&key=${this.$config.apiGoogleMaps}`
          )
          .then((result) => {
            this.$emit('address', result.data.results[0].formatted_address)
          })
      })
    },
  },
}
</script>
<style>
.pac-container {
  z-index: 1500 !important;
}
</style>
