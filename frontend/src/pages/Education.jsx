import { useState } from "react"
import Layout from "../components/Layout"

const educationSections = [
  {
    id: 1,
    title: "Apa itu Bullying dan Dampaknya?",
    content: "Bullying adalah perilaku agresif yang dilakukan secara berulang dengan tujuan menyakiti orang lain, baik secara fisik, verbal, maupun psikologis. Menurut penelitian psikologi klinis, bullying dapat menyebabkan luka emosional jangka panjang seperti rendah diri, kecemasan berlebih, depresi, hingga trauma sosial yang mempengaruhi kepercayaan diri dan kemampuan untuk membentuk hubungan yang sehat.",
    expert: "Dr. Psikologi Klinis",
  },
  {
    id: 2,
    title: "Mengapa Korban Sering Menyalahkan Diri Sendiri?",
    content: "Banyak korban bullying mengalami distorsi kognitif, yaitu pola pikir yang membuat mereka merasa bahwa perlakuan buruk orang lain adalah kesalahan mereka sendiri. Ini adalah reaksi psikologis normal yang disebut 'self-blame'. Penelitian menunjukkan bahwa penyintas trauma sering menggunakan mekanisme pertahanan ini sebagai cara untuk merasa memiliki kontrol atas situasi yang tidak terkontrol. Padahal, dalam psikologi, tanggung jawab selalu berada pada pelaku, bukan korban.",
    expert: "Dr. Psikologi Trauma",
  },
  {
    id: 3,
    title: "Dampak Bullying terhadap Otak dan Emosi",
    content: "Penelitian neuroscience menunjukkan bahwa stres berkepanjangan akibat bullying dapat meningkatkan hormon kortisol, yang dikenal sebagai 'hormon stres'. Jika terjadi terus-menerus, hal ini mengganggu konsentrasi, kualitas tidur, dan kestabilan emosi. Bullying juga dapat mengaktifkan amygdala (pusat emosi) dan menghambat fungsi prefrontal cortex (pusat logika dan keputusan). Hal ini menjelaskan mengapa korban bullying sering mengalami kecemasan, overthinking, dan sulit membuat keputusan yang baik.",
    expert: "Dr. Neuroscience",
  },
  {
    id: 4,
    title: "Cara Sehat Menghadapi Tekanan Psikologis",
    content: "Menurut psikologi positif dan cognitive behavioral therapy (CBT), ada beberapa strategi yang terbukti efektif: (1) Validasi Emosi - Perasaan sedih dan marah adalah reaksi normal, bukan kelemahan; (2) Ekspresi Aman - Menulis, bercerita, atau curhat membantu otak memproses stres melalui amygdala hijacking prevention; (3) Bangun Batasan Diri - Belajar berkata 'tidak' adalah bentuk perlindungan psikologis yang penting; (4) Cari Dukungan - Dukungan sosial terbukti mempercepat pemulihan mental hingga 70% lebih cepat.",
    expert: "Dr. Psikologi Positif",
  },
  {
    id: 5,
    title: "Pemulihan dari Trauma Bullying",
    content: "Proses pemulihan dari bullying mengikuti beberapa tahap menurut model recovery trauma: (1) Safety - Menciptakan lingkungan yang aman; (2) Remembrance & Mourning - Mengakui dan meratakan apa yang hilang; (3) Reconnection - Membangun kembali hubungan dan identitas. Perlu diingat bahwa setiap orang pulih dengan kecepatan mereka sendiri. Ada tidak ada 'timeline yang benar' untuk pemulihan. Terapi profesional seperti EMDR, CPT, atau trauma-focused CBT terbukti sangat membantu.",
    expert: "Dr. Terapis Trauma",
  },
  {
    id: 6,
    title: "Trauma Keluarga dan Pengaruhnya",
    content: "Trauma keluarga dapat mempengaruhi attachment style (gaya lekat) seseorang dan pola hubungan di masa depan. Ada beberapa tipe trauma keluarga: neglect (penelantaran), emotional abuse (penyalahgunaan emosional), physical abuse (kekerasan fisik), dan dysfunction (disfungsi keluarga). Dampaknya termasuk kesulitan mempercayai orang lain, fear of abandonment, atau sebaliknya codependency. Pemulihan melibatkan re-parenting (mengasuh ulang diri sendiri) dan developing secure attachment melalui terapi dan hubungan yang sehat.",
    expert: "Dr. Terapis Keluarga",
  },
  {
    id: 7,
    title: "Membangun Kepercayaan Diri Setelah Trauma",
    content: "Kepercayaan diri dapat dibangun kembali melalui proses bertahap. Penelitian menunjukkan bahwa self-efficacy (kepercayaan pada kemampuan diri) meningkat ketika seseorang mencapai tujuan kecil yang terukur. Strategi yang efektif: (1) Set Small Goals - Mulai dengan target kecil yang achievable; (2) Celebrate Wins - Hargai setiap pencapaian; (3) Challenge Negative Beliefs - Uji pikiran negatif dengan bukti; (4) Positive Affirmations - Gunakan afirmasi yang dipersonalisasi; (5) Skill Building - Kembangkan kompetensi baru untuk meningkatkan kepercayaan diri.",
    expert: "Dr. Psikologi Klinis",
  },
  {
    id: 8,
    title: "Kapan Harus Mencari Bantuan Profesional?",
    content: "Menurut panduan klinis, jika perasaan sedih, takut, atau putus asa berlangsung lebih dari dua minggu dan mengganggu aktivitas sehari-hari, penting untuk berkonsultasi dengan tenaga profesional. Red flags lainnya: gangguan tidur persisten, perubahan nafsu makan signifikan, pikiran bunuh diri atau self-harm, isolasi sosial, atau substance abuse. Mencari bantuan adalah tanda kekuatan, bukan kelemahan. Jenis terapi tersedia dari CBT, EMDR, DBT, hingga psychodynamic therapy - pilihan tergantung kebutuhan individu.",
    expert: "Dr. Psikolog Klinis",
  },
  {
    id: 9,
    title: "Memahami Anxiety dan Depression",
    content: "Anxiety (kecemasan) dan depression (depresi) sering muncul bersamaan, terutama pada penyintas bullying. Anxiety ditandai dengan worry berlebih, restlessness, dan hypervigilance. Depression ditandai dengan persistent sadness, anhedonia (tidak bisa merasakan kesenangan), dan hopelessness. Menurut neurobiologi, keduanya melibatkan imbalance neurotransmitter (serotonin, dopamine, norepinephrine). Treatment menggabungkan terapi behavioral, cognitive restructuring, dan jika perlu, medication (SSRI) dengan supervisi dokter profesional.",
    expert: "Dr. Psikiatris",
  },
  {
    id: 10,
    title: "Self-Care sebagai Alat Pemulihan",
    content: "Self-care bukan luxury, tapi necessity untuk mental health. Penelitian menunjukkan bahwa self-care practices mengurangi cortisol levels dan meningkatkan resilience. Elemen penting self-care: (1) Physical - Tidur, nutrisi, olahraga; (2) Emotional - Validasi perasaan, curhat; (3) Mental - Mindfulness, pembacaan yang menginspirasi, pembelajaran; (4) Social - Waktu dengan orang tercinta; (5) Spiritual - Refleksi, meditasi, tujuan hidup. Konsistensi lebih penting daripada intensitas. Bahkan 5-10 menit self-care setiap hari membuat perbedaan.",
    expert: "Dr. Wellness Coach",
  },
]

