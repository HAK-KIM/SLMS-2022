<template>
    <div style="width: 80%;padding: 20px;box-shadow: #00000059 0px 5px 15px;border-radius:10px;">
        <div style="display: flex;justify-content: center;">
            <img src="https://i.pinimg.com/564x/35/8f/c9/358fc916283e21aa785ef5d6fbe56eba.jpg" alt="" width="80" height="80" style="border-radius:50%;">
        </div>
        <div style="text-align: center;">
            <H1>Signin your account</H1>
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
            mailEnter: '',
            passwordEnter: '',
            loginNow:{email: '', password: '',},
            logos:  "https://i.pinimg.com/564x/28/72/bb/2872bb61e93425c0bb9393d5e444e9e5.jpg",
            show:false
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

