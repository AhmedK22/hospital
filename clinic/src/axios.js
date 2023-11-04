// axios
import axios from 'axios'
import Cookies from 'js-cookie';
// require('dotenv').config();

// const domain = document.documentElement.getAttribute('data-base-url')

let token = Cookies.get("token")

let axiosInstance =  axios.create({
  baseURL: 'http://127.0.0.1:8000/api',
  headers: {
    'content-type': 'application/json',
    'accept'      : 'application/json',
    'Access-Control-Allow-Origin' : "*",
    'Authorization': `Bearer ${token}`,
  }
})

axiosInstance.interceptors.request.use(
    (config) => {
      const tokenn =  Cookies.get("token")
      const auth = tokenn ? `Bearer ${ Cookies.get("token")}` : '';
      config.headers['Authorization'] = auth;
      return config;
    },
    (error) => Promise.reject(error),
);

export default axiosInstance;
