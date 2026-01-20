import { Routes, Route } from "react-router-dom"
import Landing from "./pages/Landing"
import Login from "./pages/Login"
import Register from "./pages/Register"
import Dashboard from "./pages/Dashboard"
import Cerita from "./pages/Cerita"
import Chat from "./pages/Chat"
import Healing from "./pages/Healing"
import Education from "./pages/Education"

export default function App() {
  return (
    <Routes>
      {/* PUBLIC */}
      <Route path="/" element={<Landing />} />
      <Route path="/login" element={<Login />} />
      <Route path="/register" element={<Register />} />

      {/* DASHBOARD SYSTEM */}
      <Route path="/dashboard" element={<Dashboard />} />
      <Route path="/story" element={<Cerita />} />
      <Route path="/chat" element={<Chat />} />
      <Route path="/healing" element={<Healing />} />
      <Route path="/education" element={<Education />} />
    </Routes>
  )
}
