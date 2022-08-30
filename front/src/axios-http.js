import axios from "axios";

export default axios.create({
  baseURL: process.env.VUE_APP_API_URL,
  
  headers: {
    Authorization: 'Bearer ' + localStorage.getItem('Authorization'),
    "Content-type": "application/json",
  }
});