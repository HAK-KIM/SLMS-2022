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
              required
              v-model="type"
            ></v-select>
            <p v-if="type.length <= 0 && isValid" style="color: red">
              !Select leave type🙏
            </p>
          </v-col>
          <v-col cols="12" sm="6">
            <label for="">Start Date</label>

            <input
              type="date"
              class="date"
              :min="currentDate"
              v-model="startDate"
            />
            <p v-if="startDate == 'invalidDate' && isValid" style="color: red">
              !Start date is require☺
            </p>
          </v-col>
          <v-col cols="12" sm="6">
            <label for="">Time</label>
            <v-select
              v-model="timeStart"
              :items="['Afternoon', 'Morning']"
            ></v-select>
            <p v-if="timeStart.length <= 0 && isValid" style="color: red">
              !Detail time🙏
            </p>
          </v-col>
          <v-col cols="12" sm="6">
            <label for="">End Date</label>
            <input
              type="date"
              :min="currentDate"
              class="date"
              v-model="endDate"
            />
            <p v-if="endDate == 'invalidDate' && isValid" style="color: red">
              !End date is require☺
            </p>
          </v-col>
          <v-col cols="12" sm="6">
            <label for="">Time</label>
            <v-select
              v-model="timeEnd"
              :items="['Afternoon', 'Morning']"
            ></v-select>
            <p v-if="timeEnd.length <= 0 && isValid" style="color: red">
              !Detail time🙏
            </p>
          </v-col>
          <v-col cols="12" md="12" sm="12">
            <span for=""
              >Duration: <span>{{ duration }} day/days</span></span
            >
          </v-col>
          <v-col cols="12" md="12" sm="12">
            <v-textarea label="Reason" v-model="reason" required></v-textarea>
            <p v-if="reason.length <= 0 && isValid" style="color: red">
              !Reason is require☺
            </p>
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
    startDate: "invalidDate",
    endDate: "invalidDate",
    timeStart: "",
    timeEnd: "",
    type: "",
    reason: "",
    successed: null,
    duration: 0,
    isValid: false,
    currentDate: "",
  }),
  emits: ["leave"],
  methods: {
    createLeave() {
      if (
        this.type != "" &&
        this.endDate != "invalidDate" &&
        this.timeStart != "" &&
        this.timeEnd != "" &&
        (this.startDate != "invalidDate") & (this.reason != "")
      ) {
        this.$emit("leave", {
          leave_type: this.type,
          date_start: this.startDate,
          end_date: this.endDate,
          status: null,
          end_time: this.timeEnd,
          start_time: this.timeStart,
          reason: this.reason,
          duration: this.duration,
        });

        this.type = "";
        this.startDate = "invalidDate";
        this.endDate = "invalidDate";
        this.timeStart = "";
        (this.timeEnd = ""), (this.reason = "");
        this.successed = true;
        this.isValid = false;
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