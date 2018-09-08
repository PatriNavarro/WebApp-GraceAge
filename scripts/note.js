//make structure result get request -> webpage
function noteToViewModel(note) {
    return '<div class="every-note-div" style="padding-top: 2%;">'+
            '<tr class="every-note-row" id="task-'+ note.id+'" style=" margin: 20px;">'+
            '<td valign="top" style="width:20%; padding:0.5%;"><b>'+ note.title +
            ':</b></td>'+ 
            '<td valign="top" style="width:50%; padding:0.5%;">'+ note.content +
            '</td>' +
            '<td valign="top" style="width:15%; padding:0.5%;">'+
            '<button class="btn edit-button" data-toggle="modal" data-target="#create-modal" style="padding: 5px; margin-top: 5px" type="button" id="'+note.id+'">Edit</button>'+
            '</td>' +
            '<td valign="top" style="width:15%; padding:0.5%;">'+
            '<button class="btn delete-button" style="padding: 5px; margin-top: 5px" type="button" id="'+note.id+'">Delete</button>'+
            '</td>' +
            '</tr>' +
            '</div>';
}


