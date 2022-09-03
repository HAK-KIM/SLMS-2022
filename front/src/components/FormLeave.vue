<template>
  <v-row justify="center" class="ml-1 pa-9">
    <v-card
      class="pb-5 "
      elevation="6"
      max-width="450"
      
    >
      <v-card-title class="text-center" style="background-color: #04e">
        <span class="text-h5 text-white" >CREATE REQUEST</span>
      </v-card-title>
      <v-card-text>
        <v-container>
          <v-row>
            <v-col cols="12" sm="12" md="12">
            <label for="">Leave Type</label>
            <select
              v-model="type"
              class="input"
              placeholder="Leave Type"
            >
              <option 
                v-for:="item in ['Sick', 'Go to home town', 'family event', 'Other']" :value="item"
              >{{item}}</option>
            </select>
              <small v-if="type.length <= 0 && isValid" style="color: red">
                leave type cannot be empty!
              </small>
            </v-col>
            <v-col cols="12" sm="6">
              <label for="">Start Date</label>
              <input type="date" placeholder="Start from" class="input" :min="currentDate" v-model="startDate"/>
              <small v-if="startDate == 'invalidDate' && isValid" style="color: red">
                start date cannot be empty!
              </small>
            </v-col>
            <v-col cols="12" sm="6">
              <label for="">Time</label>
              <select
                v-model="timeStart"
                class="input"
              >
                <option 
                  v-for:="item in ['Afternoon', 'Morning']" :value="item"
                >{{item}}</option>
              </select>
              <small v-if="timeStart.length <= 0 && isValid" style="color: red">
                start time cannot be empty!
              </small>
            </v-col>
            <v-col cols="12" sm="6">
              <label for="">End Date</label>
              <input
                type="date"
                :min="currentDate"
                class="input"
                v-model="endDate"
              />
              <small v-if="endDate == 'invalidDate' && isValid" style="color: red">
                end date cannot be empty!
              </small>
            </v-col>
            <v-col cols="12" sm="6">
              <label for="">Time</label>
              <select
                v-model="timeEnd"
                class="input"
              >
                <option 
                  v-for:="item in ['Afternoon', 'Morning']" :value="item"
                >{{item}}</option>
              </select>
              <small v-if="timeEnd.length <= 0 && isValid" style="color: red">
                end time cannot be empty!
              </small>
            </v-col>
            <v-col cols="12" md="12" sm="12">
              <span>Duration: {{ duration }} <span v-if="duration<=1"> day</span> <span v-else> days</span></span
              >
            </v-col>
            <v-col cols="12" md="12" sm="12">
              <textarea class="input" placeholder="Reason" v-model="reason" required ></textarea>
              <small v-if="reason.length <= 0 && isValid" style="color: red">
                Reason cannot be empty!
              </small>
            </v-col>
          </v-row>
        </v-container>
      </v-card-text>
      <v-card-actions class="ml-6" style="margin-top: -35px;">
        <v-btn 
          :elevation="hover ? 24 : 6"
          style="background-color: #f04" 
          color="#fff" text
          @click="dialog=false"
        > Cancel </v-btn>
        <v-btn
          :elevation="hover ? 24 : 6"
          style="background-color: #04f"
          @click="createLeave"
          class="text-white btn"
        >Create</v-btn>
      </v-card-actions>
    </v-card>
  </v-row>
</template>
<script>
import moment from "moment";
import axios from '../axios-http'
export default {
  data: () => ({
    startDate: "invalidDate",
    endDate: "invalidDate",
    timeStart: "Morning",
    timeEnd: "Afternoon",
    type: "Sick",
    reason: "",
    successed: null,
    duration: 0,
    isValid: false,
    currentDate: "",
    dialog: false,
  }),
  emits: ["progress"],
  methods: {
    createLeave() {
      if (
        this.type != "" &&
        this.endDate != "invalidDate" &&
        this.timeStart != "" &&
        this.timeEnd != "" &&
        this.startDate != "invalidDate" && 
        this.reason != ""
      ) {
          let id = JSON.parse(localStorage.getItem('id'));
          let body = {user_id: id, leave_type: this.type, date_start: this.startDate, end_date: this.endDate, status: null, end_time: this.timeEnd, start_time: this.timeStart, reason: this.reason, duration: this.duration};
          this.sentMail();
          axios.post('requests', body)
          .then((response) => {
            console.log(response.data);
            return this.$router.push('/leave/'+localStorage.getItem('id'));
          })
          this.type = "";
          this.startDate = "invalidDate";
          this.endDate = "invalidDate";
          this.timeStart = "";
          this.timeEnd = "";
          this.reason = "";
          this.successed = true;
          this.isValid = false;
          this.dialog = false;
      } else {
        this.successed = false;
        this.isValid = true;
      }
    },
    calculateDuration(start, end) {
      if (start == "invalidDate" || end == "invalidDate") {
        this.duration = 0;
      } else {
        this.duration = Math.abs(
          moment(start, "YYYY.MM.DD").diff(moment(end, "YYYY.MM.DD"), "days")
        );
      }
    },
    getCurrentDate() {
      this.currentDate = new Date().toJSON().slice(0, 10).replace(/-/g, "-");
    },
    sentMail() {
      let body = {greeting: 'Request for leave', body: 'Dear teacher, I hope you are doing well. I am writting this email to let you know I want to ask premession to leave', actiontext: 'Go to System', actionurl: 'http://localhost:8080/', endtext: 'I looking forward to heaing from you.'};
      axios.get('students/'+localStorage.getItem('id'))
      .then((response) => {
        if (response.data.batch==2022) {
          axios.post('admin/email/1', body)
            .then((response=> {{
              console.log(response.data);
          }}))
        }else if (response.data.batch==2023) {
          axios.post('admin/email/2', body)
            .then((response=> {{
              console.log(response.data);
          }}))
        }
      })
    }
  },
  watch: {
    startDate() {
      this.calculateDuration(this.startDate, this.endDate);
    },
    endDate() {
      this.calculateDuration(this.startDate, this.endDate);
    },
  },
  mounted() {
    this.getCurrentDate();
  }
}
</script>

<style scoped>
  .container {
    border-top: 10px solid #04e;
    margin-top: 10px;
    border-radius: 10px;
    box-shadow: -5px -5px 9px #dde1e7, 5px 5px 9px rgba(94,104,121,0.3);
  }
  .input {
    width: 100%;
    padding: 10px;
    padding-left: 20px;
    border-radius: 5px;
    outline: none;
    box-shadow: inset 6px 6px 6px #d3d0d0, inset -6px -6px 6px rgb(217, 214, 214);
  }
  .btn:hover {
    transition: 0.2s;
    transform: translateY(-2px);
  }
</style>