<template>
    <div class="ma-5">
        <div style="text-align: center; font-size: 30px; font-weight: bold;">
            Change My Password
        </div>
        <v-form
            ref="form"
            v-model="valid"
            lazy-validation
            class="purple darken-2 white--text mt-5"
            >
            <div class="group-form">
                <v-text-field
                    id="password"
                    v-model="passwordEnter"
                    label="Password" 
                    :type="show ?'text': 'password'"
                    :rules="passwordRules"
                    :append-inner-icon="show ?'mdi-eye':'mdi-eye-off'"   
                    @click:append-inner="show=!show">
                </v-text-field>
            </div>
           
            <div class="btn-longin my-2 d-flex justify-content: center;">
                <v-btn
                    class="ma-2"
                    outlined
                    color="indigo"
                    @click="resetPassword"
                >
                    Change Password
                </v-btn>              

            </div>
        </v-form>
    </div>
</template>
<script>
export default {
    emits: ['emit-password'],
    data(){
        return{
            passwordEnter: '',
            isPassword:false,
            show:false,
            passwordRules: [
            v => !!v || 'password is required',
            v => (v &&  10 >= v.length>=5)  || 'Passwor must be between 5 and 10 characters',
            ],
        }
    },
    methods:{
        resetPassword(){
            if(this.passwordEnter != ''){
                this.$emit('emit-password', this.passwordEnter,false)
            }
            console.log(this.passwordEnter)
        },
    },
}
</script>

