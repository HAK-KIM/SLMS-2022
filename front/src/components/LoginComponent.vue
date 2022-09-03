<template>
    <div class="form-container">
        <div class="login-logo">
            <img :src="logos" alt="" width="500" height="500">
        </div>
        <div class="text-title text-white ">
            SIGNIN ACCOUNT
        </div>
        <v-form
            ref="form"
            v-model="valid"
            lazy-validation
            class="purple darken-2 white--text mt-5"
            >

            <v-text-field
                v-model="mailEnter"
                :rules="emailRules"
                label="E-mail"
                required
            ></v-text-field>

            <div class="group-form">
                <v-text-field
                    id="password"
                    v-model="passwordEnter"
                    label="Password" 
                    :type="show ?'text': 'password'"
                    :rules="passwordRules"
                    :append-icon="show ?'mdi-eye':'mdi-eye-off'"   
                    @click:append="show=!show">
                </v-text-field>
            </div>
           
            <div class="btn-longin my-2">
                <v-btn block color="primary" @click="login" x-large>
                    LOGIN NOW
                </v-btn>                  
                <div class="forgot">
                    <router-link to="/change">Forgot password?</router-link>
                </div>
            </div>
        </v-form>
    </div>
</template>
<script>
export default {
    emits: ['emit-login'],
    data(){
        return{
            mailEnter: '',
            passwordEnter: '',
            loginNow:{email: '', password: '',},
            // logos:  "https://i.pinimg.com/236x/e5/c3/36/e5c3363701f1a2d7f29fba6ed0ccb97d.jpg"
            logos:  "https://i.pinimg.com/564x/28/72/bb/2872bb61e93425c0bb9393d5e444e9e5.jpg"
        }
    },
    methods:{
        login(){
            if(this.mailEnter != '' && this.passwordEnter != ''){
                this.loginNow.email = this.mailEnter
                this.loginNow.password = this.passwordEnter
                this.$emit('emit-login', this.loginNow)
                this.isEmail = false;
                this.isPassword = false;
            }
            // if (this.mailEnter == ''){
            //     this.isEmail = true;
            // }
            // if (this.passwordEnter == ''){
            //     this.isPassword = true;
            // }
            console.log(this.mailEnter)
            console.log(this.passwordEnter)
        },
    },

}
</script>
<style scoped>
    .form-container{
        /* width: 40%; */
        padding: 30px;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        border-radius:10px;
        /* background-color: rgb(27, 91, 253); */
        /* background-color: #1976d2; */
    }
    .login-logo{
        display: flex;
        justify-content: center;
    }
    .login-logo img{
        width: 150px;
        height: 150px;
    }
    .text-title{
        font-size: 30px;
        display: flex;
        justify-content: center;
    }

    button{
        width: 100px;
        margin: auto;      
        /* color: white; */
    }
    .btn-longin{
        width: 100%;
        margin: auto;
    }
    .forgot{
        display: flex;
        justify-content: end;
    }
    .forgot a{
        color: rgb(10, 189, 10);

    }
    .group-form p{
        color: red;
    }
</style>