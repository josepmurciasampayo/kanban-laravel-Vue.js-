<?php
namespace App\Http\Controllers;

use App\Models\Card;
use App\Http\Requests\StoreCardRequest;
use App\Http\Requests\UpdateCardRequest;
use App\Http\Resources\CardResource;
use App\Models\Column;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DatabaseController extends Controller {
    
    public function export (Request $request, Response $response) {

        $today = date('Y-m-d');
        $databaseName = config("app.database_name");
        $userName = config("app.database_username");
        $password = config("app.database_password");

        $command = "mysqldump --user={$userName} --password={$password} {$databaseName} > {$databaseName}-{$today}.sql";
        exec($command);
    
        return response()->download("{$databaseName}-{$today}.sql");
    }
}