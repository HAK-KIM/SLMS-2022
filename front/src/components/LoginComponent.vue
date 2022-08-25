<template>
    <div class="form-container">
        <div class="login-logo">
            <img :src="logos" alt="" width="200" height="200">
        </div>
        <div class="text-title">
            Signin your account
        </div>
        <form @submit.prevent = "login">
            <div class="group-form">
                <label for="">Email Address</label><br>
                <input type="email" placeholder="Enter email address" v-model="mailEnter" required>
            </div>
            <div class="group-form">
                <label for="">Password</label><br>
                 <input type="password" placeholder="Enter password" v-model="passwordEnter" required>
            </div>
            <div class="verify-email">
               Forgot Password?
            </div>
            <div class="btn-longin">
                <button>Sign Me in</button>
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
            logos: 'https://i.pinimg.com/564x/05/cd/df/05cddf679e00c43a62c7f4a53856d775.jpg'
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
        width: 80%;
        padding: 20px;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        border-radius:10px;
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
    form{
        padding-right: 10px;
        width: 100%;
    }
    .group-form{
        margin: 10px;
    }
    .group-form input, button{
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
        border-radius: 10px;
        border: 1px solid rgb(32, 253, 32);
    }
    .btn-longin{
        width: 95%;
        margin: auto;
        margin: 10px;
    
    }
    button{
        padding: 10px;
        background: #0044AA;
        border: 2px solid  white;
        color: white;
        box-sizing: border-box;
        width: 100%;
    }
    
</style>