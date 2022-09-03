<template>
    <div style="display: flex;justify-content: space-around;align-items: center; height: 80vh;;">
        <div style="">
            <img src="https://www.datocms-assets.com/40521/1614850600-hrms-6.png">
        </div>
        <div style="width: 40%;">
            <LoginComponent @emit-login="loginData" :isNotLogin="isNotValid"/>
        </div>
    </div>
</template>
<script>
import LoginComponent from '@/components/LoginComponent.vue'
// import ForgotPassword from '@/components/Profiles/ForgotPassword.vue';
import axios from '../axios-http';
export default {
    components: { LoginComponent }, 
    data(){
        return {
            isNotValid: false,
        }
    },
    methods: {
        loginData(value){
            console.log(value)
            // if (this.$route.meta.isAdmin && (/[a-z].[a-z]*@passerellesnumeriques.org*/.test(value.email))) {
            if (this.$route.meta.isAdmin ) {
                axios.post('/loginAdmin', value)
                .then((response) => {
                    console.log(response.data);
                    localStorage.setItem("user",'teacher' );
                    localStorage.setItem("Authorization", (response.data.token));
                    this.$router.push('/leave');
                    // setTimeout(function(){
                    //     window.location.reload();
                    // }, 2000);
                }).catch((error) => {
                    console.log(error);
                })
            }
             else if ((/[a-z].[a-z]*@student.passerellesnumeriques.org*/.test(value.email)) && !this.$route.meta.isAdmin ){
                axios.post('/login', value)
                .then((response) => {
                    console.log(response.data);
                    localStorage.setItem("id", (response.data.user.id));
                    localStorage.setItem("user",'student' );
                    localStorage.setItem("Authorization", (response.data.token));
                    setTimeout(function(){
                            window.location.reload();
                    }, 2000);
                    // let id = localStorage.getItem("id");
                    this.$router.push('/leave/'+localStorage.getItem("id"));
                }).catch((error) => {
                    console.log(error);
                })
            } else {
                console.log('error')
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
    // created() {
    //     this.logout();
    // }
}
</script>
