<?php
require_once 'config/openai.php';

class RecommendationEngine {
    private $db;
    private $openai;
    private $userBehavior;

    public function __construct($db) {
        $this->db = $db;
        $this->openai = new OpenAI();
        $this->userBehavior = new UserBehavior($db);
    }

    public function getRecommendations($user_id = null) {
        // Get user behavior
        $behavior = $this->userBehavior->getUserBehavior($user_id);
        
        // If no behavior, return featured products
        if (empty($behavior)) {
            return $this->getFeaturedProducts();
        }

        // Get AI recommendations
        $recommended_ids = $this->openai->getRecommendations($behavior);
        
        // Get product details
        $product = new Product($this->db);
        $stmt = $product->readByIds($recommended_ids);
        
        $recommendations = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $recommendations[] = $row;
        }

        return $recommendations;
    }

    private function getFeaturedProducts() {
        $product = new Product($this->db);
        $stmt = $product->read();
        
        $featured = [];
        $count = 0;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC) && $count < 5) {
            $featured[] = $row;
            $count++;
        }
        
        return $featured;
    }
}
?>