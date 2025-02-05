<?php
    session_start();
    if(isset($_POST['add'])){
        //print_r($_POST['product_id']);
        if(isset($_SESSION['cart'])){
            // print_r($_SESSION['cart']);
            $item_array_id = array_column($_SESSION['cart'],"product_id");
            $item_array_size = array_column($_SESSION['size_product_id'],"size");
            // print_r($item_array_id);
            //kiem tra product_id co trong card chua
            if(in_array($_POST['product_id'],$item_array_id)){
                echo '<script language="javascript">alert("San pham da co trong Cart ...!"); window.location="index_after_login.php";</script>';
            }
            else{
                $count = count($_SESSION['cart']);
                $item_array_id = array(
                    'product_id' => $_POST['product_id']
                ); // item product_id
                $item_array_size = array(
                    'size' => $_POST['size']
                ); // item size_product
                echo '<script language="javascript">alert("Product added successfully!");</script>';
                $_SESSION['cart'][$count] = $item_array_id;
                $_SESSION['size_product_id'][$count] = $item_array_size;
                // print_r($_SESSION['cart']);
                // echo "<br />";
                // print_r($_SESSION['size_product_id']);
            }
        }
        else{
            $item_array_id = array(
                'product_id' => $_POST['product_id']
            ); //item product_id
            $item_array_size = array(
                'size' => $_POST['size']
            ); //item size_product

            $_SESSION['cart'][0]=$item_array_id;
            $_SESSION['size_product_id'][0]=$item_array_size;
            echo '<script language="javascript">alert("Product added successfully!");</script>';
            // print_r($_SESSION['cart']);
            // echo "<br />";
            // print_r($_SESSION['size_product_id']);

        }

    }
?>
<!DOCTYPE html>
<html>
<head>
    <link rel = "icon" href = "./icon/Daco_373178.png" type = "image/x-icon"> 
    <meta charset="UTF-8">
    <title>Pizza Hut</title>
    <link rel="stylesheet" type="text/css" href="./style.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <script>
        function warning_logout() {
            alert ("logged out")
        }
    </script>
