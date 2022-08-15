<template>
  <section id="form">
    <form @submit.prevent="getData">
      <label for="leaveType">Leaves type</label>
      <div class="leaveType">
        <select name="" id="leaveType" v-model="leaveType">
          <option value="sick leave">Sick leave</option>
          <option value="family event">Family event</option>
          <option value="other">Other</option>
        </select>
      </div>
      <!-- @start date -->
      <label for="date">Start date</label>
      <div class="startDate">
        <input type="date" placeholder="Start from" v-model="startDate"/>
        <select name="" id="" v-model="startTime">
          <option value="morning">Morning</option>
          <option value="afternoon">Afternoon</option>
        </select>
      </div>
      <!-- @end date; -->
      <label for="date">End date</label>
      <div class="endDate">
        <input type="date" placeholder="Until" v-model="endDate"/>
        <select name="" id="" v-model="endTime">
          <option value="morning" >Morning</option>
          <option value="afternoon">Afternoon</option>
        </select>
      </div>
      <!-- @reasons -->
      <label for="">Reasons</label>
      <div class="textarea" >
        <textarea
          name=""
          id=""
          cols="30"
          rows="10"
          placeholder="What is your reasons?"
          v-model="reason"
        ></textarea>
      </div>
      <div class="btn">
        <button type="submit">Submit</button>
      </div>
    </form>
  </section>
</template>

<script>
export default {
  data() {
    return {
      leaveType: "sick leave",
      startDate: "",
      startTime: "morning",
      endDate: "",
      endTime: "morning",
      reason: "",
      datas: [],
    };
  },
  methods: {
    getData() {
      this.datas.push({
        leaveType: this.leaveType,
        startDate: this.startDate,
        startTime: this.startTime,
        endDate: this.endDate,
        endTime: this.endTime,
        reason: this.reason,
      });
        console.log(this.datas);
      this.leaveType=''
      this.startDate=''
      this.startTime=''
      this.endDate=''
      this.endTime=''
      this.reason=''
    
    },
  },
};
</script>

<style scoped>
#form {
  border-top: 10px solid blue;
  border-radius: 5%;
  padding: 2%;
  width: 30%;
  margin: auto;
  box-shadow: 3px 5px 10px;
}
form {
  width: 100%;
  margin: auto;
  justify-content: center;
}
label {
  display: flex;
}
input,
select {
  width: 50%;
  padding: 1%;
}
textarea,
#leaveType {
  width: 100%;
}
.leaveType,
.startDate,
.endDate,
.textarea {
  display: flex;
  margin-bottom: 2%;
}
button {
  color: white;
  background: blue;
  padding: 2%;
  border: none;
  border-radius: 10px;
  width: 20%;
  margin: auto;
}

</style>