<link rel="stylesheet" href="<?=base_url();?>styles/homescreen.css">

<div id="full-clndr" class="clearfix" style="font-size: 19pt">
    <script type="text/template" id="full-clndr-template">
        <div class="clndr-controls" id="controls"}>
            <div data-step="2" data-intro="<?=$this->lang->line('h_prev')?>" data-position='down' class="clndr-previous-button">
                <div class="clndr-previous-button"><button class="btn btn-small" type="button">PREVIOUS</button></div>

            </div>
            <div data-step="3" data-intro="<?=$this->lang->line('h_next')?>" data-position='down' class="clndr-next-button">
                <button class="btn btn-small" type="button">NEXT</button>
            </div>
            <div data-step="1" data-intro="<?=$this->lang->line('h_month')?>" data-position='down' class="current-month"><%= month %> <%= year %></div>
        </div>
        <table data-step="4" data-intro="<?=$this->lang->line('h_calendar')?>" data-position='right' class="clndr-grid">
            <tr class="days-of-the-week clearfix">
                <% _.each(daysOfTheWeek, function(day) { %>
                <th class="header-day"><%= day %></th>
                <% }); %>
            </tr>
            <tr class="days" style="font-size: 22pt;">
                <% _.each(days, function(day) { %>
                <td class="<%= day.classes %>" id="<%= day.id %>"><div class="day-number"><%= day.day %></div></td>
                <% }); %>
            </tr>
        </table>

        <div  class="event-listing">
            <div class="event-listing-title">
                TO-DO'S OF
                <span id="selected-date"></span>
                <button style="padding: 5px;" class="btn pull-right" data-toggle="modal" data-target="#create-modal">
                    Add
                </button>
            </div>
            <table id="todo-list" class="event-item" style="width: 98%; margin: 2%">
            </table>
        </div>
    </script>
</div>


<div class="modal fade" id="create-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Add Task
            </div>
            <form class="form-horizontal" id="task-creation-form" action="<?=base_url();?>index.php/api/task" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="description">Description</label>
                        <div class="col-xs-10">
                            <input type="text" class="form-control" name="description" id="description" placeholder="Task Description">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="date-time">Date-Time</label>
                        <div class="col-xs-10">
                            <input type="date" name="task_date" class="form-control" id="date-time" placeholder="Date">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btn-task-save" type="submit" class="btn btn-default">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="<?=base_url();?>scripts/less.js" type="text/javascript"></script>
<script src="<?=base_url();?>scripts/underscore.js" type="text/javascript"></script>
<script src="<?=base_url();?>scripts/moment.js" type="text/javascript"></script>
<script src="<?=base_url();?>scripts/clndr.js" type="text/javascript"></script>
<script src="<?=base_url();?>scripts/config.js" type="text/javascript"></script>
<script src="<?=base_url();?>scripts/site.js" type="text/javascript"></script>
<script src="<?=base_url();?>scripts/manage.js" type="text/javascript"></script>