<template>
    <div class=home>
        <div class="background">
            <img :src="image">
        </div>
        <div class="login" v-if="isShwo">
            <LoginComponent @emit-login="loginData"/>
        </div>
    </div>
</template>
<script>
import LoginComponent from '@/components/GetIn/LoginComponent.vue'
import axios from '../axios-http';
export default {
    components: { LoginComponent },
    data(){
        return {
            image: 'https://www.datocms-assets.com/40521/1614850600-hrms-6.png',
            isShwo: false
        }
    },
    methods: {
        loginData(value){
            axios.post('/signin', value).then((response) => {
            console.log('successfull', response);
            return this.$router.push({name: "check leave"});
          })
        }
    },
    mounted() {
        setTimeout( () => {
            return this.isShwo = true;
        }, 1000);
    }
}
</script>
<style>
    .home{
        display: flex;
        justify-content: space-between;
        align-items: end;
    }
    .login{
        width:40%;
    }
    .background{
        width: 70%;
        margin-top: 20px;
    }
</style>