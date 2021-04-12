/ CreatePost.vue

<template>
    <div>
        <h1>Create A product</h1>
        <form @submit.prevent="addProduct">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Product Title:</label>
                        <input type="text" class="form-control" v-model="title">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Product Name:</label>
                        <input type="text" class="form-control" v-model="name">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Product Price:</label>
                        <input type="text" class="form-control" v-model="price">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Product Img:</label>
                        <input type="file" id="img" ref="file" class="form-control" v-on:change="onImageChange">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3" v-if="FILE">
                    <img :src="FILE" class="img-responsive" height="70" width="90">
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
            FILE: null,
            name: '',
            title : '',
            price : '',

        }
    },
    methods: {
        // onImageChange(event) {
        //     this.FILE = URL.createObjectURL(event.target.files[0]);
        //     this.FILE = event.target.files[0];
        //     console.log(this.FILE);
        // },
        onImageChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createImage(files[0]);
        },
        createImage(file) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = (e) => {
                vm.FILE = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        addProduct(){
            const formData = new FormData();
            formData.append('img',this.FILE,this.FILE.name);
            formData.append('name',this.name);
            formData.append('title',this.title);
            formData.append('price',this.price);

            console.log(this.product);
            let uri = 'http://127.0.0.1:8000/api/product/create';
            this.axios.post(uri, formData).then((response) => {
                this.$router.push({name: 'product'});
            });
        }
    }
}
</script>
