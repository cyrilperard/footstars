/* global $, moment, daily, date_start, date_end, year, unavailable, meetings */
moment.locale("fr");
var MOBILEANDTABLETCHECK = false;
var INFO;
var INFO_TOP;

const DAYS = [
    "Dimanche",
    "Lundi",
    "Mardi",
    "Mercredi",
    "Jeudi",
    "Vendredi",
    "Samedi",
];
const DAYS_LIST = [
    "Lundi",
    "Mardi",
    "Mercredi",
    "Jeudi",
    "Vendredi",
    "Samedi",
    "Dimanche",
];
const MONTHS = [
    "Janvier",
    "Février",
    "Mars",
    "Avril",
    "Mai",
    "Juin",
    "Juillet",
    "Août",
    "Septembre",
    "Octobre",
    "Novembre",
    "Décembre",
];
var FIRST_CELL;

function mobileAndTabletCheck(){
    (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) MOBILEANDTABLETCHECK = true;})(navigator.userAgent||navigator.vendor||window.opera);
};
mobileAndTabletCheck();
class Info {
    constructor(callback) {
        if (!callback)
        {
            callback = function(data)
            {
                return JSON.stringify(data)
            };
        }
        this.callback = callback;
        this.block = $(".info");
        this.hide();
        this.moveBox();
    }
    show() {
        this.block.show();

    }
    hide() {
        this.block.hide();
    }

    display(args) {
        this.block.html(this.callback.call(this, args));
    }
    onResizeInfo(dailies){
        if(dailies.length < 10){
            $('.info').css('width','auto')
        }else if(dailies.length >= 10 && dailies.length <= 32){
            $('.info').css('width','45%')
        }else{
            $('.info').css('width','70%')
        }
    }

    moveBox() {
        document.addEventListener("mousemove", (e) => {


            if (e.pageX > window.innerWidth / 2) {
                this.block.css("left", "auto");
                this.block.css("right", window.innerWidth - e.pageX - 10);
            } else {
                this.block.css("right", "auto");
                this.block.css("left", e.pageX + 10);
            }
            if (e.pageY > window.innerHeight / 2) {
                this.block.css("top", "auto");
                this.block.css("bottom", window.innerHeight - e.pageY - 10);
            } else {
                this.block.css("bottom", "auto");
                this.block.css("top", e.pageY + 10);
            }
        });
    }
}
class InfoTop {
    constructor(callback) {
        if (!callback)
        {
            callback = function(data)
            {
                return JSON.stringify(data)
            };
        }
        this.callback = callback;
        this.block = $(".infotop");
        this.cells = [];
        this.hide();
        this.block.draggable();
    }
    show() {
        this.block.show();
    }
    hide() {
        this.block.hide();
    }

    onResizeInfoTop(){
        $('.table-infotop td:last-child').css("border-right","none")
    }

    close(){
        //Laptop // Mobile
        $('.infotop-display-none').on('click', () => {
            $('.infotop').hide();
            for (let i = 0; i < this.cells.length; i++) {
                this.cells[i].block.classList.remove('selected');
            }
            this.cells = [];
            if($('.dispo_btns_container').length > 0){
                $('.dispo_btns_container').css("visibility", "hidden");
            }
        });
    }

    openClose(){
        //Laptop // Mobile
        $('.infotop-close').on('click', () => {
            $('.table-infotop').hide()
            $('.infotop-open').css({"display":"flex","justify-content":"center","align-items":"center"});
            $('.infotop-close').css("display","none");
        });
        $('.infotop-open').on('click', () => {
            $('.table-infotop').show()
            $('.infotop-close').css({"display":"flex","justify-content":"center","align-items":"center"});
            $('.infotop-open').css("display","none");
        })
    };




