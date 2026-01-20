# 📖 Visual Feature Walkthrough - RuangPulih

## 🎬 How Features Look & Work

---

## 1️⃣ DASHBOARD VIEW

### Visual Layout:
```
┌──────────────────────────────────────────────────────────┐
│                   SIDEBAR                │  MAIN CONTENT │
│                                          │               │
│  🌿 RuangPulih                           │ Selamat datang│
│                                          │ kembali 🌿   │
│  [🏠 Beranda] ← Active                   │               │
│  [✍ Cerita]                              │ ┌─────────────┤
│  [💬 Curhat]                             │ │ "Kamu tidak │
│  [🌱 Pulih]                              │ │ rusak..."   │
│  [📖 Edukasi]                            │ │ (GRADIENT)  │
│                                          │ └─────────────┤
│  [🚪 Logout]                             │               │
│                                          │ [Stats: 4 cards]
│                                          │ [Actions: 5 buttons]
│                                          │ [Resources: 2 cards]
│                                          │ [Tips: 6 items]
│                                          │ [Warnings: 2 cards]
└──────────────────────────────────────────────────────────┘
```

### Cards on Dashboard:
```
┌─────────────────────┐  ┌─────────────────────┐
│  ✍ Cerita Disimpan │  │  💬 Sesi Curhat     │
│         0           │  │         0            │
│  Cerita pribadi     │  │  Waktu berbagi      │
└─────────────────────┘  └─────────────────────┘

┌─────────────────────┐  ┌─────────────────────┐
│  🌱 Hari Healing    │  │  📖 Artikel Dibaca  │
│         0           │  │         0            │
│  Langkah pemulihan  │  │  Pengetahuan        │
└─────────────────────┘  └─────────────────────┘
```

### Quick Action Buttons:
```
[✍ Tulis    [💬 Curhat   [🌱 Pulih   [📖 Edukasi [🤝 Konsultasi]
 Cerita]     untuk        untuk      untuk        untuk
             curhat]      pulih]      belajar]     konsultasi]
```

---

## 2️⃣ CERITA (STORY) VIEW

### User View - Write Story:
```
┌──────────────────────────────────┬────────────────────────┐
│ FORM (sticky di kanan)           │ CERITA LIST (di kiri)   │
│                                  │                        │
│ Tulis Cerita Baru 📝             │ Cerita yang disimpan:  │
│                                  │                        │
│ [✍ Mulai Menulis Cerita]         │ ┌──────────────────┐  │
│                                  │ │ 📅 20 Jan 2026   │  │
│ (Ketika diklik)                  │ │ 😔 Mood          │  │
│                                  │ │                  │  │
│ ┌─────────────────────────┐      │ │ Teks cerita...   │  │
│ │ Aku ingin bercerita...  │      │ │ [✏️ Edit][🗑️Del]│  │
│ │                         │      │ └──────────────────┘  │
│ │                         │      │                        │
│ │                         │      │ ┌──────────────────┐  │
│ └─────────────────────────┘      │ │ 📅 19 Jan 2026   │  │
│                                  │ │ 😢 Mood          │  │
│ [💚 Simpan][Batal]              │ │ ...              │  │
│                                  │ └──────────────────┘  │
│ 💡 Tips Menulis:                 │                        │
│ • Tulis jujur                   │                        │
│ • Tidak ada yang salah          │                        │
│ • Aman & terlindungi            │                        │
└──────────────────────────────────┴────────────────────────┘
```

### Admin View - View All Stories:
```
┌────────────────────────────────────────────────────────┐
│ 👨‍💼 ADMIN PANEL - Semua Cerita Pengguna              │
│ Total: 42 cerita telah disimpan                       │
│                                                        │
│ ┌──────────────────────────────────────────────────┐ │
│ │ CERITA #42                                       │ │
│ │ 📅 20 Jan 2026 10:30                             │ │
│ │ [🗑️ Hapus]                                       │ │
│ │                                                  │ │
│ │ Teks cerita lengkap dari user...                │ │
│ └──────────────────────────────────────────────────┘ │
│                                                        │
│ ┌──────────────────────────────────────────────────┐ │
│ │ CERITA #41                                       │ │
│ │ 📅 20 Jan 2026 09:15                             │ │
│ │ ...                                              │ │
│ └──────────────────────────────────────────────────┘ │
└────────────────────────────────────────────────────────┘
```

---

## 3️⃣ CHAT VIEW

