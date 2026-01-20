# 🚀 Quick Reference - RuangPulih Developer Guide

## 📁 Project Structure

```
frontend/
├── src/
│   ├── components/
│   │   └── Layout.jsx          ← REUSABLE LAYOUT (sidebar & main)
│   ├── pages/
│   │   ├── Landing.jsx         ← Welcome page
│   │   ├── Login.jsx           ← Login page
│   │   ├── Register.jsx        ← Register page
│   │   ├── Dashboard.jsx       ← 🌟 ENHANCED (cards, stats, tips)
│   │   ├── Cerita.jsx          ← 🌟 NEW (story + admin panel)
│   │   ├── Chat.jsx            ← 🌟 ENHANCED (intelligent bot)
│   │   ├── Healing.jsx         ← 🌟 ENHANCED (2 categories, 6 steps)
│   │   └── Education.jsx       ← 🌟 ENHANCED (10 articles)
│   ├── App.jsx                 ← Main router
│   ├── main.jsx                ← Entry point
│   └── index.css               ← Global styles
├── public/
│   ├── music/
│   ├── team/
│   └── videos/
├── package.json
├── tailwind.config.js
├── vite.config.js
└── eslint.config.js
```

---

## 🎯 File Modifications Summary

### NEW FILES:
1. **`src/components/Layout.jsx`** (60 lines)
   - Reusable sidebar + layout component
   - Used by all pages
   - Sticky sidebar with gradient

### UPDATED FILES:
1. **`src/pages/Dashboard.jsx`** (200 lines)
   - Quote card
   - Stats cards
   - Quick actions
   - Resources
   - Tips
   - Warning signs

2. **`src/pages/Cerita.jsx`** (250 lines)
   - Write stories
   - localStorage save/load
   - Edit/delete functionality
   - Admin panel view

3. **`src/pages/Chat.jsx`** (220 lines)
   - Intelligent bot responses
   - Message display
   - Auto-scroll
   - Typing indicator

4. **`src/pages/Healing.jsx`** (350 lines)
   - Category toggle
   - 6-step guides (2 categories)
   - Mindfulness techniques
   - Journal prompts
   - Affirmations
   - Crisis support

5. **`src/pages/Education.jsx`** (400 lines)
   - 10 expandable articles
   - Expert attribution
   - Key takeaways
   - Resource recommendations

---

## 🎨 Component Architecture

### Layout Component
```jsx
<Layout>
  <div className="content">
    {children}
  </div>
</Layout>
```

All pages wrap content dengan `Layout` component untuk consistent navigation.

### Page Structure Pattern
```jsx
import Layout from "../components/Layout"

export default function PageName() {
  return (
    <Layout>
      <div className="p-10 space-y-8 max-w-7xl mx-auto">
        {/* Content here */}
      </div>
    </Layout>
  )
}
```

---

## 🔑 Key Features Implementation

### Dashboard
```jsx
const motivationalQuotes = [...]
const [quote] = useState(motiv...random)

// Components:
<StatCard />
<QuickActionButton />
<ResourceCard />
<TipItem />
<WarningItem />
```

### Cerita (Story)
```jsx
// localStorage operations
const saved = localStorage.getItem("user_stories")
setStories(JSON.parse(saved))

// Save
localStorage.setItem("user_stories", JSON.stringify(updated))

// Admin view toggle
{showAdmin ? <AdminView /> : <UserView />}
```

### Chat
```jsx
const botResponses = {
  bullying: [...],
  family: [...],
  emotion: [...],
  general: [...]
}

function getBotResponse(message) {
  // Detect topic and return appropriate response
}
```

### Healing
```jsx
const healingCategories = {
  bullying: { steps: [...] },
  family: { steps: [...] }
}

// Expandable steps
{isExpanded && <StepDetails />}
```

### Education
```jsx
const educationSections = [
  { id: 1, title: "...", content: "...", expert: "..." },
  // ... 10 articles
]

// Expandable articles
{expandedId === section.id && <FullContent />}
```