    async add(cell) {
        if (cell.selected && !this.cells.includes(cell))
            this.cells.push(cell);
        else if (!cell.selected && this.cells.includes(cell))
            this.cells.splice(this.cells.indexOf(cell), 1);
        this.cells.sort(
            (a, b) =>
                new Date(a.date_format).getTime() - new Date(b.date_format).getTime()
        );
        this.block.html(await this.callback.call(this, this.cells));
        if (this.cells.length > 0){
            this.show()
            this.close();
            this.openClose()
            this.onResizeInfoTop()
        }
        else
            this.hide();
        this.handleAdmin();
    }
    async addEmpty(cell)
    {
        if (cell.selected && !this.cells.includes(cell))
            this.cells.push(cell);
        else if (!cell.selected && this.cells.includes(cell))
            this.cells.splice(this.cells.indexOf(cell), 1);
        this.cells.sort(
            (a, b) =>
                new Date(a.date_format).getTime() - new Date(b.date_format).getTime()
        );
        this.block.html(await this.callback.call(this, this.cells));
        this.show();
        this.handleAdmin();
    }

    handleAdmin() {
        $('.js_add').click(function()
        {
            let opt = $(this).parents("tr").find('select option:selected').val();
            let student_id = $(this).parents("tr").find('select option:selected').data('studentid');
            $(this).parents("tr").remove();
            $.ajax({
                url: "/admin/student/"+student_id+"/add/000",
                type: "POST",
                data: { id_daily: opt },
            });
        });
        $(".js_remove").click(function () {
            $(this).parents("tr").remove();
            $.ajax({
                url: "/admin/student/errors",
                type: "POST",
                data: { user: $(this).data("student"), list: [$(this).data("daily")] },
            });
        });
    }
}
class Cell {
    constructor(date, calendar) {
        this.calendar = calendar;
        this.date = date;
        this.date_format = date.format("YYYY-MM-DD");
        this.unavailable = false;
        this.block = document.createElement("td");
        let day = date.weekday();

        this.dailies = [];
        if (day !==6){
            this.block.innerHTML = "<i>" + date.date() + "</i>";
        }
        if (day === 5){
            this.block.classList.add("weekendDisplayNone");
            this.weekend = true;
        }
        else if(day === 6){
            this.block.classList.add("weekend");
            this.weekend = true;
        }
        // this.attendance(Math.random() > 0.5, Math.random() > 0.5);
    }
    addMeeting(meeting)
    {
        /*
        .notif{width:0;
cursor:help;
height: 0;
border-style: solid;
border-width: 16px 16px 0 0;
border-color: #007bff transparent transparent transparent;
top:0px;left:0px;
}
        */
        $(this.block).append(
            '<div style="width:0;cursor:help;height: 0;border-style: solid;border-width: 16px 16px 0 0;border-color: #007bff transparent transparent transparent;top:0px;left:0px;">' +
            /*meeting.hour+*/
            "</div>"
        );
    }
    attendance(morning, afternoon) {
        let color = 200;
        let alpha = 0.5;
        if (morning) morning = "rgba(0," + color + ",0," + alpha + ")";
        else morning = "rgba(" + color + ",0,0," + alpha + ")";
        if (afternoon) afternoon = "rgba(0," + color + ",0," + alpha + ")";
        else afternoon = "rgba(" + color + ",0,0," + alpha + ")";
        if (Math.random() > 0.5)
            $(this.block).css(
                "background",
                "linear-gradient(to right, " + morning + " 50%, " + afternoon + " 50%)"
            );
    }
    today() {
        this.today = true;
        this.block.classList.add("today");
    }
    addDailyCalendarTypeError(daily){
        this.dailies.push(daily);
        this.block.classList.add("errorCalendar");

        $(this.block).append(
            '<span class="dailyCalendarTypeError" style="display:none;">' +
            this.dailies.length +
            "</span>"
        );
    }

