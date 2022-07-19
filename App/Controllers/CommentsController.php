<?php
namespace App\Controllers;

use App\App\Request;
use App\Models\CommentModel;

class CommentsController extends Controller
{
    public function get(Request $request)
    {
        $page = (int)($request->post('page') ?? 1);

        $data["pagesCount"] = CommentModel::getPagesCount();
        $data["items"] = CommentModel::getCommentsByPage($page);

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function store(Request $request)
    {
        if (!$request->post('body') || !$request->post('name') || !$request->post('email'))
            die('empty_param');

        if (!filter_var($request->post('email'), FILTER_VALIDATE_EMAIL))
            die('novalid_email');

        echo CommentModel::create([
            'name' => $request->post('name'),
            'email' => $request->post('email'),
            'body' => $request->post('body'),
            'dtime' => date('Y-m-d H:i:s')
        ]);;
    }
}