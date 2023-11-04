import React from 'react'

export default function Navbar() {
  return (
    <>
     <nav className="navbar navbar-expand-lg navbar-light ">
        <div className="container-fluid">
            <h2>ONNMED</h2>
            <div className="collapse navbar-collapse" id="navbarSupportedContent">
                <ul className="navbar-nav ms-auto mt-2 mt-lg-0">
                    <li className="nav-item active me-2"><button type="submit" className="btn btn-primary"
                            >Register</button></li>
                    <li className="nav-item active "><button type="submit" className="btn btn-primary">Login</button></li>
                </ul>
            </div>
           
        </div>
    </nav>
    </>
  )
}
