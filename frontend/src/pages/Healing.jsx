import { useState } from "react"
import Layout from "../components/Layout"

const healingCategories = {
  bullying: {
    title: "🛡️ Pemulihan dari Bullying",
    description: "Panduan langkah demi langkah untuk pulih dari trauma bullying",
    steps: [
      {
        title: "Akui Rasa Sakitmu",
        description: "Jangan menekan atau menyangkal perasaanmu. Rasa sakit adalah nyata dan valid.",
        tips: [
          "Izinkan diri Anda untuk merasa sedih, marah, atau takut",
          "Jangan beri tahu diri Anda bahwa Anda seharusnya merasa lebih baik",
          "Validasi pengalaman Anda sendiri",
        ]
      },
      {
        title: "Jangan Menyalahkan Diri Sendiri",
        description: "Bullying BUKAN kesalahan Anda. Tanggung jawab ada pada pelaku, bukan Anda.",
        tips: [
          "Ingat: tidak ada yang Anda lakukan yang membuat Anda 'layak' untuk dibully",
          "Pelaku memilih untuk berperilaku seperti itu",
          "Kehadiran Anda bernilai apa adanya",
        ]
      },
      {
        title: "Cari Dukungan",
        description: "Ceritakan pada orang yang Anda percaya - keluarga, teman, atau profesional.",
        tips: [
          "Berbicara mengurangi beban yang Anda bawa sendirian",
          "Orang yang peduli ingin membantu Anda",
          "Profesional terlatih bisa memberikan perspektif berharga",
        ]
      },
      {
        title: "Bangun Batasan Sehat",
        description: "Lindungi diri Anda dengan menetapkan batasan yang jelas.",
        tips: [
          "Berani mengatakan 'tidak' adalah bentuk keberanian",
          "Hindari situasi atau orang yang membuat Anda tidak aman",
          "Prioritaskan hubungan yang saling menghormati",
        ]
      },
      {
        title: "Jaga Kesehatan Fisik",
        description: "Tubuh dan pikiran terhubung. Perawatan fisik membantu pemulihan mental.",
        tips: [
          "Tidur cukup 7-9 jam per malam",
          "Makan makanan bergizi",
          "Olahraga ringan seperti jalan atau yoga",
        ]
      },
      {
        title: "Temukan Hal yang Membawa Kebahagiaan",
        description: "Kembangkan hobi dan aktivitas yang membuat Anda merasa baik.",
        tips: [
          "Musik, seni, olahraga, atau membaca",
          "Habiskan waktu di alam",
          "Berinteraksi dengan orang-orang yang positif",
        ]
      },
    ]
  },
  family: {
    title: "👨‍👩‍👧 Pemulihan dari Trauma Keluarga",
    description: "Panduan untuk menyembuhkan luka keluarga dan membangun hubungan yang sehat",
    steps: [
      {
        title: "Pahami Trauma Anda",
        description: "Identifikasi bagaimana pengalaman keluarga Anda mempengaruhi Anda hari ini.",
        tips: [
          "Refleksikan pola perilaku yang muncul dari masa lalu",
          "Cari tahu perasaan apa yang dipicu oleh situasi tertentu",
          "Tulis pengalaman Anda untuk memahami lebih baik",
        ]
      },
      {
        title: "Validasi Perasaan Anda",
        description: "Apa yang Anda rasakan adalah sah, bahkan jika keluarga mengatakan sebaliknya.",
        tips: [
          "Marah, sedih, dan kecewa adalah reaksi normal terhadap trauma",
          "Anda tidak perlu memaafkan untuk melanjutkan hidup",
          "Emosi Anda adalah bukti bahwa Anda peduli",
        ]
      },
      {
        title: "Menetapkan Batasan",
        description: "Tentukan apa yang bisa Anda terima dan tolak dalam hubungan keluarga.",
        tips: [
          "Anda berhak atas privasi dan ruang pribadi",
          "Tidak apa-apa untuk mengurangi kontak jika diperlukan",
          "Batasan adalah bentuk cinta terhadap diri sendiri",
        ]
      },
      {
        title: "Curhat dengan Profesional",
        description: "Terapis atau konselor dapat membantu Anda memproses trauma dengan aman.",
        tips: [
          "Terapi dapat membantu Anda memahami pola keluarga",
          "Profesional memberikan perspektif netral dan non-judgmental",
          "Ada berbagai jenis terapi yang bisa disesuaikan dengan kebutuhan Anda",
        ]
      },
      {
        title: "Temukan 'Keluarga Pilihan'",
        description: "Kembangkan hubungan supportif dengan orang-orang yang memilih Anda.",
        tips: [
          "Teman dekat dapat menjadi keluarga yang Anda butuhkan",
          "Cari komunitas dengan nilai-nilai yang sama",
          "Hubungan yang sehat adalah kemungkinan bagi Anda",
        ]
      },
      {
        title: "Investasi dalam Diri Sendiri",
        description: "Pindahkan energi menuju pertumbuhan pribadi dan kebahagiaan.",
        tips: [
          "Pelajari hal-hal baru yang membuat Anda tertarik",
          "Kembangkan keterampilan dan hobi Anda",
          "Hargai pencapaian Anda, sekecil apa pun",
        ]
      },
    ]
  }
}

