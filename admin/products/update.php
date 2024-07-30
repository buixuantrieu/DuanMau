 <?php include '../../model/product.php';

    if (isset($_POST['product-submit']) && isset($_GET['id'])) {
        if ($_FILES['product-image']['name'] === "") {
            $name = $_POST['product-name'];
            $quantity = $_POST['product-quantity'];
            $des = $_POST['product-des'];
            $price = $_POST['product-price'];
            $sale = $_POST['product-sale'];
            $category_id = $_POST['category'];
            $image = $_POST['image'];
            update_product($name, $image, $price, $sale, $des, $category_id, $_GET['id'], $quantity);
            header('Location: ./index.php?page=products');
        } else if ($_FILES['product-image']['name'] !== "") {
            $picture = $_FILES['product-image'];
            $path = __DIR__ . '/../../uploadFiles';
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }
            if (move_uploaded_file($picture['tmp_name'], $path . '/' . $picture['name'])) {
                $quantity = $_POST['product-quantity'];
                $name = $_POST['product-name'];
                $des = $_POST['product-des'];
                $price = $_POST['product-price'];
                $sale = $_POST['product-sale'];
                $category_id = $_POST['category'];
                $image = $picture['name'];
                update_product($name, $image,  $price, $sale, $des, $category_id, $_GET['id'], $quantity);
                header('Location:./index.php?page=products');
            } else {
                echo 'Image uploaded Error!';
            }
        }
    }
    ?>
 <div class="products__wrapper">
     <div class="product__title">Quản lí sản phẩm</div>
     <div class="popup__wrapper active__popup">
         <div class="popup__container">
             <div class="popup__container--exits">
                 <a href="./index.php?page=products"><i class="fa-solid fa-xmark"></i></a>
             </div>
             <div class="popup__title">
                 Cập nhật sản phẩm
             </div>
             <form action="" method="post" enctype="multipart/form-data">
                 <label for="">
                     Tên:
                 </label>
                 <input name="product-name" value="<?php echo $item['name'] ?>" required type="text">
                 <label for="">Mô tả:</label>
                 <textarea required name="product-des" name="" id=""><?php echo $item['des'] ?></textarea>
                 <label for="">Category:</label>
                 <select name="category" id="">
                     <?php
                        foreach ($list_category as $items) {
                            extract($items)
                        ?>
                         <option value="<?php echo $id ?>"><?php echo $name ?></option>
                     <?php
                        }
                        ?>
                 </select>
                 <label for="">Giá:</label>
                 <input value="<?php echo $item['price'] ?>" name="product-price" required>
                 <label for="">Số lượng:</label>
                 <input value="<?php echo $item['quantity'] ?>" type="number" min="1" max="999" name="product-quantity" required>
                 <label for="">Khuyến mãi:</label>
                 <input value="<?php echo $item['sale'] ?>" name="product-sale" required>
                 <label for="">Ảnh:</label>
                 <input type="hidden" name="image" value="<?php echo $item['image'] ?>">
                 <input name="product-image" type="file">
                 <input name="product-submit" type="submit" value="Cập nhật sản phẩm">
                 <input type="reset" value="Reset">
             </form>
         </div>
     </div>
 </div>