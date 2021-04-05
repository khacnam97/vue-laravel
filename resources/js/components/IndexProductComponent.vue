// IndexComponent.vue

<template>
    <div>
        <h1>Product</h1>
        <div class="row">
            <div class="col-md-10"></div>
            <div class="col-md-2">
                <router-link :to="{ name: 'create' }" class="btn btn-primary">Create product</router-link>
            </div>
        </div><br />

        <table class="table">
            <thead class="thead-light">
            <tr>
                <th>Item Name</th>
                <th>Item Title</th>
                <th>Item Price</th>
                <th>Actions</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(product, key) in products" :key="product.id">
                <td>{{ product.name }}</td>
                <td>{{ product.title }}</td>
                <td>{{ product.price }}</td>
                <td><router-link :to="{name: 'edit', params: { id: product.id }}" class="btn btn-primary">Edit</router-link></td>
                <td><button class="btn btn-danger" @click.prevent="deleteProduct(product.id,key)">Delete</button></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            products: []
        }
    },
    created() {
        let uri = 'http://127.0.0.1:8000/api/products';
        this.axios.get(uri).then(response => {
            this.products = response.data.data;
        });
    },
    methods: {
        deleteProduct(id, index) {
            let uri = `http://127.0.0.1:8000/api/products/delete/${id}`;
            this.axios.delete(uri).then(response => {
                this.products.splice(index, 1);
            });
        }
    }
}
</script>