---

## 🎨 Styling Patterns

### Tailwind Classes Used:
```
Layout:
- Flexbox: flex, flex-col, justify-between, items-center
- Grid: grid-cols-1, md:grid-cols-2, lg:grid-cols-3+
- Spacing: p-6, p-8, p-10, gap-4, gap-6, space-y-4, space-y-8
- Max-width: max-w-3xl, max-w-5xl, max-w-7xl
- Sticky: sticky, top-0, top-8

Colors:
- Blue: bg-blue-600, text-blue-600, from-blue-400, to-blue-600
- Purple: from-purple-600, to-purple-600
- Gradients: from-X via-Y to-Z
- Text: text-slate-800, text-slate-500, text-white

Effects:
- Shadows: shadow-md, shadow-lg, shadow-xl, shadow-2xl
- Hover: hover:shadow-xl, hover:scale-105
- Transitions: transition, transition duration-300
- Rounded: rounded-lg, rounded-xl, rounded-2xl, rounded-3xl
- Borders: border-2, border-l-4, border-blue-200, border-red-300

Responsive:
- Mobile: no prefix (default)
- Tablet: md: prefix
- Desktop: lg: prefix
```

### Common Component Classes:
```jsx
// Card style
<div className="bg-white rounded-2xl shadow-lg p-8 border-l-4 border-blue-500">

// Button style
<button className="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-8 py-4 rounded-xl font-semibold transition shadow-lg">

// Section title
<h2 className="text-2xl font-bold text-slate-800 mb-6">

// Info box
<div className="bg-blue-50 border-2 border-blue-200 p-4 rounded-xl">
```

---

## 💾 Data Management

### localStorage API:
```javascript
// Save
localStorage.setItem("key", JSON.stringify(data))

// Load
const data = JSON.parse(localStorage.getItem("key"))

// Delete
localStorage.removeItem("key")

// Clear all
localStorage.clear()
```

### Current Storage:
```
Key: "user_stories"
Value: [
  {
    id: timestamp,
    text: "story content",
    date: "formatted date",
    mood: "emoji"
  }
]
```

---

## 🔄 State Management

### React Hooks Used:
```jsx
// State
const [stories, setStories] = useState([])
const [expandedId, setExpandedId] = useState(null)

// Effects
useEffect(() => {
  // Load dari localStorage saat mount
  const saved = localStorage.getItem("user_stories")
  if (saved) setStories(JSON.parse(saved))
}, [])

// Refs
const messagesEndRef = useRef(null)
useEffect(() => {
  // Auto-scroll ke ref
  messagesEndRef.current?.scrollIntoView({ behavior: "smooth" })
}, [messages])
```

---

## 🎯 Development Tips

### Adding New Feature:
1. Create file di `src/pages/`
2. Import Layout component
3. Wrap content dengan `<Layout>`
4. Add route di `App.jsx`
5. Add menu item di `Layout.jsx`

### Styling Guide:
1. Use Tailwind classes (no custom CSS needed)
2. Maintain spacing consistency (p-6 to p-10)
3. Use color palette (blue, purple, green, red)
4. Add hover effects (scale-105, shadow-xl)
5. Implement responsive design (mobile-first)

### Component Reusability:
```jsx
// Extract repeated JSX into components
function StatCard({ title, value, icon, color }) {
  return <div>...</div>
}

// Use in multiple places
<StatCard title="Cerita" value="5" icon="✍" color="from-blue-400" />
```

---

## 🚀 Build & Deploy

### Development:
```bash
npm run dev
# Access at http://localhost:5174
```

### Production Build:
```bash
npm run build
# Output: dist/ folder
```

### Preview Build:
```bash
npm run preview
# Preview production build locally
```

### Lint Check:
```bash
npm run lint
# Check for code quality issues
```

---

## 📊 Performance Tips

