export const paginationMixin= {

    data() {
        return {
            dataSet: false,
        }
    },
    created() {
        this.fetch();
    },

    methods: {
        fetch(page) {
            axios.get(this.url(page)).then(this.refresh);
        },

        url(page) {
            if (!page) {
                let query = location.search.match(/page=(\d+)/);

                page = query ? query[1] : 1;
            }

            return `api${location.pathname}?page=${page}`;
        },

        refresh({data}) {
            this.dataSet = data;
            this.items = data.data;

            window.scrollTo(0, 0);
        },
    }

}
