<template>
    <b-container fluid class="categorias">
      <hr>
      <b-row>
        <b-col cols="12" lg="3" md="6" class="title">
          <h2>
            Categoría
          </h2>
          <!-- <hr> -->
        </b-col>
        <b-col cols="12" lg="9" md="9">
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
        </b-col>
      </b-row>
    </b-container>
</template>


<style lang="sass">
@import "~/assets/css/components/categorias.scss"
</style>