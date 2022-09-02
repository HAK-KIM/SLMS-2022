<template>
    <div class="form-container">
        <div class="login-logo">
            <img :src="logos" alt="" width="500" height="500">
        </div>
        <div class="text-title text-white ">
            SIGNIN ACCOUNT
        </div>
        <form @submit.prevent = "login">
            <div class="group-form text-white">
                <label for="">Email Address</label><br>
                <input type="email" placeholder="Enter email address" v-model="mailEnter" required>
            </div>
            <div class="group-form text-white">
                <label for="">Password</label><br>
                 <input type="password" placeholder="Enter password" v-model="passwordEnter" required>
            </div>
            <div class="verify-email text-white">
               Forgot Password?
            </div>
            <div class="btn-longin">
                <button>Login</button>
            </div>
        </form>
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
            this.loginNow.email = this.mailEnter
            this.loginNow.password = this.passwordEnter
            this.$emit('emit-login', this.loginNow)
        }
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
    form{
        padding-right: 10px;
        width: 100%;
    }
    .group-form{
        margin: 20px;
    }
    .group-form input, button{
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
        border-radius: 10px;
        /* border: 1px solid rgb(32, 253, 32); */
    }
    .btn-longin{
        width: 95%;
        margin: auto;
        margin: 10px;
    
    }
    button{
        padding: 10px;
        background: #0044AA;
        /* border: 2px solid  white; */
        color: white;
        box-sizing: border-box;
        width: 100%;
    }
    
</style>