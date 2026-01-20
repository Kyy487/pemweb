import { useState } from "react"
import Layout from "../components/Layout"

const motivationalQuotes = [
  "Kamu tidak rusak. Kamu hanya sedang lelah.",
  "Setiap hari adalah kesempatan baru untuk pulih.",
  "Kekuatan sejatimu datang dari bagaimana kamu bangkit.",
  "Kamu pantas mendapatkan kebahagiaan dan kedamaian.",
  "Trauma itu nyata, tapi kamu lebih kuat.",
]

export default function Dashboard() {
  const [quote] = useState(motivationalQuotes[Math.floor(Math.random() * motivationalQuotes.length)])

  return (
    <Layout>
      <div className="p-10 space-y-8 max-w-7xl mx-auto">
        {/* HEADER */}
        <div className="mb-10">
          <h1 className="text-4xl font-bold text-slate-800 mb-2">
            Selamat datang kembali 🌿
          </h1>
          <p className="text-slate-500 text-lg">
            Kamu aman di sini. Tidak ada yang menghakimi, tidak ada yang menilai.
          </p>
        </div>

        {/* QUOTE CARD */}
        <div className="bg-gradient-to-r from-purple-500 via-pink-500 to-blue-500 rounded-3xl p-8 text-white shadow-2xl transform hover:scale-105 transition duration-300 relative overflow-hidden">
          <div className="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
          <div className="relative z-10 text-center">
            <p className="text-3xl font-bold leading-relaxed mb-4">
              "{quote}"
            </p>
            <p className="text-purple-100 text-sm font-medium">💫 Kutipan Inspirasi Hari Ini</p>
          </div>
        </div>

        {/* STATS */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          <StatCard title="Cerita Disimpan" value="0" icon="✍" color="from-blue-400 to-blue-600" />
          <StatCard title="Sesi Curhat" value="0" icon="💬" color="from-green-400 to-green-600" />
          <StatCard title="Hari Healing" value="0" icon="🌱" color="from-purple-400 to-purple-600" />
          <StatCard title="Artikel Dibaca" value="0" icon="📖" color="from-orange-400 to-orange-600" />
        </div>

        {/* QUICK ACTIONS */}
        <div>
          <h2 className="text-2xl font-bold text-slate-800 mb-6">Mulai Sekarang 🚀</h2>
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
            <QuickActionButton icon="✍" title="Tulis Cerita" href="/story" />
            <QuickActionButton icon="💬" title="Curhat" href="/chat" />
            <QuickActionButton icon="🌱" title="Pulih" href="/healing" />
            <QuickActionButton icon="📖" title="Edukasi" href="/education" />
            <QuickActionButton icon="🤝" title="Konsultasi" href="/chat" />
          </div>
        </div>

        {/* RESOURCES SECTION */}
        <div className="bg-white rounded-2xl shadow-xl p-8 border-l-4 border-blue-500">
          <h2 className="text-2xl font-bold text-slate-800 mb-6">Sumber Daya Kesehatan Mental 💙</h2>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
            <ResourceCard 
              title="🛡️ Pulih dari Bullying"
              tips={[
                "Jangan menyalahkan diri sendiri",
                "Berbicara dengan orang terpercaya",
                "Tulis perasaanmu di jurnal",
                "Jaga kesehatan fisik Anda"
              ]}
            />
            <ResourceCard 
              title="👨‍👩‍👧 Pulih dari Trauma Keluarga"
              tips={[
                "Validasi perasaan Anda sendiri",
                "Pahami batasan yang sehat",
                "Cari dukungan sosial yang positif",
                "Fokus pada pertumbuhan diri"
              ]}
            />
          </div>
        </div>

        {/* TIPS SECTION */}
        <div className="bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl p-8 border-2 border-blue-200">
          <h2 className="text-2xl font-bold text-blue-900 mb-6">✨ Tips Harian untuk Kesehatan Mental</h2>
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <TipItem emoji="😴" title="Tidur Cukup" desc="7-9 jam per malam" />
            <TipItem emoji="💧" title="Minum Air" desc="8 gelas air per hari" />
            <TipItem emoji="🏃" title="Bergerak" desc="30 menit aktivitas fisik" />
            <TipItem emoji="🧘" title="Meditasi" desc="5-10 menit mindfulness" />
            <TipItem emoji="📱" title="Istirahat Digital" desc="Kurangi media sosial" />
            <TipItem emoji="🎵" title="Musik" desc="Dengarkan lagu favorit" />
          </div>
        </div>

        {/* WARNING SIGNS */}
        <div className="bg-red-50 rounded-2xl p-8 border-2 border-red-200">
          <h2 className="text-2xl font-bold text-red-900 mb-6">⚠️ Tanda-tanda yang Perlu Perhatian</h2>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
            <WarningItem 
              title="Saat Perlu Bantuan Profesional"
              signs={[
                "Perasaan sedih berlangsung > 2 minggu",
                "Sulit tidur atau tidur terlalu banyak",
                "Kehilangan minat pada hal yang disukai",
                "Pikiran untuk menyakiti diri sendiri"
              ]}
            />
            <WarningItem 
              title="Apa yang Harus Dilakukan"
              signs={[
                "📞 Hubungi psikolog atau konselor",
                "🤝 Ceritakan pada orang terpercaya",
                "🏥 Kunjungi fasilitas kesehatan mental",
                "🆘 Hubungi hotline jika krisis (119)"
              ]}
            />
          </div>
        </div>
      </div>
    </Layout>
  )
}

function StatCard({ title, value, icon, color }) {
  return (
    <div className={`bg-gradient-to-br ${color} rounded-2xl p-6 text-white shadow-xl hover:shadow-2xl transform hover:scale-105 transition duration-300`}>
      <div className="text-4xl mb-3">{icon}</div>
      <div className="text-4xl font-bold mb-2">{value}</div>
      <h3 className="font-semibold text-lg">{title}</h3>
    </div>
  )
}

function QuickActionButton({ icon, title, href }) {
  return (
    <a
      href={href}
      className="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transform hover:scale-105 transition duration-300 text-center border-2 border-transparent hover:border-blue-400 cursor-pointer block"
    >
      <div className="text-3xl mb-2">{icon}</div>
      <h3 className="font-bold text-slate-800 text-sm">{title}</h3>
    </a>
  )
}

function ResourceCard({ title, tips }) {
  return (
    <div className="bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl p-6 border-2 border-slate-200 hover:shadow-lg transition">
      <h3 className="font-bold text-slate-800 mb-4 text-lg">{title}</h3>
      <ul className="space-y-3">
        {tips.map((tip, idx) => (
          <li key={idx} className="text-slate-700 flex items-start gap-3">
            <span className="flex-shrink-0 text-xl">✓</span>
            <span>{tip}</span>
          </li>
        ))}
      </ul>
    </div>
  )
}

function TipItem({ emoji, title, desc }) {
  return (
    <div className="bg-white rounded-lg p-4 shadow-md hover:shadow-lg transition text-center border-l-4 border-blue-500 hover:border-purple-500">
      <div className="text-3xl mb-2">{emoji}</div>
      <h4 className="font-bold text-slate-800">{title}</h4>
      <p className="text-sm text-slate-500">{desc}</p>
    </div>
  )
}

function WarningItem({ title, signs }) {
  return (
    <div className="bg-white rounded-lg p-6 border-2 border-red-200">
      <h4 className="font-bold text-red-900 mb-4">{title}</h4>
      <ul className="space-y-2">
        {signs.map((sign, idx) => (
          <li key={idx} className="text-slate-700 flex items-center gap-2">
            <span className="text-red-500">•</span>
            {sign}
          </li>
        ))}
      </ul>
    </div>
  )
}

