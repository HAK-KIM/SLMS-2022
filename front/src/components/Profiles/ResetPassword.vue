<template>
    <div style="width: 60%;padding: 20px;box-shadow: #00000059 0px 5px 15px;border-radius:10px;">
        <div style="display: flex;justify-content: center;">
            <img src="https://i.pinimg.com/564x/35/8f/c9/358fc916283e21aa785ef5d6fbe56eba.jpg" alt="" width="80" height="80">
        </div>
        <div style="text-align: center;">
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
                    :append-icon="show ?'mdi-eye':'mdi-eye-off'"   
                    @click:append="show=!show">
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

