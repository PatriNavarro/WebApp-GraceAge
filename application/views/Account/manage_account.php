<?php
$this->lang->load('manage_account', $my_language);
?>

<script>
    var prefered_language = [
        { Name: "All", Id: "" },
        { Name: "EN", Id: "1" },
        { Name: "NL", Id: "2" },
        { Name: "FR", Id: "3"}
    ];
    var user_type = [
        { Name: "All", Id: "" },
        { Name: "Admin", Id: "1" },
        { Name: "Caregiver", Id: "2" },
        { Name: "Elderly", Id: "3"}
    ];
    $(document).ready(function () {
        $("#jsGrid").jsGrid({
            height : "80%",
            width: "100%",

            filtering: true,
            sorting: true,
            paging: true,

            autoload: true,
            deleteConfirm: "<?= $this->lang->line('delete_confirm')?>",
            rowClick: function(args) {
                $(location).attr('href','<?=base_url();?>index.php/account/edit/'+args.item.id);
            },

            controller: {
                loadData: function(filter) {

                    var d = $.Deferred();
                    $.ajax({
                        type: "GET",
                        url: "<?=base_url();?>index.php/api/account",
                        data: filter,
                        dataType: "json"
                    }).done(function(response) {
                        d.resolve(response.value);
                    });
                    return d.promise();
                },
                deleteItem: function(item) {

                    $.ajax({
                        type: "GET",
                        url: "<?=base_url();?>index.php/account/delete/"+item.id,
                        success: function () {
                            alert('<?= $this->lang->line('user_deleted')?>');
                        }
                    });
                }
            },

            fields: [
                { title: "<?= $this->lang->line('username')?>", name: "username", type: "text" },
                { title: "<?= $this->lang->line('name')?>", name: "display_name", type: "text" },
                { title: "<?= $this->lang->line('description')?>", name: "description", type: "textarea", width: 150 },
                { title: "<?= $this->lang->line('email')?>", name: "email", type: "text"},
                { title: "<?= $this->lang->line('language')?>", name: "preferred_language", type: "select", items: prefered_language, valueField: "Id", textField: "Name" },
                { title: "<?= $this->lang->line('user_type')?>", name: "user_type", type: "select", items: user_type, valueField: "Id", textField: "Name" },
                { title: "<?= $this->lang->line('join_date')?>", name: "created_date", type: "text" },
                {
                    type: "control",
                    modeSwitchButton: true,
                    editButton: false,
                    filtering: true,
                },
            ]
        });
        $('.jsgrid-button.jsgrid-mode-button.jsgrid-search-mode-button').click();
        $('#jsGrid').css('word-wrap', 'break-word', 'important');
    });
</script>


<div class="row">
    <div class="col-xs-8 col-sm-10">
        <h2 class="page-title hidden-xs"><?= $this->lang->line('user_account_management')?></h2>
        <h4 class="page-title hidden-sm hidden-lg hidden-md"><?= $this->lang->line('user_account_management')?></h4>
    </div>
    <div class="col-xs-4 col-sm-2" style="margin-top: 4px;">
        <a href="<?=base_url();?>index.php/account/create">
            <button type="button" class="btn btn-primary pull-right"><?= $this->lang->line('create_account')?></button>
        </a>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div id="jsGrid"></div>
    </div>
</div>