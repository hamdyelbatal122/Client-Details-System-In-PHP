# ⚡ DevSuite — Premium PHP Developer Dashboard & Workspace

[![PHP Version](https://img.shields.io/badge/PHP-%E2%89%A5%208.0-777bb4.svg?style=for-the-badge&logo=php)](https://www.php.net)
[![Database](https://img.shields.io/badge/Database-SQLite-003b57.svg?style=for-the-badge&logo=sqlite)](https://www.sqlite.org)
[![Aesthetics](https://img.shields.io/badge/Aesthetics-Glassmorphism-blueviolet.svg?style=for-the-badge)](https://en.wikipedia.org/wiki/Glassmorphism)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)](LICENSE)

DevSuite is a state-of-the-art, high-performance, and beautifully crafted developer workspace designed to streamline daily workflows. It bundles core developer utilities, custom REST clients, cryptographic tools, and uptime monitoring services into a single lightweight, zero-dependency, glassmorphic dark-mode PHP application.

---

## ✨ Features

### 📈 Uptime & API Service Monitor
* Live health tracking of microservices, APIs, databases, and third-party integrations.
* Persistent SQLite database storage for monitored targets.
* Displays response time (roundtrip latency) and HTTP status indicators.
* Interactive card grid with smooth status updating animations.

### 🚀 API REST Client
* Modern visual request builder to run, test, and debug HTTP calls (`GET`, `POST`, `PUT`, `DELETE`, etc.).
* Custom HTTP Headers editor.
* Integrated JSON request body compiler.
* Formatted syntax-highlighted response browser displaying response size, latency, HTTP status, and headers.

### 🛡️ Crypto & Cipher Lab
* **BCrypt Suite**: Fast secure password hashing and verification with configurable work/cost factor.
* **AES-256 Symmetric Suite**: Advanced symmetric encryption and decryption of raw text using strong secret-key derivations (AES-256-CBC).

### 🔑 JWT Decoder
* Fast JSON Web Token (JWT) analyzer.
* Decodes and displays token parts (Header, Claims/Payload, and Signature) instantly with beautiful structured coloring.

### 📝 JSON Prettifier & Minifier
* Beautifies complex JSON structures with collapsible syntax indentations.
* One-click validation and JSON syntax error detection.
* Lightweight JSON minimizer to compress configurations for production.

### 💾 SQL Query Runner
* Lightweight direct SQLite workspace database interface.
* Safe SQL playground with dynamic HTML outputs and detailed execution times.

---

## 🎨 Visual Design Systems
* **Glassmorphic Surface Design**: Semi-transparent, blur-backed surface containers (`backdrop-filter`) creating premium layered interfaces.
* **Curated Dark Color Palette**: Slate and deep space backgrounds with neon indigo, emerald green, and soft amber highlighting badges.
* **Custom Typography**: Premium standard Inter for interfaces and JetBrains Mono for system responses and code blocks.
* **Interactive Micro-Animations**: Smooth, responsive CSS transform actions on clicks, hovers, and status refreshes.

---

## ⚙️ Quick Installation

Getting DevSuite up and running is incredibly simple:

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/hamdyelbatal122/Client-Details-System-In-PHP.git
   cd Client-Details-System-In-PHP
   ```

2. **Run Dev Server**:
   Start PHP's built-in web server directly from your terminal:
   ```bash
   php -S localhost:8000
   ```

3. **Open Workspace**:
   Navigate to [http://localhost:8000](http://localhost:8000) on your favorite browser!

---

## 📂 Architecture Structure

```
├── config.php            # Core configs, DB init, and auto-seeding
├── api.php               # Backend JSON API endpoints (curl, SQL, crypto)
├── index.php             # Core router and gorgeous front-end SPA dashboard
├── db/
│   └── devsuite.sqlite   # SQLite self-contained database
└── README.md             # Technical overview
```

---

## 🔒 Security Principles
* Built on strictly pure, secure PHP standard features without heavy, bloated dependencies.
* Safe, query statement parameters binding prevents SQLite injection vectors in the SQL Playground.
* Robust SSL verification bypass options designed strictly for convenient local development and API testing environments.

---

## 📜 License
DevSuite is open-source software licensed under the [MIT License](LICENSE) — Hamdy Elbatal.
