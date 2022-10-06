<div class="container">

    <a href="<?php echo (Yii::app()->createUrl("//bannerType/update",array("id"=>$type['id']))) ?>">
        <i style="color: #a71f1fa1;" onmouseover="this.style.color='#a71f1f'" onmouseout="this.style.color='#a71f1fa1'" class="fa fa-arrow-circle-left fa-2x"></i>
    </a>

    <h1 style="margin-bottom: 20px;">Banner type: <?php echo $type['name'] ?></h1>

    <h3 style="margin-bottom: 20px; margin-top: 50px;" class="text-center"><?php echo "$description" ?></h3>

    <table class="table table-hover table-bordered text-center">
        <thead style="background-color: #a71f1f">
            <tr style="color: #fff;">
                <th scope="col" class="text-center">№</th>
                <th scope="col" class="text-center">View count <span style="margin-left: 10px;"><i class="fa fa-eye"></i></span></th>
                <th scope="col" class="text-center">Click count <span style="margin-left: 10px;"><i class="fa fa-hand-o-up"></i></span></th>
                <th scope="col" class="text-center">Status</th>
                <th scope="col" class="text-center">Date <span style="margin-left: 10px;"><i class="fa fa-calendar"></i></span></th>
            </tr>
        </thead>

        <tbody>
        <?php
            foreach ($banners as $item => $banner){
        ?>
            <tr>
                <th scope="row" class="text-center"><?php echo $item + 1 ?></th>
                <td><?php echo $banner->view_count ?></td>
                <td><?php echo $banner->click_count ?></td>
                <td>
                    <?php
                        switch ($banner->status){
                            case 0:
                                echo "<i style='color: #953b39;' class='fa fa-times' aria-hidden='ture'></i>";
                                break;
                            case 1:
                                echo "<i style='color: #00aa00' class='fa fa-check'>";
                                break;
                            case 2:
                                echo "<i style='color: #e5d404' class='fa fa-calendar-o' aria-hidden='true'></i></i>";
                                break;

                        }
                    ?>
                </td>
                <td style="font-weight: bold"><?php echo date_format(date_create($banner->date_created),"d/m/Y H:i:s") ?></td>
            </tr>
        <?php
            }
        ?>
        </tbody>
    </table>

</div>