
<h3><?php echo $pollsModel->getMixedDescriptionModel()->title; ?></h3>

<div class="opros_answers">
<?php
$total_likes = 0;
if (isset($answers)) {
    foreach ($answers as $answer) {
        $total_likes+=$answer->likes;
    }

    if ($total_likes > 0) {
        ?>
        <table class="poll">
            <tbody>
                <?php
                foreach ($answers as $answer) {
                    $percent = round($answer->likes * 100 / $total_likes,1);
                    echo "<tr>";
                    echo '<td align="left">' . $answer->getMixedDescriptionModel()->answer . ' ('.$answer->likes." ".Yii::t('app','sany').')<h6 style="background:#0033CC; width:' . $percent . '%">&nbsp;</h6></td>';
                    echo "</tr>";
                }
                ?>
                <tr>
                    <th align="center" style="font-weight: normal; color: red; font-size: 14px; padding-bottom: 10px;"><?php echo Yii::t('app','total_answers').': '.$total_likes; ?></th>
                </tr>
                <tr>
                    <th align="center" style="font-weight: normal; color: red; font-size: 14px; padding-bottom: 10px;">
                        <?php
                            echo CHtml::ajaxLink(Yii::t('app', 'Return_to_opros'), Yii::app()->createUrl('/polls/poll',array('id'=>$pollsModel->id)),$ajaxOptions=array(
                                   'success'=>'js:function(data){
                                           try {
                                               $(".opros").html(data);
                                            } catch (e) {
                                               console.log(e);
                                               console.log(data);
                                            }
                                     }'
                           ));
                        ?>
                    </th>
                </tr>
            </tbody>
        </table>
        <?php
    }
}
?>
</div>