1. **Component Splitting** - Break large components into smaller ones
2. **Lazy Loading** - Use React.lazy() for route-based code splitting
3. **Memoization** - Use React.memo() untuk expensive components
4. **Event Delegation** - Use event bubbling instead of many listeners
5. **CSS Classes** - Keep CSS classes organized in Tailwind
6. **Image Optimization** - Optimize images untuk web
7. **Bundle Size** - Monitor bundle size dengan vite plugins

---

## 🐛 Debugging

### Browser DevTools:
1. **React DevTools** - Inspect component hierarchy
2. **Redux DevTools** - Not used (using useState)
3. **Network Tab** - Check localStorage operations
4. **Console** - Check for errors/warnings

### localStorage Debugging:
```javascript
// View all localStorage
console.log(localStorage)

// Get specific key
console.log(localStorage.getItem("user_stories"))

// View as parsed JSON
console.log(JSON.parse(localStorage.getItem("user_stories")))
```

### Common Issues:
```
Issue: Cerita tidak tersimpan
Solution: Check localStorage.setItem() dipanggil dengan benar

Issue: Chat tidak merespons
Solution: Check getBotResponse() function logic

Issue: Layout tidak muncul
Solution: Ensure page wrapped dengan <Layout> component

Issue: Styling tidak terlihat
Solution: Check Tailwind classes dan browser cache (hard refresh)
```

---

## 📚 Documentation Files

1. **IMPROVEMENTS.md** - Feature-by-feature breakdown
2. **FEATURES.md** - Complete feature list dengan workflows
3. **USER_GUIDE.md** - End-user documentation
4. **SUMMARY_IMPROVEMENTS.md** - Executive summary
5. **README_COMPLETION.md** - Completion checklist
6. **QUICK_REFERENCE.md** - This file!

---

## 🎯 Code Quality Standards

### Maintained:
✅ No console errors
✅ No TypeScript/Syntax warnings
✅ Clean code structure
✅ Consistent naming convention
✅ Proper component organization
✅ Reusable components
✅ Accessible HTML structure
✅ Responsive design
✅ Performance optimized

### Not Used (Kept Simple):
❌ Redux / Context API (useState sufficient)
❌ TypeScript (plain JavaScript)
❌ Custom CSS (Tailwind only)
❌ External UI libraries (Tailwind components)
❌ Form libraries (Vanilla forms)

---

## 🔐 Security Considerations

### Current:
✅ No authentication implemented (assume login exists)
✅ localStorage is browser-based (limited scope)
✅ No external API calls
✅ No sensitive data exposed

### Future Enhancements:
- Implement JWT authentication
- Hash sensitive data
- Use environment variables
- Implement CORS properly
- Add input validation
- Sanitize user input

---

## 📞 Support & Maintenance

### Regular Maintenance:
- Update dependencies: `npm update`
- Check for vulnerabilities: `npm audit`
- Test responsive design
- Clear browser cache periodically
- Monitor performance

### Bug Reports:
- Check browser console for errors
- Test in multiple browsers
- Check localStorage state
- Review Network tab for failed requests

---

## ✨ Pro Tips

1. **Use browser DevTools Elements tab** to inspect responsive behavior
2. **Use React DevTools** to track state changes
3. **Clear localStorage** if data seems corrupted: `localStorage.clear()`
4. **Hard refresh browser** (Ctrl+Shift+R) untuk clear cache
5. **Test on mobile** using browser device emulation
6. **Check console** sebelum merasa ada bug
7. **Use CSS Grid** untuk complex layouts
8. **Use Flexbox** untuk simple layouts
9. **Keep components small** untuk easier maintenance
10. **Comment complex logic** untuk future reference

---

## 🎓 Learning Resources

### Tailwind CSS:
- https://tailwindcss.com/docs
- https://ui.shadcn.com/ (component inspiration)

### React:
- https://react.dev/
- https://react.dev/learn

### Vite:
- https://vitejs.dev/guide/

### localStorage:
- https://developer.mozilla.org/en-US/docs/Web/API/Window/localStorage

---

**Happy Coding!** 💚🌿

*Last Updated: January 20, 2026*
*Version: 2.0*