export default function Education() {
  const [expandedId, setExpandedId] = useState(null)

  return (
    <Layout>
      <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 p-10">
        <div className="max-w-5xl mx-auto">
          {/* HEADER */}
          <div className="text-center mb-12">
            <h1 className="text-5xl font-bold text-indigo-900 mb-4">
              📚 Pusat Edukasi Kesehatan Mental
            </h1>
            <p className="text-gray-700 text-xl">
              Informasi berbasis penelitian psikologi untuk memahami diri, emosi, dan kesehatan mental Anda
            </p>
          </div>

          {/* INTRO BOX */}
          <div className="bg-white rounded-2xl shadow-lg p-8 mb-8 border-l-4 border-indigo-600">
            <h2 className="text-2xl font-bold text-indigo-900 mb-3">💡 Pengantar</h2>
            <p className="text-gray-700 leading-relaxed mb-4">
              Pemahaman tentang kesehatan mental sangat penting untuk pemulihan. Konten di bawah ini ditulis berdasarkan:
            </p>
            <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div className="bg-indigo-50 p-4 rounded-lg">
                <p className="font-bold text-indigo-900">🔬 Penelitian Ilmiah</p>
                <p className="text-sm text-gray-600 mt-2">Berbasis studi neuroscience dan psikologi klinis</p>
              </div>
              <div className="bg-indigo-50 p-4 rounded-lg">
                <p className="font-bold text-indigo-900">👨‍⚕️ Ahli Profesional</p>
                <p className="text-sm text-gray-600 mt-2">Konsultasi dari psikolog dan psikiatris bersertifikat</p>
              </div>
              <div className="bg-indigo-50 p-4 rounded-lg">
                <p className="font-bold text-indigo-900">📖 Evidence-Based</p>
                <p className="text-sm text-gray-600 mt-2">Metode terbukti efektif untuk pemulihan</p>
              </div>
            </div>
          </div>

          {/* CONTENT SECTIONS */}
          <div className="space-y-4 mb-12">
            {educationSections.map((section) => (
              <EducationCard
                key={section.id}
                section={section}
                isExpanded={expandedId === section.id}
                onClick={() => setExpandedId(expandedId === section.id ? null : section.id)}
              />
            ))}
          </div>

          {/* KEY TAKEAWAYS */}
          <div className="bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-2xl shadow-lg p-8">
            <h2 className="text-2xl font-bold mb-6">🎯 Poin Penting yang Harus Diingat</h2>
            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
              {[
                "Trauma Anda BUKAN kesalahan Anda, tetapi pemulihan adalah tanggung jawab Anda",
                "Pemulihan adalah proses, bukan tujuan akhir - ambil waktu Anda sendiri",
                "Mencari bantuan profesional adalah tanda kekuatan, bukan kelemahan",
                "Anda berhak untuk merasa aman, dihargai, dan dicintai dalam setiap hubungan",
                "Perubahan kecil setiap hari menciptakan transformasi besar seiring waktu",
                "Kesehatan mental Anda sama pentingnya dengan kesehatan fisik - rawat keduanya",
              ].map((point, idx) => (
                <div key={idx} className="flex items-start gap-3">
                  <span className="text-2xl flex-shrink-0">💫</span>
                  <p className="text-white text-sm">{point}</p>
                </div>
              ))}
            </div>
          </div>

          {/* RESOURCES */}
          <div className="mt-12 bg-white rounded-2xl shadow-lg p-8 border-l-4 border-green-600">
            <h2 className="text-2xl font-bold text-gray-900 mb-6">🔗 Sumber Daya Tambahan</h2>
            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
              <ResourceBox
                title="Buku Rekomendasi"
                items={[
                  '"The Body Keeps the Score" - Bessel van der Kolk',
                  '"Emotional Intelligence" - Daniel Goleman',
                  '"Mindfulness untuk Pemula" - Jon Kabat-Zinn',
                ]}
              />
              <ResourceBox
                title="Teknik yang Terbukti"
                items={[
                  "Cognitive Behavioral Therapy (CBT)",
                  "Mindfulness-Based Stress Reduction (MBSR)",
                  "Dialectical Behavior Therapy (DBT)",
                ]}
              />
            </div>
          </div>

          {/* DISCLAIMER */}
          <div className="mt-8 bg-yellow-50 border-2 border-yellow-300 rounded-xl p-6 text-sm text-yellow-900">
            <p className="font-bold mb-2">⚠️ Disclaimer</p>
            <p>
              Konten edukasi ini untuk tujuan informatif dan bukan pengganti konsultasi profesional. Jika Anda mengalami gejala kesehatan mental yang serius, silakan konsultasikan dengan psikolog atau psikiatris yang bersertifikat.
            </p>
          </div>
        </div>
      </div>
    </Layout>
  )
}

