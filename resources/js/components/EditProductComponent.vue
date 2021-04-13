// EditComponent.vue

<template>
    <div>
        <h1>Edit A product</h1>
        <form @submit.prevent="updatePost">
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
                        <input type="file" id="img" accept="image/*" ref="file" class="form-control" v-on:change="onImageChange">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3" >
                    <img :src="product.img" class="img-responsive" height="70" width="90">
                </div>
            </div><br />
            <div class="form-group">
                <button class="btn btn-primary">Edit</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            product: {},
            File : null,
        }
    },
    created() {
        let uri = `http://127.0.0.1:8000/api/product/edit/${this.$route.params.id}`;
        this.axios.get(uri).then((response) => {
            this.product = response.data;
            console.log(this.product);
        });
    },
    methods: {
        onImageChange(event) {
            this.product.img = URL.createObjectURL(event.target.files[0]);
            this.FILE = event.target.files[0];
            // console.log(this.img1);
        },
        updatePost() {
            let uri = `http://127.0.0.1:8000/api/product/update/${this.$route.params.id}`;
            const formData = new FormData();
            formData.append('name',this.product.name);
            formData.append('title',this.product.title);
            formData.append('price',this.product.price);
            if (this.FILE){
                formData.append('img',this.FILE,this.FILE.name);
            }
            // else
            // formData.append('img',this.img,this.img.name);

            this.axios.post(uri, formData).then((response) => {
                this.$router.push({name: 'product'});
            });
        }
    }
}
</script>
