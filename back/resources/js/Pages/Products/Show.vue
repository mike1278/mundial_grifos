<template>
    <div class="flex flex-wrap">
        <div class="w-full md:w-1/2 lg:w-1/3">
            <img :src="$page.props.url.large + selectedImage" :alt="product.name">
            <div class="mt-2 flex">
                <div
                    v-for="image in product.images"
                    :key="image.id"
                    class="w-16 h-16 mr-4"
                >
                    <img
                        :src="$page.props.url.large + image.url"
                        :alt="product.name"
                        class="w-full h-full"
                    >
                </div>
            </div>
        </div>
        <div class="w-full md:w-1/2 lg:w-2/3">
            <h2 class="text-gray-700 text-weight-lg text-3xl">
                {{ product.name }}
            </h2>
            <p>{{ product.description }}</p>
            <hr class="border-gray-400 border-t-2 my-3"/>
            <p class="mt-2 mb-0">
                <span class="text-gray-700 text-weight-lg">Código del producto:</span>
                {{ product.serial_code }}
            </p>
            <p class="mb-0">
                <span class="text-gray-700 text-weight-lg">Marca:</span>
                {{ product.brand.name }}
            </p>
            <p class="mb-0">
                <span class="text-gray-700 text-weight-lg">Categoría:</span>
                {{ product.category.name }}
            </p>
            <p class="mb-0">
                <span class="text-gray-700 text-weight-lg">Modelo:</span>
                {{ product.model.name }}
            </p>
            <p class="mb-0">
                <span class="text-gray-700 text-weight-lg">Precio:</span>
                {{ $filters.numeral($page.props.bs * product.price) }}Bs
            </p>
            <p class="mb-0">
                <span class="text-gray-700 text-weight-lg">Precio referencial:</span>
                {{ $filters.numeral(product.price) }}$
            </p>
            <p class="mb-0">
                <span class="text-gray-700 text-weight-lg">Descuento:</span>
                {{ product.discount }}%
            </p>
            <p class="mb-0">
                <span class="text-gray-700 text-weight-lg">Descripción:</span>
                {{ product.description }}
            </p>
            <div>
                <p class="text-gray-700 text-weight-lg">Colores:</p>
                <div class="flex">
                    <div
                        v-for="(color, i) in product.colors"
                        :key="i + 'color'"
                        class="mr-3 w-12"
                    >
                        <img
                            :src="imageUrl('square-medium') + color.image.url"
                            :alt="product.name"
                            class="h-100 w-100"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['product'],
    created() {
        this.selectImage(this.product.images[0].url)
    },
    data() {
        return {
            selectedImage: null,
        }
    },
    methods: {
        selectImage(image) {
            this.selectedImage = image
        },
    },
}
</script>
