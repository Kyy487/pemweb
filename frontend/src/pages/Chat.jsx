import { useState, useEffect, useRef } from "react"
import Layout from "../components/Layout"

// Load messages dari localStorage
function loadMessages() {
  try {
    const saved = localStorage.getItem("chat_messages")
    return saved ? JSON.parse(saved) : []
  } catch {
    return []
  }
}

// Save messages ke localStorage
function saveMessages(messages) {
  localStorage.setItem("chat_messages", JSON.stringify(messages))
}

export default function Chat() {
  const [messages, setMessages] = useState([])
  const [input, setInput] = useState("")
  const [isAdminMode, setIsAdminMode] = useState(false)
  const [adminReply, setAdminReply] = useState("")
  const [selectedMessageId, setSelectedMessageId] = useState(null)
  const [username, setUsername] = useState("")
  const [showUsernameForm, setShowUsernameForm] = useState(true)
  const messagesEndRef = useRef(null)

  // Load messages from localStorage on mount
  useEffect(() => {
    const saved = loadMessages()
    setMessages(saved)
    const savedUsername = localStorage.getItem("user_chat_name")
    if (savedUsername) {
      setUsername(savedUsername)
      setShowUsernameForm(false)
    }
  }, [])

  // Auto scroll ke pesan terbaru
  useEffect(() => {
    messagesEndRef.current?.scrollIntoView({ behavior: "smooth" })
  }, [messages])

  // Set username
  const handleSetUsername = (e) => {
    e.preventDefault()
    if (username.trim()) {
      localStorage.setItem("user_chat_name", username)
      setShowUsernameForm(false)
    }
  }

  // Send message dari user
  const sendMessage = () => {
    if (!input.trim() || !username.trim()) return

    const newMessage = {
      id: Date.now(),
      sender: "user",
      username: username,
      text: input,
      timestamp: new Date().toISOString(),
      read: false
    }

    const updated = [...messages, newMessage]
    setMessages(updated)
    saveMessages(updated)
    setInput("")
  }

  // Admin reply ke message
  const replyMessage = () => {
    if (!adminReply.trim() || !selectedMessageId) return

    const updated = messages.map(msg => {
      if (msg.id === selectedMessageId) {
        return {
          ...msg,
          reply: {
            text: adminReply,
            timestamp: new Date().toISOString(),
            from: "Dr. Psikolog (Admin)"
          },
          read: true
        }
      }
      return msg
    })

    setMessages(updated)
    saveMessages(updated)
    setAdminReply("")
    setSelectedMessageId(null)
  }

  // Delete message
  const deleteMessage = (id) => {
    if (window.confirm("Hapus pesan ini?")) {
      const updated = messages.filter(msg => msg.id !== id)
      setMessages(updated)
      saveMessages(updated)
    }
  }

  // Clear all messages
  const clearAllMessages = () => {
    if (window.confirm("Hapus SEMUA pesan? Tindakan ini tidak bisa dibatalkan!")) {
      setMessages([])
      saveMessages([])
      setSelectedMessageId(null)
    }
  }

  const handleKeyPress = (e) => {
    if (e.key === "Enter" && !e.shiftKey) {
      e.preventDefault()
      sendMessage()
    }
  }

  // Count unread messages
  const unreadCount = messages.filter(m => !m.read).length

  if (showUsernameForm) {
    return (
      <Layout>
        <div className="min-h-screen bg-gradient-to-br from-blue-50 to-purple-50 flex items-center justify-center p-8">
          <div className="bg-white rounded-3xl shadow-2xl p-8 max-w-md w-full">
            <div className="text-center mb-8">
              <h1 className="text-4xl mb-2">💬</h1>
              <h2 className="text-3xl font-bold text-blue-600 mb-2">Selamat Datang</h2>
              <p className="text-slate-600">Sebelum mulai curhat, siapa nama Anda?</p>
            </div>

            <form onSubmit={handleSetUsername} className="space-y-6">
              <input
                type="text"
                value={username}
                onChange={(e) => setUsername(e.target.value)}
                placeholder="Masukkan nama Anda..."
                className="w-full p-4 border-2 border-blue-300 rounded-xl focus:ring-2 focus:ring-blue-400 focus:border-transparent outline-none"
                autoFocus
              />
              
              <button
                type="submit"
                className="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white py-4 rounded-xl font-semibold transition shadow-lg"
              >
                ➤ Lanjutkan
              </button>
            </form>

            <p className="text-center text-sm text-slate-500 mt-6">
              Nama Anda hanya untuk identitas dalam chat. Data pribadi Anda aman. 💚
            </p>
          </div>
        </div>
      </Layout>
    )
  }

  return (
    <Layout>
      <div className="h-screen flex flex-col bg-white">
        {/* HEADER */}
        <div className="bg-gradient-to-r from-blue-600 to-purple-600 text-white p-8 shadow-lg">
          <div className="flex justify-between items-start">
            <div>
              <h1 className="text-3xl font-bold mb-2">
                {isAdminMode ? "🔑 Panel Admin - Kelola Chat" : "💬 Curhat & Konsultasi"}
              </h1>
              <p className="text-blue-100">
                {isAdminMode 
                  ? "Balas pesan pengguna sebagai Psikolog"
                  : `Halo ${username}! Berbicara dengan Psikolog (Admin) - Aman & Terpercaya`
                }
              </p>
            </div>
            
            <div className="flex gap-3">
              {unreadCount > 0 && !isAdminMode && (
                <div className="bg-red-500 text-white px-4 py-2 rounded-full font-bold">
                  {unreadCount} Balasan Baru
                </div>
              )}
              
              <button
                onClick={() => {
                  setIsAdminMode(!isAdminMode)
                  setSelectedMessageId(null)
                }}
                className={`px-6 py-3 rounded-lg font-semibold transition ${
                  isAdminMode
                    ? "bg-red-500 hover:bg-red-600 text-white"
                    : "bg-blue-500 hover:bg-blue-600 text-white"
                }`}
              >
                {isAdminMode ? "🔓 Keluar Admin" : "🔐 Admin Panel"}
              </button>
            </div>
          </div>
        </div>

        {/* CHAT AREA */}
        <div className="flex-1 overflow-y-auto p-8 space-y-4 bg-slate-50">
          {messages.length === 0 ? (
            <div className="h-full flex items-center justify-center text-center">
              <div className="text-slate-400">
                <p className="text-5xl mb-4">💭</p>
                <p className="text-xl font-semibold mb-2">
                  {isAdminMode ? "Belum ada pesan" : "Mulai percakapan Anda"}
                </p>
                <p className="text-slate-500">
                  {isAdminMode 
                    ? "Tunggu pengguna mengirim pesan..." 
                    : "Bagikan cerita atau keluh kesah Anda dengan aman"
                  }
                </p>
              </div>
            </div>
          ) : (
            messages.map((message) => (
              <div key={message.id} className="space-y-3">
                {/* USER MESSAGE */}
                <div className={`flex ${isAdminMode ? "justify-start" : "justify-end"}`}>
                  <div
                    className={`max-w-2xl p-5 rounded-2xl ${
                      isAdminMode
                        ? "bg-blue-100 border-2 border-blue-300"
                        : "bg-blue-600 text-white"
                    }`}
                  >
                    {isAdminMode && (
                      <p className="text-sm font-bold mb-2 text-blue-900">
                        👤 {message.username}
                      </p>
                    )}
                    <p className="leading-relaxed whitespace-pre-wrap">{message.text}</p>
                    <p className={`text-xs mt-2 ${isAdminMode ? "text-blue-700" : "text-blue-100"}`}>
                      {new Date(message.timestamp).toLocaleString("id-ID")}
                    </p>

                    {isAdminMode && (
                      <div className="flex gap-2 mt-3">
                        <button
                          onClick={() => setSelectedMessageId(message.id)}
                          className={`px-4 py-2 rounded-lg font-semibold transition text-sm ${
                            selectedMessageId === message.id
                              ? "bg-purple-600 text-white"
                              : "bg-blue-300 text-blue-900 hover:bg-blue-400"
                          }`}
                        >
                          💬 Balas
                        </button>
                        <button
                          onClick={() => deleteMessage(message.id)}
                          className="px-4 py-2 bg-red-300 hover:bg-red-400 text-red-900 rounded-lg font-semibold transition text-sm"
                        >
                          🗑️ Hapus
                        </button>
                      </div>
                    )}
                  </div>
                </div>

                {/* ADMIN REPLY */}
                {message.reply && (
                  <div className="flex justify-start">
                    <div className="max-w-2xl p-5 rounded-2xl bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-bl-none">
                      <p className="text-sm font-bold mb-2">🟣 {message.reply.from}</p>
                      <p className="leading-relaxed whitespace-pre-wrap">{message.reply.text}</p>
                      <p className="text-xs mt-2 text-purple-100">
                        {new Date(message.reply.timestamp).toLocaleString("id-ID")}
                      </p>
                    </div>
                  </div>
                )}

                {/* NO REPLY YET */}
                {!message.reply && !isAdminMode && (
                  <div className="flex justify-center">
                    <p className="text-sm text-slate-500 italic">⏳ Menunggu balasan psikolog...</p>
                  </div>
                )}
              </div>
            ))
          )}

          <div ref={messagesEndRef} />
        </div>

        {/* INPUT AREA */}
        <div className="p-8 bg-white border-t-2 border-slate-200">
          <div className="max-w-4xl mx-auto space-y-4">
            {isAdminMode ? (
              // ADMIN REPLY FORM
              <>
                {selectedMessageId ? (
                  <>
                    <div className="bg-purple-50 border-2 border-purple-200 p-4 rounded-xl">
                      <p className="text-sm font-semibold text-purple-900 mb-2">📝 Balas Pesan:</p>
                      <div className="bg-white p-3 rounded-lg border-l-4 border-purple-600">
                        <p className="text-slate-700 text-sm">
                          {messages.find(m => m.id === selectedMessageId)?.text}
                        </p>
                      </div>
                    </div>

                    <textarea
                      value={adminReply}
                      onChange={(e) => setAdminReply(e.target.value)}
                      onKeyPress={handleKeyPress}
                      placeholder="Tulis balasan profesional sebagai psikolog..."
                      rows="4"
                      className="w-full p-4 border-2 border-purple-300 rounded-xl focus:ring-2 focus:ring-purple-400 focus:border-transparent outline-none resize-none"
                      autoFocus
                    />

                    <div className="flex gap-3">
                      <button
                        onClick={replyMessage}
                        disabled={!adminReply.trim()}
                        className="flex-1 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 disabled:opacity-50 disabled:cursor-not-allowed text-white px-8 py-4 rounded-xl font-semibold transition shadow-lg"
                      >
                        ✓ Kirim Balasan
                      </button>
                      <button
                        onClick={() => {
                          setSelectedMessageId(null)
                          setAdminReply("")
                        }}
                        className="bg-slate-300 hover:bg-slate-400 text-slate-900 px-8 py-4 rounded-xl font-semibold transition"
                      >
                        Batal
                      </button>
                    </div>
                  </>
                ) : (
                  <div className="bg-slate-100 border-2 border-slate-300 p-6 rounded-xl text-center">
                    <p className="text-slate-600">👆 Pilih pesan untuk dibalas</p>
                  </div>
                )}

                <div className="flex gap-3 pt-4 border-t-2 border-slate-200">
                  <button
                    onClick={clearAllMessages}
                    className="flex-1 bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-xl font-semibold transition"
                  >
                    🗑️ Hapus Semua Pesan
                  </button>
                </div>
              </>
            ) : (
              // USER MESSAGE FORM
              <>
                <div className="bg-blue-50 border-2 border-blue-200 p-4 rounded-xl flex items-center gap-3">
                  <span className="text-2xl">💡</span>
                  <p className="text-sm text-blue-900">
                    <strong>Tips:</strong> Bagikan perasaan Anda dengan detail. Semakin detail, semakin baik kami memahami dan membantu Anda. Psikolog kami akan membaca dan membalas secepatnya. 💚
                  </p>
                </div>

                <div className="flex gap-3">
                  <textarea
                    value={input}
                    onChange={(e) => setInput(e.target.value)}
                    onKeyPress={handleKeyPress}
                    placeholder="Bagikan cerita, perasaan, atau keluh kesah Anda di sini..."
                    rows="3"
                    className="flex-1 p-4 border-2 border-blue-300 rounded-xl focus:ring-2 focus:ring-blue-400 focus:border-transparent outline-none resize-none"
                  />
                  <button
                    onClick={sendMessage}
                    disabled={!input.trim()}
                    className="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 disabled:opacity-50 disabled:cursor-not-allowed text-white px-8 py-4 rounded-xl font-semibold transition self-end shadow-lg"
                  >
                    ➤ Kirim
                  </button>
                </div>

                <p className="text-sm text-slate-500 text-center">
                  Nama: <strong>{username}</strong> | <button onClick={() => {
                    localStorage.removeItem("user_chat_name")
                    setShowUsernameForm(true)
                  }} className="text-blue-600 hover:underline">Ganti Nama</button>
                </p>
              </>
            )}
          </div>
        </div>
      </div>

      <style jsx>{`
        @keyframes fadeIn {
          from {
            opacity: 0;
            transform: translateY(10px);
          }
          to {
            opacity: 1;
            transform: translateY(0);
          }
        }
        
        .animate-fadeIn {
          animation: fadeIn 0.3s ease-out;
        }
      `}</style>
    </Layout>
  )
}
