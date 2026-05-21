<?php
// config.php
// DevForge Core Configuration & Database Bootstrapper

define('APP_NAME', 'DevForge');
define('APP_VERSION', '1.0.0');
define('DB_DIR', __DIR__ . '/db');
define('DB_FILE', DB_DIR . '/devforge.sqlite');

// Ensure DB directory exists
if (!file_exists(DB_DIR)) {
    mkdir(DB_DIR, 0755, true);
}

// Connect to SQLite Database
try {
    $db = new PDO('sqlite:' . DB_FILE);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    // Initialize monitors table
    $db->exec("CREATE TABLE IF NOT EXISTS monitors (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        url TEXT NOT NULL,
        type TEXT DEFAULT 'http',
        last_status TEXT DEFAULT 'UNKNOWN',
        last_response_code INTEGER,
        last_response_time INTEGER,
        last_checked TEXT,
        created_at TEXT DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Seed database if empty
    $count = $db->query("SELECT COUNT(*) FROM monitors")->fetchColumn();
    if ($count == 0) {
        $stmt = $db->prepare("INSERT INTO monitors (name, url, type) VALUES (:name, :url, :type)");
        
        $seeds = [
            ['name' => 'Google Search', 'url' => 'https://www.google.com', 'type' => 'http'],
            ['name' => 'GitHub API', 'url' => 'https://api.github.com', 'type' => 'http'],
            ['name' => 'JSONPlaceholder', 'url' => 'https://jsonplaceholder.typicode.com/posts', 'type' => 'http']
        ];
        
        foreach ($seeds as $seed) {
            $stmt->execute($seed);
        }
    }
    
} catch (PDOException $e) {
    die("Database Connection Failed: " . $e->getMessage());
}
