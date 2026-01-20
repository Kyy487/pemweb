# 🌿 RuangPulih - Aplikasi Dukungan Kesehatan Mental

Aplikasi web untuk mendukung pemulihan dari bullying, trauma keluarga, dan masalah kesehatan mental lainnya dengan pendekatan holistik yang compassionate.

## ✨ Fitur-Fitur Utama

### 1. **Dashboard (Beranda)**
- 📊 **Inspirational Quote Card** - Kutipan motivasi yang berubah setiap kali halaman dimuat
- 📈 **Statistics Cards** - Menampilkan jumlah cerita, sesi curhat, hari healing, dan artikel yang dibaca
- 🚀 **Quick Action Buttons** - Akses cepat ke semua fitur utama
- 💙 **Resource Cards** - Panduan singkat untuk pulih dari bullying dan trauma keluarga
- ✨ **Daily Tips** - Tips harian untuk kesehatan mental (tidur, minum air, olahraga, dll)
- ⚠️ **Warning Signs** - Tanda-tanda yang perlu perhatian dan kapan harus mencari bantuan profesional

### 2. **Fitur Cerita (Story Management)**
- ✍ **Tulis Cerita Baru** - User dapat menulis cerita pribadi dengan interface yang user-friendly
- 💾 **Penyimpanan Otomatis** - Cerita disimpan di localStorage (tersimpan secara lokal)
- 📝 **Edit Cerita** - User dapat mengedit cerita yang sudah ditulis
- 🗑️ **Hapus Cerita** - User dapat menghapus cerita jika ingin
- 👨‍💼 **Admin Panel** - Mode khusus untuk admin melihat semua cerita yang telah disimpan pengguna
- 📋 **Daftar Cerita** - Menampilkan semua cerita dengan timestamp dan mood indicator
- 💡 **Tips Menulis** - Panduan untuk pengguna agar menulis dengan jujur dan terbuka

### 3. **Fitur Chat (Curhat dengan Bot)**
- 💬 **Intelligent Bot Responses** - Bot memberikan respon yang meaningful berdasarkan topik:
  - **Bullying Category** - Responses spesifik untuk korban bullying
  - **Family Trauma Category** - Responses untuk trauma keluarga
  - **Emotional Support** - Responses untuk dukungan emosi umum
- 🔄 **2-Way Conversation** - User dapat melanjutkan percakapan dengan bot
- ⚡ **Real-time Chat** - Chat langsung dengan typing indicator
- ⏰ **Timestamps** - Setiap pesan memiliki waktu
- 📱 **User-Friendly Interface** - Design yang nyaman untuk berkomunikasi
- 🧠 **Mindfulness Tips** - Info box berisi tips tentang pentingnya komunikasi

### 4. **Fitur Pulih (Healing Journey)**
- 🛡️ **Kategori Bullying** - 6 langkah pemulihan dari bullying:
  1. Akui Rasa Sakitmu
  2. Jangan Menyalahkan Diri Sendiri
  3. Cari Dukungan
  4. Bangun Batasan Sehat
  5. Jaga Kesehatan Fisik
  6. Temukan Hal yang Membawa Kebahagiaan

- 👨‍👩‍👧 **Kategori Trauma Keluarga** - 6 langkah pemulihan dari trauma keluarga:
  1. Pahami Trauma Anda
  2. Validasi Perasaan Anda
  3. Menetapkan Batasan
  4. Curhat dengan Profesional
  5. Temukan 'Keluarga Pilihan'
  6. Investasi dalam Diri Sendiri

- 🧘 **Teknik Mindfulness** - Deep breathing, body scan, 5-4-3-2-1 technique, meditasi berjalan
- 📝 **Jurnal Prompts** - Panduan menulis jurnal untuk self-reflection
- 💪 **Afirmasi Harian** - 6 afirmasi positif yang dapat diulang setiap hari
- 🆘 **Crisis Support** - Informasi hotline krisis dan pertolongan darurat

### 5. **Fitur Edukasi (Education Hub)**
- 📚 **10 Artikel Komprehensif** tentang kesehatan mental:
  1. Apa itu Bullying dan Dampaknya?
  2. Mengapa Korban Sering Menyalahkan Diri Sendiri?
  3. Dampak Bullying terhadap Otak dan Emosi
  4. Cara Sehat Menghadapi Tekanan Psikologis
  5. Pemulihan dari Trauma Bullying
  6. Trauma Keluarga dan Pengaruhnya
  7. Membangun Kepercayaan Diri Setelah Trauma
  8. Kapan Harus Mencari Bantuan Profesional?
  9. Memahami Anxiety dan Depression
  10. Self-Care sebagai Alat Pemulihan

