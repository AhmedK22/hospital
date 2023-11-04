

import Cookies from 'js-cookie'
import React from 'react'
import { Navigate, Outlet } from 'react-router-dom'

export default function PrivateRoutes () {
 
    let token= Cookies.get('token')
   
    return(
        token != null ? <Outlet/> : <Navigate to="/admin/login"/>
    )
  
}
