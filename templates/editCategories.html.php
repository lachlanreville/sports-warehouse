<div class="featured-wrapper">
    <div class="featured-heading">
        <h2><?= $productsHeading ?></h2>
    </div>
    <div>
        <table>
            <tr>
                <th>Category</th>
                <th></th>
            </tr>

            <?php foreach($category as $cat): 
                $categoryName = $cat["categoryName"];
                $categoryId = $cat["categoryId"];
            ?>

            <tr>
                <td><?= $categoryName ?></td>
                <td><form method="post">
                    <input type="submit" name="edit" value="Edit">
                    <input type="hidden" value="<?= $categoryId ?>" name="categoryId">
                </form></td>
            </tr>
            <?php endforeach ?>

            <tr>
                <td>Add New Category</td>
                <td><form method="post">
                    <input type="submit" value="Add" name="new">
                    <input type="hidden" value="new" name="categoryId">
                </form></td>
            </tr>
        </table>
        <?php if($data !== ""): ?>
            <?php if($data == "new"): ?> 
                <form method="post">
                    <input type="text" name="categoryName" id="categoryName">
                    <input type="submit" value="add" name="editCategory" id="edit">
                </form>
            <?php else: ?>
                <form method="post">
                <?php foreach($data as $cat): 
                        $categoryName = $cat["categoryName"];
                        $categoryId = $cat["categoryId"];
                    ?>
                    <input type="text" name="categoryName" id="categoryName" value="<?= $categoryName ?>">
                    <input type="hidden" name="categoryId" value="<?= $categoryId ?>">
                    <input type="submit" value="edit" name="editCategory" id="edit">
                </form>
                <?php endforeach ?>
            <?php endif ?>
        <?php endif ?>
        </div>
</div>