<link rel="stylesheet" href="<?=base_url();?>styles/homescreen.css">

<div class="col-md-4" style="margin-top:10px; margin-bottom: 10px;">
    <div class="col-xs-12" style="text-align: center; height: 100%; background-color: white;border-radius: 7px;box-shadow: 0 5px 3px grey;">
        <div class="panel daily-calendar-head" style=" height: 11%;border-radius: 7px;">
            <div style="font-size: 3vh; color: whitesmoke">
                <?php
                $date = date("Y-m-d");//, strtotime("+1 day"))
                echo date('l', strtotime($date)).' (Today)';
                ?>
            </div>
            <div style="font-size: 3vh; color: whitesmoke">
                <?php
                    echo date('d-F-Y');
                ?>
            </div>
        </div>
        <div style="text-align: left; font-size: 17pt">

            <ul>
                <?php
                    foreach ($day0 as $task)
                        echo '<li>'.date("H:i",strtotime($task->task_date)).'u - '.$task->description.'</li>';
                ?>
            </ul>
        </div>
    </div>
</div>
<div class="col-md-4" style="margin-top:10px; margin-bottom: 10px;">
    <div class="col-xs-12" style="text-align: center; height: 100%; background-color: white;border-radius: 7px;box-shadow: 0 5px 3px grey;">
        <div class="panel daily-calendar-head" style=" height: 11%;border-radius: 7px;">
            <div style="font-size: 3vh; color: whitesmoke">
                <?php
                $date = date("Y-m-d", strtotime("+1 day"));
                echo date('l', strtotime($date));
                ?>
            </div>
            <div style="font-size: 3vh; color: whitesmoke">
                <?php
                echo date('d-F-Y', strtotime("+1 day"));
                ?>
            </div>
        </div>
        <div style="text-align: left; font-size: 17pt">

            <ul>
                <?php
                foreach ($day1 as $task)
                    echo '<li>'.date("H:i",strtotime($task->task_date)).'u - '.$task->description.'</li>';
                ?>
            </ul>
        </div>
    </div>
</div>

<div class="col-md-4" style="margin-top:10px; margin-bottom: 10px;">
    <div class="col-xs-12" style="text-align: center; height: 100%; background-color: white;border-radius: 7px;box-shadow: 0 5px 3px grey;">
        <div class="panel daily-calendar-head" style=" height: 11%;border-radius: 7px;">
            <div style="font-size: 3vh; color: whitesmoke">
                <?php
                $date = date("Y-m-d", strtotime("+2 day"));
                echo date('l', strtotime($date));
                ?>
            </div>
            <div style="font-size: 3vh; color: whitesmoke">
                <?php
                echo date('d-F-Y', strtotime("+2 day"));
                ?>
            </div>
        </div>
        <div style="text-align: left; font-size: 17pt">

            <ul>
                <?php
                foreach ($day2 as $task)
                    echo '<li>'.date("H:i",strtotime($task->task_date)).'u - '.$task->description.'</li>';
                ?>
            </ul>
        </div>
    </div>
</div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="<?=base_url();?>scripts/site.js" type="text/javascript"></script>
