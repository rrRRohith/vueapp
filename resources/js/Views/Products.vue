<template>
    <div class="w-100 vh-100 d-flex align-content-center">
        <div class="row w-100">
            <div class="col-lg-9 m-auto">
                <div class="card border-0 shadow-sm text-dark mb-4">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="card-title fs-2">Products</div>
                            <div class="ms-auto">
                                <input hidden accept=".csv" :key="file" type="file" name="file" id="file" @change="importProducts">
                                <label for="file" class="btn d-block w-100 btn-primary  rounded-1 shadow-none">{{
                                    busy? 'Please hold on': 'Import products'
                                }}</label>
                            </div>
                        </div>
                        <div>
                            <Table :products='products' :loading="loading"></Table>
                        </div>
                    </div>
                </div>
                <router-link :to="{ name: 'welcome' }" class="text-decoration-none ">Back to
                    home</router-link>
            </div>
        </div>
    </div>
</template>

<script>

import Table from '../components/Table.vue';
export default {
    components: {
        Table
    },
    data() {
        return {
            products: [],
            errors: null,
            busy: false,
            loading: false,
        }
    },
    methods: {
        async fetchProducts() {
            this.loading = true;
            try {
                const response = await this.$axios.get(`/api/products`);
                this.products = response.data.data;
            }
            catch (e) { };
            this.loading = false;
        },

        async importProducts(event) {
            this.busy = true;
            try {
                let data = new FormData();
                data.append('file', event.target.files[0]);
                const response = await this.$axios.post(`/api/products`, data, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then((res) => {
                    this.$helper.toast(this, res, 'success');
                }).catch((err) => {
                    throw err.response
                });
                this.file++;
            }
            catch (e) {
                this.$helper.apiError(this, e);
            };
            this.busy = false;
            this.fetchProducts();
        }
    },
    async mounted() {
        await this.fetchProducts()
    }
}
</script>