<template>
    <table class="table table-borderless">
        <thead>
            <tr>
                <th scope="col"  class="d-none d-lg-table-cell">ID</th>
                <th scope="col">Name</th>
                <th scope="col"  class="d-none d-sm-table-cell">SKU</th>
                <th scope="col" class="text-end d-md-table-cell d-none">Price</th>
                <th scope="col"  class="d-none d-xl-table-cell">Description</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody v-if="loading">
            <tr>
                <td colspan="6" class="text-center">
                    Loading records..
                </td>
            </tr>
        </tbody>
        <tbody v-else-if="products.length">
            <tr v-for="product in products">
                <td  class="d-none d-lg-table-cell">#{{ product.id }}</td>
                <td>{{ product.name }}</td>
                <td  class="d-none d-sm-table-cell ">{{ product.sku }}</td>
                <td class="text-end  d-none d-md-table-cell">{{ product.price_text }}</td>
                <td  class="d-none d-xl-table-cell">{{ product.description }}</td>
                <td>
                    <a class="text-decoration-none text-danger" @click.prevent="deleteProduct(product.id)"
                        href="#">Delete</a>
                </td>
            </tr>
        </tbody>
        <tbody v-else>
            <tr>
                <td colspan="6" class="text-center">
                    Opps, no records found.
                </td>
            </tr>
        </tbody>
    </table>
</template>
<script>
export default {
    name: 'Table',
    props: {
        products: Array,
        loading: Boolean,
    },
    methods: {
        async deleteProduct(id) {
            try {
                const response = await this.$axios.delete(`/api/products/${id}`).then((res) => {
                    this.$helper.toast(this, res, 'success');
                }).catch((err) => {
                    throw err.response
                });
                this.$parent.fetchProducts();
            }
            catch (e) {
                this.$helper.apiError(this, e);
            };
        }
    },
}
</script>