<?php
// index.php
// DevForge — Premium PHP Developer Workspace
require_once __DIR__ . '/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevForge — Premium Developer Workspace</title>
    <!-- Google Fonts & FontAwesome -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --bg: #070b13;
            --surface: rgba(13, 20, 38, 0.65);
            --surface-hover: rgba(22, 33, 62, 0.85);
            --border: rgba(255, 255, 255, 0.06);
            --border-active: rgba(99, 102, 241, 0.4);
            --text: #f3f4f6;
            --text-muted: #9ca3af;
            --text-subtle: #6b7280;
            --primary: #6366f1;
            --primary-glow: rgba(99, 102, 241, 0.15);
            --success: #10b981;
            --success-glow: rgba(16, 185, 129, 0.15);
            --danger: #f43f5e;
            --danger-glow: rgba(244, 63, 94, 0.15);
            --warning: #f59e0b;
            --font-sans: 'Inter', system-ui, sans-serif;
            --font-mono: 'JetBrains Mono', monospace;
            --sidebar-width: 260px;
            --radius: 12px;
            --radius-lg: 16px;
            --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: var(--font-sans);
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            overflow-x: hidden;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(99, 102, 241, 0.05) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(139, 92, 246, 0.04) 0%, transparent 40%);
            background-attachment: fixed;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.2);
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* --- SIDEBAR --- */
        .sidebar {
            width: var(--sidebar-width);
            background: rgba(7, 10, 19, 0.8);
            border-right: 1px solid var(--border);
            backdrop-filter: blur(20px);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
        }

        .sidebar-brand {
            padding: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid var(--border);
        }

        .brand-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--primary), #8b5cf6);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: #fff;
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.4);
        }

        .brand-name {
            font-weight: 700;
            font-size: 1.25rem;
            letter-spacing: -0.5px;
            background: linear-gradient(135deg, #fff, #a5b4fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .sidebar-menu {
            list-style: none;
            padding: 20px 12px;
            display: flex;
            flex-direction: column;
            gap: 6px;
            flex: 1;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: var(--radius);
            font-weight: 500;
            font-size: 0.92rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .menu-item i {
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
            transition: var(--transition);
        }

        .menu-item:hover {
            color: var(--text);
            background: rgba(255, 255, 255, 0.03);
        }

        .menu-item.active {
            color: #fff;
            background: var(--primary-glow);
            border: 1px solid var(--border-active);
            box-shadow: inset 0 0 12px rgba(99, 102, 241, 0.05);
        }

        .menu-item.active i {
            color: #818cf8;
            text-shadow: 0 0 10px rgba(99, 102, 241, 0.5);
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid var(--border);
            font-size: 0.78rem;
            color: var(--text-subtle);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* --- MAIN CONTENT --- */
        .main-container {
            margin-left: var(--sidebar-width);
            flex: 1;
            padding: 40px;
            max-width: 1400px;
            width: calc(100% - var(--sidebar-width));
        }

        header {
            margin-bottom: 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-title h1 {
            font-size: 1.8rem;
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 4px;
        }

        .header-title p {
            color: var(--text-muted);
            font-size: 0.92rem;
        }

        .tab-content {
            display: none;
            animation: fadeIn 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .tab-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* --- PREMIUM COMPONENTS --- */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 24px;
            backdrop-filter: blur(12px);
            margin-bottom: 24px;
            transition: var(--transition);
        }

        .card:hover {
            border-color: rgba(255, 255, 255, 0.1);
            background: var(--surface-hover);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-title i {
            color: var(--primary);
        }

        /* Forms & Inputs */
        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .input-row {
            display: flex;
            gap: 12px;
        }

        input[type="text"],
        input[type="url"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 12px 16px;
            color: var(--text);
            font-family: inherit;
            font-size: 0.92rem;
            outline: none;
            transition: var(--transition);
        }

        input:focus, select:focus, textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 15px var(--primary-glow);
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: var(--radius);
            font-weight: 600;
            font-size: 0.92rem;
            cursor: pointer;
            border: 1px solid transparent;
            transition: var(--transition);
            white-space: nowrap;
        }

        .btn-primary {
            background: var(--primary);
            color: #fff;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }

        .btn-primary:hover {
            background: #4f46e5;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.05);
            border-color: var(--border);
            color: var(--text);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .btn-danger {
            background: var(--danger);
            color: #fff;
            box-shadow: 0 4px 15px rgba(244, 63, 94, 0.3);
        }

        .btn-danger:hover {
            background: #e11d48;
            transform: translateY(-1px);
        }

        .btn-sm {
            padding: 8px 14px;
            font-size: 0.8rem;
            border-radius: 8px;
        }

        /* --- MONITORS GRID --- */
        .monitors-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
        }

        .monitor-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 20px;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            gap: 16px;
            transition: var(--transition);
        }

        .monitor-card:hover {
            border-color: var(--border-active);
            transform: translateY(-2px);
        }

        .monitor-status-indicator {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--text-subtle);
        }

        .monitor-card.status-UP .monitor-status-indicator {
            background: var(--success);
            box-shadow: 0 1px 10px var(--success);
        }

        .monitor-card.status-DOWN .monitor-status-indicator {
            background: var(--danger);
            box-shadow: 0 1px 10px var(--danger);
        }

        .monitor-meta {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .monitor-name {
            font-weight: 700;
            font-size: 1.05rem;
            margin-bottom: 4px;
        }

        .monitor-url {
            color: var(--text-muted);
            font-size: 0.8rem;
            word-break: break-all;
            display: block;
        }

        .status-badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .status-badge.UNKNOWN { background: rgba(255, 255, 255, 0.05); color: var(--text-muted); }
        .status-badge.UP { background: var(--success-glow); color: var(--success); border: 1px solid rgba(16, 185, 129, 0.2); }
        .status-badge.DOWN { background: var(--danger-glow); color: var(--danger); border: 1px solid rgba(244, 63, 94, 0.2); }

        .monitor-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            background: rgba(0, 0, 0, 0.15);
            padding: 12px;
            border-radius: var(--radius);
            font-size: 0.8rem;
        }

        .stat-box span {
            display: block;
            color: var(--text-muted);
            font-size: 0.7rem;
            margin-bottom: 2px;
            text-transform: uppercase;
        }

        .stat-box font {
            font-weight: 600;
            color: #fff;
        }

        .monitor-actions {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            border-top: 1px solid var(--border);
            padding-top: 12px;
        }

        /* --- API TESTER SPECIFICS --- */
        .api-tester-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        @media (max-width: 1024px) {
            .api-tester-container {
                grid-template-columns: 1fr;
            }
        }

        .api-method-select {
            width: 130px;
            font-weight: 700;
            background: var(--primary-glow);
            border-color: var(--border-active);
            color: #a5b4fc;
        }

        .key-value-row {
            display: flex;
            gap: 10px;
            margin-bottom: 8px;
        }

        .editor-container {
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
        }

        .response-meta {
            display: flex;
            gap: 16px;
            margin-bottom: 12px;
            font-size: 0.85rem;
        }

        .response-meta-badge {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid var(--border);
            padding: 6px 12px;
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .code-box {
            background: #04060b;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 16px;
            font-family: var(--font-mono);
            font-size: 0.85rem;
            line-height: 1.5;
            overflow-x: auto;
            max-height: 450px;
            white-space: pre-wrap;
        }

        /* --- UTILITY TABS --- */
        .grid-two {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        @media (max-width: 768px) {
            .grid-two {
                grid-template-columns: 1fr;
            }
        }

        /* Glow effects for success / status alerts */
        .alert-box {
            padding: 12px 16px;
            border-radius: var(--radius);
            font-size: 0.9rem;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .alert-success { background: var(--success-glow); color: var(--success); border: 1px solid rgba(16, 185, 129, 0.2); }
        .alert-danger { background: var(--danger-glow); color: var(--danger); border: 1px solid rgba(244, 63, 94, 0.2); }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">
                <i class="fa-solid fa-layer-group"></i>
            </div>
            <span class="brand-name"><?= APP_NAME ?></span>
        </div>
        
        <ul class="sidebar-menu">
            <li>
                <div class="menu-item active" onclick="switchTab('uptime', this)">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>Uptime Monitor</span>
                </div>
            </li>
            <li>
                <div class="menu-item" onclick="switchTab('api-client', this)">
                    <i class="fa-solid fa-paper-plane"></i>
                    <span>API Client</span>
                </div>
            </li>
            <li>
                <div class="menu-item" onclick="switchTab('json-tool', this)">
                    <i class="fa-solid fa-code"></i>
                    <span>JSON Prettifier</span>
                </div>
            </li>
            <li>
                <div class="menu-item" onclick="switchTab('jwt-decoder', this)">
                    <i class="fa-solid fa-key"></i>
                    <span>JWT Decoder</span>
                </div>
            </li>
            <li>
                <div class="menu-item" onclick="switchTab('hash-lab', this)">
                    <i class="fa-solid fa-shield-halved"></i>
                    <span>Hash & Crypt Lab</span>
                </div>
            </li>
            <li>
                <div class="menu-item" onclick="switchTab('db-explorer', this)">
                    <i class="fa-solid fa-database"></i>
                    <span>DB Query Runner</span>
                </div>
            </li>
        </ul>
        
        <div class="sidebar-footer">
            <span>v<?= APP_VERSION ?></span>
            <span style="display:flex;align-items:center;gap:4px;"><i class="fa-solid fa-circle" style="color:var(--success);font-size:0.5rem;"></i> System Active</span>
        </div>
    </aside>

    <!-- MAIN CONTAINER -->
    <main class="main-container">
        
        <!-- UPTIME MONITOR TAB -->
        <div id="uptime" class="tab-content active">
            <header>
                <div class="header-title">
                    <h1>Uptime & Service Monitor</h1>
                    <p>Live health monitoring for websites, APIs, and microservices.</p>
                </div>
                <button class="btn btn-primary" onclick="openAddMonitorModal()">
                    <i class="fa-solid fa-plus"></i> Add Service
                </button>
            </header>

            <!-- Add Monitor Widget -->
            <div id="add-monitor-widget" class="card" style="display:none; animation: fadeIn 0.25s ease;">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa-solid fa-circle-plus"></i> Register New Target</h3>
                    <button class="btn btn-secondary btn-sm" onclick="closeAddMonitorModal()"><i class="fa-solid fa-times"></i></button>
                </div>
                <div class="grid-two" style="gap:15px; margin-bottom:15px;">
                    <div class="form-group">
                        <label>Service Name</label>
                        <input type="text" id="mon-name" placeholder="e.g. My Website">
                    </div>
                    <div class="form-group">
                        <label>Target URL</label>
                        <input type="url" id="mon-url" placeholder="https://example.com">
                    </div>
                </div>
                <div style="display:flex; justify-content:flex-end; gap:10px;">
                    <button class="btn btn-secondary" onclick="closeAddMonitorModal()">Cancel</button>
                    <button class="btn btn-primary" onclick="saveMonitor()">Save Monitor</button>
                </div>
            </div>

            <!-- Monitors Grid -->
            <div class="monitors-grid" id="monitors-list-container">
                <!-- Loaded dynamically by AJAX -->
            </div>
        </div>

        <!-- API CLIENT TAB -->
        <div id="api-client" class="tab-content">
            <header>
                <div class="header-title">
                    <h1>API REST Client</h1>
                    <p>Modern HTTP playground to test API endpoints and inspect responses.</p>
                </div>
            </header>

            <div class="api-tester-container">
                <!-- Request Panel -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fa-solid fa-circle-arrow-up"></i> Configure HTTP Request</h3>
                    </div>
                    
                    <div class="form-group">
                        <label>Method & Endpoint URL</label>
                        <div class="input-row">
                            <select id="api-method" class="api-method-select">
                                <option value="GET">GET</option>
                                <option value="POST">POST</option>
                                <option value="PUT">PUT</option>
                                <option value="DELETE">DELETE</option>
                                <option value="PATCH">PATCH</option>
                            </select>
                            <input type="url" id="api-url" placeholder="https://api.github.com/users/hamdyelbatal122" value="https://api.github.com/users/hamdyelbatal122">
                        </div>
                    </div>

                    <!-- Headers Section -->
                    <div class="form-group" style="margin-top: 24px;">
                        <label style="display:flex; justify-content:space-between; align-items:center;">
                            <span>HTTP Headers</span>
                            <button class="btn btn-secondary btn-sm" onclick="addHeaderRow()"><i class="fa-solid fa-plus"></i> Add Header</button>
                        </label>
                        <div id="headers-rows-container">
                            <div class="key-value-row">
                                <input type="text" placeholder="Key (e.g. User-Agent)" class="header-key" value="User-Agent">
                                <input type="text" placeholder="Value" class="header-value" value="DevForge Client">
                                <button class="btn btn-danger btn-sm" onclick="this.parentElement.remove()"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>
                    </div>

                    <!-- Body Section -->
                    <div class="form-group" style="margin-top: 24px;">
                        <label>Request Body (JSON / Text)</label>
                        <textarea id="api-body" placeholder='{ "name": "John Doe" }'></textarea>
                    </div>

                    <div style="margin-top: 24px;">
                        <button class="btn btn-primary" style="width:100%;" onclick="sendApiRequest()" id="send-api-btn">
                            <i class="fa-solid fa-paper-plane"></i> Send Request
                        </button>
                    </div>
                </div>

                <!-- Response Panel -->
                <div class="card" style="display:flex; flex-direction:column;">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fa-solid fa-circle-arrow-down"></i> Response Output</h3>
                    </div>

                    <div id="response-placeholder" style="flex:1; display:flex; flex-direction:column; justify-content:center; align-items:center; min-height:300px; color:var(--text-subtle);">
                        <i class="fa-solid fa-reply-all" style="font-size:3rem; margin-bottom:15px; opacity:0.3;"></i>
                        <p>Configure a request and click "Send Request"</p>
                    </div>

                    <div id="response-content" style="display:none; flex:1;">
                        <div class="response-meta">
                            <div class="response-meta-badge">
                                <i class="fa-solid fa-server"></i>
                                <span>Status:</span>
                                <font id="res-status" style="font-weight:700;"></font>
                            </div>
                            <div class="response-meta-badge">
                                <i class="fa-solid fa-gauge-high"></i>
                                <span>Time:</span>
                                <font id="res-time" style="font-weight:700; color:var(--warning);"></font>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Headers</label>
                            <pre class="code-box" id="res-headers" style="max-height:120px; font-size:0.78rem;"></pre>
                        </div>

                        <div class="form-group" style="flex:1;">
                            <label>Body</label>
                            <pre class="code-box" id="res-body"></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- JSON PRETTIFIER TAB -->
        <div id="json-tool" class="tab-content">
            <header>
                <div class="header-title">
                    <h1>JSON Prettifier & Validator</h1>
                    <p>Format, validate, parse, and tidy your JSON data instantly.</p>
                </div>
            </header>

            <div class="grid-two">
                <div class="card">
                    <div class="form-group">
                        <label>Raw Input JSON</label>
                        <textarea id="json-input" placeholder='{"name":"hamdy","role":"developer","active":true}' style="min-height:350px; font-family:var(--font-mono); font-size:0.85rem;"></textarea>
                    </div>
                    <div style="display:flex; gap:10px;">
                        <button class="btn btn-primary" onclick="prettifyJson()"><i class="fa-solid fa-align-left"></i> Prettify & Validate</button>
                        <button class="btn btn-secondary" onclick="minifyJson()"><i class="fa-solid fa-compress"></i> Minify</button>
                    </div>
                </div>

                <div class="card">
                    <div class="form-group">
                        <label>Formatted Output</label>
                        <pre class="code-box" id="json-output" style="min-height:350px; margin-bottom:0;"></pre>
                    </div>
                </div>
            </div>
        </div>

        <!-- JWT DECODER TAB -->
        <div id="jwt-decoder" class="tab-content">
            <header>
                <div class="header-title">
                    <h1>JWT Token Decoder</h1>
                    <p>Decode JSON Web Tokens (JWT) payload, header, and check raw parameters.</p>
                </div>
            </header>

            <div class="grid-two">
                <div class="card">
                    <div class="form-group">
                        <label>JWT Token String</label>
                        <textarea id="jwt-input" placeholder="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c" style="min-height:300px; font-family:var(--font-mono); font-size:0.85rem; word-break:break-all;"></textarea>
                    </div>
                    <button class="btn btn-primary" onclick="decodeJwt()"><i class="fa-solid fa-key"></i> Decode JWT</button>
                </div>

                <div class="card">
                    <div class="form-group">
                        <label>Header</label>
                        <pre class="code-box" id="jwt-header" style="max-height:150px; margin-bottom:15px; color:#818cf8;"></pre>
                    </div>
                    <div class="form-group">
                        <label>Payload (Decoded claims)</label>
                        <pre class="code-box" id="jwt-payload" style="max-height:220px; color:#34d399;"></pre>
                    </div>
                </div>
            </div>
        </div>

        <!-- CRYPTOGRAPHY LAB TAB -->
        <div id="hash-lab" class="tab-content">
            <header>
                <div class="header-title">
                    <h1>Hash & Cryptography Lab</h1>
                    <p>Encrypt, decrypt, generate BCRYPT secure passwords, and parse ciphertexts.</p>
                </div>
            </header>

            <div class="grid-two">
                <!-- BCrypt Lab -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fa-solid fa-lock"></i> BCrypt Hash & Matcher</h3>
                    </div>
                    
                    <div class="form-group">
                        <label>Plaintext String</label>
                        <input type="text" id="bcrypt-text" placeholder="Enter plaintext to hash or verify">
                    </div>
                    
                    <div class="form-group">
                        <label>Cost / Work Factor</label>
                        <select id="bcrypt-cost" style="width:100px;">
                            <option value="8">8</option>
                            <option value="10" selected>10</option>
                            <option value="12">12</option>
                            <option value="14">14</option>
                        </select>
                    </div>
                    
                    <div style="display:flex; gap:10px; margin-bottom:20px;">
                        <button class="btn btn-primary" onclick="bcryptHash()">Generate Hash</button>
                        <button class="btn btn-secondary" onclick="bcryptVerify()">Verify Hash</button>
                    </div>

                    <div class="form-group">
                        <label>Result Hash / Input Hash to Verify</label>
                        <textarea id="bcrypt-hash" placeholder="BCrypt hash result" style="min-height:80px;"></textarea>
                    </div>
                </div>

                <!-- AES Symmetric Encryption -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fa-solid fa-key"></i> AES-256 Symmetric Cipher</h3>
                    </div>
                    
                    <div class="form-group">
                        <label>Data String</label>
                        <textarea id="aes-text" placeholder="Plaintext or Ciphertext" style="min-height:80px;"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Secret Passphrase (Key)</label>
                        <input type="text" id="aes-key" placeholder="Passphrase key">
                    </div>

                    <div style="display:flex; gap:10px; margin-bottom:20px;">
                        <button class="btn btn-primary" onclick="aesEncrypt()">Encrypt AES</button>
                        <button class="btn btn-secondary" onclick="aesDecrypt()">Decrypt AES</button>
                    </div>

                    <div class="form-group">
                        <label>Result</label>
                        <textarea id="aes-result" placeholder="Encryption / Decryption result" style="min-height:80px;" readonly></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- DATABASE EXPLORER TAB -->
        <div id="db-explorer" class="tab-content">
            <header>
                <div class="header-title">
                    <h1>SQLite Query Runner</h1>
                    <p>Execute SQL commands directly on your devforge database playground.</p>
                </div>
            </header>

            <div class="card">
                <div class="form-group">
                    <label>SQL Query Statement</label>
                    <textarea id="sql-query" style="font-family:var(--font-mono); min-height:100px;">SELECT * FROM monitors;</textarea>
                </div>
                
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <div style="font-size:0.8rem; color:var(--text-subtle);">
                        <i class="fa-solid fa-info-circle"></i> Supports all valid SQLite query syntax.
                    </div>
                    <button class="btn btn-primary" onclick="runSqlQuery()"><i class="fa-solid fa-play"></i> Run Statement</button>
                </div>
            </div>

            <div class="card" id="db-results-card" style="display:none;">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa-solid fa-table"></i> Query execution results</h3>
                </div>
                <div class="table-wrap" style="overflow-x:auto;" id="db-results-table-container">
                    <!-- Results loaded dynamically -->
                </div>
            </div>
        </div>

    </main>

    <!-- Custom Frontend Logic -->
    <script>
        // Tab switching
        function switchTab(tabId, el) {
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });
            document.querySelectorAll('.menu-item').forEach(item => {
                item.classList.remove('active');
            });

            document.getElementById(tabId).classList.add('active');
            el.classList.add('active');

            if (tabId === 'uptime') {
                loadMonitors();
            }
        }

        // Add Header Row for API Tester
        function addHeaderRow() {
            const container = document.getElementById('headers-rows-container');
            const row = document.createElement('div');
            row.className = 'key-value-row';
            row.innerHTML = `
                <input type="text" placeholder="Key" class="header-key">
                <input type="text" placeholder="Value" class="header-value">
                <button class="btn btn-danger btn-sm" onclick="this.parentElement.remove()"><i class="fa-solid fa-trash"></i></button>
            `;
            container.appendChild(row);
        }

        // Add Monitor Modals
        function openAddMonitorModal() {
            document.getElementById('add-monitor-widget').style.display = 'block';
        }
        function closeAddMonitorModal() {
            document.getElementById('add-monitor-widget').style.display = 'none';
        }

        // AJAX: Save monitor
        async function saveMonitor() {
            const name = document.getElementById('mon-name').value;
            const url = document.getElementById('mon-url').value;

            if (!name || !url) {
                alert('Please enter both Name and URL.');
                return;
            }

            const res = await fetch('api.php?action=monitor_add', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ name, url, type: 'http' })
            });
            const data = await res.json();

            if (data.success) {
                document.getElementById('mon-name').value = '';
                document.getElementById('mon-url').value = '';
                closeAddMonitorModal();
                loadMonitors();
            } else {
                alert(data.error || 'Failed to add monitor.');
            }
        }

        // AJAX: Load monitors list
        async function loadMonitors() {
            const container = document.getElementById('monitors-list-container');
            container.innerHTML = '<div style="grid-column:1/-1;text-align:center;color:var(--text-subtle);"><i class="fa-solid fa-spinner fa-spin" style="font-size:2rem;margin-bottom:10px;"></i><p>Loading services...</p></div>';

            const res = await fetch('api.php?action=monitors_list');
            const data = await res.json();

            if (data.success) {
                container.innerHTML = '';
                if (data.data.length === 0) {
                    container.innerHTML = '<div style="grid-column:1/-1;text-align:center;color:var(--text-subtle);padding:40px;"><i class="fa-solid fa-folder-open" style="font-size:3rem;margin-bottom:15px;opacity:0.3;"></i><p>No services found. Click "Add Service" to start.</p></div>';
                    return;
                }

                data.data.forEach(mon => {
                    const card = document.createElement('div');
                    card.className = `monitor-card status-${mon.last_status || 'UNKNOWN'}`;
                    card.id = `mon-card-${mon.id}`;
                    
                    const codeLabel = mon.last_response_code ? `${mon.last_response_code}` : 'N/A';
                    const timeLabel = mon.last_response_time ? `${mon.last_response_time}ms` : 'N/A';
                    const checkedLabel = mon.last_checked ? mon.last_checked : 'Never';

                    card.innerHTML = `
                        <div class="monitor-status-indicator"></div>
                        <div class="monitor-meta">
                            <div>
                                <span class="monitor-name">${escapeHtml(mon.name)}</span>
                                <span class="monitor-url">${escapeHtml(mon.url)}</span>
                            </div>
                            <span class="status-badge ${mon.last_status || 'UNKNOWN'}">
                                <i class="fa-solid fa-circle" style="font-size:0.5rem;"></i> ${mon.last_status || 'UNKNOWN'}
                            </span>
                        </div>
                        
                        <div class="monitor-stats">
                            <div class="stat-box">
                                <span>HTTP Code</span>
                                <font id="mon-code-${mon.id}">${codeLabel}</font>
                            </div>
                            <div class="stat-box">
                                <span>Response Time</span>
                                <font id="mon-time-${mon.id}">${timeLabel}</font>
                            </div>
                            <div class="stat-box" style="grid-column:1/-1;">
                                <span>Last Verified</span>
                                <font id="mon-checked-${mon.id}" style="font-size:0.75rem;font-weight:400;color:var(--text-muted);">${checkedLabel}</font>
                            </div>
                        </div>

                        <div class="monitor-actions">
                            <button class="btn btn-secondary btn-sm" onclick="checkMonitor(${mon.id}, this)">
                                <i class="fa-solid fa-rotate"></i> Ping
                            </button>
                            <button class="btn btn-danger btn-sm" style="padding: 8px 10px;" onclick="deleteMonitor(${mon.id})">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    `;
                    container.appendChild(card);
                });
            }
        }

        // AJAX: Ping / Check monitor status
        async function checkMonitor(id, btn) {
            const icon = btn.querySelector('i');
            icon.className = 'fa-solid fa-spinner fa-spin';
            btn.disabled = true;

            const res = await fetch(`api.php?action=monitor_check&id=${id}`);
            const data = await res.json();

            icon.className = 'fa-solid fa-rotate';
            btn.disabled = false;

            if (data.success) {
                loadMonitors(); // reload list
            } else {
                alert(data.error || 'Verification failed.');
            }
        }

        // AJAX: Delete monitor
        async function deleteMonitor(id) {
            if (!confirm('Are you sure you want to delete this monitor?')) return;
            const res = await fetch(`api.php?action=monitor_delete&id=${id}`);
            const data = await res.json();
            if (data.success) {
                loadMonitors();
            } else {
                alert(data.error || 'Failed to delete.');
            }
        }

        // AJAX: Custom API HTTP Request builder
        async function sendApiRequest() {
            const url = document.getElementById('api-url').value;
            const method = document.getElementById('api-method').value;
            const body = document.getElementById('api-body').value;
            const sendBtn = document.getElementById('send-api-btn');

            if (!url) {
                alert('Please enter a target URL.');
                return;
            }

            sendBtn.disabled = true;
            sendBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Processing Request...';

            // Gather headers
            const headers = [];
            document.querySelectorAll('#headers-rows-container .key-value-row').forEach(row => {
                const key = row.querySelector('.header-key').value;
                const value = row.querySelector('.header-value').value;
                if (key) {
                    headers.push({ key, value });
                }
            });

            try {
                const res = await fetch('api.php?action=api_request', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ url, method, headers, body })
                });
                const data = await res.json();

                document.getElementById('response-placeholder').style.display = 'none';
                const container = document.getElementById('response-content');
                container.style.display = 'block';

                if (data.success) {
                    // Update response UI
                    const statusText = document.getElementById('res-status');
                    statusText.textContent = data.status;
                    statusText.style.color = data.status >= 200 && data.status < 400 ? 'var(--success)' : 'var(--danger)';

                    document.getElementById('res-time').textContent = `${data.time}ms`;
                    document.getElementById('res-headers').textContent = data.headers;

                    const bodyBox = document.getElementById('res-body');
                    try {
                        const parsed = JSON.parse(data.body);
                        bodyBox.textContent = JSON.stringify(parsed, null, 4);
                        bodyBox.style.color = '#34d399'; // beautiful green for clean json
                    } catch (e) {
                        bodyBox.textContent = data.body;
                        bodyBox.style.color = 'var(--text)';
                    }
                } else {
                    document.getElementById('res-status').textContent = 'ERROR';
                    document.getElementById('res-status').style.color = 'var(--danger)';
                    document.getElementById('res-time').textContent = 'N/A';
                    document.getElementById('res-headers').textContent = 'No headers returned';
                    document.getElementById('res-body').textContent = data.error;
                    document.getElementById('res-body').style.color = 'var(--danger)';
                }
            } catch (e) {
                alert('Request failed: ' + e.message);
            } finally {
                sendBtn.disabled = false;
                sendBtn.innerHTML = '<i class="fa-solid fa-paper-plane"></i> Send Request';
            }
        }

        // Prettify JSON Output
        function prettifyJson() {
            const raw = document.getElementById('json-input').value;
            const out = document.getElementById('json-output');
            if (!raw.trim()) {
                out.textContent = 'JSON Input is empty.';
                out.style.color = 'var(--danger)';
                return;
            }
            try {
                const parsed = JSON.parse(raw);
                out.textContent = JSON.stringify(parsed, null, 4);
                out.style.color = '#34d399';
            } catch (e) {
                out.textContent = 'Invalid JSON: ' + e.message;
                out.style.color = 'var(--danger)';
            }
        }

        // Minify JSON
        function minifyJson() {
            const raw = document.getElementById('json-input').value;
            const out = document.getElementById('json-output');
            if (!raw.trim()) {
                out.textContent = 'JSON Input is empty.';
                out.style.color = 'var(--danger)';
                return;
            }
            try {
                const parsed = JSON.parse(raw);
                out.textContent = JSON.stringify(parsed);
                out.style.color = '#818cf8';
            } catch (e) {
                out.textContent = 'Invalid JSON: ' + e.message;
                out.style.color = 'var(--danger)';
            }
        }

        // AJAX: JWT Decoder
        async function decodeJwt() {
            const token = document.getElementById('jwt-input').value;
            if (!token) {
                alert('Please enter a JWT token.');
                return;
            }

            const res = await fetch('api.php?action=jwt_decode', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ token })
            });
            const data = await res.json();

            if (data.success) {
                document.getElementById('jwt-header').textContent = JSON.stringify(data.header, null, 4);
                document.getElementById('jwt-payload').textContent = JSON.stringify(data.payload, null, 4);
            } else {
                document.getElementById('jwt-header').textContent = 'Error decoding token.';
                document.getElementById('jwt-payload').textContent = data.error;
            }
        }

        // AJAX: BCrypt generate hash
        async function bcryptHash() {
            const text = document.getElementById('bcrypt-text').value;
            const cost = document.getElementById('bcrypt-cost').value;
            if (!text) {
                alert('Please enter text to hash.');
                return;
            }
            const res = await fetch('api.php?action=crypto_bcrypt', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ type: 'hash', text, cost })
            });
            const data = await res.json();
            if (data.success) {
                document.getElementById('bcrypt-hash').value = data.result;
            } else {
                alert(data.error);
            }
        }

        // AJAX: BCrypt verify hash
        async function bcryptVerify() {
            const text = document.getElementById('bcrypt-text').value;
            const hash = document.getElementById('bcrypt-hash').value;
            if (!text || !hash) {
                alert('Please enter both Plaintext and Hash.');
                return;
            }
            const res = await fetch('api.php?action=crypto_bcrypt', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ type: 'verify', text, hash })
            });
            const data = await res.json();
            if (data.success) {
                alert(data.matches ? 'SUCCESS: Password Matches Hash!' : 'ERROR: Password Mismatch!');
            } else {
                alert(data.error);
            }
        }

        // AJAX: AES Symmetric Encrypt
        async function aesEncrypt() {
            const text = document.getElementById('aes-text').value;
            const key = document.getElementById('aes-key').value;
            if (!text || !key) {
                alert('Please enter Data and Key.');
                return;
            }
            const res = await fetch('api.php?action=crypto_aes', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ type: 'encrypt', text, key })
            });
            const data = await res.json();
            if (data.success) {
                document.getElementById('aes-result').value = data.result;
            } else {
                alert(data.error);
            }
        }

        // AJAX: AES Symmetric Decrypt
        async function aesDecrypt() {
            const text = document.getElementById('aes-text').value;
            const key = document.getElementById('aes-key').value;
            if (!text || !key) {
                alert('Please enter AES encrypted data (base64) and Secret Key.');
                return;
            }
            const res = await fetch('api.php?action=crypto_aes', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ type: 'decrypt', text, key })
            });
            const data = await res.json();
            if (data.success) {
                document.getElementById('aes-result').value = data.result;
            } else {
                alert(data.error);
            }
        }

        // AJAX: SQLite Query Runner
        async function runSqlQuery() {
            const query = document.getElementById('sql-query').value;
            if (!query) {
                alert('SQL query is empty.');
                return;
            }

            const res = await fetch('api.php?action=db_query', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ query })
            });
            const data = await res.json();

            const card = document.getElementById('db-results-card');
            const tableContainer = document.getElementById('db-results-table-container');

            card.style.display = 'block';

            if (data.success) {
                if (data.is_select) {
                    if (data.data.length === 0) {
                        tableContainer.innerHTML = '<p style="color:var(--text-muted);padding:10px;">Query completed. Empty result set.</p>';
                        return;
                    }
                    // Generate table
                    const cols = Object.keys(data.data[0]);
                    let html = '<table style="width:100%; border-collapse:collapse; font-size:0.85rem;">';
                    // Header
                    html += '<thead style="border-bottom:2px solid var(--border);"><tr>';
                    cols.forEach(col => {
                        html += `<th style="padding:10px;text-align:left;color:var(--text-muted);">${escapeHtml(col)}</th>`;
                    });
                    html += '</tr></thead><tbody>';
                    // Rows
                    data.data.forEach(row => {
                        html += '<tr style="border-bottom:1px solid var(--border);">';
                        cols.forEach(col => {
                            html += `<td style="padding:10px;color:var(--text);">${escapeHtml(String(row[col] ?? 'NULL'))}</td>`;
                        });
                        html += '</tr>';
                    });
                    html += '</tbody></table>';
                    tableContainer.innerHTML = html;
                } else {
                    tableContainer.innerHTML = `<div class="alert-box alert-success"><i class="fa-solid fa-circle-check"></i> Command executed successfully. Affected rows: ${data.affected_rows}</div>`;
                }
            } else {
                tableContainer.innerHTML = `<div class="alert-box alert-danger"><i class="fa-solid fa-circle-exclamation"></i> SQL Error: ${escapeHtml(data.error)}</div>`;
            }
        }

        // Helper to Escape HTML safely
        function escapeHtml(string) {
            return String(string).replace(/[&<>"']/g, function (s) {
                return {
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#39;'
                }[s];
            });
        }

        // Initialize monitors list on page load
        window.addEventListener('load', () => {
            loadMonitors();
        });
    </script>
</body>
</html>
