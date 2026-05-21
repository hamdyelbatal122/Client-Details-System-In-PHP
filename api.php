<?php
// api.php
// DevSuite Backend JSON API Handler

header('Content-Type: application/json');
require_once __DIR__ . '/config.php';

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'monitors_list':
        try {
            $stmt = $db->query("SELECT * FROM monitors ORDER BY id DESC");
            $monitors = $stmt->fetchAll();
            echo json_encode(['success' => true, 'data' => $monitors]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        break;

    case 'monitor_add':
        try {
            $input = json_decode(file_get_contents('php://input'), true);
            $name = trim($input['name'] ?? '');
            $url = trim($input['url'] ?? '');
            $type = trim($input['type'] ?? 'http');

            if (empty($name) || empty($url)) {
                throw new Exception('Name and URL are required.');
            }

            if (!filter_var($url, FILTER_VALIDATE_URL) && $type === 'http') {
                throw new Exception('Invalid HTTP URL format.');
            }

            $stmt = $db->prepare("INSERT INTO monitors (name, url, type) VALUES (:name, :url, :type)");
            $stmt->execute(['name' => $name, 'url' => $url, 'type' => $type]);
            echo json_encode(['success' => true, 'message' => 'Monitor added successfully.']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        break;

    case 'monitor_delete':
        try {
            $id = intval($_GET['id'] ?? 0);
            $stmt = $db->prepare("DELETE FROM monitors WHERE id = :id");
            $stmt->execute(['id' => $id]);
            echo json_encode(['success' => true, 'message' => 'Monitor deleted successfully.']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        break;

    case 'monitor_check':
        try {
            $id = intval($_GET['id'] ?? 0);
            $stmt = $db->prepare("SELECT * FROM monitors WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $monitor = $stmt->fetch();

            if (!$monitor) {
                throw new Exception('Monitor not found.');
            }

            $ch = curl_init($monitor['url']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_NOBODY, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

            $startTime = microtime(true);
            $response = curl_exec($ch);
            $endTime = microtime(true);

            $responseTime = round(($endTime - $startTime) * 1000);

            if ($response === false) {
                $status = 'DOWN';
                $code = 0;
            } else {
                $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $status = ($code >= 200 && $code < 400) ? 'UP' : 'DOWN';
            }
            curl_close($ch);

            // Update DB
            $updateStmt = $db->prepare("UPDATE monitors SET last_status = :status, last_response_code = :code, last_response_time = :time, last_checked = :checked WHERE id = :id");
            $updateStmt->execute([
                'status' => $status,
                'code' => $code,
                'time' => $responseTime,
                'checked' => date('Y-m-d H:i:s'),
                'id' => $id
            ]);

            echo json_encode([
                'success' => true,
                'status' => $status,
                'code' => $code,
                'time' => $responseTime
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        break;

    case 'api_request':
        try {
            $input = json_decode(file_get_contents('php://input'), true);
            $url = trim($input['url'] ?? '');
            $method = strtoupper(trim($input['method'] ?? 'GET'));
            $headers = $input['headers'] ?? [];
            $body = $input['body'] ?? '';

            if (empty($url)) {
                throw new Exception('URL is required.');
            }

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 15);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

            // Set method
            if ($method !== 'GET') {
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
                if (!empty($body)) {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
                }
            }

            // Format headers
            $curlHeaders = [];
            foreach ($headers as $header) {
                $k = trim($header['key'] ?? '');
                $v = trim($header['value'] ?? '');
                if (!empty($k)) {
                    $curlHeaders[] = "$k: $v";
                }
            }
            if (!empty($curlHeaders)) {
                curl_setopt($ch, CURLOPT_HTTPHEADER, $curlHeaders);
            }

            $startTime = microtime(true);
            $response = curl_exec($ch);
            $endTime = microtime(true);
            $responseTime = round(($endTime - $startTime) * 1000);

            if ($response === false) {
                $error = curl_error($ch);
                curl_close($ch);
                throw new Exception("cURL Error: $error");
            }

            $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $resHeadersRaw = substr($response, 0, $headerSize);
            $resBody = substr($response, $headerSize);
            $resCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            echo json_encode([
                'success' => true,
                'status' => $resCode,
                'time' => $responseTime,
                'headers' => $resHeadersRaw,
                'body' => $resBody
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        break;

    case 'crypto_bcrypt':
        try {
            $input = json_decode(file_get_contents('php://input'), true);
            $action_type = $input['type'] ?? 'hash';
            $text = $input['text'] ?? '';
            $hash = $input['hash'] ?? '';
            $cost = intval($input['cost'] ?? 10);

            if ($action_type === 'hash') {
                if (empty($text)) throw new Exception('Text to hash is empty.');
                $result = password_hash($text, PASSWORD_BCRYPT, ['cost' => $cost]);
                echo json_encode(['success' => true, 'result' => $result]);
            } else {
                if (empty($text) || empty($hash)) throw new Exception('Text and Hash are required for verification.');
                $matches = password_verify($text, $hash);
                echo json_encode(['success' => true, 'matches' => $matches]);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        break;

    case 'crypto_aes':
        try {
            $input = json_decode(file_get_contents('php://input'), true);
            $action_type = $input['type'] ?? 'encrypt';
            $text = $input['text'] ?? '';
            $key = $input['key'] ?? '';

            if (empty($text) || empty($key)) {
                throw new Exception('Data and secret key are required.');
            }

            $cipher = "aes-256-cbc";
            $key_hash = hash('sha256', $key, true);

            if ($action_type === 'encrypt') {
                $ivlen = openssl_cipher_iv_length($cipher);
                $iv = openssl_random_pseudo_bytes($ivlen);
                $ciphertext = openssl_encrypt($text, $cipher, $key_hash, OPENSSL_RAW_DATA, $iv);
                $result = base64_encode($iv . $ciphertext);
                echo json_encode(['success' => true, 'result' => $result]);
            } else {
                $c = base64_decode($text);
                $ivlen = openssl_cipher_iv_length($cipher);
                $iv = substr($c, 0, $ivlen);
                $ciphertext = substr($c, $ivlen);
                $result = openssl_decrypt($ciphertext, $cipher, $key_hash, OPENSSL_RAW_DATA, $iv);
                if ($result === false) throw new Exception('Decryption failed. Invalid key or corrupted data.');
                echo json_encode(['success' => true, 'result' => $result]);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        break;

    case 'jwt_decode':
        try {
            $input = json_decode(file_get_contents('php://input'), true);
            $token = trim($input['token'] ?? '');

            if (empty($token)) {
                throw new Exception('JWT Token is required.');
            }

            $parts = explode('.', $token);
            if (count($parts) !== 3) {
                throw new Exception('Invalid JWT format. Must contain 3 dot-separated parts.');
            }

            $header = json_decode(base64_decode(str_replace(['-', '_'], ['+', '/'], $parts[0])), true);
            $payload = json_decode(base64_decode(str_replace(['-', '_'], ['+', '/'], $parts[1])), true);
            $signature = $parts[2];

            echo json_encode([
                'success' => true,
                'header' => $header,
                'payload' => $payload,
                'signature' => $signature
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        break;

    case 'db_query':
        try {
            $input = json_decode(file_get_contents('php://input'), true);
            $query = trim($input['query'] ?? '');

            if (empty($query)) {
                throw new Exception('SQL query is empty.');
            }

            // Restrict dangerous statements in public playground, but allow simple writes/reads
            $isSelect = stripos($query, 'select') === 0 || stripos($query, 'explain') === 0;
            
            $stmt = $db->prepare($query);
            $stmt->execute();
            
            if ($isSelect) {
                $results = $stmt->fetchAll();
                echo json_encode(['success' => true, 'is_select' => true, 'data' => $results]);
            } else {
                $affected = $stmt->rowCount();
                echo json_encode(['success' => true, 'is_select' => false, 'affected_rows' => $affected]);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        break;

    default:
        echo json_encode(['success' => false, 'error' => 'Invalid API Action.']);
        break;
}
