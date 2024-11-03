<?php

namespace App\Repository\Dashboard\Stats;
use App\Http\Resources\Dashboard\Client\ClientResource;
use App\Models\Visitor;
use App\Models\Client;
use App\Models\Project;
use App\Models\Team;

class DashboardRepo
{
    public function dashboardStats()
    {
        $stats = [
            'Visitors' => Visitor::count(),

            'Running_Projects' => Project::where('status', 'Running')->count(),

            'Completed_Projects' => Project::where('status', 'Completed')->count(),

            'One Hand Team' => [
                Team::select('name', 'position')->get()
            ],

            'Clients' => [
                
                ClientResource::collection(Client::with('projects')->get())
            ],

        ];

        return successResponseData($stats);

    }
}