<?php
class EventfulApi {
    private $api_key;

    public function __construct($api_key) {
        $this->api_key = $api_key;
    }

    public function call($endpoint, $params = array()) {
        // URL de base de l'API Eventful
        $base_url = 'https://api.predicthq.com/v1/';

        // Ajouter la clé API aux paramètres
        $params['id'] = $this->api_key;

        // Construire l'URL de l'appel API
        $url = $base_url . $endpoint . '?' . http_build_query($params);

        // Initialiser une session cURL
        $curl = curl_init();

        // Configuration de l'URL et d'autres options
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Authorization: Bearer ' . $this->api_key
            ),
        ));

        // Exécuter la requête cURL et récupérer la réponse
        $response = curl_exec($curl);

        // Vérifier les erreurs cURL
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
            curl_close($curl);
            return array('success' => false, 'error' => $error_msg);
        }

        // Fermer la session cURL
        curl_close($curl);

        // Convertir la réponse JSON en objet PHP
        $decoded_response = json_decode($response);

        // Vérifier si la réponse est un objet JSON valide
        if ($decoded_response === null && json_last_error() !== JSON_ERROR_NONE) {
            return array('success' => false, 'error' => 'Invalid JSON response');
        }

        // Retourner la réponse réussie
        return array('success' => true, 'body' => $decoded_response);
    }
}