### Chat Interface:
```
┌────────────────────────────────────────────────────┐
│ 💬 Curhat & Konsultasi                             │
│ Berbicara dengan Pendamping Virtual 24/7           │
└────────────────────────────────────────────────────┘

┌────────────────────────────────────────────────────┐
│ CHAT AREA                                          │
│                                                    │
│ [Bot] Halo! 👋 Saya di sini untuk mendengarkan│ │ │
│ [Bot] cerita Anda...                           │ │ │
│                                  10:00          │ │ │
│                                                    │
│                  [User] Saya merasa sedih        │ │ │
│                  karena di-bully di sekolah     │ │ │
│                                  10:02          │ │ │
│                                                    │
│ [Bot] Saya mendengarkan Anda. Apa yang          │ │ │
│ [Bot] Anda alami adalah nyata dan tidak pantas  │ │ │
│                                  10:03          │ │ │
│                                                    │
│                  [User] Terima kasih...           │ │ │
│                                                    │
│ [Bot] • • •  [typing indicator]                   │
└────────────────────────────────────────────────────┘

┌────────────────────────────────────────────────────┐
│ ℹ️ Tips: Cerita dengan detail membantuku         │
│ memahami situasimu lebih baik. 💙                 │
│                                                    │
│ ┌──────────────────────────────────────────────┐  │
│ │ Ketik perasaanmu di sini...                  │  │
│ │                                              │  │
│ └──────────────────────────────────────────────┘  │
│                                  [➤ Kirim]        │
└────────────────────────────────────────────────────┘
```

---

## 4️⃣ HEALING VIEW

### Category Toggle:
```
[🛡️ Pemulihan dari Bullying] [👨‍👩‍👧 Pemulihan dari Trauma Keluarga]
         (SELECTED)                    (NOT SELECTED)
```

### Bullying Recovery Steps:
```
┌─────────────────────────────────────────────┐
│ LANGKAH 1: Akui Rasa Sakitmu                │
│ Jangan tekan atau abaikan perasaan Anda     │
│                                       ▼    │
│ + Tips ketika diklik:                      │
│   ✓ Izinkan diri untuk merasa sedih         │
│   ✓ Emosi adalah valid                      │
│   ✓ Jangan tekan perasaan Anda              │
└─────────────────────────────────────────────┘

┌─────────────────────────────────────────────┐
│ LANGKAH 2: Jangan Menyalahkan Diri Sendiri  │
│ Bullying BUKAN kesalahan Anda               │
│                                       ▼    │
└─────────────────────────────────────────────┘
```

### Additional Resources:
```
┌──────────────────────┬──────────────────────┐
│ 🧘 Mindfulness Tech. │ 📝 Journal Prompts    │
│                      │                      │
│ • Deep Breathing     │ • Hari ini saya      │
│ • Body Scan          │   merasa...          │
│ • 5-4-3-2-1 Technique│ • Satu hal yang      │
│ • Walking Meditation │   saya hargai...     │
└──────────────────────┴──────────────────────┘

┌──────────────────────────────────────────────┐
│ 💪 Afirmasi Harian                           │
│                                              │
│ "Saya layak mendapatkan kebahagiaan..."     │
│ "Masa lalu saya tidak mendefinisikan..."    │
│ "Saya memiliki kekuatan untuk..."           │
│ ...                                          │
└──────────────────────────────────────────────┘

┌──────────────────────────────────────────────┐
│ 🆘 Dalam Krisis?                            │
│                                              │
│ 📞 Hotline Krisis: 119                      │
│ 🏥 Rumah Sakit Terdekat                     │
└──────────────────────────────────────────────┘
```

---

## 5️⃣ EDUCATION VIEW

### Article List:
```
┌────────────────────────────────────────┐
│ INTRO                                  │
│ Informasi berbasis penelitian dari     │
│ 🔬 Penelitian Ilmiah                  │
│ 👨‍⚕️ Ahli Profesional                  │
│ 📖 Evidence-Based Methods              │
└────────────────────────────────────────┘

┌────────────────────────────────────────┐
│ 1. Apa itu Bullying dan Dampaknya?  ▶ │
│    (Collapsed)                         │
└────────────────────────────────────────┘

┌────────────────────────────────────────┐
│ 2. Mengapa Korban Sering Menyalahkan ▼ │
│    Diri Sendiri? (Expanded)            │
│                                        │
│    Full text: Banyak korban bullying  │
│    mengalami distorsi kognitif...     │
│                                        │
│    👨‍⚕️ Ahli: Dr. Psikologi Trauma      │
└────────────────────────────────────────┘

[... 8 more articles ...]

┌────────────────────────────────────────┐
│ 🎯 POIN PENTING                        │
│                                        │
│ 💫 Trauma Anda BUKAN kesalahan Anda    │
│ 💫 Pemulihan adalah proses             │
│ 💫 Mencari bantuan adalah kekuatan     │
│ 💫 Anda berhak aman & dicintai         │
│ 💫 Perubahan kecil = transformasi besar│
│ 💫 Kesehatan mental = kesehatan fisik  │
└────────────────────────────────────────┘

┌────────────────────────────────────────┐
│ 🔗 RESOURCES                           │
│                                        │
│ Buku Rekomendasi          Teknik Terapi│
│ • The Body Keeps...        • CBT       │
│ • Emotional Intelligence   • MBSR      │
│ • Mindfulness...           • DBT       │
└────────────────────────────────────────┘
```

---

## 🎨 VISUAL DESIGN ELEMENTS