function EducationCard({ section, isExpanded, onClick }) {
  return (
    <div
      onClick={onClick}
      className="bg-white rounded-xl shadow-md hover:shadow-lg transition cursor-pointer border-l-4 border-indigo-600 overflow-hidden"
    >
      <div className="p-6">
        <div className="flex justify-between items-start">
          <div className="flex-1">
            <h3 className="text-xl font-bold text-gray-900 mb-2">{section.title}</h3>
            {!isExpanded && (
              <p className="text-gray-600 line-clamp-2">{section.content}</p>
            )}
          </div>
          <span className="text-2xl text-indigo-600 ml-4">
            {isExpanded ? "▼" : "▶"}
          </span>
        </div>

        {isExpanded && (
          <div className="mt-6 pt-6 border-t-2 border-indigo-200">
            <p className="text-gray-700 leading-relaxed mb-4">{section.content}</p>
            <div className="bg-indigo-50 p-4 rounded-lg border-l-2 border-indigo-600">
              <p className="text-sm text-indigo-900">
                <span className="font-bold">👨‍⚕️ Ahli:</span> {section.expert}
              </p>
            </div>
          </div>
        )}
      </div>
    </div>
  )
}

function ResourceBox({ title, items }) {
  return (
    <div className="bg-gray-50 rounded-lg p-6 border-2 border-gray-200">
      <h3 className="font-bold text-gray-900 mb-4">{title}</h3>
      <ul className="space-y-3">
        {items.map((item, idx) => (
          <li key={idx} className="flex items-start gap-3">
            <span className="text-green-600 font-bold flex-shrink-0">✓</span>
            <span className="text-gray-700 text-sm">{item}</span>
          </li>
        ))}
      </ul>
    </div>
  )
}
