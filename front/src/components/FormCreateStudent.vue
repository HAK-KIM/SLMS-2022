<template>
    <v-btn v-if="type" color="#04e" class="text-white" v-bind="attrs" @click="dialog=true">Create student</v-btn>
    <span v-else @click="dialog=true" style="cursor: pointer; padding: 5px 15px; background-color: #04e;border-radius:10px;color: #fff; display: flex;align-items: center;">Edit</span>
    <v-dialog v-model="dialog" max-width="600px" persistent min-height="650px">
      <v-card class="py-3">
        <v-card-title class="text-center text-uppercase">
          <span v-if="type">Create Student</span>
          <span v-else>Edit Student Infomation</span>
        </v-card-title>
        <v-card-text class="mx-1 my-1">            
          <v-row>
            <v-col cols="12" sm="6" md="6">
              <v-text-field label="firstName" v-model="firstName"></v-text-field>
              <small class="text-error">{{error.firstName}}</small>
            </v-col>
            <v-col cols="12" sm="6" md="6">
              <v-text-field label="lastName" v-model="lastName"></v-text-field>
              <small class="text-error">{{error.lastName}}</small>
            </v-col>
            <v-col cols="12" sm="12">
              <v-text-field label="E-mail" v-model='email'></v-text-field>
              <small class="text-error">{{error.email}}</small>
            </v-col>
            <v-col cols="12" sm="6">
              <v-select label="Gender" v-model="gender" :items="['Male', 'Female', 'Other']"
              ></v-select>
              <small class="text-error" >{{error.gender}}</small>
            </v-col>
            <v-col cols="12" sm="6">
              <v-select label="Batch" v-model="batch" :items="['2022', '2023']"></v-select>
              <small class="text-error">{{error.batch}}</small>
            </v-col>
            <v-col cols="12" md="6" sm="6">
              <v-text-field label="Phone number" v-model="phone"></v-text-field>
              <small class="text-error">{{error.phone}}</small>
            </v-col>
            <v-col cols="12" md="6" sm="6">
              <v-text-field type="number" label="Student ID" v-model="studentID"></v-text-field>
              <small class="text-error">{{error.studentID}}</small>
            </v-col>
            </v-row>
        </v-card-text>
        <v-card-actions class="ml-5 mb-5">
          <v-btn style="background-color: #f04" color="#fff" @click="dialog=false"> Cancel </v-btn>
          <v-btn v-if="type" style="background-color: #04f" @click="createStudent" class="text-white">Create</v-btn>
          <v-btn v-else style="background-color: #04f" @click="updateStudent" class="text-white">Update</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
</template>
<script>
export default {
  props: ['type', 'student', 'id'],
    data: () => ({
      dialog: false,
      firstName: '',
      lastName: '',
      gender: '',
      batch: '',
      email: '',
      phone: '',
      studentID: '',
      isValid: false,
      error: {},
    }),
    emits: ["create", 'update'],
    methods: {
      clearForm() {
        this.firstName = '';
        this.lastName = '';
        this.email = '';
        this.gender = '';
        this.batch = '';
        this.phone = '';
        this.studentID = '';
      },
      createStudent() {
        this.checkForm();
        if (this.isValid) {
          this.$emit('create', {
            firstName: this.firstName, 
            lastName: this.lastName,
            email: this.email,
            gender: this.gender,
            batch: this.batch,
            phone: this.phone,
            password: '123456789',
            studentID: this.studentID,
          });
          this.clearForm();
          this.dialog=false;
          this.isValid = false;
        }
      },
      checkForm() {
        const pattern  = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (this.firstName == '') {
          this.error.firstName = 'firstName is required'
        } else if (this.firstName != '') {
          this.error.firstName = ''
        }
        if (this.lastName == '') {
          this.error.lastName = 'lastName is required'
        } else if (this.lastName != '') {
          this.error.lastName = ''
        } if (this.gender == '') {
          this.error.gender = 'gender is required'
        } else if (this.gender != '') {
          this.error.gender = ''
        } if (this.studentID == '') {
          this.error.studentID = 'studentID is required'
        } else if (this.gender != '') {
          this.error.gender = ''
        } if (this.batch == '') {
          this.error.batch = 'batch is required'
        }else if (this.batch != '') {
          this.error.batch = ''
        } if (this.phone.length <= 9) {
          this.error.phone = 'phone minimum size is 9'
        }else if (this.phone.length > 8) {
          this.error.phone = ''
        } if (!pattern.test(this.email)) {
          this.error.email = 'email invalid'
        }else if (this.email != '') {
          this.error.email = ''
        } if (
          this.studentID != '' && this.firstName != '' && this.lastName != '' && this.email != '' && 
          this.batch != '' && pattern.test(this.email) && this.phone.length > 8
        ){
          this.isValid = true;
        }
      },
      getDataUpdate() {
        if (!this.type) {
          this.firstName = this.student.firstName;
          this.lastName = this.student.lastName;
          this.email = this.student.email;
          this.batch = this.student.batch;
          this.phone = this.student.phone;
          this.gender = this.student.gender;
          this.studentID = this.student.studentID;
        }
      },
      updateStudent() {
        this.checkForm();
        if (this.isValid) {
          this.$emit('update', this.id, {
            firstName: this.firstName,
            lastName: this.lastName,
            email: this.email,
            batch: this.batch,
            gender: this.gender,
            phone: this.phone,
            studentID: this.studentID,
          })
          this.dialog = false;
        }
      }
    },
    created() {
      this.getDataUpdate()
    }
}
</script>
<style scoped>
  .input {
    width: 100%;
    outline: none;
    padding: 10px;
    background-color: #eee;
    border-bottom: 1px solid #999;
    font-size: 16px;
    color: #000;
    border-radius: 3px 3px 0 0;
    font-weight: 300;
    cursor: pointer;
  }
</style>