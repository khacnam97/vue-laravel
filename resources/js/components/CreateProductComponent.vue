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

/*.dirty:focus {*/
/*    outline-color: #8E8;*/
/*}*/

.form-group--error{
    color: red;
}
.form-group--error >.form__input, .form-group--error >.error{
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
                        <input type="text" class="form-control" v-model="form.title">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" :class="{ 'form-group--error': $v.form.name.$error }">
                        <label class="form__label">Name</label>
                        <input class="form__input form-control" v-model.trim="$v.form.name.$model"/>
                        <div class="error" v-if="!$v.form.name.required && $v.form.name.$error">Field is required</div>
                    </div>
                    <p>{{$v.form.name}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" :class="{ 'form-group--error': $v.form.price.$error }">
                        <label class="form__label">Price</label>
                        <input class="form__input form-control" v-model.trim="$v.form.price.$model"/>
                        <div class="error" v-if="!$v.form.price.decimal && $v.form.price.$error">Field is number</div>
                        <div class="error" v-if="!$v.form.price.required && $v.form.price.$error">Field is required</div>
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
                <div class="col-md-3" v-if="form.img">
                    <img :src="form.img" class="img-responsive" height="70" width="90">
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
            form: {
                errors: [],
                FILE: null,
                name: '',
                title: '',
                price: 0,
                img: null
            }
        }
    },
    validations: {
        form: {
            name: {
                required,

            },
            price: {
                decimal,
                required
            }
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
            // if(!this.name){
            //     this.errors.push('Name required');
            // }
            formData.append('name',this.name);
            formData.append('title',this.title);
            formData.append('price',this.price);
            console.log(this.$v.form.$error);
            if(!this.$v.form.$error) {return;}
            else {
                let uri = 'http://127.0.0.1:8000/api/product/create';
                this.axios.post(uri, formData).then((response) => {
                    this.$router.push({name: 'product'});
                });
            }
        }
    }
}
</script>
