
!function($) {
    "use strict";
    var CalendarApp = function() {
        this.$body = $("body")
        this.$calendar = $('#calendar'),
        this.$event = ('#calendar-events div.calendar-events'),
        this.$categoryForm = $('#add_new_event form'),
        this.$extEvents = $('#calendar-events'),
        this.$modal = $('#my_event'),
        this.$saveCategoryBtn = $('.save-category'),
        this.$calendarObj = null,
        this.$route = $('#route'),
        this.$domain = "http://project_2.test/"
    };

    /* validate event form on keyup and submit */
    CalendarApp.prototype.validateEventForm = function(form) {
        form.validate({
            rules: {
                car: {
                    required: true
                },
                driver: {
                    required: true
                },
                date: {
                    required: true
                },
                time: {
                    required: true
                },
                price: {
                    required: true
                }
            },
            messages: {
                car: {
                    required: "Vui lòng chọn xe"
                },
                driver: {
                    required: "Vui lòng chọn tài xế"
                },
                date: {
                    required: "Vui lòng chọn ngày"
                },
                time: {
                    required: "Vui lòng chọn giờ"
                },
                price: {
                    required: "Vui lòng nhập giá"
                }
            },
        });
        if (form.valid()) {
            form.submit();
        }
    };

    /* notification */
    CalendarApp.prototype.notification = function(response) {
        // notifi
        $.toast({
            heading: response.success ? 'Thành công' : 'Lỗi',
            text: response.message,
            position: 'top-right',
            icon: response.success ? 'success' : 'error',
            showHideTransition: 'slide',
        });
    };

    /* create event */
    CalendarApp.prototype.createEvent = function(day,time,car_id) {
        var $this = this;
        $this.$modal.modal({
            backdrop: 'static'
        });
        var form = $("<form action='"+this.$domain+"admin/buses/store') }} method='POST'></form>");
        form.append("<div class='event-inputs'></div>");
        form.find(".event-inputs")
            .append("<div class='form-group row'><label class='col-form-label col-md-2'>Xe</label><div class='col-md-10'><select class='form-control' name='car' id='car'></select></div></div>")
            .append("<div class='form-group row'><label class='col-form-label col-md-2'>Tài Xế</label><div class='col-md-10'><input class='form-control' name='driver' type=text disabled /></div></div>")
            .append("<div class='form-group row'><label class='col-form-label col-md-2'>Ngày</label><div class='col-md-10'><input class='form-control' name='date' type=date value='" + day + "'/></div></div>")
            .append("<div class='form-group row'><label class='col-form-label col-md-2'>Giờ</label><div class='col-md-10'><input class='form-control' name='time' type=time value='" + time + "'/></div></div>")
            .append("<div class='form-group row'><label class='col-form-label col-md-2'>Giá</label><div class='col-md-10'><input class='form-control' name='price' type=text /></div></div>");
        
                // load carriages by route
        $.ajax({
            url: this.$domain+"admin/carriages/apiNameCarriages",
            type: "GET",
            dataType: "json",
            data: {
                route_id: $this.$route.val(),
            },
            success: function(data) {
                var options = "<option value=''>Chọn xe</option>";
                $.each(data, function(key, value) {
                    options += "<option value='" + value.id + "'>" + value.license_plate + "</option>";
                });
                form.find("select[name='car']").html(options);
                form.find("select[name='car'] option[value='" + car_id + "']").attr("selected", "selected");
            }
        });
        $.ajax({
            url: this.$domain+"admin/users/apiGetDriverByCar",
            type: "GET",
            dataType: "json",
            data: {
                route_id: $this.$route.val(),
                car_id: car_id,
            },
            success: function(response) {
                form.find("input[name='driver']").val(response.name);
            }
        });
        $.ajax({
            url: this.$domain+"admin/buses/apiGetPrice",
            type: 'GET',
            data: {
                route_id: $this.$route.val(),
                car_id: car_id,
            },
            success: function(response) {
                form.find("input[name='price']").val(response.price);
            }
        });
        // load driver by car
        $(document).ready(function(){
            $("#car").change(function() {
                var car = $(this).val();
                var domain = $.CalendarApp.$domain;
                $.ajax({
                    url: domain +"admin/users/apiGetDriverByCar",
                    type: "GET",
                    dataType: "json",
                    data: {
                        route_id: $this.$route.val(),
                        car_id: car,
                    },
                    success: function(response) {
                        form.find("input[name='driver']").val(response.name);
                    }
                });
                $.ajax({
                    url:  domain +"admin/buses/apiGetPrice",
                    type: 'GET',
                    data: {
                        route_id: $this.$route.val(),
                        car_id: car,
                    },
                    success: function(response) {
                        form.find("input[name='price']").val(response.price);
                    }
                });
            });
            
        });
        $this.$modal.modal('show');

        $this.$modal.find('.delete-event').hide().end().find('.save-event').hide().end().find('.create-event').show().end().find('.modal-body').empty().prepend(form).end().find('.create-event').unbind('click').click(function () {
            $this.validateEventForm(form);
        });

        $this.$modal.find('form').on('submit', function () {
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize() + '&route=' + $this.$route.val(),
                success: function (response) {
                    if (response.success) {
                        var id = response.id;
                        var route_id = $this.$route.val();
                        var departure_time = moment(form.find('input[name="date"]').val() + ' ' + form.find('input[name="time"]').val());
                        var price = form.find('input[name="price"]').val();
                        var car_id = form.find('select[name="car"]').val();
                        var license_plate = form.find('select[name="car"] option:selected').text();
                        var driver_name = form.find('input[name="driver"]').val();
                        $this.$calendarObj.fullCalendar('renderEvent', {
                            id: id,
                            route_id: route_id,
                            departure_time: departure_time,
                            price: price,
                            car_id: car_id,
                            license_plate: license_plate,
                            driver_name: driver_name,
                            eventId: id,
                            start: departure_time,
                            end: moment(departure_time).add(30, 'minutes').format('YYYY-MM-DD HH:mm:ss'),
                            title: license_plate,
                            className: 'bg-info',
                        }, true);  
                        $this.$modal.modal('hide');
                    }
                    $this.notification(response);
                },
                error: function (response) {
                    $this.notification(response);
                } 
            });
            return false;
        });
        $this.$calendarObj.fullCalendar('unselect');

        $this.$modal.find('.close').click(function () {
            $this.$modal.modal('hide');
        });
    };
    /* on drop */
    CalendarApp.prototype.onDrop = function (eventObj, date) { 
        var day = moment(date).format('YYYY-MM-DD');
        var time = moment(date).format('HH:mm');
        var car_id = eventObj.attr('value');
        this.createEvent(day,time,car_id);
    },
    /* on click on event */
    CalendarApp.prototype.onEventClick =  function (calEvent, jsEvent, view) {
        var $this = this;
        var car_id = calEvent.car_id;
        var driver = calEvent.driver_name;
        var day = calEvent.start.format('YYYY-MM-DD');
        var time = calEvent.start.format('HH:mm');
        var price = calEvent.price;
        var form = $("<form action='"+this.$domain+"admin/buses/update/" + calEvent._id + "') }} method='POST'></form>");
        form.append("<div class='event-inputs'></div>");
        form.find(".event-inputs")
            .append("<div class='form-group row'><label class='col-form-label col-md-2'>Xe</label><div class='col-md-10'><select class='form-control' name='car' id='car'></select></div></div>")
            .append("<div class='form-group row'><label class='col-form-label col-md-2'>Tài Xế</label><div class='col-md-10'><input class='form-control' name='driver' type=text value='" + driver + "' disabled /></div></div>")
            .append("<div class='form-group row'><label class='col-form-label col-md-2'>Ngày</label><div class='col-md-10'><input class='form-control' name='date' type=date value='" + day + "' /></div></div>")
            .append("<div class='form-group row'><label class='col-form-label col-md-2'>Giờ</label><div class='col-md-10'><input class='form-control' name='time' type=time value='" + time + "' /></div></div>")
            .append("<div class='form-group row'><label class='col-form-label col-md-2'>Giá</label><div class='col-md-10'><input class='form-control' name='price' type=text value='" + price + "' /></div></div>");
        
        // load carriages by route
        $.ajax({
            url: this.$domain+"admin/carriages/apiNameCarriages",
            type: "GET",
            dataType: "json",
            data: {
                route_id: calEvent.route_id,
            },
            success: function(data) {
                var options = "<option value=''>Chọn xe</option>";
                $.each(data, function(key, value) {
                    options += "<option value='" + value.id + "'>" + value.license_plate + "</option>";
                });
                form.find("select[name='car']").html(options);
                form.find("select[name='car'] option[value='" + car_id + "']").attr("selected", "selected");
            }
        });
        // load driver by car
        $(document).ready(function(){
            $("#car").change(function() {
                var car = $(this).val();
                var domain = $.CalendarApp.$domain;
                $.ajax({
                    url:  domain +"admin/users/apiGetDriverByCar",
                    type: "GET",
                    dataType: "json",
                    data: {
                        route_id: calEvent.route_id,
                        car_id: car,
                    },
                    success: function(response) {
                        form.find("input[name='driver']").val(response.name);
                    }
                });
            });
        });

        $this.$modal.modal({
            backdrop: 'static'
        });
        $this.$modal.modal('show');

        $this.$modal.find('.delete-event').show().end().find('.save-event').show().end().find('.create-event').hide().end().find('.modal-body').empty().prepend(form).end().find('.delete-event').unbind('click').click(function () {
            let confirm_delete = confirm('Bạn có chắc chắn muốn xóa?');
            let domain = $.CalendarApp.$domain;
            if (confirm_delete) {
                var form_delete = $("<form action='"+domain+"admin/buses/destroy/" + calEvent._id + "') }} method='POST'></form>");
                form_delete.append("<input type='hidden' name='_method' value='DELETE' />");
                $.ajax({
                    url: form_delete.attr('action'),
                    type: "POST",
                    dataType: "json",
                    data: form_delete.serialize(),
                    success: function(response) {
                        $this.$calendarObj.fullCalendar('removeEvents', function (ev) {
                            return (ev._id == calEvent._id);
                        });
                        $this.$modal.modal('hide');
                        $this.notification(response);
                    },
                    error: function(response) {
                        $this.notification(response);
                    }
                });
            };
        });

        $this.$modal.find('.save-event').unbind('click').click(function () {
            $this.validateEventForm(form);
        });

        $this.$modal.find('form').on('submit', function () {
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize() + '&route=' + calEvent.route_id,
                success: function (response) {
                    if (response.success) {
                        // update event on the calendar
                        calEvent.car_id = form.find('select[name="car"]').val();
                        calEvent.driver_name = form.find('input[name="driver"]').val();
                        calEvent.departure_time = moment(form.find('input[name="date"]').val() + ' ' + form.find('input[name="time"]').val());
                        calEvent.start = calEvent.departure_time;
                        calEvent.end = moment(calEvent.departure_time).add(30, 'minutes').format('YYYY-MM-DD HH:mm:ss');
                        calEvent.price = form.find('input[name="price"]').val();
                        $this.$calendarObj.fullCalendar('updateEvent', calEvent);
                        $this.$modal.modal('hide');
                    }
                    $this.notification(response);
                },
                error: function (response) {
                    $this.notification(response);
                } 
            });
            return false;
        });

        $this.$modal.find('.close').click(function () {
            $this.$modal.modal('hide');
        });

    },
    /* on select */
    CalendarApp.prototype.onSelect = function (start, end, allDay) {
        var day = start.format('YYYY-MM-DD');
        var time = start.format('HH:mm');
        var car_id = '';
        this.createEvent(day,time,car_id);
    },
    CalendarApp.prototype.enableDrag = function() {
        //init events
        $(".calendar-events").each(function () {
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            };
            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);
            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });
        });
    },
    /* Initializing */
    CalendarApp.prototype.init = function() {
        this.enableDrag();
        /*  Initialize the calendar  */

        var $this = this;
        $this.$calendarObj = $this.$calendar.fullCalendar({
            slotDuration: '00:30:00', /* If we want to split day time each 15minutes */
            minTime: '00:00:00',
            maxTime: '24:00:00',
            defaultView: 'month',  
            handleWindowResize: true,   
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,listDay'
                // agendaWeek,agendaDay đang bị lỗi
            },
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            eventLimit: true, // allow "more" link when too many events
            selectable: true,
            weekNumbers: true,
            navLinks: true,
            drop: function(date) { $this.onDrop($(this), date); },
            select: function (start, end, allDay) { 
                $this.onSelect(start, end, allDay); 
            },
            eventClick: function(calEvent, jsEvent, view) {
                $this.onEventClick(calEvent, jsEvent, view);
            }, 
        });

        //on new event
        this.$saveCategoryBtn.on('click', function(){
            var categoryName = $this.$categoryForm.find("input[name='category-name']").val();
            var categoryColor = $this.$categoryForm.find("select[name='category-color']").val();
            if (categoryName !== null && categoryName.length != 0) {
                $this.$extEvents.append('<div class="calendar-events" data-class="bg-' + categoryColor + '" style="position: relative;"><i class="fas fa-circle text-' + categoryColor + '"></i>' + categoryName + '</div>')
                $this.enableDrag();
            }

        });
    },

   //init CalendarApp
    $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp
    
}(window.jQuery),

//initializing CalendarApp
function($) {
    "use strict";
    $.CalendarApp.init()
}(window.jQuery);