<?php
require 'db.php';

$search = '';
$searchQuery = '';

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $searchQuery = "AND (title LIKE ? OR content LIKE ? OR tags LIKE ?)";
}

$sql = "SELECT * FROM posts WHERE status = 'published' $searchQuery ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);

if ($searchQuery) {
    $likeSearch = "%$search%";
    $stmt->bind_param('sss', $likeSearch, $likeSearch, $likeSearch);
}

$stmt->execute();
$result = $stmt->get_result();
$posts = $result->fetch_all(MYSQLI_ASSOC);


function safe_truncate($html, $length) {
    $is_open = false;
    $tags = [];
    $result = '';
    $total_length = 0;

    preg_match_all('/<[^>]+>|[^<]+/', $html, $matches);

    foreach ($matches[0] as $token) {
        if ($token[0] === '<') {
        
            if ($token[1] !== '/') {
                preg_match('/<([a-zA-Z0-9]+)(\s[^>]*)?>/', $token, $tag_match);
                $tags[] = $tag_match[1];
            } 
   
            else {
                array_pop($tags);
            }
            $result .= $token;
        } else {
         
            $text_length = mb_strlen($token);
            if ($total_length + $text_length > $length) {
                $result .= mb_substr($token, 0, $length - $total_length);
                break;
            } else {
                $result .= $token;
                $total_length += $text_length;
            }
        }
    }

    while (!empty($tags)) {
        $result .= '</' . array_pop($tags) . '>';
    }

    return $result;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Public Blogs</title>
</head>

<body>
    <header>
        <h1>Blog Posts</h1>
        <a href="login.php" class="btn">Publish Your Blog</a>
    </header>

    <div class="container">
        <div class="search-bar">
            <form method="get" action="index.php">
                <input type="text" name="search" placeholder="Search by title, content, or tags"
                    value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit">Search</button>
            </form>
        </div>

        <?php if (count($posts) > 0): ?>
            <?php foreach ($posts as $post): ?>
                <div class="post">
                    <h2 class="title-txt"><?php echo htmlspecialchars($post['title']); ?></h2>
                    <p><?php  echo safe_truncate($post['content'], 270); ?></p>
                    <a class="btn" href="view_post.php?id=<?php echo $post['id']; ?>">Read More</a>
                    
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No posts found.</p>
        <?php endif; ?>
    </div>
</body>

</html>