<?php

namespace App\Services;

use App\Models\Agent;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class AgentImportService
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.agents_api.url');
    }

    protected function clearAgents()
    {
        try {
            DB::table('agents')->truncate();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function importAgents()
    {
        try {
            // Supprime d'abord tous les agents
            // if (!$this->clearAgents()) {
            //     return [
            //         'success' => false,
            //         'message' => 'Erreur lors de la suppression des agents existants.',
            //     ];
            // }

            $reponse = Http::get($this->apiUrl . '/api/agents');

            if ($reponse->successful()) {

                $agents = $reponse->json();
                // dd($agents);

                foreach ($agents as $agent) {
                    // Vérifie si l'agent existe déjà
                    // dd($agent);
                    $fonction = '';
                    if (isset($agent['fonction'])) {
                        $fonction = $agent['fonction']['name'];
                    }
                    Agent::updateOrCreate(
                        ['matricule' => $agent['matricule']],
                        [
                            'nom' => $agent['nom'],
                            'postnom' => $agent['postnom'],
                            'prenom' => $agent['prenom'],
                            'sexe' => $agent['sexe'],
                            'fonction' => $fonction,
                            'email' => $agent['email'],
                            'telephone' => $agent['phone'],
                        ]
                    );
                }

                return [
                    'success' => true,
                    'message' => 'Agents importés avec succès.',
                    'count' => count($agents),
                ];
            }
            return [
                'success' => false,
                'message' => 'Erreur lors de l\'importation des agents.',
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Erreur lors de l\'importation des agents : ' . $e->getMessage(),
            ];
        }
    }
}
