//make structure result get request -> webpage
function medicationToViewModel(medication) {
    return '<div class="every-note-div" style="padding: 3%;">'+
        '<tr class="every-note-row" id="task-'+ medication.id+'" style=" margin: 0">'+
        '<td valign="top" style="width:20%; padding:0.5%;"><b>'+ medication.title +
        ':</b></td>'+
        '<td valign="top" style="width:15%; padding:0.5%; text-align:center;"><i>'+ medication.day +
        ':</i></td>'+
        '<td valign="top" style="width:45%; padding:1%;">'+ medication.content +
        '</td>' +
        '<td valign="top" style="width:10%; padding:0.5%;">'+
        '<button class="btn edit-button" data-toggle="modal" data-target="#create-modal" style="padding: 5px; margin-top: 5px; text-align:center;" type="button" id="'+medication.id+'">Edit</button>'+
        '</td>' +
        '<td valign="top" style="width:10%; padding:0.5%;">'+
        '<button class="btn delete-button" style="padding: 5px; margin-top: 5px; text-align:center;" type="button" id="'+medication.id+'">Delete</button>'+
        '</td>' +
        '</tr>' +
        '</div>';
}

function elderlyMedicationPrint(medication) {

}


