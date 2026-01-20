import { Link } from "react-router-dom"

export default function Register() {
  return (
    <div className="min-h-screen bg-gradient-to-b from-sky-500 via-blue-600 to-indigo-700 flex items-center justify-center text-white">

      <div className="bg-white/15 backdrop-blur-2xl border border-white/30 rounded-3xl shadow-2xl w-full max-w-md p-10 animate-[fadeUp_1s_ease-out]">

        <h2 className="text-3xl font-bold text-center mb-2">
          Buat Akun Baru
        </h2>
        <p className="text-center text-blue-100 mb-8">
          Daftar untuk masuk ke ruang aman Web Bully
        </p>

        <form className="space-y-6">

          <div>
            <label className="block mb-2 text-sm">Nama Lengkap</label>
            <input
              type="text"
              placeholder="Nama kamu"
              className="w-full px-4 py-3 rounded-xl bg-white/20 border border-white/30 text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-white/50"
            />
          </div>

          <div>
            <label className="block mb-2 text-sm">Email</label>
            <input
              type="email"
              placeholder="you@example.com"
              className="w-full px-4 py-3 rounded-xl bg-white/20 border border-white/30 text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-white/50"
            />
          </div>

          <div>
            <label className="block mb-2 text-sm">Password</label>
            <input
              type="password"
              placeholder="••••••••"
              className="w-full px-4 py-3 rounded-xl bg-white/20 border border-white/30 text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-white/50"
            />
          </div>

          <button
            type="submit"
            className="w-full bg-white text-blue-600 py-3 rounded-xl font-semibold shadow-lg hover:scale-105 transition"
          >
            Daftar
          </button>
        </form>

        <div className="text-center mt-6 text-sm text-blue-100 space-y-2">
  <div>
    Sudah punya akun?{" "}
    <Link to="/login" className="text-white font-semibold hover:underline">
      Masuk di sini
    </Link>
  </div>

  <div>
    <Link
      to="/"
      className="inline-flex items-center gap-1 text-blue-200 hover:text-white transition"
    >
      ← Kembali ke Landing Page
    </Link>
  </div>
</div>


      </div>
    </div>
  )
}
