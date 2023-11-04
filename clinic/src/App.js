import logo from './logo.svg';
import './App.css';
import {  Route, Routes } from 'react-router-dom';

import AdminDoctor from './admin/AdminDoctor';
import AdminLogin from './admin/AdminLogin';

import PrivateRoutes from './utils/PrivateRoutes ';

function App(props) {



  return (

    <Routes>
        <Route path="/" element={<AdminLogin  />} />
      <Route element={<PrivateRoutes />}>
        <Route path="admin/doctor" element={<><AdminDoctor /></>} />
    </Route>
        <Route path="admin/login" element={<AdminLogin  />} />
    </Routes>




  );
}

export default App;
