import { configureStore } from '@reduxjs/toolkit'

import adminSlice from './store/adminSlice'

export const store = configureStore({
  reducer: {
    admin: adminSlice,
  },
})