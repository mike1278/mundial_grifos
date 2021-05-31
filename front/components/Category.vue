<template>
  <div class="categories pt-4 pb-4">
    <h6>Categorias</h6>
    <hr>
    <b-container fluid class="cont">
      <b-row class="justify-content-center fila">
        <b-col cols="12" lg="4" md="6" class="item pb-4">
          <div class="image" style="background-image: url('/img/grifo.jpg');">
            <div class="name pt-2 pb-2">
              <h2>Ducha</h2>
            </div>
          </div> 
        </b-col>

        <b-col cols="12" lg="4" md="6" class="item pb-4">
          <div class="image" style="background-image: url('/img/grifo.jpg');">
            <div class="name pt-2 pb-2">
              <h2>fregadero</h2>              
            </div>          
          </div> 
        </b-col>

        <b-col cols="12" lg="4" md="6" class="item pb-4">
          <div class="image" style="background-image: url('/img/grifo.jpg');">
            <div class="name pt-2 pb-2">
              <h2>lavamano</h2>
            </div>          
          </div>  
        </b-col>

      </b-row>
    </b-container>
  </div>
</template>

<style lang="sass">
@import "~/assets/css/components/category-index.scss"
</style>