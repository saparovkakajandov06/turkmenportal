<table id="calendar">
    <thead>
    <tr class="month-year-row">
        <th class="previous-month"><?php echo CHtml::link('<span class="fa fa-angle-double-left"></span>', $this->previousLink, array ("rel" => "nofollow")); ?></th>
        <th colspan="5"><?php echo $this->monthName . ', ' . $this->year; ?></th>
        <th class="next-month"><?php echo CHtml::link('<span class="fa fa-angle-double-right"></span>', $this->nextLink, array ("rel" => "nofollow")); ?></th>
    </tr>
    <tr class="weekdays-row">
        <?php
        $weekDays = Yii::app()->locale->getWeekDayNames('abbreviated');
        //                array_push($weekDays, array_shift($weekDays));
        foreach ($weekDays as $key => $weekDay): ?>
            <?php $class = ($key == 6 || $key == 0) ? "weekday" : "workday"; ?>
            <th class="<?= $class ?>"><?php echo $weekDay; ?></th>
        <?php endforeach; ?>
    </tr>
    </thead>
    <tbody>
    <tr>
        <?php $daysStarted = false;
        $day = 1; ?>
        <?php for ($i = 1;
        $i <= $this->daysInCurrentMonth + $this->firstDayOfTheWeek;
        $i++): ?>

        <?php if (!$daysStarted) $daysStarted = ($i == $this->firstDayOfTheWeek + 1); ?>

        <td <?php if ($day == $this->day) echo 'class="calendar-selected-day"'; ?>>
            <?php if ($daysStarted && $day <= $this->daysInCurrentMonth): ?>
                <?php echo CHtml::link($day, $this->getDayLink($day), array ("rel" => "nofollow"));
                $day++; ?>
            <?php endif; ?>
        </td>

        <?php if ($i % 7 == 0): ?>
    </tr>
    <tr>
        <?php endif; ?>
        <?php endfor; ?>
    </tr>
    </tbody>
</table>
