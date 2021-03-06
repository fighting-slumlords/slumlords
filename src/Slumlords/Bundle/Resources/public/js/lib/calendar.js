        var canvas;
        var context;

        var thisMonth;
        var prevMonthLastDate;
        var thisMonthLastDate;
        var thisMonthFirstDay;
        var nextMonthFirstDay;
        var monthDay;

        var thisMonthColor = "#202020";
        var prevMonthColor = "#909090";
        var nextMonthColor = "#909090";

        var dateOffset;

        function init() {
            var selectedMonth = document.getElementById("ddlMonth").value;
            var selectedYear = document.getElementById("txtYear").value;

            monthDay = 0;

            selectedDate = new Date(selectedMonth + " 1, " + selectedYear);
            var thisMonth = selectedDate.getMonth() + 1;

            prevMonthLastDate = getLastDayOfMonth(thisMonth - 1);
            thisMonthLastDate = getLastDayOfMonth(thisMonth);
            thisMonthFirstDay = selectedDate.getDay();
            thisMonthFirstDate = selectedDate.getDate();

            if (thisMonth == 12)
                nextMonthFirstDay = 1;
            else
                nextMonthFirstDay = thisMonth + 1;

            dateOffset = thisMonthFirstDay;

            canvas = document.getElementById("cal");
            context = canvas.getContext("2d");
            context.fillStyle = "#f0f0f0";

            drawCalendar();
        }

        function drawCalendar() {
            for(j=0; j<6; ++j) {
                drawWeek(j);
            }
        }

        function drawWeek(j) {
            for(i=0; i<7; ++i) {
                drawDay(i, j);
            }
        }

        function drawDay(i, j) {
            x_offset = 7 + 106 * i;
            y_offset = 5 + 106 * j;

            context.fillStyle = "#f0f0f0";
            context.fillRect(x_offset, y_offset, 100, 100); 

            // First week
            if (j == 0) {
                if (i < thisMonthFirstDay) {
                    drawDayNumber(prevMonthLastDate - (dateOffset - i) + 1, prevMonthColor);
                }
                else if (i == thisMonthFirstDay) {
                    monthDay = 1;
                    drawDayNumber(thisMonthFirstDate + (dateOffset - i), thisMonthColor);
                }
                else {
                    ++monthDay;
                    drawDayNumber(monthDay, thisMonthColor);
                }
            }            
            // Last weeks
            else if (thisMonthLastDate <= monthDay) {
                ++monthDay;
                drawDayNumber(monthDay - thisMonthLastDate, prevMonthColor);
            }
            // Other weeks
            else {
                ++monthDay;
                drawDayNumber(monthDay, thisMonthColor);
            }
        }

        function drawDayNumber(dayNumber, color) {
            context.fillStyle = color;
            context.font = "bold 32px sans-serif";
            context.fillText(dayNumber, x_offset + 10, y_offset + 35);
        }

        function getLastDayOfMonth(month,year)
        {
            var day;

            switch (month)
            {
                case 0 : // prevents error when checking for previous month in jan
                case 1 :
                case 3 :
                case 5 :
                case 7 :
                case 8 :
                case 10:
                case 12:
                case 13: // prevents error when checking for next month in december
                    day = 31;
                    break;
                case 4 :
                case 6 :
                case 9 :
                case 11:
                    day = 30;
                    break;
                case 2 :
                    if( ( (year % 4 == 0) && ( year % 100 != 0) ) 
                                   || (year % 400 == 0) )
                        day = 29;
                    else
                        day = 28;
                    break;

            }

            return day;
        }

      init();

