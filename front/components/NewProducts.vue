<template>
  <div class="new-products pt-4">
    <h6>Nuevos Productos</h6>
    <hr>
    <b-container fluid class="cont">
      <b-row class="justify-content-center fila">
        <b-col cols="12" lg="3" md="6" class="item pb-4">
          <div class="image" style="background-image: url('/img/grifo.jpg');">
          </div>
          <div class="info mt-2">
            <p class="pt-2 category">COCINA / MONOMANDO</p>
            <p class="title">Unidad de</p>
            <p class="price">$ 80.00</p>
          </div>  
        </b-col>

        <b-col cols="12" lg="3" md="6" class="item pb-4">
          <div class="image" style="background-image: url('/img/grifo.jpg');">
          </div>
          <div class="info mt-2">
            <p class="pt-2 category">COCINA / MONOMANDO</p>
            <p class="title">Unidad de fregadero de un orificio</p>
            <p class="price">$ 80.00</p>
          </div>  
        </b-col>

        <b-col cols="12" lg="3" md="6" class="item pb-4">
          <div class="image" style="background-image: url('/img/grifo.jpg');">
          </div>
          <div class="info mt-2">
            <p class="pt-2 category">COCINA / MONOMANDO</p>
            <p class="title">Unidad de fregadero de un orificio</p>
            <p class="price">$ 80.00</p>
          </div>  
        </b-col>

        <b-col cols="12" lg="3" md="6" class="item pb-4">
          <div class="image" style="background-image: url('/img/grifo.jpg');">
          </div>
          <div class="info mt-2">
            <p class="pt-2 category">COCINA / MONOMANDO</p>
            <p class="title">Unidad de fregadero de un orificio</p>
            <p class="price">$ 80.00</p>
          </div>  
        </b-col> 

      </b-row>
    </b-container>
  </div>
</template>

<script>

export default{  
  /*
  data(){
    products: [
      {
        category: "COCINA/ MONOMANDO",
        name: "Mezclador de fregadero",
        price: 80.00
      },
      {
        category: "COCINA/ TRADICIONAL",
        name: "Unidad de fregadero de un orificio",
        price: 60.00
      },
      {
        category: "COCINA/ TRADICIONAL",
        name: "Unidad de fregadero de un orificio",
        price: 60
      },
      {
        category: "BAÑO/ JUMP",
        name: "Mezclador de lavabo",
        price: 50.00
      },
    ]
  }*/
}

</script>


<style lang="sass">
@import "~/assets/css/components/newProducts.scss"
</style>