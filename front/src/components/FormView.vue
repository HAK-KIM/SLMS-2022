<template>
  <v-card
    class="pa-6"
    style="
      width: 500px;
      box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px,
        rgba(0, 0, 0, 0.23) 0px 3px 6px;
      border-top: 5px solid #04e;
      border-radius: 10px;
    "
  >
    <v-alert
      v-if="successed == true"
      type="success"
      variant="tonal"
      class="mx-auto mt-3"
      border="start"
    >
      Request leave createed successfully!
    </v-alert>
    <v-alert
      v-if="successed == false"
      type="error"
      variant="tonal"
      class="mx-auto mt-3"
      border="start"
    >
      You need to fill all input!
    </v-alert>
    <v-card-title class="text-center">
      <span class="text-h4">Create Request</span>
    </v-card-title>
    <v-card-text>
      <v-container>
        <v-row>
          <v-col cols="12" sm="12" md="12">
            <v-select
              :items="['Sick', 'Go to home town', 'family event']"
              label="Leaves Type"
              v-model="type"
            ></v-select>
          </v-col>
          <v-col cols="12" sm="6">
            <label for="">Start Date</label>
            <input
              type="date"
              placeholder="Start from"
              class="date"
              v-model="startDate"
            />
          </v-col>
          <v-col cols="12" sm="6">
            <label for="">Time</label>
            <v-select
              v-model="timeStart"
              :items="['Afternoon', 'Morning']"
            ></v-select>
          </v-col>
          <v-col cols="12" sm="6">
            <label for="">End Date</label>
            <input
              type="date"
              placeholder="Start from"
              class="date"
              v-model="endDate"
            />
          </v-col>
          <v-col cols="12" sm="6">
            <label for="">Time</label>
            <v-select
              v-model="timeEnd"
              :items="['Afternoon', 'Morning']"
            ></v-select>
          </v-col>
          <v-col cols="12" md="12" sm="12">
            <span for=""
              >Duration: <span>{{ duration }} day/days</span></span
            >
          </v-col>
          <v-col cols="12" md="12" sm="12">
            <v-textarea label="Reason" v-model="reason"></v-textarea>
          </v-col>
        </v-row>
      </v-container>
    </v-card-text>
    <v-card-actions class="ml-6">
      <v-btn style="background-color: #f04" color="#fff" text> Cancel </v-btn>
      <v-btn
        style="background-color: #04f"
        color="#fff"
        text
        @click="createLeave"
      >
        Request
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>

import moment from "moment";
export default {
  data: () => ({
    startDate: Date,
    endDate: Date,
    timeStart: "",
    timeEnd: "",
    type: "",
    reason: "",
    successed: null,
    duration: 0,
  }),
  emits: ["leave"],
  methods: {
    createLeave() {
      if (
        this.type != "" &&
        this.endDate != "" &&
        this.timeStart != "" &&
        this.timeEnd != "" &&
        (this.startDate != "") & (this.reason != "")
      ) {
        this.$emit("leave", {
          leave_type: this.type,
          date_start: this.startDate,
          end_date: this.endDate,
          status: null,
          end_time: this.timeEnd,
          start_time: this.timeStart,
          reason: this.reason,
        });
        this.type = "";
        this.startDate = "";
        this.endDate = "";
        this.timeStart = "";
        this.endDate = "";
        this.reason = "";
        this.successed = true;
      } else {
        this.successed = false;
      }
      this.calculateDuration(this.startDate,this.endDate)
    },
    calculateDuration(start,end) {
      this.duration = Math.abs(
        moment(start, "YYYY.MM.DD").diff(moment(end, "YYYY.MM.DD"),"days")
      );
    },
  },
};


</script>

<style scoped>
.date {
  width: 100%;
  outline: none;
  padding: 16px;
  background-color: #eee;
  border-bottom: 1px solid #999;
  font-size: 16px;
  color: #000;
  border-radius: 3px 3px 0 0;
  font-weight: 300;
}
</style>