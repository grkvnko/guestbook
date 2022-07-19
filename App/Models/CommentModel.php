<?php
namespace App\Models;

use App\App\App;
use App\App\DB;

class CommentModel extends Model
{
    const COMMENTS_PER_PAGE = 5;

    /**
     * общее количество комментариев в базе
     */
    public static function getPostsCount(): int
    {
        if ($res = DB::$dbProvider->provider()->query("SELECT COUNT(id) FROM guest_book")) {
            $result = $res->fetch_row();
            return $result[0];
        }

        return 1;
    }

    /**
     * Подсчет количества страниц с учетом количества комментариев на страницу
     */
    public static function getPagesCount(): int
    {
        return ceil(self::getPostsCount() / self::COMMENTS_PER_PAGE);
    }

    /**
     * Выборка комментариев для отображения на указанной странице
     */
    public static function getCommentsByPage(int $page): array
    {
        $commentsPerPage = self::COMMENTS_PER_PAGE;
        $startPost =  $commentsPerPage * $page - $commentsPerPage;

        $query = "SELECT name, email, dtime, body
        FROM guest_book  
        ORDER BY dtime DESC 
        LIMIT {$commentsPerPage} OFFSET {$startPost}";

        if ($res = DB::$dbProvider->provider()->query($query)) {
            $result = $res->fetch_all(MYSQLI_ASSOC);
            return $result;
        }

        return [];
    }

    public static function create(array $data)
    {
        $values = '(\''.implode('\',\'',array_values($data))."')";
        $keys = '('.implode(',', array_keys($data)).')';

        if ($values == '')
            return 'nn';

        $query = "INSERT INTO guest_book $keys VALUES $values";
        if (DB::$dbProvider->provider()->query($query)) {
            return 'ok';
        }

        return 'error: ' . mysqli_error(DB::$dbProvider->provider()->link());
    }
}

