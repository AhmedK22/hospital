import React, { useEffect, useState } from 'react'

import axios from '../axios'
import CreateDoctor from './CreateDoctor'
import { useDispatch, useSelector } from 'react-redux'
import EditDoctor from './EditDoctor'
import { setDoctor } from '../store/adminSlice'
import Cookies from 'js-cookie'




export default function AdminDoctor() {
    const [doctors, setdoctors] = useState([])
    let { doctor } = useSelector(state => state.admin)
    const [deletedId, setdeletedId] = useState("")
    const dispatch = useDispatch()

    const getAllDoctors = function () {
    
        axios.get(`/admin/doctors`)
            .then(data => {

                setdoctors(data.data.doctor)

            }).catch(error => {

                window.alert(error)
            })

    }
    useEffect(() => {
        getAllDoctors()
    }, [])

    useEffect(() => {

        getAllDoctors()

    }, [doctor])



    const showEditdModal = function (doctor) {
      
        dispatch(setDoctor(doctor))

    }

    const showDeletedModal = function (doctor) {
        setdeletedId(doctor.id)

    }
    const deleteDoctor = function () {
        axios.delete(`/admin/doctors/delete/${deletedId}`)
            .then(data => {
             
                getAllDoctors()
                window.location.href = '/admin/doctor';
            }).catch(error => {

                window.alert(error)
            })

    }

    const handleLogout = () => {
        Cookies.remove('token'); // Remove the 'token' cookie
        window.location.href = '/admin/doctor';

    };




    return (
        <>

            <div className="modal fade" id="deletedId" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div className="modal-dialog">
                    <div className="modal-content">
                        <div className="modal-header">
                            <h1 className="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                            <button type="button" className="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div className="modal-body">
                            do you sure you want to delete
                        </div>
                        <div className="modal-footer">
                            <button type="button" className="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" className="btn btn-primary" onClick={deleteDoctor} data-bs-dismiss="modal" >Delete</button>
                        </div>
                    </div>
                </div>
            </div>
            <CreateDoctor />
            <EditDoctor />

         
            <div className="d-flex">
                <div className="container pt-5 ">
                    <div className="createAppointment float-end">
                        <button type="submit" data-bs-toggle="modal" data-bs-target="#create" className="btn btn-primary m-5">Create Doctor</button>

                        <button className='btn btn-danger ' onClick={handleLogout}>
                            Logout
                        </button>
                    </div>
                    <div className="clearfix"></div>
                    <div className="container ">


                        <div className="tableAppointment">
                            <div className="row">
                                <div className="col-12">
                                    <table className="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Doctor Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {doctors.map((doctor, index) => {

                                                return (<tr key={index}>
                                                    <th scope="row">{doctor.name}</th>
                                                    <td>{doctor.email}</td>

                                                    <td>
                                                        <button type="button" className="btn btn-success me-2"><i
                                                            className="far fa-edit" data-bs-toggle="modal" data-bs-target="#edit" onClick={() => showEditdModal(doctor)}></i></button>

                                                        <button type="button" className="btn btn-danger"><i
                                                            className="far fa-trash-alt" data-bs-toggle="modal" data-bs-target="#deletedId" onClick={() => showDeletedModal(doctor)}></i></button>
                                                    </td>
                                                </tr>)
                                            })}

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </>
    )
}
