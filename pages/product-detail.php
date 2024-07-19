<?php extract($product_detail) ?>
<link rel="stylesheet" href="assets/css/product-detail.css">
<div class="product__detail--wrapper">
    <?php
    if ($check && isset($check)) {
    ?>
        <div class="notification">
            hi
        </div>
    <?php
    } else if (!$check && isset($check)) {
    ?>
        <div class="notification">
            Cập nhật giỏ hàng thành công!
        </div>
    <?php
    }
    ?>
    <div class="product__detail--container">
        <div class="product__detail--left">
            <img src="uploadFiles/<?php echo $image ?>" alt="">
        </div>
        <div class="product__detail--right">
            <form action="" method="post">
                <div class="product__detail--category"> <?php echo $category_name ?></div>
                <div class="product__detail--name"><?php echo $product_name ?></div>
                <div class="price">Giá:</div>
                <div class="product__price">
                    <?php echo number_format($price - $price * $sale) ?>đ
                    <?php if ($sale > 0) {
                    ?>
                        <div class="product__price--sale"><?php echo number_format($price) ?>đ</div>
                        <div class="product__sale">-<?php echo $sale * 100 ?>%</div>
                    <?php
                    } ?>
                </div>
                <div class="product__detail--quantity">
                    <label for="">Số lượng:</label>
                    <input min="1" max="99" value="1" name="quantity" type="number">
                </div>
                <div class="product__detail--endow">
                    <div class="endow__title">Ưu đãi</div>
                    <div class="endow__content">
                        <h5>Trả góp không phụ thêm phí khi mua <?php echo $product_name ?>.</h5>
                        <ul>
                            <li>- Cơ hội trúng 10 xe máy Yamaha Sirius mỗi tháng, tổng giải thưởng lên đến 390 Triệu.</li>
                            <li>- Nhập mã VNPAYTGDD2 giảm ngay 1% (tối đa 200.000đ) khi thanh toán qua VNPAY-QR, áp dụng cho đơn hàng từ 3 Triệu.</li>
                        </ul>
                    </div>
                </div>
                <div>
                    <input class="product__detail--add--cart" type="submit" name="add-to-cart" value="Thêm vào giỏ hàng">
                </div>
            </form>
        </div>
    </div>
    <div>
        <div class="review__wrapper">
            <div class="review__title">Đánh giá sản phẩm</div>
            <?php
            foreach ($review_list as $review_item) {
                extract($review_item);
            ?>
                <div class="box__review">
                    <div class="avatar__name">
                        <div class="review__avatar" style="background-image: url(uploadFiles/<?php echo $avatar ?>);">
                        </div>
                        <div class="review__name--container">
                            <div class="review__name"><?php echo $full_name ?></div>
                            <div class="review__star">
                                <?php
                                if ($rate === 1) {
                                ?>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                <?php
                                } else if ($rate === 2) {
                                ?>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                <?php
                                } else if ($rate === 3) {
                                ?>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                <?php
                                } else if ($rate === 4) {
                                ?>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                <?php
                                } else {
                                ?>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                    <div class="review__content"><?php echo $comment ?></div>
                </div>
            <?php
            }
            ?>

            <div>
                <?php
                if (!isset($_SESSION['auth'])) {
                ?>
                    <p class="show__check">Bạn cần đăng nhập để thực hiện chức năng này</p>
                <?php
                } else if (!$check_review) {
                ?>
                    <p class="show__check">Bạn đã đánh giá về sản phẩm này rồi !!</p>
                <?php
                } else if ($check_status) {
                ?>
                    <p class="show__check">Bạn cần mua sản phẩm thành công mới có thể bình luận</p>
                <?php
                } else {
                ?>
                    <form class="form__review--wrapper" action="" method="post">
                        <textarea required name="comment" id=""></textarea>
                        <div class="rate__container">
                            <div class="rate__group">
                                <input name="rate" type="radio" value="1">
                                <label for="">1 sao</label>
                            </div>
                            <div class="rate__group">
                                <input name="rate" type="radio" value="2">
                                <label for="">2 sao</label>
                            </div>
                            <div class="rate__group">
                                <input name="rate" type="radio" value="3">
                                <label for="">3 sao</label>
                            </div>
                            <div class="rate__group">
                                <input name="rate" type="radio" value="4">
                                <label for="">4 sao</label>
                            </div>
                            <div class="rate__group">
                                <input checked name="rate" type="radio" value="5">
                                <label for="">5 sao</label>
                            </div>
                        </div>
                        <input type="submit" value="Bình luận">
                    </form>
                <?php
                }
                ?>

            </div>
        </div>
    </div>
</div>