</head>
<body>
    <div id="header">
        <div class="div-header-1"><a href=""><img src="./icon/pizaahut.png" alt="logo pizzahut"></a></div>
        <div class="div-header-2">
            <?php
                echo ' <div><a href=""><img src="./icon/icon-khach-hang.png">'.$_SESSION['Name'].'</a></div>';
            ?>
            <div class="cart-box">
                <a href="cart.php">
                    <img src="./icon/cart_icon.svg">
                   
                </a>
                <span class="cart_count">
                    <?php 
                    if(isset($_SESSION['cart'])){
                        $count = count($_SESSION['cart']);
                        echo "<p>$count</p>";
                    }
                    else{
                        echo "<p>0</p>";
                    }
                    ?>
                    <p></p>
                </span>
            </div>
        </div>
        <div class="div-header-4"><a href="./exit.php" onclick="warning_logout()"><img src="./icon/exit.svg"></a></div>
        <div class="div-header-3">
            <select class="select-box">
                <optgroup label="">
                <option class="opt-VN">VN</option>
                <option class="opt-EN">EN</option> 
            </select>
        </div>  
    </div>
    <div class="temp-1" ></div>
    <div id="main">
        <div class="content-1"><img src="./quangcao/quang-cao-171k.jpg" alt="quang cao img"></div>
        <div class="content-2"> &mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&nbsp;&nbsp;BESTSELLERS&nbsp;&nbsp;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;</div>
        <div class="flex-content-3">
            <div><a id="m1t1" class="active" onclick="active_m1t1()">Mua 1 tặng 1</a></div>
            <div><a id="cb" onclick="active_cb()">Combo</a></div>
            <div><a id="pz" onclick="active_pz()">Pizza</a></div>
            <div><a id="myva" onclick="active_myva()">Mì ý và cơm</a></div>
            <div><a id="mkv" onclick="active_kv()">Món khai vị</a></div>
            <div><a id="tu" onclick="active_tu()">Thức uống</a></div>
        </div>
    <?php 
        require 'connect.php';
        $con->set_charset("UTF-8");
        $sql_1 = "SELECT * FROM sanpham WHERE Ma_Loai='1T1' ";
        $sql_2 = "SELECT * FROM sanpham WHERE Ma_Loai='CB' ";
        $sql_3 = "SELECT * FROM sanpham WHERE Ma_Loai='PZ' ";
        $sql_4 = "SELECT * FROM sanpham WHERE Ma_Loai='M' OR Ma_Loai='C' ";
        $sql_5 = "SELECT * FROM sanpham WHERE Ma_Loai='MKV' ";
        $sql_6 = "SELECT * FROM sanpham WHERE Ma_Loai='N' ";
        $result_1 = $con->query($sql_1);
        $result_2 = $con->query($sql_2);
        $result_3 = $con->query($sql_3);
        $result_4 = $con->query($sql_4);
        $result_5 = $con->query($sql_5);
        $result_6 = $con->query($sql_6);
    ?>
        <div  class=parent-flex-container>
            <div id=mua-1-tang-1 class=flex-container>
                <?php while ($row = $result_1->fetch_assoc()) { ?>
                    <div class=flex-container-item>
                        <form action="index_after_login.php" method="POST">
                            <div class=flex-container-item-content-1>
                                <a><img src="<?php echo $row['HINH']?>"></a>
                            </div>
                            <div class='flex-container-item-content-2'>
                                <div class=flex-container-item-content-2-name> <?php echo $row['Ten_SP'] ?></div>
                                <div class=flex-container-item-content-2-money> <?php echo $row['MOTA'] ?></div>
                                <div class=flex-container-item-content-2-buy>
                                    <button type="submit" name="add" class=flex-container-item-content-2-buy-button>THÊM VÀO GIỎ HÀNG</button>
                                    <input type="hidden" name="product_id" value="<?php echo $row['Ma_SP'] ?>">
                                    <input type="hidden" name="size" value="M">
                                </div>
                            </div>
                        </form>
                    </div>

                <?php } ?> 
            </div>

            <div id=combo class=flex-container>
                <?php while ($row = $result_2->fetch_assoc()) { ?>
                    <div class=flex-container-item>
                        <form action="index_after_login.php" method="POST">
                            <div class=flex-container-item-content-1>
                                <a><img src="<?php echo $row['HINH'] ?>"></a>
                            </div>
                            <div class='flex-container-item-content-2'>
                                <div class=flex-container-item-content-2-name><?php echo $row['Ten_SP'] ?></div>
                                <div class=flex-container-item-content-2-money><?php echo $row['MOTA'] ?></div>
                                <div class=flex-container-item-content-2-buy>
                                    <button type="submit" name="add" class=flex-container-item-content-2-buy-button>THÊM VÀO GIỎ HÀNG</button>
                                    <input type="hidden" name="product_id" value="<?php echo $row['Ma_SP'] ?>">
                                    <input type="hidden" name="size" value="M">
                                </div>
                            </div>
                        </form>
                    </div>
                <?php }; ?> 
            </div>

            <div id=pizza class=flex-container>
                <?php while ($row = $result_3->fetch_assoc()) { ?>
                    <div class=flex-container-item>
                        <form action="index_after_login.php" method="POST">
                            <div class="select-box-pizza">
                                <select name="size">
                                    <option value="S">S</option>
                                    <option value="M" selected="selected">M</option>
                                    <option value="L">L</option>
                                </select>
                            </div>
                            <div class=flex-container-item-content-1>
                                <a><img src=" <?php echo $row['HINH'] ?>"></a>
                            </div>
                            <div class='flex-container-item-content-2'>
                                <div class=flex-container-item-content-2-name><?php echo $row['Ten_SP'] ?></div>
                                <div class=flex-container-item-content-2-money><?php echo $row['MOTA'] ?></div>
                                <div class=flex-container-item-content-2-buy>
                                    <button type="submit" name="add" class=flex-container-item-content-2-buy-button>THÊM VÀO GIỎ HÀNG</button>
                                    <input type="hidden" name="product_id" value="<?php echo $row['Ma_SP'] ?>">
                                </div>
                            </div>
                        </form>
                    </div>
                <?php }; ?>
            </div> 

            <div id=my-y-va-com class=flex-container>
                <?php while ($row = $result_4->fetch_assoc()) { ?>
                    <div class=flex-container-item>
                        <form action="index_after_login.php" method="POST">
                            <div class=flex-container-item-content-1>
                                <a><img src="<?php echo $row['HINH'] ?>"></a>
                            </div>

                            <div class='flex-container-item-content-2'>
                                <div class=flex-container-item-content-2-name><?php echo $row['Ten_SP'] ?></div>
                                <div class=flex-container-item-content-2-money><?php echo $row['MOTA'] ?></div>
                                <div class=flex-container-item-content-2-buy>
                                    <button type="submit" name="add" class=flex-container-item-content-2-buy-button>THÊM VÀO GIỎ HÀNG</button>
                                    <input type="hidden" name="product_id" value="<?php echo $row['Ma_SP'] ?>">
                                    <input type="hidden" name="size" value="M">
                                </div>
                            </div>
                        </form>
                    </div>
                <?php }; ?>
            </div>

            <div id=mon-khai-vi class=flex-container>
                <?php while ($row = $result_5->fetch_assoc()) { ?>
                    <div class=flex-container-item>
                        <form action="index_after_login.php" method="POST">
                            <div class=flex-container-item-content-1>
                                <a><img src="<?php echo $row['HINH'] ?>"></a>
                            </div>

                            <div class='flex-container-item-content-2'>
                                <div class=flex-container-item-content-2-name><?php echo  $row['Ten_SP'] ?></div>
                                <div class=flex-container-item-content-2-money><?php echo  $row['MOTA'] ?></div>
                                <div class=flex-container-item-content-2-buy>
                                    <button type="submit" name="add" class=flex-container-item-content-2-buy-button>THÊM VÀO GIỎ HÀNG</button>
                                    <input type="hidden" name="product_id" value="<?php echo $row['Ma_SP'] ?>">
                                    <input type="hidden" name="size" value="M">
                                </div>
                            </div>
                        </form>
                    </div>
                <?php }; ?>
            </div>

            <div id=thuc-uong class=flex-container>
                <?php while ($row = $result_6->fetch_assoc()) { ?>
                    <div class=flex-container-item>
                        <form action="index_after_login.php" method="POST">
                            <div class=flex-container-item-content-1>
                                <a><img src=" <?php echo $row['HINH'] ?>"></a>
                            </div>

                            <div class='flex-container-item-content-2'>
                                <div class=flex-container-item-content-2-name><?php echo $row['Ten_SP'] ?></div>
                                <div class=flex-container-item-content-2-money><?php echo $row['MOTA'] ?></div>
                                <div class=flex-container-item-content-2-buy>
                                    <button type="submit" name="add" class=flex-container-item-content-2-buy-button>THÊM VÀO GIỎ HÀNG</button>
                                    <input type="hidden" name="product_id" value="<?php echo $row['Ma_SP'] ?>">
                                    <input type="hidden" name="size" value="M">
                                </div>
                            </div>
                        </form>
                    </div>
                <?php }; ?> 
            </div>

        </div> <!-- closs flex parent  -->
    </div> <!-- closs class main  -->
    <div id="footer">
        <div class="flex-footer">
            <div>
                <ul>
                    <li class="title-footer">Cần sự hỗ trợ?</li>
                    <li class="call-footer">Gọi 1900 1822</li>
                </ul>
            </div>
            <div>
                <ul>
                    <li class="title-footer">Về chúng tôi</li>
                    <li><a href="#">Giới thiệu</a></li>
                    <li><a href="#">Tầm nhìn của chúng tôi</a></li>
                    <li><a href="#">Giá trị cốt lõi</a></li>
                    <li><a href="#">Vệ sinh an toàn thực phẩm</a></li>
                </ul>   
            </div>
            <div>
                <ul>
                    <li class="title-footer">Tìm cửa hàng</li>
                    <li><a href="#">Miền Bắc</a></li>
                    <li><a href="#">Miền Trung</a></li>
                    <li><a href="#">Miền Nam</a></li>
                </ul>
            </div>
            <div>
                <ul>
                    <li class="title-footer">Thông tin tuyển dụng</li>
                    <li><a href="#">làm việc tại Pizza Hut</a></li>
                    <li><a href="#">Môi trường làm việc</a></li>
                    <li><a href="#">Cơ hội phát triển nghề nghiệp</a></li>
                </ul>
            </div>
            <div>
                <ul>
                    <li class="title-footer">Liên hệ với Pizza Hut</li>
                    <li>
                        <a href="https://www.facebook.com/VietnamPizzaHut" target="_blank"><img src="icon/FB.png"></a>
                        <a href="https://www.youtube.com/channel/UCyqyAPpM7hbYhrRKi1kv0vg" target="blank"><img src="icon/YT.png"></a>
                        <a href="mailto:customerservice@pizzahut.vn" target="blank"><img src="icon/M.png"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <script>

        var x1 = document.getElementById("m1t1");
        var x2 = document.getElementById("cb");
        var x3 = document.getElementById("pz");
        var x4 = document.getElementById("myva");
        var x5 = document.getElementById("mkv");
        var x6 = document.getElementById("tu");

        var y1 = document.getElementById("mua-1-tang-1");
        var y2 = document.getElementById("combo");
        var y3 = document.getElementById("pizza");
        var y4 = document.getElementById("my-y-va-com");
        var y5 = document.getElementById("mon-khai-vi");
        var y6 = document.getElementById("thuc-uong");

        function active_m1t1() {
            x1.setAttribute("class","active")
            x2.setAttribute("class","")
            x3.setAttribute("class","")
            x4.setAttribute("class","")
            x5.setAttribute("class","")
            x6.setAttribute("class","")

            y1.style.left="0"
            y2.style.left="0"
            y3.style.left="0"
            y4.style.left="0"
            y5.style.left="0"
            y6.style.left="0"
        }
        function active_cb() {
            x1.setAttribute("class","")
            x2.setAttribute("class","active")
            x3.setAttribute("class","")
            x4.setAttribute("class","")
            x5.setAttribute("class","")
            x6.setAttribute("class","")

            y1.style.left="-100%"
            y2.style.left="-100%"
            y3.style.left="-100%"
            y4.style.left="-100%"
            y5.style.left="-100%"
            y6.style.left="-100%"
        }
        function active_pz() {
            x1.setAttribute("class","")
            x2.setAttribute("class","")
            x3.setAttribute("class","active")
            x4.setAttribute("class","")
            x5.setAttribute("class","")
            x6.setAttribute("class","")

            y1.style.left="-200%"
            y2.style.left="-200%"
            y3.style.left="-200%"
            y4.style.left="-200%"
            y5.style.left="-200%"
            y6.style.left="-200%"
        }
        function active_myva() {
            x1.setAttribute("class","")
            x2.setAttribute("class","")
            x3.setAttribute("class","")
            x4.setAttribute("class","active")
            x5.setAttribute("class","")
            x6.setAttribute("class","")

            y1.style.left="-300%"
            y2.style.left="-300%"
            y3.style.left="-300%"
            y4.style.left="-300%"
            y5.style.left="-300%"
            y6.style.left="-300%"
        }
        function active_kv() {
            x1.setAttribute("class","")
            x2.setAttribute("class","")
            x3.setAttribute("class","")
            x4.setAttribute("class","")
            x5.setAttribute("class","active")
            x6.setAttribute("class","")

            y1.style.left="-400%"
            y2.style.left="-400%"
            y3.style.left="-400%"
            y4.style.left="-400%"
            y5.style.left="-400%"
            y6.style.left="-400%"
        }
        function active_tu() {
            x1.setAttribute("class","")
            x2.setAttribute("class","")
            x3.setAttribute("class","")
            x4.setAttribute("class","")
            x5.setAttribute("class","")
            x6.setAttribute("class","active")
            y1.style.left="-500%"
            y2.style.left="-500%"
            y3.style.left="-500%"
            y4.style.left="-500%"
            y5.style.left="-500%"
            y6.style.left="-500%"

        }
    </script>
</body>
</html>