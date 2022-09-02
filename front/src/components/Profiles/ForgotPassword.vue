<template>
    <div style="width: 80%;padding: 20px;box-shadow: #00000059 0px 5px 15px;border-radius:10px;">
        <div style="display:flex;justify-content:center;">
            <img src="https://o.remove.bg/downloads/cc449e3b-f195-4e45-9347-d3345655a9bf/New_Project-removebg-preview.png" alt="" width="120" height="120">
        </div>
        <div style="text-align: center;font-weight: bold;">
            Forgot My password!
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
                <v-btn block color="primary" @click="re" x-large>
                    LOGIN NOW
                </v-btn>                  
                <div style="display: flex;justify-content: end;">
                    <p  style="color: rgb(10, 189, 10);cursor: pointer;width: 50%;text-align:center;">Forgot password?</p>
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
        },
    },

}
</script>
<style>
 
</style>