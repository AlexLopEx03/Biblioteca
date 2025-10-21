<?php

# Cors
require_once '../../cors.php';

require_once '../../utils/checkAuth.php';

http_response_code(200);
echo json_encode([
    'success' => true,
    'message' => 'Authorized'
]);