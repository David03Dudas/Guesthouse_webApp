let zile = [
    'Luni',
    'Marți',
    'Miercuri',
    'Joi',
    'Vineri',
    'Sâmbătă',
    'Duminică'
];

let luni = [
    'Ianuarie',
    'Februarie',
    'Martie',
    'Aprilie',
    'Mai',
    'Iunie',
    'Iulie',
    'August',
    'Septembrie',
    'Octombrie',
    'Noiembrie',
    'Decembrie'
]

let data = new Date();
indexLuna = $('#hidden-month').val()-1;
an = $('#hidden-year').val();
day = $('#hidden-day').val();

$('#luna').html(luni[indexLuna]);
$('#luna').val(indexLuna+1);
$('#anul').html(an);
$('#anul').val(an);

setData(indexLuna, an);

$('#next-luna').click(function () {
    indexLuna++;
    if(indexLuna >= 12) {
        indexLuna = 0;
        an++;
        $('#anul').html(an);
    }
    $('#luna').html(luni[indexLuna]);
    setData(indexLuna, an);
})

$('#prev-luna').click(function () {
    indexLuna--;
    if(indexLuna < 0) {
        indexLuna = 11;
        an--;
        $('#anul').html(an);
    }
    $('#luna').html(luni[indexLuna]);
    setData(indexLuna, an);
})

function getDaysInMonth(year, month) {
    return new Date(year, month, 0).getDate();
}

function getFirstDayOfMonth(year, month) {
    let d = new Date(year, month, 1);
    return d.getDay();
}

function setCalendarColors(indexLuna, an) {
    let dates = $("#disp_dates_list").val();
    dates = dates.split(' ');
    dates.pop();
    for(let i = 0; i < dates.length; i++) {
        dates[i] = dates[i].split(',');
    }
    let predate = $(".predate");
    for(let i = 0; i < predate.length; i++) {
        for(let j = 0; j < dates.length; j++) {
            //console.log(date[i].value+' '+indexLuna+' '+an+'???'+dates[j][0]+' '+dates[j][1]+' '+dates[j][2])
            if(predate[i].value == dates[j][0] && indexLuna - 1 == dates[j][1] && an == dates[j][2]){
                predate[i].classList.add("calendar_ocupat");
            }
            else {
                predate[i].classList.add("calendar_disponibil");
            }
        }
    }
    let date = $(".date");
    for(let i = 0; i < date.length; i++) {
        for(let j = 0; j < dates.length; j++) {
            //console.log(date[i].value+' '+indexLuna+' '+an+'???'+dates[j][0]+' '+dates[j][1]+' '+dates[j][2])
            if(date[i].value == dates[j][0] && indexLuna == dates[j][1] && an == dates[j][2]){
                date[i].classList.add("calendar_ocupat");
            }
            else {
                date[i].classList.add("calendar_disponibil");
            }
        }
    }
    let postdate = $(".postdate");
    for(let i = 0; i < postdate.length; i++) {
        for(let j = 0; j < dates.length; j++) {
            //console.log(date[i].value+' '+indexLuna+' '+an+'???'+dates[j][0]+' '+dates[j][1]+' '+dates[j][2])
            if(postdate[i].value == dates[j][0] && indexLuna + 1 == dates[j][1] && an == dates[j][2]){
                postdate[i].classList.add("calendar_ocupat");
            }
            else {
                postdate[i].classList.add("calendar_disponibil");
            }
        }
    }
}
function setData (indexLuna, an) {
    $("#datele").empty();
    let zilePrescurtate = [
        'Lu', 'Ma', 'Mi', 'Jo', 'Vi', 'Sa', 'Du'
    ];
    for(let i = 0; i < 7; i++){
        let d = $("<p></p>").text(zilePrescurtate[i]);
        $('#datele').append(d);
    }
    let start = getFirstDayOfMonth(an, indexLuna) - 1;
    let predays = getDaysInMonth(an, indexLuna) + 1;
    if(start == -1) start = 6;
    for(let i = start; i >= 1; i--){
        let goToMonth = indexLuna;
        let goToYear = an;
        if(indexLuna == 0) {
            goToMonth = 12;
            goToYear = an-1;
        }
        let d = $("<button type = 'submit' name = \"day\" class='predate' onclick =\"decrMonth()\" value = '"+(predays-i)+"'></button>").text(predays-i);
        $('#datele').append(d);
    }
    let days = getDaysInMonth(an, indexLuna + 1); 
    for(let i = 1; i <= days; i++){
        let d = $("<button name = \"day\" type = \"submit\" class='date'></button>").text(i);
        d.val(i);
        if(indexLuna == new Date().getMonth() && an == new Date().getFullYear() && i == new Date().getDate()){
            d.addClass('actualDay');
        }
        if(i == day && indexLuna == $('#hidden-month').val()-1 && an == $('#hidden-year').val()) {
            d.addClass('outputDay');
        }
        $('#datele').append(d);
    }
    if(start < 0) start = 0;
    for(let i = 1; i <= 7 - (days + start)%7 && (days + start)%7 != 0; i++){
        let d = $("<button type = 'submit' name = \"day\" class='postdate' onclick =\"incrMonth()\" value = '"+(i)+"'></button>").text(i);
        $('#datele').append(d);
    }
    let m = $("<input type = \"hidden\" name = \"month\" id=\"form-month\"></input>");
    let y = $("<input type = \"hidden\" name = \"year\" id=\"form-year\"></input>");
    m.val(indexLuna + 1);
    y.val(an);
    $('#datele').append(m);
    $('#datele').append(y);

    if($('#disp_dates_list').val()) {
        setCalendarColors(indexLuna+1, an);
    }
}

