import axios from '../axios';
import React, { useEffect, useState } from 'react'
import { useDispatch, useSelector } from 'react-redux';
import { setDoctor } from '../store/adminSlice';

export default function EditDoctor() {
   
    
    const [editDoctor, seteditDoctor] = useState({
        "name":"",
        "password":"",
        "department":"",
        "email":"",
    })
    const dispatch = useDispatch()

    let {doctor} = useSelector(state => state.admin)

    useEffect(() => {
   
      seteditDoctor(doctor)
    
    }, [doctor])
    
const newDoctor = function (e){
    e.preventDefault()
    axios.patch(`/admin/doctors/update/${doctor.id}`,editDoctor)
    .then(data => {
       
        dispatch(setDoctor(data.data.doctor))
        seteditDoctor({
            "name":"",
            "password":"",
            "department":"",
            "email":"",
        })

    }).catch(error => {

        window.alert(error.response.data.message)
    })
}

    const doctorData = function (e) {
        let newdoctor = { ...editDoctor }
        newdoctor[e.target.name] = e.target.value;
        seteditDoctor(newdoctor)
      
    }
    return (
        <>
            <div className="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false"  aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div className="modal-dialog">
                    <div className="modal-content">
                        <form action="signup" method="post" >
                            <div className="modal-header">
                                <h1 className="modal-title fs-5" id="staticBackdropLabel">edit Doctor</h1>
                                <button type="button" className="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div className="modal-body">
                                <div className="  ">

                                    <div className="form-group">
                                        <label htmlFor="name">Full Name</label>
                                        <input value={editDoctor.name} onChange={doctorData} type="text" className="form-control mt-2" name="name" placeholder="Enter your Name" />
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="email">Email address</label>
                                        <input value={editDoctor.email} onChange={doctorData} type="email" className="form-control mt-2" name="email" placeholder="Enter your Email" />
                                    </div>

                                    <div className="form-group">
                                        <label htmlFor="password">Password</label>
                                        <input value={editDoctor.password}  onChange={doctorData} type="password" className="form-control mt-2" name="password" placeholder="Enter Password" />
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="department">department</label>
                                        <input value={editDoctor.department} onChange={doctorData} type="" placeholder='department' className="form-control  mt-2" name="department"
                                        />
                                    </div>

                                </div>
                            </div>
                            <div className="modal-footer ">
                                <button type="button" className="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" onClick={newDoctor} className=" mt-2 btn btn-primary" data-bs-dismiss="modal">Create</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </>
    )
}