export default function Healing() {
  const [selectedCategory, setSelectedCategory] = useState("bullying")
  const [expandedStep, setExpandedStep] = useState(0)

  const category = healingCategories[selectedCategory]

  return (
    <Layout>
      <div className="p-10 space-y-8 max-w-6xl mx-auto">
        {/* HEADER */}
        <div className="mb-10">
          <h1 className="text-4xl font-bold text-slate-800 mb-2">
            🌱 Langkah-Langkah Menuju Pemulihan
          </h1>
          <p className="text-slate-500 text-lg">
            Pemulihan adalah proses, bukan destinasi. Ambil langkah kecil setiap hari.
          </p>
        </div>

        {/* CATEGORY SELECTOR */}
        <div className="flex gap-4 flex-wrap">
          {Object.entries(healingCategories).map(([key, value]) => (
            <button
              key={key}
              onClick={() => {
                setSelectedCategory(key)
                setExpandedStep(0)
              }}
              className={`px-8 py-4 rounded-xl font-semibold transition duration-300 ${
                selectedCategory === key
                  ? "bg-gradient-to-r from-blue-600 to-purple-600 text-white shadow-lg scale-105"
                  : "bg-white text-slate-800 border-2 border-slate-200 hover:border-blue-400"
              }`}
            >
              {value.title}
            </button>
          ))}
        </div>

        {/* STEPS */}
        <div className="space-y-4">
          {category.steps.map((step, idx) => (
            <StepCard
              key={idx}
              step={step}
              index={idx}
              isExpanded={expandedStep === idx}
              onClick={() => setExpandedStep(expandedStep === idx ? -1 : idx)}
            />
          ))}
        </div>

        {/* ADDITIONAL RESOURCES */}
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          <ResourceSection
            title="🧘 Teknik Mindfulness"
            items={[
              "Deep Breathing: Tarik napas dalam selama 4 detik, tahan 4 detik, keluarkan 4 detik",
              "Body Scan: Fokus pada setiap bagian tubuh, dari kepala hingga kaki",
              "5-4-3-2-1: Identifikasi 5 hal yang Anda lihat, 4 yang Anda dengar, dst",
              "Meditasi Berjalan: Berjalan perlahan sambil fokus pada setiap langkah",
            ]}
          />
          <ResourceSection
            title="📝 Jurnal Prompts"
            items={[
              "Hari ini saya merasa... karena...",
              "Satu hal yang saya hargai tentang diri saya adalah...",
              "Ketika saya merasa sedih, saya bisa...",
              "Orang yang saya percayai adalah... karena...",
            ]}
          />
        </div>

        {/* DAILY AFFIRMATIONS */}
        <div className="bg-gradient-to-br from-purple-100 to-pink-100 rounded-2xl p-8 border-2 border-purple-300">
          <h2 className="text-2xl font-bold text-purple-900 mb-6">💪 Afirmasi Harian</h2>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            {[
              "Saya layak mendapatkan kebahagiaan dan kedamaian pikiran.",
              "Masa lalu saya tidak mendefinisikan masa depan saya.",
              "Saya memiliki kekuatan untuk memilih cara saya merespons.",
              "Saya terus tumbuh dan menjadi lebih kuat setiap hari.",
              "Harga diri saya tidak tergantung pada pendapat orang lain.",
              "Saya berhak atas hubungan yang sehat dan suportif.",
            ].map((affirmation, idx) => (
              <div key={idx} className="bg-white rounded-xl p-4 border-l-4 border-purple-500">
                <p className="text-purple-900 font-medium">{affirmation}</p>
              </div>
            ))}
          </div>
        </div>

        {/* CRISIS SUPPORT */}
        <div className="bg-red-50 rounded-2xl p-8 border-2 border-red-300">
          <h2 className="text-2xl font-bold text-red-900 mb-4">🆘 Dalam Krisis?</h2>
          <p className="text-red-800 mb-4">Jika Anda memiliki pikiran untuk menyakiti diri sendiri, hubungi segera:</p>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div className="bg-white p-4 rounded-lg border-2 border-red-400">
              <p className="font-bold text-red-900">Hotline Krisis 24/7</p>
              <p className="text-red-800 text-lg font-bold mt-2">📞 119 (Indonesia)</p>
            </div>
            <div className="bg-white p-4 rounded-lg border-2 border-red-400">
              <p className="font-bold text-red-900">Pertolongan Darurat</p>
              <p className="text-red-800 text-lg font-bold mt-2">🏥 Rumah Sakit Terdekat</p>
            </div>
          </div>
        </div>
      </div>
    </Layout>
  )
}

function StepCard({ step, index, isExpanded, onClick }) {
  return (
    <div
      onClick={onClick}
      className="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-blue-500 cursor-pointer hover:shadow-xl transition"
    >
      <div className="flex justify-between items-center">
        <div>
          <h3 className="text-xl font-bold text-slate-800 mb-2">
            Langkah {index + 1}: {step.title}
          </h3>
          <p className="text-slate-600">{step.description}</p>
        </div>
        <div className="text-3xl">
          {isExpanded ? "▼" : "▶"}
        </div>
      </div>

      {isExpanded && (
        <div className="mt-6 pt-6 border-t-2 border-slate-200 space-y-3">
          {step.tips.map((tip, idx) => (
            <div key={idx} className="flex items-start gap-3 p-3 bg-blue-50 rounded-lg">
              <span className="text-blue-600 font-bold flex-shrink-0">✓</span>
              <p className="text-slate-700">{tip}</p>
            </div>
          ))}
        </div>
      )}
    </div>
  )
}

function ResourceSection({ title, items }) {
  return (
    <div className="bg-white rounded-2xl shadow-lg p-6 border-2 border-blue-200">
      <h3 className="text-xl font-bold text-slate-800 mb-4">{title}</h3>
      <div className="space-y-3">
        {items.map((item, idx) => (
          <div key={idx} className="flex items-start gap-3 p-3 bg-blue-50 rounded-lg">
            <span className="text-blue-600 flex-shrink-0 font-bold">•</span>
            <p className="text-slate-700 text-sm">{item}</p>
          </div>
        ))}
      </div>
    </div>
  )
}
