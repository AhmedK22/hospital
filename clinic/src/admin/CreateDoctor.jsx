import axios from '../axios';
import React, { useEffect, useState } from 'react'
import { useDispatch, useSelector } from 'react-redux';
import { setDoctor } from '../store/adminSlice';

export default function CreateDoctor() {

    
    const [createDoctor, setcreateDoctor] = useState({
        "name":"",
        "password":"",
        "department":"",
        "email":"",
    })
    const dispatch = useDispatch()

    let doctor = useSelector(state => state.admin)

    useEffect(() => {
    //   console.log(doctor)
    
    
    }, [])
    
const newDoctor = function (e){
    e.preventDefault()
    axios.post(`/admin/doctors`,createDoctor)
    .then(data => {
        // console.log(data)
        dispatch(setDoctor(data.data.doctor))
        setcreateDoctor({
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
        let newdoctor = { ...createDoctor }
        newdoctor[e.target.name] = e.target.value;
        setcreateDoctor(newdoctor)
       
    }
    return (
        <>
            <div className="modal fade" id="create" data-bs-backdrop="static" data-bs-keyboard="false"  aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div className="modal-dialog">
                    <div className="modal-content">
                        <form action="signup" method="post" >
                            <div className="modal-header">
                                <h1 className="modal-title fs-5" id="staticBackdropLabel">Create Doctor</h1>
                                <button type="button" className="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div className="modal-body">
                                <div className="  ">

                                    <div className="form-group">
                                        <label htmlFor="name">Full Name</label>
                                        <input value={createDoctor.name} onChange={doctorData} type="text" className="form-control mt-2" name="name" placeholder="Enter your Name" />
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="email">Email address</label>
                                        <input value={createDoctor.email} onChange={doctorData} type="email" className="form-control mt-2" name="email" placeholder="Enter your Email" />
                                    </div>

                                    <div className="form-group">
                                        <label htmlFor="password">Password</label>
                                        <input value={createDoctor.password}  onChange={doctorData} type="password" className="form-control mt-2" name="password" placeholder="Enter Password" />
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="department">department</label>
                                        <input value={createDoctor.department} onChange={doctorData} type="" placeholder='department' className="form-control  mt-2" name="department"
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

