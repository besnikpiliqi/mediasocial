<?php
// $posts = Post::select(DB::raw('count(*)'))->whereColumn('user_id', 'users.id');
//         $users = User::select([
//         'users.*',
//         'last_posted_at' => $post
//     ])->get();
//     $posts = DB::select("SELECT posts.*,
//     (select count(*) from likes_post where likes_post.post_id = posts.id) as likes_post
//     ,
//     (select count(*) from likes_comment
//     INNER JOIN comments ON comments.id = likes_comment.comment_id where posts.id = comments.post_id) as likes_comment
//     FROM posts");

//     $posts = DB::select("SELECT users.*,
//     (select count(*) from posts where  posts.user_id = users.id) as post_count
//     ,
//     (select count(*) from comments 
//         inner join `posts` on `posts`.`id` = `comments`.`post_id` 
//         where `posts`.`user_id` =  users.id) as comment_count
//     ,
//     (select count(*) from `likes_post` 
//         inner join `posts` on `posts`.`id` = `likes_post`.`post_id` 
//         where `posts`.`user_id` =  users.id ) as likes_post
//     ,
//     (select avg(likes_post.stars) from `likes_post` 
//         inner join `posts` on `posts`.`id` = `likes_post`.`post_id` 
//         where `posts`.`user_id` =  users.id ) as avg_likes_post
//     ,

//     (select COUNT(*) from `likes_comment` 
//         inner join `posts` on `posts`.`id` = `likes_comment`.`post_id` 
//         where `posts`.`user_id` = users.id ) as likes_comment
//     ,
//     (select avg(likes_comment.stars) from `likes_comment` 
//         inner join `posts` on `posts`.`id` = `likes_comment`.`post_id` 
//         where `posts`.`user_id` = users.id ) as avg_likes_comment

//     FROM users limit 5");

    // //kjo eshte kur do me kqyr kush nuk ta ka kthy hala followin
    // "SELECT user_id,follow_id FROM `followers` WHERE user_id = 1 AND follow_id NOT IN (SELECT user_id FROM followers WHERE follow_id = 1)"
    
    // //kjo eshte kur do me pa kujna hala sja ke kthy followin 
    // "SELECT user_id,follow_id FROM `followers` WHERE follow_id = 1 AND user_id NOT IN (SELECT follow_id FROM followers WHERE user_id = 1)"

    // kjo me pa per krejt users kush hala sja ka kthy followin
    //SELECT user_id,follow_id FROM `followers` WHERE follow_id IN(SELECT user_id FROM followers) AND user_id NOT IN (SELECT follow_id FROM followers); 

    // kjo eshte me pa sa kerkesa COUNT(user_id) per follow jan ba te nje user_id dhe nuk jan kthy hala dmth follow_id sja ka kthy hala user_id
    //SELECT COUNT(user_id),user_id,follow_id FROM `followers` WHERE follow_id IN(SELECT user_id FROM followers) AND user_id NOT IN (SELECT follow_id FROM followers) GROUP BY user_id; 