- 🔬 **Evidence-Based Content** - Semua konten berbasis penelitian psikologi ilmiah
- 👨‍⚕️ **Expert Attribution** - Setiap artikel dikreditkan kepada ahli psikologi
- 📖 **Expandable Sections** - User dapat membuka/menutup setiap artikel
- 💡 **Key Takeaways** - Poin-poin penting yang harus diingat
- 🔗 **Resource Recommendations** - Buku dan teknik terapi yang direkomendasikan

## 🎨 Design Improvements

### Visual Enhancements:
- **Gradient Backgrounds** - Beautiful gradient dari biru ke ungu ke pink
- **Card-Based Layout** - Organized dengan card components
- **Hover Effects** - Smooth transitions dan scale effects
- **Color Coding** - Setiap fitur memiliki warna unik untuk mudah diidentifikasi
- **Typography** - Font yang jelas dan readable dengan hierarchy yang baik
- **Responsiveness** - Design yang optimal untuk mobile, tablet, dan desktop
- **Shadows & Depth** - Box shadows untuk menciptakan depth dan visual hierarchy

### UI/UX Improvements:
- **Clear Call-to-Action** - Tombol-tombol yang jelas dan eye-catching
- **Sticky Sidebar** - Sidebar yang selalu terlihat saat scrolling
- **Auto-scrolling Chat** - Chat otomatis scroll ke pesan terbaru
- **Loading States** - Indikator typing untuk bot
- **Confirmation Dialogs** - Konfirmasi sebelum menghapus data
- **Empty States** - Pesan yang jelas saat tidak ada data
- **Tooltips & Hints** - Panduan untuk membantu user

## 🔧 Technical Features

### Frontend Technologies:
- **React 19** - Latest React version untuk UI yang responsif
- **React Router v7** - Client-side routing yang smooth
- **Tailwind CSS** - Utility-first CSS untuk styling yang efisien
- **Vite** - Build tool yang cepat dan modern

### Data Management:
- **localStorage API** - Penyimpanan data lokal untuk cerita
- **State Management** - React hooks (useState, useEffect) untuk state management
- **Component Reusability** - Shared Layout component untuk DRY principle

### Code Quality:
- **Modular Components** - Setiap fitur terpisah menjadi component
- **Props-based Configuration** - Flexible component design
- **Semantic HTML** - Accessibility-focused HTML structure
- **Clean Code** - Readable dan maintainable code structure

## 📱 Responsive Design

- **Mobile-First Approach** - Optimized untuk small screens
- **Grid System** - Flexible grid layout (grid-cols-1, md:grid-cols-2, lg:grid-cols-3)
- **Touch-Friendly** - Buttons dan interactive elements optimized untuk touch
- **Performance Optimized** - Lazy loading dan efficient rendering

## 🔐 Data Privacy & Security

- **Local Storage Only** - Semua data cerita disimpan di browser lokal user
- **No Server Upload** - Data tidak dikirim ke server (privacy-first)
- **User Control** - User memiliki kontrol penuh atas data mereka
- **Edit & Delete** - User dapat mengedit atau menghapus cerita kapan saja

## 📊 User Flow

```
Landing → Login/Register → Dashboard
                              ├─ Story (Tulis & Simpan Cerita)
                              ├─ Chat (Curhat dengan Bot)
                              ├─ Healing (Panduan Pemulihan)
                              └─ Education (Materi Psikologi)
```

## 🎯 Key Psychology Concepts

Aplikasi ini didesain berdasarkan prinsip-prinsip psikologi:
- **Trauma-Informed Approach** - Sensitif terhadap pengalaman trauma
- **Cognitive Behavioral Therapy (CBT)** - Termasuk teknik kognitif
- **Mindfulness & Meditation** - Evidence-based untuk stress reduction
- **Social Support** - Menekankan pentingnya dukungan sosial
- **Self-Efficacy** - Membangun kepercayaan diri secara bertahap

## 🚀 Getting Started

### Installation:
```bash
cd frontend
npm install
npm run dev
```

### Access the App:
```
http://localhost:5174
```

### Build for Production:
```bash
npm run build
```

## 📞 Support & Resources

- **24/7 Chat Support** - Bot yang selalu siap mendengarkan
- **Healing Guide** - Step-by-step panduan pemulihan
- **Education Hub** - Informasi komprehensif tentang kesehatan mental
- **Crisis Hotline** - Nomor darurat 119 (Indonesia)

## 💚 Message to Users

**Kamu tidak rusak. Kamu hanya sedang lelah. Kamu pantas merasa aman, dihargai, dan dicintai.**

Aplikasi ini adalah ruang aman untuk berbagi, belajar, dan berkembang. Tidak ada yang menghakimi di sini. Ambil waktu Anda sendiri untuk pulih.

---

**RuangPulih v1.0** - A safe space for healing and growth 🌱
