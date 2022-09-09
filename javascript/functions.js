const d = new Date();

function takenRooms() {
    let rezerverdRooms = $('.rezervari');
    //console.log(rezerverdRooms[1].childNodes[1].innerHTML);
    let roomsNr = [];
    for(let i = 1; i < rezerverdRooms.length; i++){
        roomsNr.push(rezerverdRooms[i].childNodes[1].innerHTML);
    }
    for(let i = 0; i < roomsNr.length; i++){
        let id = 'cam';
        id += roomsNr[i];
        id = "#" + id;
        $(id).addClass('ocupat');
        $(id).removeClass('disponibila');
    }
}

function backHome(day = d.getDate(), month = d.getMonth()+1, year = d.getFullYear()) {
    location.href = './index.php?day='+day+'&month='+month+'&year='+year;
}

takenRooms();

function decrMonth(){
    let m = $("#form-month").val();
    let y = $("#form-year").val();
    m--;
    if(m == 0) {
        m = 12;
        y--;
    }
    $("#form-month").val(m);
    $("#form-year").val(y);
}

function incrMonth(){
    let m = $("#form-month").val();
    let y = $("#form-year").val();
    m++;
    if(m == 13) {
        m = 1;
        y++;
    }
    $("#form-month").val(m);
    $("#form-year").val(y);
}

function getRezervations() {
    let month = $('#form-month').val();
    let year = $('#form-year').val();
    location.href = './rezervations-list.php?month='+month+'&year='+year;
}

