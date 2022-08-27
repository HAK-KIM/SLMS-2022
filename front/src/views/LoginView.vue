<template>
    <div class=home>
        <div class="background">
            <img :src="image">
        </div>
        <div class="login">
            <LoginComponent @emit-login="loginData"/>
        </div>
    </div>
</template>
<script>
import LoginComponent from '@/components/LoginComponent.vue'
import axios from '../axios-http';
export default {
    components: { LoginComponent },
    data(){
        return {
            image: 'https://www.datocms-assets.com/40521/1614850600-hrms-6.png',
        }
    },
    methods: {
        loginData(value){
            if (this.$route.meta.isAdmin && (/[a-z].[a-z]*@passerellesnumeriques.org*/.test(value.email))) {
                axios.post('/loginAdmin', value)
                .then((response) => {
                    console.log(response.data);
                    localStorage.setItem("id", (response.data.user.id));
                    localStorage.setItem("Authorization", (response.data.token));
                    this.$router.push('/leave');
                }).catch((error) => {
                    console.log(error);
                })
            } else if ((/[a-z].[a-z]*@student.passerellesnumeriques.org*/.test(value.email)) && !this.$route.meta.isAdmin ){
                axios.post('/login', value)
                .then((response) => {
                    let id = localStorage.getItem("id");
                    console.log(response.data);
                    localStorage.setItem("id", (response.data.user.id));
                    localStorage.setItem("Authorization", (response.data.token));
                    this.$router.push('/leave/'+id);
                }).catch((error) => {
                    console.log(error);
                })
            } else {
                console.log('error');
            }
            console.log(this.$route.meta.isAdmin);
            console.log(this.$route.meta.logout);
        },
        logout() {
            if (this.$route.meta.logout) {
                localStorage.removeItem("Authorization");
                localStorage.removeItem("id");
            }
        }
    },
    mounted() {

    },
    created() {
        this.logout();
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