/ CreatePost.vue
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
        <h1>Create A product</h1>
        <form @submit.prevent="addProduct">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" :class="{ 'form-group--error': $v.title.$error }">
                        <label>Product Title:</label>
                        <input type="text" class="form__input form-control" v-model.trim="$v.title.$model">
                        <div class="error" v-if="!$v.title.required && $v.title.$error">Field is required</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" :class="{ 'form-group--error': $v.name.$error }">
                        <label class="form__label">Name</label>
                        <input class="form__input form-control" v-model.trim="$v.name.$model"/>
                        <div class="error" v-if="!$v.name.required && $v.name.$error">Field is required</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" :class="{ 'form-group--error': $v.price.$error }">
                        <label class="form__label">Price</label>
                        <input class="form__input form-control" v-model.trim="$v.price.$model"/>
                        <div class="error" v-if="!$v.price.decimal && $v.price.$error">Field is number</div>
                        <div class="error" v-if="!$v.price.required && $v.price.$error">Field is required</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" :class="{ 'form-group--error': $v.img.$error }">
                        <label>Product Img:</label>
                        <input type="file" id="img" accept="image/*" ref="file" class="form-control form__input" v-on:change="onImageChange">
                        <div class="error" v-if="!$v.img.required && $v.img.$error">Field is required</div>
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
import { required,decimal } from 'vuelidate/lib/validators';
export default {
    data(){
        return {
            FILE: null,
            name: '',
            title: '',
            price: 0,
            img: null
        }
    },
    validations: {
        name: {
            required,

        },
        title: {
            required,

        },
        price: {
            decimal,
            required
        },
        img: {
            required
        }
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
            formData.append('name',this.name);
            formData.append('title',this.title);
            formData.append('price',this.price);
            console.log(this.name);
            this.$v.$touch();
            console.log(this.$v.name);
            if(this.$v.$invalid) {return;}
            else {
                let uri = 'http://127.0.0.1:8000/api/product/create';
                this.axios.post(uri, formData).then((response) => {
                    this.$router.push({name: 'home'});
                });
            }
        }
    }
}
</script>
