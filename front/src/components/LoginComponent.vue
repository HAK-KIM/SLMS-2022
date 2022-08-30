<template>
    <div class="form-container">
        <div class="login-logo">
            <img src="https://i.pinimg.com/564x/05/cd/df/05cddf679e00c43a62c7f4a53856d775.jpg" alt="" width="200" height="200">
        </div>
        <div class="text-title">
            Signin your account
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
            isEmail:false,
            isPassword:false,
            show:false,
            passwordRules: [
            v => !!v || 'password is required',
            v => (v &&  10 >= v.length>=5)  || 'Passwor must be between 5 and 10 characters',
            ],
            email: '',
            emailRules: [
            v => !!v || 'E-mail is required',
            v => /.+@.+\..+/.test(v) || 'E-mail must be passerellesnumeriques.org account!',
            ],
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
        width: 80%;
        padding: 20px;
        box-shadow: #00000059 0px 5px 15px;
        border-radius:10px;
        position: relative;
        top: 150px;
    }
    .login-logo{
        display: flex;
        justify-content: center;
    }
    .login-logo img{
        width: 80px;
        height: 80px;
    }
    .text-title{
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