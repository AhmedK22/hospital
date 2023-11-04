import { createSlice } from '@reduxjs/toolkit'

const initialState = {
  doctor: {},
}

export const   adminSlice = createSlice({
  name: ' admin',
  initialState,
  reducers: {
    setDoctor: (state, action) => {
    
     console.log(action)
      state.doctor =action.payload
    },
  },
})

// Action creators are generated for each case reducer function
export const { setDoctor } =   adminSlice.actions

export default   adminSlice.reducer