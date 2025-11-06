<?php
class UserBehavior {
    private $conn;
    private $table_name = "user_behavior";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function trackView($product_id, $user_id = null) {
        $query = "INSERT INTO " . $this->table_name . " (user_id, product_id, action_type) VALUES (?, ?, 'view')";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$user_id, $product_id]);
    }

    public function trackAddToCart($product_id, $user_id = null) {
        $query = "INSERT INTO " . $this->table_name . " (user_id, product_id, action_type) VALUES (?, ?, 'add_to_cart')";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$user_id, $product_id]);
    }

    public function getUserBehavior($user_id = null, $limit = 20) {
        $query = "SELECT product_id, action_type, COUNT(*) as count 
                  FROM " . $this->table_name . " 
                  WHERE user_id = ? OR (user_id IS NULL AND ? IS NULL)
                  GROUP BY product_id, action_type 
                  ORDER BY MAX(created_at) DESC 
                  LIMIT ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$user_id, $user_id, $limit]);
        
        $behavior = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $behavior[] = $row;
        }
        
        return $behavior;
    }
}
?>