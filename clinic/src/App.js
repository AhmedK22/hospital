import logo from './logo.svg';
import './App.css';
import { Navigate, Route, Routes } from 'react-router-dom';
import Home from './Home';
import AdminDoctor from './admin/AdminDoctor';
import AdminLogin from './admin/AdminLogin';
import Cookies from 'js-cookie';
import { useEffect, useState } from 'react';
import PrivateRoutes from './utils/PrivateRoutes ';

// import Home from './Home';

// import {Routes,Route} from'react-router-dom'
// import Navbar from './Navbar';
// import MovieDetails from './MovieDetails';
// import Register from './Register';
// import { Login } from './Login';
// import { useNavigate ,Navigate} from 'react-router-dom';

// import React,{useState,useEffect} from 'react'


function App(props) {

  //   let navigate=useNavigate()
  const [userData, setUserData] = useState(null)

  function getUserData() {
    let token = Cookies.get('token');
    setUserData(token)

  }


  return (

    <Routes>
        <Route path="/" element={<Home userData={userData} />} />
      <Route element={<PrivateRoutes />}>
        <Route path="admin/doctor" element={<><AdminDoctor /></>} />
    </Route>
        <Route path="admin/login" element={<AdminLogin userData={userData} />} />
    </Routes>




  );
}

export default App;
