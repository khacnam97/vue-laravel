// EditComponent.vue
<style>
.form-group--error{
    color: red;
}
.form-group--error >.form__input, .form-group--error >.error{
    border-color: red;
}
</style>
<template>
    <div>
        <h1>Edit A product</h1>
        <form @submit.prevent="updatePost">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" :class="{ 'form-group--error': $v.product.title.$error }">
                        <label>Product Title:</label>
                        <input type="text" class="form__input form-control" v-model.trim="$v.product.title.$model">
                        <div class="error" v-if="!$v.product.title.required && $v.product.title.$error">Field is required</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" :class="{ 'form-group--error': $v.product.name.$error }">
                        <label>Product Name:</label>
                        <input class="form__input form-control" v-model.trim="$v.product.name.$model"/>
                        <div class="error" v-if="!$v.product.name.required && $v.product.name.$error">Field is required</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" :class="{ 'form-group--error': $v.product.price.$error }">
                        <label>Product Price:</label>
                        <input type="text" class="form__input form-control" v-model.trim="$v.product.price.$model">
                        <div class="error" v-if="!$v.product.price.required && $v.product.price.$error">Field is required</div>
                        <div class="error" v-if="!$v.product.price.decimal && $v.product.price.$error">Field is number</div>
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
import { required,decimal } from 'vuelidate/lib/validators';
export default {
    data() {
        return {
            product: {},
            File : null,
        }
    },
    validations: {
        product: {
            name: {
                required,
            },
            title: {
                required,
            },
            price: {
                decimal,
                required
            }
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
            this.$v.$touch();
            console.log(this.$v.name);
            if(this.$v.$invalid) {return;}
            else {
                this.axios.post(uri, formData).then((response) => {
                    this.$router.push({name: 'home'});
                });
            }
        }
    }
}
</script>
