<?php
    include 'db_connection.php';
    
    // =========== Fetch Employee Details ==========
    $select = "SELECT id, name, email, phone, address, created_at FROM employee";
    $result = executeQuery($select);
    
    // Parse the result for the employee list
    $employees = [];
    if (!empty($result) && strpos($result, 'ERROR') === false) {
        $lines = explode("\n", trim($result));
        $cleanLines = [];
        
        foreach ($lines as $line) {
            // Skip warning messages
            if (strpos($line, 'Warning') === false && strpos($line, 'mysql:') === false && !empty(trim($line))) {
                $cleanLines[] = trim($line);
            }
        }
        
        if (count($cleanLines) >= 1) {
            $headers = explode("\t", $cleanLines[0]);
            
            // Process each employee row
            for ($i = 1; $i < count($cleanLines); $i++) {
                $data = explode("\t", $cleanLines[$i]);
                if (count($headers) == count($data)) {
                    $employees[] = array_combine($headers, $data);
                }
            }
        }
    }
    
    // Create a mock result for compatibility with the while loop in home.php
    $s_query_data = $employees;
    $s_query_index = 0;
    
    // Mock mysqli_fetch_assoc function for this specific case
    function mysqli_fetch_assoc($query) {
        global $s_query_data, $s_query_index;
        
        if ($s_query_index < count($s_query_data)) {
            $row = $s_query_data[$s_query_index];
            $s_query_index++;
            return $row;
        }
        return false;
    }
    
    // For now, we'll handle other operations later
    // This gets the basic employee list working first
?>