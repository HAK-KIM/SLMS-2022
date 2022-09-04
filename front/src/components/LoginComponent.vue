<template>
    <div class="form-container">
        <div class="login-logo">
            <img :src="logos" alt="">
        </div>
        <div class="text-title ">
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
                <div style="text-align: right;">
                    <router-link to="/forgot" style="color: green;">Forgot password?</router-link>
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
            show:false,
            mailEnter: '',
            passwordEnter: '',
            loginNow:{email: '', password: '',},
            logos:  "https://i.pinimg.com/564x/5c/c9/a3/5cc9a3dfeb7ad4e84c418b3f4938edc3.jpg"
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
            console.log(this.mailEnter)
            console.log(this.passwordEnter)
        },
    },

}
</script>
<style scoped>
    .form-container{
        padding: 50px;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        border-radius:10px;
        background: white;
    }
    .login-logo{
        display: flex;
        justify-content: center;
    }
    .login-logo img{
        width: 150px;
        height: 150px;
        margin-top: -40px;
    }
    .text-title{
        font-size: 30px;
        display: flex;
        justify-content: center;
    }

    button{
        width: 100px;
        margin: auto;    
    }
    .btn-longin{
        width: 100%;
        margin: auto;
    }
    .forgot{
        display: flex;
        justify-content: end;
        padding-top: 20px;
    }
    .forgot a{
        color: rgb(10, 189, 10);
        text-decoration: none;

    }
</style>
