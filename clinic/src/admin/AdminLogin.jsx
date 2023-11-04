import axios from '../axios';
import React, { useState } from 'react'
import { useNavigate } from 'react-router-dom';
import Cookies from 'js-cookie';
import ReCAPTCHA from "react-google-recaptcha";

export default function AdminLogin(props) {

  const navigate = useNavigate();
const [captch, setcaptch] = useState('')

  const [admin, setadmin] = useState({})




  function adminData(e) {
    let newAdmin = { ...admin }

    newAdmin[e.target.name] = e.target.value;
    setadmin(newAdmin)
    
  }
  const login = (e) => {
    e.preventDefault()

    if(captch !== '') {

      axios.post(`/admin/login`, admin)
        .then(data => {
  
          Cookies.set('token', data.data.token)
  
        
          navigate('/admin/doctor')
        }).catch(error => {
          
          window.alert(error.response.data.message)
        })
    }
    else{
      window.alert("I'm not robot")
    }

  }

  function onChange(value) {
    setcaptch(value)
   
  }



  return (
    <>
      <div className="container col-md-4 offset-md-4 pt-5">
        <h5 className="text-center">SignIn</h5>

        <form action="login" method="post" >
          <div className="form-group">
            <label for="email">Email address</label>
            <input onChange={adminData} type="email" className="form-control mt-2" name="email" placeholder="Enter email" />
          </div>
          <br />
          <div className="form-group">
            <label for="password">Password</label>
            <input onChange={adminData} type="password" className="form-control mt-2" name="password" placeholder="Enter Password" />
          </div>
          <br />

          <ReCAPTCHA
            sitekey="6LdHgvUoAAAAAMeavuI5Q9XkHgD6fSnNIvkUtOU2"
            onChange={onChange}
          />,
          <button onClick={login} type="submit" className="btn btn-primary mt-2">Login</button>
        </form>

      </div>
    </>
  )
}
