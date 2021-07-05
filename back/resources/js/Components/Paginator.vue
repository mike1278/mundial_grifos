<template>
    <nav
        v-if="paginator!==undefined"
        role="navigation"
    >
        <div class="flex-1 flex items-center justify-center">
            <span class="relative z-0 inline-flex shadow-sm rounded-md">
                <div v-for="(link,i) in paginator.links" :key="i">
                    <inertia-link
                        v-if="!link.active && link.url !== null"
                        :href="link.url"
                        v-html="link.label"
                        class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                    ></inertia-link>
                    <span
                        v-else
                        aria-disabled="true"
                        v-html="link.label"
                        :class="link.active ? 'bg-gray-800 border-gray-300 text-white' : ''"
                        class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium border cursor-default leading-5"
                    ></span>
                </div>
            </span>
        </div>
    </nav>
</template>

<script>
export default {
    name: "Paginator",
    props: {
        paginator: {
            current_page: Number,
            data: Array,
            first_page_url: String,
            from: Number,
            last_page: Number,
            last_page_url: String,
            links: Array,
            next_page_url: String,
            path: String,
            per_page: Number,
            prev_page_url: String,
            to: Number,
            total: Number,
        },
    },
    methods: {
        isFirstOrLastOrDots(index, links_length, label) {
            return index === 0 || index === links_length - 1 || label.includes('...')
        },
    },
    computed: {
        onFirstPage() {
            return this.paginator.current_page === 1;
        },
        hasMorePages() {
            return this.paginator.current_page < this.paginator.last_page;
        },
        nextPageUrl() {
            return this.paginator.next_page_url;
        },
        previousPageUrl() {
            return this.paginator.prev_page_url;
        },
        firstItem() {
            return this.paginator.from;
        },
        lastItem() {
            return this.paginator.to;
        },
        total() {
            return this.paginator.total;
        },
    }
}
</script>
