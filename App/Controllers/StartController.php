<?php
namespace App\Controllers;

use App\App\Request;
use App\App\View;
use App\Models\CommentModel;

class StartController extends Controller
{
    public function action(Request $request) {
        $data["pagesCount"] = CommentModel::getPagesCount();
        $data["items"] = CommentModel::getCommentsByPage(1);

        View::render('comments', $data);
    }

    public function error404(Request $request) {
        View::render('error404');
    }
}