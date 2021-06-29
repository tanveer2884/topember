<?php

namespace Topdot\Core\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Topdot\Core\Repositories\UserRepository;
use Topdot\Core\Services\Excel\Export\User\UserCsvExportService;

class UserCsvExportController extends Controller
{
    public function __invoke(Request $request, UserRepository $userRepository)
    {
        $users = $userRepository->get($request,false,'DESC','created_at');
        $userCsvExportService = new UserCsvExportService($users);
        return $userCsvExportService->handle();
    }
}
