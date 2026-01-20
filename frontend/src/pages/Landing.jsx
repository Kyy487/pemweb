import { Link } from "react-router-dom"

export default function Landing() {
  return (
    <div className="min-h-screen bg-gradient-to-b from-sky-500 via-blue-600 to-indigo-700 text-white overflow-x-hidden scroll-smooth">

      {/* NAVBAR */}
      <nav className="fixed top-0 left-0 w-full z-50 bg-white/10 backdrop-blur-xl shadow-md animate-[slideDown_0.8s_ease-out]">
        <div className="flex items-center justify-between px-12 py-4">
          <h1 className="text-2xl font-bold">Ruang Cerita</h1>

          <div className="hidden md:flex space-x-8 text-blue-100 font-medium">
            <a href="#features" className="hover:text-white transition">Features</a>
            <a href="#team" className="hover:text-white transition">Team</a>
            <a href="#help" className="hover:text-white transition">Help</a>
          </div>

          <div className="space-x-4">
            <Link to="/login" className="hover:text-blue-200 transition">Login</Link>
            <Link
              to="/dashboard"
              className="bg-white text-blue-600 px-5 py-2 rounded-lg font-semibold shadow hover:scale-105 transition"
            >
              Dashboard
            </Link>
          </div>
        </div>
      </nav>

      {/* HERO */}
      <section className="min-h-screen grid md:grid-cols-2 gap-16 px-12 pt-40 items-center">

        {/* LEFT */}
        <div className="space-y-8 animate-[fadeLeft_1s_ease-out]">
          <h2 className="text-5xl xl:text-6xl font-extrabold leading-tight">
            Kamu Berharga. <br />
            <span className="text-sky-200">Kami Hadir Untuk Melindungimu.</span>
          </h2>

          <p className="text-lg text-blue-100 max-w-xl">
            Ruang Cerita adalah platform perlindungan digital untuk korban perundungan.
            Kami membangun ruang aman yang profesional, rahasia, dan manusiawi.
          </p>

          <div className="flex space-x-4">
            <Link
              to="/login"
              className="bg-white text-blue-600 px-7 py-3 rounded-xl font-semibold shadow-lg hover:scale-110 hover:shadow-xl transition-all duration-300"
            >
              Masuk Sekarang
            </Link>

            <Link
              to="/dashboard"
              className="border border-white px-7 py-3 rounded-xl font-semibold hover:bg-white hover:text-blue-600 transition"
            >
              Lihat Dashboard
            </Link>
          </div>

          <div className="flex space-x-12 pt-6">
            {[
              ["100%", "Aman & Rahasia"],
              ["24/7", "Support"],
              ["Komunitas", "Positif"]
            ].map(([num, label]) => (
              <div key={label} className="animate-[fadeUp_1s_ease-out]">
                <h3 className="text-3xl font-bold">{num}</h3>
                <p className="text-blue-200">{label}</p>
              </div>
            ))}
          </div>
        </div>

        {/* RIGHT GLASS PANEL */}
        <div className="bg-white/15 backdrop-blur-2xl border border-white/30 rounded-3xl p-12 shadow-2xl space-y-8 animate-[fadeRight_1.2s_ease-out] hover:-translate-y-2 transition">

          <h3 className="text-2xl font-bold text-center">
            Kenapa Memilih Ruang Cerita?
          </h3>

          <div className="space-y-6 text-white/90">
            {[
              "🛡️ Privasi dan kerahasiaan pengguna dijamin penuh.",
              "💬 Ruang aman berbicara tanpa takut disalahkan.",
              "⚡ Sistem pelaporan cepat dan profesional.",
              "📚 Edukasi pencegahan bullying berbasis teknologi."
            ].map((text, i) => (
              <div
                key={i}
                className="flex space-x-4 animate-[fadeUp_1s_ease-out] hover:translate-x-2 transition"
              >
                <span className="text-2xl">{text.split(" ")[0]}</span>
                <p>{text.substring(3)}</p>
              </div>
            ))}
          </div>

          <p className="text-center text-sm text-white/70 italic pt-4">
            Bersama, kita bangun internet yang lebih aman 🌱
          </p>
        </div>
      </section>

      {/* FEATURES */}
      <section id="features" className="py-32 px-12 bg-white/5">
        <h2 className="text-4xl font-bold text-center mb-16 animate-[fadeUp_1s_ease-out]">
          Fitur Unggulan
        </h2>

        <div className="grid md:grid-cols-3 gap-10 max-w-6xl mx-auto">
          {[
            ["🔒", "Keamanan Data", "Seluruh laporan dienkripsi end-to-end."],
            ["🤝", "Pendampingan", "Korban mendapat dukungan komunitas positif."],
            ["📊", "Analitik Kasus", "Pantau tren bullying secara real-time."]
          ].map(([icon, title, desc]) => (
            <div
              key={title}
              className="bg-white/10 backdrop-blur-lg p-8 rounded-2xl text-center hover:-translate-y-3 transition animate-[fadeUp_1s_ease-out]"
            >
              <div className="text-4xl mb-4">{icon}</div>
              <h3 className="text-xl font-semibold mb-2">{title}</h3>
              <p className="text-blue-100">{desc}</p>
            </div>
          ))}
        </div>
      </section>

      {/* TEAM */}
<section id="team" className="py-32 px-6 md:px-20 w-full">
  <h2 className="text-4xl font-bold text-center mb-16 animate-[fadeUp_1s_ease-out]">
    Tim Kami
  </h2>

  {/*
    EDIT DATA TIM DI SINI SAJA
  */}
  {(() => {
    const teamMembers = [
      {
        name: "Nama 1",
        role: "Founder",
        photo: "/team/person1.jpg",
      },
      {
        name: "Nama 2",
        role: "Co-Founder",
        photo: "/team/person2.jpg",
      },
      {
        name: "Nama 3",
        role: "Developer",
        photo: "/team/person3.jpg",
      },
      {
        name: "Nama 4",
        role: "Designer",
        photo: "/team/person4.jpg",
      },
      {
        name: "Nama 5",
        role: "Psychologist",
        photo: "/team/person5.jpg",
      },
    ]

    return (
      <div className="grid grid-cols-2 md:grid-cols-5 gap-10 w-full">
        {teamMembers.map((member) => (
          <div
            key={member.name}
            className="bg-white/10 backdrop-blur-lg p-6 rounded-2xl text-center hover:scale-105 hover:shadow-2xl hover:shadow-blue-400/30 transition animate-[fadeUp_1s_ease-out]"
          >
            <div className="w-28 h-28 mx-auto mb-4 rounded-full overflow-hidden border-4 border-white/30 shadow-lg">
              <img
                src={member.photo}
                alt={member.name}
                className="w-full h-full object-cover"
              />
            </div>

            <h3 className="text-lg font-semibold">{member.name}</h3>
            <p className="text-blue-200">{member.role}</p>
          </div>
        ))}
      </div>
    )
  })()}
</section>


      {/* HELP */}
      <section id="help" className="py-32 px-12 bg-white/5 text-center">
        <h2 className="text-4xl font-bold mb-6 animate-[fadeUp_1s_ease-out]">
          Butuh Bantuan?
        </h2>

        <p className="text-blue-100 mb-10 max-w-2xl mx-auto animate-[fadeUp_1s_ease-out]">
          Tim kami siap membantu korban perundungan kapan saja secara aman dan profesional.
        </p>

        <Link
          to="/login"
          className="bg-white text-blue-600 px-10 py-4 rounded-xl font-semibold shadow-lg hover:scale-110 transition animate-[fadeUp_1s_ease-out]"
        >
          Hubungi Kami Sekarang
        </Link>
      </section>

    </div>
  )
}
