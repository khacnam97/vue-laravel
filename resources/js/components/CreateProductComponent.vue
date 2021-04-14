/ CreatePost.vue
<style>
/*input {*/
/*    border: 1px solid silver;*/
/*    border-radius: 4px;*/
/*    background: white;*/
/*    padding: 5px 10px;*/
/*}*/

/*.dirty {*/
/*    border-color: #5A5;*/
/*    background: #EFE;*/
/*}*/


.error {
    /*border-color: red;*/
    color: red;
}
.error-border ,.error-border:focus{
    border-color: red;
}

/*.error:focus {*/
/*    outline-color: #F99;*/
/*}*/

</style>
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
                    <div class="form-group"  v-if="$v.name.required">
                        <label >Product Name:</label>
                        <input type="text" class="form-control " v-model.trim="$v.name.$model">
                    </div>
                    <div class="form-group"  v-else>
                        <label >Product Name:</label>
                        <input type="text" class="form-control error-border" v-model.trim="$v.name.$model">
                        <div class="error" v-if="!$v.name.required">Name is required</div>
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
                        <input type="file" id="img" accept="image/*" ref="file" class="form-control" v-on:change="onImageChange">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3" v-if="img">
                    <img :src="img" class="img-responsive" height="70" width="90">
                </div>
            </div><br />
            <div class="form-group">
                <button class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
</template>

<script>
import { validationMixin } from "vuelidate";
const { required, maxLength, minLength } = require("vuelidate/lib/validators");
export default {
    data(){
        return {
            errors : [],
            FILE: null,
            name: '',
            title : '',
            price : '',
            img : null

        }
    },
    validations: {
        name: {
            required
        },
    },
    methods: {
        onImageChange(event) {
            this.img = URL.createObjectURL(event.target.files[0]);
            this.FILE = event.target.files[0];
        },
        addProduct(){
            const formData = new FormData();
            if (this.FILE){
                formData.append('img',this.FILE,this.FILE.name);
            }
            // if(!this.name){
            //     this.errors.push('Name required');
            // }
            formData.append('name',this.name);
            formData.append('title',this.title);
            formData.append('price',this.price);

            let uri = 'http://127.0.0.1:8000/api/product/create';
            this.axios.post(uri, formData).then((response) => {
                this.$router.push({name: 'product'});
            });
        }
    }
}
</script>
