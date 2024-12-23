<?php
require_once '../signup/config_seesion.inc.php';  
require_once '../signup/dbh.inc.php'; 

if (!isset($_SESSION['user_id'])) {
    header('Location: ../signup/sign_index.php?error=unauthorized');
    exit();
}

include '../signup/header_author.php';

// SQL Query
$query = "
SELECT 
    a.id, 
    a.title, 
    a.views_count, 
    a.created_time, 
    COUNT(c.id) AS comment_count,
    COALESCE(SUM(l.number_likes), 0) AS number_likes
FROM article a
LEFT JOIN commentes c ON a.id = c.article_id
LEFT JOIN likes l ON a.id = l.article_id
WHERE a.author_id = :author_id
GROUP BY a.id
ORDER BY a.created_time DESC;
";

$stmt = $pdo->prepare($query);

$stmt->bindParam(':author_id', $_SESSION['user_id'], PDO::PARAM_INT);

$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="main_dash">
    <div class="table">
        <div class="table_header">
            <div class="adddd">
                <form action="creat_post.php">
                    <button class="add_new">+Add new</button>
                </form>
            </div>
        </div>
        <div class="tables_section">
            <table>
                <thead>
                    <tr>
                        <th>Arc.title</th>
                        <th>Views</th>
                        <th>Comments</th>
                        <th>Likes</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($posts): ?>
                        <?php foreach ($posts as $post): ?>
                            <tr>
                                <td><?= htmlspecialchars($post['title']) ?></td>
                                <td><?= htmlspecialchars($post['views_count']) ?></td>
                                <td><?= htmlspecialchars($post['comment_count']) ?></td>
                                <td><?= htmlspecialchars($post['number_likes']) ?></td>
                                <td>
                                    <a href="article.php?id=<?= $post['id'] ?>">View</a>
                                    <form action="../authore/edit_article.php" method="get">
                                        <input type="hidden" name="id" value="<?= $post['id'] ?>">
                                        <button>Edit</button>
                                    </form>
                                    <form action="../authore/delet_article.php" method="get">
                                        <input type="hidden" name="id" value="<?= $post['id'] ?>">
                                        <button>Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5">No posts found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include '../authore/footer.php'; ?>
