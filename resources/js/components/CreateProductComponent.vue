/ CreatePost.vue

<template>
    <div>
        <h1>Create A product</h1>
        <form @submit.prevent="addProduct">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Product Title:</label>
                        <input type="text" class="form-control" v-model="product.title">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Product Name:</label>
                        <input type="text" class="form-control" v-model="product.name">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Product Price:</label>
                        <input type="text" class="form-control" v-model="product.price">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Product Img:</label>
                        <input type="file" id="file" ref="file" class="form-control" v-on:change="handleFileUpload()">
                    </div>
                </div>
            </div><br />
            <div class="form-group">
                <button class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data(){
        return {
            product:{}
        }
    },
    methods: {
        handleFileUpload(){
            this.file = this.$refs.file.files[0];
        },
        addProduct(){
            console.log(this.file);

            console.log(this.product);
            let uri = 'http://127.0.0.1:8000/api/product/create';
            this.axios.post(uri, this.product).then((response) => {
                this.$router.push({name: 'product'});
            });
        }
    }
}
</script>
