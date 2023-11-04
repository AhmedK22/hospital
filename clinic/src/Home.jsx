import React, { useEffect, useState } from 'react'
import Navbar from './Navbar'
import {axios} from './axios'


export default function Home(props) {

  const [appointment, setappointment] = useState({})
  function appointmentData(e){
      let newAppointment={...appointment}
      newAppointment[e.target.name]=e.target.value;
      setappointment(newAppointment)
      console.log(newAppointment)
  }
  const createAppointment = async (e)=> {
    e.preventDefault()
  //   let data = await axios.get(`http://127.0.0.1:8000/api/guest/appointments`)
  console.log('jhgh')

  }


  
  return (
    <>
      <Navbar userData ={this.props.userData} />

      <div className="container">

        <form action="book" method="post" className=''>
          <div className="form-group">
            <label for="date">Date</label>
            <input type="date" className="form-control mt-2" name="date" placeholder="dd-mm-yyyy" value=""
              min="1997-01-01" max="2030-12-31" />
          </div>
          <div className="form-group">
            <label for="email">Email address</label>
            <input type="email" className="form-control mt-2" name="email" placeholder="Enter email" />
          </div> <br />
          <button onClick={createAppointment} type="submit" className="btn btn-primary">Book</button>
        </form>
      </div>

    </>
  )
}
