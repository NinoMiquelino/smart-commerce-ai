<?php
class OpenAI {
    private $api_key = "SUA_CHAVE_API_OPENAI";
    private $api_url = "https://api.openai.com/v1/chat/completions";

    public function getRecommendations($user_behavior) {
        $prompt = "Baseado no seguinte comportamento do usuário: " . json_encode($user_behavior) . 
                 ". Recomende 5 produtos relevantes. Retorne apenas um array JSON com os IDs dos produtos recomendados.";

        $data = [
            "model" => "gpt-3.5-turbo",
            "messages" => [
                [
                    "role" => "system",
                    "content" => "Você é um assistente de recomendações de e-commerce. Retorne apenas JSON válido."
                ],
                [
                    "role" => "user",
                    "content" => $prompt
                ]
            ],
            "temperature" => 0.7
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->api_key
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, true);
        
        if (isset($result['choices'][0]['message']['content'])) {
            return json_decode($result['choices'][0]['message']['content'], true);
        }
        
        return [1, 2, 3, 4, 5]; // Fallback recommendations
    }
}
?>