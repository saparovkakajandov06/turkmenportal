<div id="calendar_widget" style="overflow: visible"></div>
<?php
Yii::app()->clientScript->registerScript("calendarWidgetWrapper",
    'function calendarWidget(url,direction){
                var defaultUrl="'.Yii::app()->createUrl("//widgets/partial").'";
                if(url===null || url===undefined){
                    url=defaultUrl;
                }
                if(direction===null || direction===undefined){
                    direction="left";
                }
                
                $.ajax({
                            url: url,
                            type: "POST",
                            dataType:"html",
                            data:{
                                "widget":"ext.simple-calendar.SimpleCalendarWidget",
                                "_url":"'.$this->url.'"
                            },
                            success: function(html) {
                                 "left" == direction ? $("#calendar_widget").hide("slide", {
                                    direction: "left"
                                }, 500, function() {
                                    $("#calendar_widget").html(html).show("slide", {
                                        direction: "right"
                                    }, 500)
                                }) : $("#calendar_widget").hide("slide", {
                                    direction: "right"
                                }, 500, function() {
                                    $("#calendar_widget").html(html).show("slide", {
                                        direction: "left"
                                    }, 500)
                                });
                            }
                }); 
            }
                
            $("body").on("click","#calendar_widget .month-year-row a",function(e){
                e.preventDefault();
                var url=$(this).attr("href");
                var parent=$(this).parent();
                var direction="left";
                if(parent.hasClass("previous-month"))
                    var direction="right";
                calendarWidget(url,direction);
                return false;
            });   
             
            timer = setTimeout("calendarWidget()", 50);',
    CClientScript::POS_END);
?>