<div class="featured-wrapper">
    <div class="featured-heading">
        <h2><?= $productsHeading ?></h2>
    </div>
    <div>
        <table>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Sale Price</th>
                <th>Description</th>
                <th>Category Name</th>
                <th>Featured</th>
                <th></th>
            </tr>

            <?php foreach($products as $item): 
                $itemName = $item["itemName"];
                $itemId = $item["itemId"];
                $price = $item["price"];
                $salePrice = $item["saleprice"];
                $description = $item["description"];
                $categoryName = $item["categoryName"];
                $featured = $item["featured"];
            ?>

            <tr>
                <td><?= $itemName ?></td>
                <td><?= $price ?></td>
                <?php if($salePrice): ?>
                    <td><?= $salePrice ?></td>
                <?php else: ?>
                    <td>None</td>
                <?php endif ?>
                <td><?= $description ?></td>
                <td><?= $categoryName ?></td>
                <?php if($featured == 1): ?>
                    <td>True</td>
                <?php else: ?>
                    <td>False</td>
                <?php endif ?>
                <td><form method="post">
                    <input type="submit" name="edit" value="Edit">
                    <input type="hidden" value="<?= $itemId ?>" name="productId">
                </form></td>
            </tr>
            <?php endforeach ?>

            <tr>
                <td>Add New Product</td>
                <td><form method="post">
                    <input type="submit" name="insert" value="Add">
                    <input type="hidden" value="new" name="categoryId">
                </form></td>
            </tr>
        </table>

        <?php if($data !== ""): ?>
            <form method="post" enctype="multipart/form-data"> 
                <fieldset>
                    <legend>Product Information</legend>
                        <?php if($data == "new"): ?>
                            <p>
                                <label for="itemName">Product Name</label>
                                <input type="text" name="itemName" id="itemName" required>
                            </p>
                            <p>
                                <label for="itemPrice">Price</label>
                                <input type="text" name="itemPrice" id="itemPrice" required>
                            </p>
                            <p>
                                <label for="salePrice">Sale Price</label>
                                <input type="text" name="salePrice" id="salePrice">
                            </p>
                            <p>
                                <label for="description">Description</label>
                                <input type="text" name="description" id="description" required>
                            </p>
                            <p>
                                <label for="categoryId">Category</label>
                                <select name="categoryId" id="categoryId">
                                    <?php foreach ($category as $cat): 
                                    $categoryName = $cat["categoryName"];
                                    $categoryId = $cat["categoryId"];       
                                    ?>
                                    
                                        <?php if ($categoryId == 1): ?>
                                            <option value="<?= $categoryId ?>" selected><?= $categoryName ?></option>
                                        <?php else: ?>
                                            <option value="<?= $categoryId ?>"><?= $categoryName ?></option>    
                                        <?php endif ?>                                    
                                    <?php endforeach ?>   
                                </select>
                            </p>
                            <p>
                                <label for="featured">Featured</label>
                                <input type="checkbox" name="featured" id="featured">
                            </p>
                            <p>
                                <label for="productImage">Image</label>
                                <input type="file" name="productImage" id="productImage" required>
                                <span><?= $message ?></span>
                            </p>
                            <p>
                                <input type="submit" name="addNew" value="Confirm">
                            </p>
                        <?php else: ?>
                            <p>
                                <label for="itemName">Product Name</label>
                                <input type="text" name="itemName" id="itemName" value="<?= $data["itemName"] ?>" required>
                            </p>
                            <p>
                                <label for="itemPrice">Price</label>
                                <input type="text" name="itemPrice" id="itemPrice" value="<?= $data["price"] ?>" required>
                            </p>
                            <p>
                                <label for="salePrice">Sale Price</label>
                                <input type="text" name="salePrice" id="salePrice" value="<?= $data["saleprice"] ?>">
                            </p>
                            <p>
                                <label for="description">Description</label>
                                <input type="text" name="description" id="description" value="<?= $data["description"] ?>" required> 
                            </p>
                            <p>
                                <label for="category">Category</label>
                                <select name="category" id="category">
                                    <?php foreach ($category as $cat): 
                                    $categoryName = $cat["categoryName"];
                                    $categoryId = $cat["categoryId"];       
                                    ?>
                                        <?php if($categoryId == $data["categoryId"]): ?>
                                            <option value="<?= $categoryId ?>" selected><?= $categoryName ?></option>
                                        <?php elseif ($categoryId == 0): ?>
                                            <option value="<?= $categoryId ?>" selected><?= $categoryName ?></option>
                                        <?php else: ?>
                                            <option value="<?= $categoryId ?>"><?= $categoryName ?></option>    
                                        <?php endif ?>
                                    <?php endforeach ?>   
                                </select>
                            </p>
                            <p>
                                <label for="featured">Featured</label>
                                <?php if($data['featured'] == 1): ?>
                                    <input type="checkbox" name="featured" id="featured" checked>
                                <?php else: ?>
                                    <input type="checkbox" name="featured" id="featured">
                                <?php endif ?>
                            </p>
                            <p>
                                <label for="productImage">Image</label>
                                <input type="file" name="productImage" id="productImage">
                                <span><?= $message ?></span>
                            </p>
                            <p>
                                <input type="hidden" name="itemId" value=<?= $data["itemId"] ?>>
                                <input type="hidden" name="hiddenImage" value=<?= $data["photo"] ?>>
                                <input type="hidden" name="hiddenCategory" value=<?= $data["categoryId"] ?>>
                                <input type="submit" name="update" value="Confirm">
                            </p>
                        <?php endif ?>
                </fieldset>
            </form>
        <?php endif ?>
    </div>
</div>