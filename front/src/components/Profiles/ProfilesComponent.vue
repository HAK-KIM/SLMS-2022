<template>
    <div class="profiles-container">
      <div class="profiles-img">
      <!-- REAL IMAGE -->
      <div class="top-content">
        <h2>Personal Profile</h2>
          <img :src="users.image !=null?users.image:avataImage" alt="" width="150" height="150" >
          <div class="update">
            <label for="images">
              <img src="https://www.freeiconspng.com/thumbs/camera-icon/camera-icon-21.png" alt="" width="50" height="50" >
            </label>
            <input type="file" id="images" hidden="true" @change="onFileSelected">
          </div>
          
          <div class="change">Chang your photos</div>
      </div>
        </div>

        <div class="info-detail" v-if="!ishidden">
          <div class="name-defualt">
            <div>FIRST NAME</div>
            <div class="getinfo"><strong>{{ users.firstName }}</strong></div>
          </div>
        </div>

        <div class="info-detail" v-if="!ishidden">
          <div class="name-defualt">
            <div>LAST NAME</div>
            <div class="getinfo"><strong>{{users.lastName}}</strong></div>
          </div>
        </div>
        <!-- CLASS INFO -->
        <div class="info-detail" v-if="!ishidden">
          <div class="name-defualt">
            <div>ClASS</div>
            <div class="getinfo"><strong>{{users.class}}</strong></div>
          </div>
        </div>
        <!-- GENDER INFO-->
        <div class="info-detail" v-if="!ishidden">
          <div class="name-defualt">
            <div>GENDER</div>
            <div class="getinfo"><strong>{{users.gender}}</strong></div>
          </div>
        </div>
        <!-- BATCH GENERATION -->
        <div class="info-detail" v-if="!ishidden">
          <div class="name-defualt">
            <div>BATCH</div>
            <div class="getinfo"><strong>{{users.batch}}</strong></div>
          </div>
        </div>
        <!-- STUDENT ID -->
        <div class="info-detail" v-if="!ishidden">
          <div class="name-defualt">
            <div>STUDENT ID</div>
            <div class="getinfo"><strong>{{users.studentID}}</strong></div>
          </div>
        </div>
        <!-- PHONE NUMBER-->
        <div class="info-detail" v-if="!ishidden">
          <div class="name-defualt">
            <div>CONTACT</div>
            <div class="getinfo"><strong>{{users.phone}}</strong></div>
          </div>
        </div>
        <!-- EMAIL -->
        <div class="info-detail" v-if="!ishidden">
          <div class="name-defualt">
            <div>EMAIL</div>
            <div class="getinfo"><strong style="color: blue;">{{users.email}}</strong></div>
          </div>
        </div>
        <!-- PASSWORD -->
        <div class="info-detail" v-if="!ishidden">
          <div class="name-defualt">
            <div>PASSWORD</div>
            <div class="text-getinfo"><strong style="display: none">{{users.password}}</strong></div>
            <div class="btn-reset" @click="hidden">
              <img src="https://icon-library.com/images/edit-icon-png/edit-icon-png-0.jpg" alt="" width="20" height="20">
              <div>Reset Password</div>
            </div>
          </div>
        </div>
        <!-- CHANGE PASSWORD -->
        <div class="change-password" v-if="ishidden">
          <ResetPassword @show-data="show" :change_password="users.password" @emit-reset="sendPassword"/>
        </div>
    </div>
  
</template>

<script>
import Swal from 'sweetalert2'
import ResetPassword from './ResetPassword.vue'
import axios from '../../axios-http';
export default ({
  components: {ResetPassword},
  data: () => ({
    users:{},
    ishidden: false,
    isimage: false,
    avataImage:'https://cdn-icons-png.flaticon.com/512/149/149071.png',
    URL: '/students/'+ localStorage.getItem("id"),
    imageURL: '/upload/'+localStorage.getItem("id")
  }),
  methods: {
    getPersonalData() {
      axios.get(this.URL)
      .then((response)=>{
          this.users = response.data
      })   
    },

    hidden(){
        this.ishidden = !this.ishidden
    },
    show(value){
      this.ishidden = value;
    },
    // SELECTE FILES IMAGE
    async onFileSelected(event){
      console.log(this.users.image)
          Swal.fire({
              title: 'Are you sure, to select it?',
              showCancelButton: true,
              confirmButtonText: 'Confirm',
              customClass: {
                actions: 'my-actions',
                cancelButton: 'order-1 right-gap',
                confirmButton: 'order-2 left-gap',
              }
            }).then((result) => {
              if (result.isConfirmed) {
                Swal.fire('Saved!', '', 'success')
                console.log('Confirmed!', '', 'success')
                this.onUpload(event.target.files[0])
              }else {
                console.log('Cancled')
              }
          })
    },
    // UPLOAD IMAGES
    onUpload(image){
        const fd = new FormData();
        fd.append('image', image)
        fd.append('_method', 'PUT')
        axios.post(this.imageURL, fd).then((response)=>{
          console.log(response)
          return this.getPersonalData();
        })
    },

  sendPassword(value){
    console.log(value)
    axios.put(this.URL,{password:value}).then((response)=>{
      console.log(response)
    })
  }
  },
  mounted() {
    return this.getPersonalData()
  },

});
</script>

<style scoped>
  .profiles-container{
      width: 60%;
      margin: 0 auto;
      margin-top: 20px;
      box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
      padding: 10px;
      border-top: 5px solid blue;
      border-radius: 10px;
        
    }
    .profiles-img{
      margin: auto;
      display: flex;
      justify-content: center;
      background: rgb(212, 236, 249);
    }
    .profiles-img img{
      border-radius: 50%;
    }
    .update {
      display: flex;
      justify-content: center;
      position: relative;
      top: -35px;
    }
    .change{
      text-align: center;
      display: flex;
      justify-content: center;
      position: relative;
      top: -40px;
    }
    strong {
      color: black;
      font-weight: normal;
    }
    .name-defualt{
      width: 80%;
      margin: auto;
      display: flex;
      justify-content: space-between;
      padding: 10px;
      box-shadow: rgba(0, 0, 0, 0.04) 0px 3px 5px;
      z-index: 1;
    }
    .name-defualt:hover{
      background: rgb(240, 239, 239);
    }
    .name-defualt .getinfo{
      width: 70%;
    }
    .text-getinfo, .btn-reset{
      width: 25%;
    }
    .btn-reset{
      display: flex;
      width: 30%;
      justify-content: center;
      padding: 3px;
      color: blue;
      box-sizing: border-box;
    }
    .btn-reset:hover{
      width: 30%;
      color: black;
      font-weight: bold;
    }
    .btn-reset img{
      margin-right: 5px;
    }
    .change-password{
      width: 90%;
      margin: auto;
      z-index: 999;
      display: flex;
      justify-content: center;
    }
    button{
      padding: 10px;
      background: pink;
    }
    .my-actions { margin: 0 2em; }
.order-1 { order: 1; }
.order-2 { order: 2; }

.right-gap {
  margin-right: auto;
}
</style>