

<link rel="stylesheet" href="<?=base_url();?>styles/homescreen.css">

<div class="flex-center" style="padding: 0">
    <div id="calendar-view" class="panel" style="height: 50%; border-color: lightgray; border-style: solid; border-width: 1px;  margin: 0;">
        <div class="panel daily-calendar-head" style=" height: 25%; display:table">
            <div style="font-size: 3vw;display: table-cell; vertical-align: middle; color: whitesmoke">
                <?=date('F');?>
            </div>
        </div>
        <div class="panel" style="display: table; height: 50%;">
            <div style="display: table-cell; vertical-align: middle; font-size: 12vw; ">
                <?=date('j');?>
            </div>
        </div>
        <div class="panel" style="display: table; height: 25%;">
            <div style="display: table-cell; vertical-align: middle; font-size: 3vw; ">
                <?=date('l');?>
            </div>
        </div>
    </div>
    <div id="task-view" style="text-align: left;height: 50%;padding: 15px">
        <div style="font-size: 2vw">
            TO-DO's
        </div>
        <hr style="margin: 0"/>
        <div>
            <ul style="padding-left: 7% !important ; ">
                <?php
                $i = 0;
                foreach ($taskList as $task) {
                    echo '<li style="font-size: 1.2rem;">'.$task->description.'</li>';
                    if ($i++ >= 3)
                        break;
                }
                if ($i == 4)
                    echo 'Click for more';
                ?>
            </ul>
        </div>
    </div>
</div>
