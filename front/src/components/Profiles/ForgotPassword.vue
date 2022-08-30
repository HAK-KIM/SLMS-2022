<template>
    <div class="form-container">
        <div class="login-logo">
            <img src="https://i.pinimg.com/564x/05/cd/df/05cddf679e00c43a62c7f4a53856d775.jpg" alt="" width="200" height="200">
        </div>
        <div class="text-title">
            Forgot Password
        </div>
        <form @submit.prevent = "changePassword">
            <div class="group-form">
                <label for="">Password</label><br>
                 <input type="password" placeholder="Enter password" v-model="passwordEnter" required>
            </div>
            <button>Submit</button>
        </form>
    </div>
</template>
<script>
// import axios from "../../axios-http"
export default {
    emits: ['emit-Password'],
    props:['change_password'],
    data(){
        return{
            passwordEnter: this.change_password,
            email: '',
        }
    },
    methods:{
       changePassword(){
            // console.log('Successfully now.')
            // this.$emit('emit-reset', this.passwordEnter)
            // const response = await axios.post('forgot', {email:this.email})
            // console.log(response)
            this.$emit('emit-Password', this.passwordEnter)
        }

    }
}
</script>
<style scoped>
    .form-container{
        width: 40%;
        padding: 20px;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        border-radius:10px;
        margin: 30px auto;
        
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
        font-weight: bold;
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