    addDaily(daily) {
        this.dailies.push(daily);
        if (this.dailies.length == 1)
        {
            this.block.classList.add("course");
            if (daily.daily.validated == 0)
                this.block.classList.add("pending");
            $(this.block).append(
                '<div style="display:inline-block; padding-left: 2px">' +
                daily.modules.name +
                "</div>"
            );
        }
        this.checkErrors();
    }
    addUnavailability(unavailability) {
        this.unavailable = true;
        this.unavailability = unavailability;
        if (unavailability.status === "off") {
            this.block.classList.add("ferie");
            if (!this.block.classList.contains("weekend")) {
                $(this.block).append(
                    '<div style="padding-left:2px;display:inline-block;">FÉRIÉ</div>'
                );
            }
        }
        if (unavailability.status === "unavailable")
            this.block.classList.add("unav");
        this.checkErrors();
    }
    checkErrors() {
        if (
            this.dailies.length > 1 ||
            (this.dailies.length > 0 && this.unavailable)
        )
            this.block.classList.add("err");
        if (
            this.dailies &&
            this.dailies[0] &&
            this.dailies[0].users &&
            this.dailies[0].users.id === null
        )
            this.block.classList.add("err");
    }
    isEmpty() {
        return false;
    }
    select(force = false) {
        if (force) {
            this.block.classList.add("selected");
            this.selected = true;
        } else {
            if (this.selected) this.block.classList.remove("selected");
            else this.block.classList.add("selected");
            this.selected = !this.selected;
        }
        if (this.dailies.length > 0) {
            INFO_TOP.add(this);
            INFO_TOP.show();

        }
        else
        {
            INFO_TOP.addEmpty(this);
            INFO_TOP.show();
        }
    }
    handleTeacher() {
        if ($("td.selected").length > 0) {
            $(".dispo_btns_container").css("visibility", "visible");
        } else {
            $(".dispo_btns_container").css("visibility", "hidden");
        }
    }
    generateCell() {
        this.block.addEventListener("mouseenter", () => {
            this.block.classList.add("over");
            if (this.dailies.length > 0) {
                if(MOBILEANDTABLETCHECK === false){
                    INFO.display(this.dailies);
                    INFO.show();
                    INFO.onResizeInfo(this.dailies)

                }
            }
        });
        this.block.addEventListener("click", (e) => {
            this.select();
            if (e.shiftKey) {
                let selector = false;
                for (let i = 0; i < this.calendar.listCells.length; i++) {
                    let cell = this.calendar.listCells[i];
                    if (cell.selected) selector = true;
                    if (selector) {
                        if (!cell.weekend) cell.select(true);
                    }
                    if (cell.date_format === this.date_format) break;
                }
                e.preventDefault();
            }
            this.handleTeacher();
        });
        this.block.addEventListener("mouseleave", () => {
            this.block.classList.remove("over");
            if(MOBILEANDTABLETCHECK === false){
                INFO.hide();
            }
        });
        return this.block;
    }
}

// Cellules qui n'ont pas de date
class OffCell {
    constructor(d = 1) {
        this.block = document.createElement("td");
        this.block.classList.add("off");
        this.block.rowSpan = d;
    }
    isEmpty() {
        return true;
    }
    generateCell() {
        return this.block;
    }
}
class DayCell {
    // Cellule jour de la semaine
    constructor(day) {
        this.block = document.createElement("th");
        if(day !== 6){
            this.block.innerText = DAYS_LIST[day];
        }
        this.block.classList.add("day_week")
        if (day === 5){
            this.block.classList.add("weekendDisplayNone");
        }
        else if(day === 6){
            this.block.innerText = "Weekend"
            this.block.classList.add("weekend");
        }
    }
    isEmpty() {
        return true;
    }
    generateCell() {
        return this.block;
    }
}
class Calendar {


