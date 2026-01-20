import { useState, useEffect } from "react"
import Layout from "../components/Layout"

export default function Cerita() {
  const [stories, setStories] = useState([])
  const [newStory, setNewStory] = useState("")
  const [showForm, setShowForm] = useState(false)
  const [editingId, setEditingId] = useState(null)
  const [editText, setEditText] = useState("")
  const [showAdmin, setShowAdmin] = useState(false)

  // Load stories dari localStorage
  useEffect(() => {
    const saved = localStorage.getItem("user_stories")
    if (saved) {
      setStories(JSON.parse(saved))
    }
  }, [])

  // Save stories ke localStorage
  const saveStory = () => {
    if (!newStory.trim()) {
      alert("Cerita tidak boleh kosong!")
      return
    }

    const story = {
      id: Date.now(),
      text: newStory,
      date: new Date().toLocaleDateString("id-ID", {
        day: "numeric",
        month: "long",
        year: "numeric",
        hour: "2-digit",
        minute: "2-digit"
      }),
      mood: "😔" // bisa diganti dengan emoji selection
    }

    const updated = [story, ...stories]
    setStories(updated)
    localStorage.setItem("user_stories", JSON.stringify(updated))
    setNewStory("")
    setShowForm(false)
    alert("Ceritamu berhasil disimpan! 💚")
  }

  const deleteStory = (id) => {
    if (!confirm("Yakin ingin menghapus cerita ini?")) return
    const updated = stories.filter(s => s.id !== id)
    setStories(updated)
    localStorage.setItem("user_stories", JSON.stringify(updated))
  }

  const startEdit = (id, text) => {
    setEditingId(id)
    setEditText(text)
  }

  const saveEdit = (id) => {
    const updated = stories.map(s =>
      s.id === id ? { ...s, text: editText } : s
    )
    setStories(updated)
    localStorage.setItem("user_stories", JSON.stringify(updated))
    setEditingId(null)
  }

  return (
    <Layout>
      <div className="p-10 space-y-8 max-w-6xl mx-auto">
        {/* HEADER */}
        <div className="flex justify-between items-center mb-10">
          <div>
            <h1 className="text-4xl font-bold text-slate-800 mb-2">
              Ceritakan Apa yang Kamu Alami ✍
            </h1>
            <p className="text-slate-500 text-lg">
              Tidak perlu nama, tidak perlu identitas. Ceritamu aman di sini. ({stories.length} cerita disimpan)
            </p>
          </div>
          <button
            onClick={() => setShowAdmin(!showAdmin)}
            className="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition shadow-lg"
          >
            {showAdmin ? "👤 Lihat Cerita Saya" : "👨‍💼 Mode Admin"}
          </button>
        </div>

        {showAdmin ? (
          // ADMIN VIEW - Lihat semua cerita
          <AdminView stories={stories} onDelete={deleteStory} />
        ) : (
          // USER VIEW
          <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {/* FORM CERITA */}
            <div className="lg:col-span-1">
              <div className="bg-white rounded-2xl shadow-xl p-8 sticky top-8">
                <h2 className="text-2xl font-bold text-slate-800 mb-6">Tulis Cerita Baru 📝</h2>
                
                {!showForm ? (
                  <button
                    onClick={() => setShowForm(true)}
                    className="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white py-4 rounded-xl font-semibold transition shadow-lg"
                  >
                    ✍ Mulai Menulis Cerita
                  </button>
                ) : (
                  <div className="space-y-4">
                    <textarea
                      value={newStory}
                      onChange={(e) => setNewStory(e.target.value)}
                      placeholder="Aku ingin bercerita tentang sesuatu yang selama ini aku pendam..."
                      rows="8"
                      className="w-full p-4 border-2 border-blue-300 rounded-xl focus:ring-2 focus:ring-blue-400 focus:border-transparent outline-none resize-none"
                    />
                    
                    <div className="space-y-2">
                      <button
                        onClick={saveStory}
                        className="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl font-semibold transition shadow-lg"
                      >
                        💚 Simpan Cerita
                      </button>
                      <button
                        onClick={() => {
                          setShowForm(false)
                          setNewStory("")
                        }}
                        className="w-full bg-slate-300 hover:bg-slate-400 text-slate-800 py-3 rounded-xl font-semibold transition"
                      >
                        Batal
                      </button>
                    </div>
                  </div>
                )}

                {/* INFO BOX */}
                <div className="mt-8 p-6 bg-blue-50 border-2 border-blue-200 rounded-xl">
                  <h3 className="font-bold text-blue-900 mb-3">💡 Tips Menulis Cerita</h3>
                  <ul className="text-sm text-blue-800 space-y-2">
                    <li>• Tulis dengan jujur dan tulus</li>
                    <li>• Tidak ada yang salah dalam perasaanmu</li>
                    <li>• Cerita akan disimpan dengan aman</li>
                    <li>• Kamu bisa mengedit kapan saja</li>
                  </ul>
                </div>
              </div>
            </div>

            {/* DAFTAR CERITA */}
            <div className="lg:col-span-2">
              <div className="space-y-4">
                {stories.length === 0 ? (
                  <div className="bg-gradient-to-br from-purple-50 to-blue-50 rounded-2xl p-12 text-center border-2 border-purple-200">
                    <div className="text-6xl mb-4">📝</div>
                    <h3 className="text-2xl font-bold text-slate-800 mb-2">Belum Ada Cerita</h3>
                    <p className="text-slate-500">Mulai ceritakan pengalamanmu sekarang! Cerita pertamamu akan disimpan di sini.</p>
                  </div>
                ) : (
                  stories.map((story) => (
                    <div
                      key={story.id}
                      className="bg-white rounded-2xl shadow-lg p-8 border-l-4 border-blue-500 hover:shadow-xl transition"
                    >
                      <div className="flex justify-between items-start mb-4">
                        <div className="flex items-center gap-3">
                          <span className="text-3xl">{story.mood}</span>
                          <div>
                            <p className="text-sm text-slate-500 font-medium">{story.date}</p>
                          </div>
                        </div>
                        <div className="flex gap-2">
                          <button
                            onClick={() => startEdit(story.id, story.text)}
                            className="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition text-sm"
                          >
                            ✏️ Edit
                          </button>
                          <button
                            onClick={() => deleteStory(story.id)}
                            className="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-semibold transition text-sm"
                          >
                            🗑️ Hapus
                          </button>
                        </div>
                      </div>

                      {editingId === story.id ? (
                        <div className="space-y-4">
                          <textarea
                            value={editText}
                            onChange={(e) => setEditText(e.target.value)}
                            rows="6"
                            className="w-full p-4 border-2 border-blue-300 rounded-xl focus:ring-2 focus:ring-blue-400 outline-none resize-none"
                          />
                          <div className="flex gap-2">
                            <button
                              onClick={() => saveEdit(story.id)}
                              className="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-semibold transition"
                            >
                              💚 Simpan
                            </button>
                            <button
                              onClick={() => setEditingId(null)}
                              className="bg-slate-400 hover:bg-slate-500 text-white px-6 py-2 rounded-lg font-semibold transition"
                            >
                              Batal
                            </button>
                          </div>
                        </div>
                      ) : (
                        <p className="text-slate-700 leading-relaxed whitespace-pre-wrap">{story.text}</p>
                      )}
                    </div>
                  ))
                )}
              </div>
            </div>
          </div>
        )}
      </div>
    </Layout>
  )
}

