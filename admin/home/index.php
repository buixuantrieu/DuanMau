<html>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

<body>
    <div class="show__info">
        <div class="box__show--info">
            <div class="show__info--number"><?php echo $count_user['count_account'] ?></div>
            <div class="show__info--content">Tài khoản</div>
        </div>
        <div class="box__show--info">
            <div class="show__info--number"><?php echo $count_view['count_view'] ?></div>
            <div class="show__info--content">Lượt xem</div>
        </div>
        <div class="box__show--info">
            <div class="show__info--number"><?php echo $count_order['count_order'] ?></div>
            <div class="show__info--content">Đơn hàng giao thành công</div>
        </div>
    </div>
    <div class="chart__container">
        <div id="myChart" style="width:50%;height:500px;">
        </div>
        <div id="myPlot" style="width:50%;max-width:700px"></div>
    </div>
    <div class="table__statistical">
        <div class="filter_statistical">
            <form action="" method="post">
                <div class="form__group">
                    <label for="">Quý: </label>
                    <select class="quarter" name="quarter" id="">
                        <option value=""> Tất cả</option>
                        <option value="1">Quý 1</option>
                        <option value="2">Quý 2</option>
                        <option value="3">Quý 3</option>
                        <option value="4">Quý 4</option>
                    </select>
                </div>
                <div class="form__group">
                    <label for="">Tháng: </label>
                    <select name="month" class="month" id="">
                        <option value=""> Tất cả</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                </div>
                <div class="form__group">
                    <label for="">Năm: </label>
                    <select name="year" id="">
                        <option value=""> Tất cả</option>
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                        <option value="2021">2021</option>
                    </select>
                </div>
                <div class="form__group">
                    <label for="">Sắp xếp theo: </label>
                    <select name="sort" id="">
                        <option value=""> Mặc định</option>
                        <option value="DESC">Doanh thu cao nhất</option>
                        <option value="ASC"> Doanh thu thấp nhất</option>
                    </select>
                </div>
                <input type="submit" value="Lọc" class="revenue__submit">
            </form>
        </div>
        <table>
            <tr>
                <th>Năm</th>
                <th>Quý</th>
                <th>Tháng</th>
                <th>Tổng doanh thu</th>
            </tr>
            <?php
            foreach ($revenue_list as $item) {
                extract($item)
            ?>
                <tr>
                    <td><?php echo $years ?></td>
                    <td><?php echo $quarters ?></td>
                    <td><?php echo $months ?></td>
                    <td><?php echo number_format($revenue) ?>đ</td>
                </tr>
            <?php
            }
            ?>

        </table>
    </div>

    <script>
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);


        function drawChart() {
            const data = google.visualization.arrayToDataTable([
                ['product', 'Mhl']
                <?php
                foreach ($count_list_product as $item) {
                    extract($item);
                ?>, ['<?php echo $category_name ?>', <?php echo $count_product ?>]
                <?php
                }
                ?>
            ]);

            const options = {
                title: 'Thống kê sản phẩm theo loại hàng',
                is3D: true
            };

            const chart = new google.visualization.PieChart(document.getElementById('myChart'));
            chart.draw(data, options);
        }
    </script>
    <script>
        const xArray = [
            <?php for ($i = 1; $i <= 12; $i++) {
                echo "'$i',";
            } ?>
        ];
        const yArray = [<?php for ($i = 1; $i <= 12; $i++) {
                            $value_y = "0,";
                            foreach ($sum_price_list as $item) {
                                extract($item);
                                if ($month == $i) {
                                    $value_y = "$price_total,";
                                }
                            }
                            echo $value_y;
                        } ?>];

        const data = [{
            x: xArray,
            y: yArray,
            type: "bar"
        }];

        const layout = {
            title: "Doanh thu bán ra hàng tháng năm 2024"
        };

        Plotly.newPlot("myPlot", data, layout);
    </script>
    <script>
        const quarter = document.querySelector('.quarter');
        const monthContainer = document.querySelector('.month');
        quarter.onchange = () => {
            if (quarter.value == 1) {
                monthContainer.innerHTML = `
                    <option value=""> Tất cả</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>`;
            } else if (quarter.value == 2) {
                monthContainer.innerHTML = `
                    <option value=""> Tất cả</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>`;
            } else if (quarter.value == 3) {
                monthContainer.innerHTML = `
                    <option value=""> Tất cả</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>`;
            } else if (quarter.value == 4) {
                monthContainer.innerHTML = `
                    <option value=""> Tất cả</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>`;
            } else if (quarter.value == "") {
                monthContainer.innerHTML = `
                    <option value=""> Tất cả</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>`;
            }
        }
    </script>
</body>

</html>