### Color Scheme:
```
PRIMARY BLUE      : #3B82F6  ← Main actions
SECONDARY PURPLE  : #7C3AED  ← Accents
ACCENT PINK       : #EC4899  ← Highlights
SUCCESS GREEN     : #10B981  ← Positive actions
WARNING RED       : #EF4444  ← Critical alerts
NEUTRAL GRAY      : #64748B  ← Text & borders
```

### Spacing:
```
Padding:    p-4   p-6   p-8   p-10
Margin:     m-4   m-6   m-8
Gap:        gap-4 gap-6 gap-8
```

### Shadow Effects:
```
Shadow-md   : Light shadow for cards
Shadow-lg   : Medium shadow for buttons
Shadow-xl   : Heavy shadow for important elements
Shadow-2xl  : Extra heavy for interactive elements
```

### Rounded Corners:
```
rounded-lg    : Regular elements (0.5rem)
rounded-xl    : Cards & buttons (0.75rem)
rounded-2xl   : Large cards (1rem)
rounded-3xl   : Big sections (1.5rem)
```

### Typography:
```
text-4xl font-bold    : Page titles
text-3xl font-bold    : Major headings
text-2xl font-bold    : Section headings
text-lg font-semibold : Sub-headings
text-base              : Body text (normal)
text-sm               : Small text/captions
```

---

## 🎯 Interaction Patterns

### Button Hover:
```
Normal:    bg-blue-600 shadow-md
Hover:     bg-blue-700 shadow-xl scale-105
Active:    bg-blue-800
Disabled:  opacity-50 cursor-not-allowed
```

### Card Hover:
```
Normal:    shadow-lg border
Hover:     shadow-xl scale-102 (slight)
```

### Text Link:
```
Normal:    text-blue-600
Hover:     text-blue-700 underline
```

### Input Focus:
```
Border:    border-2 border-blue-300
Ring:      focus:ring-2 focus:ring-blue-400
Outline:   outline-none
```

---

## 📱 RESPONSIVE BREAKPOINTS

### Mobile (375px - 640px):
- Single column layout
- Full-width cards
- Smaller padding (p-4)
- Stacked buttons

### Tablet (641px - 1024px):
- Two column layout
- Grouped cards
- Normal padding (p-6)
- Side-by-side buttons

### Desktop (1025px+):
- Three+ column layout
- Optimized spacing
- Full padding (p-8, p-10)
- Maximum width containers (max-w-7xl)

### Example:
```jsx
<div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
  {/* 1 column on mobile */}
  {/* 2 columns on tablet */}
  {/* 3 columns on desktop */}
</div>
```

---

## 💫 Animation Effects

### Transitions:
```
transition duration-300 ease-out
- 300ms animation
- Smooth easing
```

### Scale Transform:
```
hover:scale-105      : Grow 5% on hover
transform            : Enable transform
```

### Opacity:
```
opacity-50           : 50% visible
opacity-100          : Fully visible
```

### Custom Animations (in CSS):
```
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px) }
  to { opacity: 1; transform: translateY(0) }
}

.animate-fadeIn { animation: fadeIn 0.3s ease-out }
```

---

## 📊 Component Hierarchy

### Page Structure:
```
Layout
└── Sidebar
    ├── Logo
    ├── Menu Items
    │   ├── Dashboard
    │   ├── Cerita
    │   ├── Chat
    │   ├── Healing
    │   └── Education
    └── Logout Button

└── Main Content
    ├── Header Section
    ├── Cards/Components
    │   ├── StatCard
    │   ├── QuickActionButton
    │   ├── ResourceCard
    │   ├── TipItem
    │   └── WarningItem
    └── Footer Info
```

---

## 🎬 User Journey Map

```
LANDING PAGE
    ↓
LOGIN/REGISTER
    ↓
DASHBOARD (First impression)
    ├─→ CERITA (Write stories)
    ├─→ CHAT (Get support 24/7)
    ├─→ HEALING (Follow recovery guide)
    └─→ EDUCATION (Learn psychology)
```

---

## ✨ Key Visual Moments

### 1. First Load
- Welcome header dengan greeting
- Inspirational quote (changes every load)
- Beautiful gradient backgrounds

### 2. Story Saved
- Success message: "Ceritamu berhasil disimpan! 💚"
- Story appears in list immediately
- Can edit/delete anytime

### 3. Chat Conversation
- Messages appear with smooth animation
- Typing indicator shows bot is "thinking"
- Auto-scrolls to latest message

### 4. Learning Moment
- Click to expand article
- Full content appears with smooth animation
- Expert credit shown at bottom

### 5. Healing Progress
- Step cards expand to show details
- Multiple techniques provided
- Affirmations highlighted in gradient box

---

**Visual Design Philosophy:**
- 🎨 Beautiful but not overwhelming
- 🎯 Clear hierarchy and navigation
- 💚 Compassionate color choices
- ♿ Accessible design patterns
- 📱 Mobile-first responsive
- ⚡ Fast and smooth interactions

---

*Last Updated: January 20, 2026*