function AdminView({ stories, onDelete }) {
  return (
    <div className="bg-white rounded-2xl shadow-xl p-8">
      <h2 className="text-3xl font-bold text-slate-800 mb-2">📋 Admin Panel - Semua Cerita Pengguna</h2>
      <p className="text-slate-500 mb-8">Total: <span className="font-bold text-lg">{stories.length}</span> cerita telah disimpan</p>

      {stories.length === 0 ? (
        <div className="text-center py-12">
          <p className="text-slate-500 text-lg">Belum ada cerita yang disimpan</p>
        </div>
      ) : (
        <div className="space-y-6 max-h-[70vh] overflow-y-auto">
          {stories.map((story, idx) => (
            <div
              key={story.id}
              className="bg-gradient-to-r from-slate-50 to-blue-50 p-6 rounded-xl border-2 border-slate-200 hover:shadow-lg transition"
            >
              <div className="flex justify-between items-start mb-3">
                <div>
                  <h3 className="font-bold text-slate-800 text-lg">Cerita #{stories.length - idx}</h3>
                  <p className="text-sm text-slate-500">{story.date}</p>
                </div>
                <button
                  onClick={() => onDelete(story.id)}
                  className="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-semibold transition text-sm"
                >
                  🗑️ Hapus
                </button>
              </div>
              <div className="bg-white p-4 rounded-lg border-l-4 border-blue-500">
                <p className="text-slate-700 leading-relaxed whitespace-pre-wrap">{story.text}</p>
              </div>
            </div>
          ))}
        </div>
      )}
    </div>
  )
}
