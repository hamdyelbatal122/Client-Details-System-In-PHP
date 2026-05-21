# ⚡ DevForge — Premium PHP Developer Workspace

[![PHP Version](https://img.shields.io/badge/PHP-%E2%89%A5%208.0-777bb4.svg?style=for-the-badge&logo=php)](https://www.php.net)
[![Database](https://img.shields.io/badge/Database-SQLite-003b57.svg?style=for-the-badge&logo=sqlite)](https://www.sqlite.org)
[![Aesthetics](https://img.shields.io/badge/Design-Glassmorphism-blueviolet.svg?style=for-the-badge)](https://en.wikipedia.org/wiki/Glassmorphism)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)](LICENSE)

**DevForge** is a state-of-the-art, self-hosted developer workspace built entirely in modern PHP 8+. It bundles the most essential daily developer tools — REST client, uptime monitoring, JWT analysis, cryptography lab, and a live SQL runner — into a single zero-dependency, glassmorphic dark-mode application.

No frameworks. No Composer. Just PHP 8 and your browser.

---

## ✨ Feature Set

### 📈 Uptime & Service Monitor
- Live HTTP health checks for APIs, websites, and microservices
- Persistent SQLite storage for all monitored targets
- Displays HTTP status code, latency (ms), and last-check timestamp
- Smooth animated status cards (UP / DOWN / UNKNOWN)

### 🚀 API REST Client
- Full HTTP request builder: `GET`, `POST`, `PUT`, `DELETE`, `PATCH`
- Dynamic custom headers editor
- JSON / raw request body support
- Formatted response viewer with syntax-highlighted JSON output, status code badge, and round-trip time

### 🛡️ Hash & Cryptography Lab
- **BCrypt**: Generate secure password hashes with configurable cost factor; verify plaintext against stored hash
- **AES-256-CBC**: Symmetric encrypt and decrypt any string using a passphrase key

### 🔑 JWT Token Decoder
- Paste any JWT and instantly decode the Header, Payload claims, and Signature
- Color-coded output for quick scanning of token contents

### 📝 JSON Prettifier & Validator
- One-click JSON beautifier with indented, readable output
- Live syntax error detection and validation messages
- JSON minifier for compact production configs

### 💾 SQL Query Runner
- Direct SQLite playground connected to the DevForge database
- Execute any `SELECT`, `INSERT`, `UPDATE`, `DELETE` statement
- Dynamic HTML table output for `SELECT` results; row-count feedback for write operations

---

## 🎨 Design System

- **Glassmorphic surfaces** — semi-transparent, blur-backed panels (`backdrop-filter`)
- **Curated dark palette** — deep space backgrounds with indigo, emerald, and amber accents
- **Premium typography** — Inter for UI, JetBrains Mono for code and response blocks
- **Micro-animations** — smooth CSS transforms on hover, status refresh, and tab transitions
- **Custom scrollbars** — styled to match the dark theme

---

## ⚙️ Quick Start

**Requirements:** PHP 8.0+ with `pdo_sqlite`, `curl`, and `openssl` extensions (all enabled by default in modern PHP builds).

```bash
# 1. Clone the repo
git clone https://github.com/hamdyelbatal122/devforge.git
cd devforge

# 2. Start the built-in PHP server
php -S localhost:8000

# 3. Open in your browser
open http://localhost:8000
```

The SQLite database (`db/devforge.sqlite`) is created automatically on first run with three seed monitors pre-loaded.

---

## 📂 Project Structure

```
devforge/
├── index.php       # Single-page SPA shell — all UI, styles, and JS
├── api.php         # JSON API backend — handles all AJAX actions
├── config.php      # App config, SQLite init, and seed data
├── .gitignore      # Excludes db/*.sqlite from version control
└── db/
    └── devforge.sqlite   # Auto-created SQLite database (git-ignored)
```

---

## 🔒 Security Notes

- All SQL parameters are bound via PDO prepared statements — no injection vectors
- AES-256-CBC encryption uses SHA-256 key derivation on the passphrase
- BCrypt cost factor is configurable (8–14) to balance security and performance
- SSL peer verification is disabled by design for the API client (local dev tool)

---

## 📜 License

[MIT](LICENSE) — Hamdy Elbatal
