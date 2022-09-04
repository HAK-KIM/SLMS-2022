<template>
  <div class="w-50 mx-auto my-3 rounded-lg" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">
    <div class="rounded-lg" style="margin: auto; display: flex; justify-content: center; background: rgb(212, 236, 249);">
      <!-- REAL IMAGE -->
      <div class="top-content">
        <h2 class="mt-3 mb-2">Personal Profile</h2>
        <img :src="users.image !=null?users.image:avataImage" alt="" width="150" height="150"
          style="border-radius: 50%;">
        <div class="update">
          <label for="images">
            <v-icon x-large class="ml-15" style="cursor: pointer;">mdi-camera</v-icon>
          </label>
          <input type="file" id="images" hidden="true" @change="onFileSelected">
        </div>
      </div>
    </div>
    <section v-if="!ishidden" class="py-3">
      <div class="info-detail mt-5">
        <div class="name-defualt">
          <div>FIRST NAME</div>
          <div class="getinfo"><strong>{{ users.firstName }}</strong></div>
        </div>
      </div>
  
      <div class="info-detail">
        <div class="name-defualt">
          <div>LAST NAME</div>
          <div class="getinfo"><strong>{{users.lastName}}</strong></div>
        </div>
      </div>
      <!-- CLASS INFO -->
      <div class="info-detail">
        <div class="name-defualt">
          <div>ClASS</div>
          <div class="getinfo"><strong>{{users.class}}</strong></div>
        </div>
      </div>
      <!-- GENDER INFO-->
      <div class="info-detail">
        <div class="name-defualt">
          <div>GENDER</div>
          <div class="getinfo"><strong>{{users.gender}}</strong></div>
        </div>
      </div>
      <!-- BATCH GENERATION -->
      <div class="info-detail">
        <div class="name-defualt">
          <div>BATCH</div>
          <div class="getinfo"><strong>{{users.batch}}</strong></div>
        </div>
      </div>
      <!-- STUDENT ID -->
      <div class="info-detail">
        <div class="name-defualt">
          <div>STUDENT ID</div>
          <div class="getinfo"><strong>{{users.studentID}}</strong></div>
        </div>
      </div>
      <!-- PHONE NUMBER-->
      <div class="info-detail">
        <div class="name-defualt">
          <div>CONTACT</div>
          <div class="getinfo"><strong>{{users.phone}}</strong></div>
        </div>
      </div>
      <!-- EMAIL -->
      <div class="info-detail">
        <div class="name-defualt">
          <div>EMAIL</div>
          <div class="getinfo"><strong style="color: blue;">{{users.email}}</strong></div>
        </div>
      </div>
      <!-- PASSWORD -->
      <div class="info-detail">
        <div class="name-defualt">
          <div>PASSWORD</div>
          <div class="getinfo" >
            <span  @click="hidden" style="padding: 8px; cursor: pointer; background-color: #04e; border-radius: 10px; color: #fff;">
              <v-icon>mdi-lock-reset</v-icon>
              Reset Password
            </span>
          </div>
        </div>
      </div>
    </section>
    <!-- CHANGE PASSWORD -->
    <div class="change-password" v-if="ishidden">
      <ResetPassword :change_password="users.password" @emit-password="sendPassword" />
    </div>
  </div>
  <section>
    <v-overlay v-model="overlay" class="d-flex justify-center align-center">
      <v-progress-circular indeterminate size="100">Loading</v-progress-circular>
    </v-overlay>
  </section>
</template>

<script>
// import Swal from 'sweetalert2'
import ResetPassword from './ResetPassword.vue'
import axios from '../../axios-http';
export default ({
  components: {ResetPassword},
  data: () => ({
    users:{},
    ishidden: false,
    isimage: false,
    avataImage:'https://cdn-icons-png.flaticon.com/512/149/149071.png',
    overlay: false,
  }),
  methods: {
    getPersonalData() {
      axios.get('/students/'+ localStorage.getItem("id"))
      .then((response)=>{
          this.users = response.data;
          this.overlay = false;
      })   
    },

    hidden(){
        this.ishidden = !this.ishidden
    },
    // SELECTE FILES IMAGE
    async onFileSelected(event){
      this.onUpload(event.target.files[0])
    },
    // UPLOAD IMAGES
    onUpload(image){
        const fd = new FormData();
        fd.append('image', image)
        fd.append('_method', 'PUT')
        axios.post('/upload/'+localStorage.getItem("id"), fd).then(()=>{
          return this.getPersonalData();
        })
        setTimeout(function(){
            window.location.reload();
        }, 1000);
    },
  // UPDATE PASSWORD
  sendPassword(pwd,boolean){
    axios.post('password/'+ localStorage.getItem("id"),{password:pwd, _method: 'PUT'}).then(()=>{
      return this.getPersonalData();
    })
    this.ishidden = boolean;
  }
  },
  created() {
    this.overlay = true;
    return this.getPersonalData()
  },

});
</script>

<style scoped>
.edit {
  background: none;
  width: 80px;
  height: 80px;
  border-radius: 50%;

  position: relative;
  right: -150px;
  top: 100px;
}

.edit:hover {
  border: 1px solid blue;
}

.update {
  display: flex;
  justify-content: center;
  position: relative;
  top: -35px;  
}

.change {
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

.name-defualt {
  width: 80%;
  margin: auto;
  display: flex;
  justify-content: space-between;
  padding: 10px;
  box-shadow: rgba(0, 0, 0, 0.04) 0px 3px 5px;
  z-index: 1;
}

.name-defualt:hover {
  background: rgb(240, 239, 239);
}

.name-defualt .getinfo {
  width: 70%;
}

.text-getinfo {
  width: 25%;
}

.btn-reset:hover {
  width: 30%;
  color: black;
  font-weight: bold;
}

.change-password {
  width: 90%;
  margin: auto;
  z-index: 999;
  display: flex;
  justify-content: center;
}

button {
  padding: 10px;
  background: pink;
}

.my-actions {
  margin: 0 2em;
}

.order-1 {
  order: 1;
}

.order-2 {
  order: 2;
}

.right-gap {
  margin-right: auto;
}
</style>