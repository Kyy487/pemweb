import { Link, useLocation } from "react-router-dom"

export default function Layout({ children }) {
  const location = useLocation()

  const menu = [
    { to: "/dashboard", label: "🏠 Beranda" },
    { to: "/story", label: "✍ Cerita" },
    { to: "/chat", label: "💬 Curhat" },
    { to: "/healing", label: "🌱 Pulih" },
    { to: "/education", label: "📖 Edukasi" },
  ]

  return (
    <div className="flex h-screen bg-gradient-to-br from-slate-100 to-blue-50 text-slate-800">
      {/* SIDEBAR */}
      <aside className="w-64 bg-white/90 backdrop-blur-xl border-r border-slate-200 shadow-2xl flex flex-col justify-between sticky top-0">
        <div>
          <div className="p-6 text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent tracking-wider flex items-center gap-2">
            🌿 <span>RuangPulih</span>
          </div>

          <nav className="px-4 space-y-2 mt-4">
            {menu.map((item) => (
              <Link
                key={item.to}
                to={item.to}
                className={`block px-4 py-3 rounded-xl transition-all duration-300 transform ${
                  location.pathname === item.to
                    ? "bg-gradient-to-r from-blue-600 to-purple-600 text-white shadow-lg scale-105"
                    : "text-slate-600 hover:bg-blue-50 hover:text-blue-600 hover:scale-102"
                }`}
              >
                {item.label}
              </Link>
            ))}
          </nav>
        </div>

        <div className="p-4 border-t border-slate-200">
          <Link
            to="/"
            className="block text-center bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white py-3 rounded-xl transition shadow-lg hover:shadow-xl transform hover:scale-105"
          >
            🚪 Logout
          </Link>
        </div>
      </aside>

      {/* MAIN CONTENT */}
      <main className="flex-1 overflow-y-auto">
        {children}
      </main>
    </div>
  )
}