    getStartEndDate() {
        this.start;
        this.end;
        if (typeof date_start !== "undefined" && typeof date_end !== "undefined") {
            this.start = moment(date_start, "DD-MM-YYYY");
            this.start.date(1);
            this.end = moment(date_end, "DD-MM-YYYY");
            this.end.date(this.end.daysInMonth());
        } else if (typeof year !== "undefined") {
            this.start = moment("01-01-" + year, "DD-MM-YYYY");
            this.end = moment("31-12-" + year, "DD-MM-YYYY");
        }
    }
    generateHead() {
        let years = {};
        let start = this.start.clone();
        let end = this.end.clone();
        let head_year = [];
        let head_month = [""];
        while (start <= end) {
            if (!years[start.year()]) years[start.year()] = 0;
            years[start.year()]++;
            head_month.push(
                '<th class="js_w">' + MONTHS[start.get("month")] + "</th>"
            );
            start.add(1, "month");
        }
        for (let year in years)
            head_year.push('<th class="js_y" colspan="' + years[year] + '">' + year + "</th>");
        this.table.append(
            '<tr class="tr_js_y"><td class="js_head_year js_w" rowspan="2"></td>' +
            head_year.join("") +
            "</tr>"
        );
        this.table.append("<tr class='tr_js_w'>" + head_month.join("") + "</tr>");

    };
    constructor(infoCallback, infoTopCallback) {
        if(MOBILEANDTABLETCHECK === false){
            INFO = new Info(infoCallback);
        }else{
            let infotop = $(".info");
            infotop.hide()
        }
        INFO_TOP = new InfoTop(infoTopCallback);
        this.table = $("table");
        this.getStartEndDate();
        this.generateHead();
        this.cells = {};
        this.listCells = [];
        this.dates = {};

        // Création du calendrier
        while (this.start <= this.end) {
            let date = this.start.format("DD-MM-YYYY");
            let dates = this.start.format("YYYY-MM");
            if (!this.dates[dates]) {
                this.dates[dates] = [];
                let d = this.start.weekday();
                for (let i = 0; i < d; i++) this.dates[dates].push(new OffCell());
            }
            let cell = new Cell(this.start.clone(), this);
            this.cells[date] = cell;
            this.listCells.push(cell);
            this.dates[dates].push(cell);
            this.start.add(1, "day");
        }

        // Création du contenue des cellules
        for (let i = 0; i < daily.length; i++) {
            if(calendarType === "Error"){
                if (this.cells[daily[i][""].date]){
                    this.cells[daily[i][""].date].addDailyCalendarTypeError(daily[i]);
                }
            }else if (calendarType === "Courses"){
                this.cells[daily[i][""].date].addDaily(daily[i]);
            }
        }
        for (let i = 0; i < unavailable.length; i++) {
            if (this.cells[unavailable[i].date])
                this.cells[unavailable[i].date].addUnavailability(unavailable[i]);
        }
        if (typeof meetings !== "undefined")
        {
            for (let i = 0; i < meetings.length; i++) {
                if (this.cells[meetings[i].date])
                    this.cells[meetings[i].date].addMeeting(meetings[i]);
            }
        }
        let today = moment().format("DD-MM-YYYY");
        if (this.cells[today]) this.cells[today].today();
        let tab = [];
        for (let i = 0; i < 42; i++) {
            tab[i] = [new DayCell(i % 7)];
            let c;
            for (let key in this.dates) {
                let elem = this.dates[key].shift();
                if (!elem) elem = new OffCell();
                tab[i].push(elem);
            }
        }
        for (let i = 0; i < tab.length; i++) {
            let empty = true;
            let tr = document.createElement("tr");
            for (let j = 0; j < tab[i].length; j++) {
                tr.appendChild(tab[i][j].generateCell());
                if (empty) empty = tab[i][j].isEmpty();
            }
            if (!empty) this.table.append(tr);
        }
        document.dispatchEvent(new Event("calendarbuilt"));
    }
}

function onResize() {

    // Ajoute une class au tr qui contient les td avec les class ferie et course
    let tdFerieCourse = document.querySelectorAll('td.ferie.course')
    for (const cell of tdFerieCourse) {
        cell.parentNode.classList.add('trFerieCourse');
    }
    // Hauteur des cellules
    let cells = document.querySelectorAll('.table td:not([rowspan],.trFerieCourse td)');
    let highest = 0;
    for (const cell of cells) {
        cell.style.height = "auto";
    }
    for (const cell of cells) {
        highest = Math.max(highest, cell.scrollHeight);
    }
    for (const cell of cells) {
        cell.style.height = "highest"+'px';
    }

    // Hauteur des cellules head
    let cellsHead = document.querySelectorAll('.table th:not([rowspan],.day_week)');
    for (const cellth of cellsHead) {
        cellth.style.height = "2em";
        //Version Mobile
        if(innerWidth < 400){
            cellth.style.padding = "0 6em";
        }else{
            cellth.style.padding = "0 3.25em";
        }
    }

    // Ajoute un display : none au tr de samedi
    let weekendDisplayNone = document.querySelectorAll('.weekendDisplayNone');
    for (const cell of weekendDisplayNone) {
        cell.parentNode.classList.add('trWeekendDisplayNone');
    }
    let tdWeekend = document.querySelectorAll('.weekend');
    for (const cell of tdWeekend) {
        cell.parentNode.classList.add('trWeekend');
    }


}

window.addEventListener('resize', onResize);
document.addEventListener('calendarbuilt', onResize);