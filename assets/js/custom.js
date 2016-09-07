

//Global var
var dubug = false;
var total_images = 0;
var pull;

function clog(str) {
    if (window['console'] != 'undefined' && dubug) {
        console.log(str);
    }
}

var pastePlainText = function () {
    // No need to pass in an ID, instead fetch the first tinyMCE instance
    var ed = tinyMCE.get(0);
    ed.pasteAsPlainText = true;

    //adding handlers crossbrowser
    if (tinymce.isOpera || /Firefox\/2/.test(navigator.userAgent)) {
        ed.onKeyDown.add(function (ed, e) {
            if (((tinymce.isMac ? e.metaKey : e.ctrlKey) && e.keyCode == 86) || (e.shiftKey && e.keyCode == 45))
                ed.pasteAsPlainText = true;
        });
    } else {
        ed.onPaste.addToTop(function (ed, e) {
            ed.pasteAsPlainText = true;
        });
    }
};

var Portal = {
    wait: function () {
        var width = $(window).width();
        var height = $(window).height();
        var html = '<div class="backdrop in">\
						<div class="loading" style="width:' + width + 'px; height:' + height + 'px">\
							<img src="' + base_url + 'assets/images/processing.gif" style="max-width:200px;" >\
						</div>\
					</div>';
        $("body").append(html);
    },
    removeWait: function () {
        $(".backdrop").remove();
    },
    init: function () {
        Portal.Order.addNew.clearCustomSelections();
    },
    pull: function () {
        return; //temporary disable live notification feature
        var rand = Date.now() / 1000 | 0;
        // console.log(rand);
        var current_page = window.location.href;
        $.ajax({
            url: site_url + 'auth/pull',
            type: 'GET',
            dataType: 'json',
            data: {page: current_page, _r: rand},
            success: function (data) {
                if (data.login < 1 && data.controller != 'auth') {
                    clearTimeout(pull);

                    $('#ajaxModal').remove();
                    var $remote = site_url + 'auth/lock'
                            , $modal = $('<div class="modal fade" id="ajaxModal"><div class="modal-body"></div></div>');
                    $('body').append($modal);
                    $modal.modal();
                    $modal.load($remote);
                } else {

                }
            },
        });
    },
    PageInit: {
        Dashboard: function () {
            $(".timeago").timeago();
        },
        PlaceOrder: function () {
            Portal.init();
            Portal.Order.addNew.CostCalc();
        },
        OrderList: function () {
            $('[data-countdown]').each(function () {
                var $this = $(this);
                var utcDate = $(this).data('countdown');
                var localDate = new Date(utcDate);
                var finalDate = Portal.Helpers.formatDate(localDate);

                $this.countdown(finalDate, function (event) {
                    var totalHours = event.offset.totalDays * 24 + event.offset.hours;
                    $this.html(event.strftime(totalHours + ':%M:%S'));
                })
                        .on('finish.countdown', function (event) {
                            $(this).parent().addClass('text-danger');
                            $(this).parents('tr').children('.sts').html('<span class="label bg-danger lter m-t-xs">Due</span>');
                        });
            });

            $("[data-toggle=tooltip]").tooltip();
        },
        Orders: function (page) {
            if (page == undefined) {
                var url = document.location.toString();
                if (url.match('#')) {
                    page = url.split('#')[1];
                } else {
                    page = 'all';
                }
            }

            if (page == 'pending') {
                $("#f_completed").prop("checked", false);
                $("#f_cancelled").prop("checked", false);
                $("#f_due").prop("checked", true);
                $("#f_pending").prop("checked", true);
            } else if (page == 'completed') {
                $("#f_pending").prop("checked", false);
                $("#f_due").prop("checked", false);
                $("#f_cancelled").prop("checked", false);
                $("#f_completed").prop("checked", true);
            } else if (page == 'cancelled') {
                $("#f_pending").prop("checked", false);
                $("#f_completed").prop("checked", false);
                $("#f_due").prop("checked", false);
                $("#f_cancelled").prop("checked", true);
            } else {
                $("#f_pending").prop("checked", false);
                $("#f_completed").prop("checked", false);
                $("#f_due").prop("checked", false);
                $("#f_cancelled").prop("checked", false);
            }

            Portal.Order.LoadOrderTable();
        },
        Quotations: function (page) {
            if (page == undefined) {
                var url = document.location.toString();
                if (url.match('#')) {
                    page = url.split('#')[1];
                } else {
                    page = 'all';
                }
            }

            if (page == 'reviewed') {
                $("#f_accepted").prop("checked", false);
                $("#f_rejected").prop("checked", false);
                $("#f_waiting").prop("checked", false);
                $("#f_reviewed").prop("checked", true);
            } else if (page == 'waiting') {
                $("#f_reviewed").prop("checked", false);
                $("#f_rejected").prop("checked", false);
                $("#f_accepted").prop("checked", false);
                $("#f_waiting").prop("checked", true);
            } else if (page == 'accepted') {
                $("#f_reviewed").prop("checked", false);
                $("#f_waiting").prop("checked", false);
                $("#f_rejected").prop("checked", false);
                $("#f_accepted").prop("checked", true);
            } else if (page == 'rejected') {
                $("#f_reviewed").prop("checked", false);
                $("#f_waiting").prop("checked", false);
                $("#f_accepted").prop("checked", false);
                $("#f_rejected").prop("checked", true);
            } else {
                $("#f_reviewed").prop("checked", false);
                $("#f_waiting").prop("checked", false);
                $("#f_accepted").prop("checked", false);
                $("#f_rejected").prop("checked", false);
            }

            Portal.Quotation.LoadQuoteTable();
        },
        Invoice: function (page) {
            if (page == undefined) {
                var url = document.location.toString();
                if (url.match('#')) {
                    page = url.split('#')[1];
                } else {
                    page = 'all';
                }
            }

            if (page == 'paid') {
                $("#f_unpaid").prop("checked", false);
                $("#f_paid").prop("checked", true);
            } else if (page == 'unpaid') {
                $("#f_paid").prop("checked", false);
                $("#f_unpaid").prop("checked", true);
            } else {
                $("#f_paid").prop("checked", false);
                $("#f_unpaid").prop("checked", false);
            }

            Portal.Invoice.LoadInvoiceTable();
        },
        Profile: function (tab) {
            if (tab == undefined) {
                var url = document.location.toString();
                if (url.match('#')) {
                    tab = url.split('#')[1];
                } else {
                    tab = 'profile';
                }
            }
            $(".nav_profile li").removeClass('active');
            $(".nav_" + tab).addClass('active');
            $('.nav-tabs a[href=#' + tab + ']').tab('show');
        }
    },
    User: {
        logout: function () {
            $.ajax({
                url: ajax_url + "/logout",
                type: 'POST',
                dataType: 'JSON',
                success: function (data) {
                    //
                },
                error: function (data) {
                }
            });
        },
        addNew: function () {
            var postData = $("#add_user_form").serializeArray();
            $.ajax({
                url: ajax_url + "/add_user",
                data: postData,
                type: 'POST',
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'OK') {
                        $('#ajaxModal').modal('hide');
                    } else {
                        if (data.errors.email != '') {
                            Portal.alert({text: data.errors.email, type: "danger"});
                        }
                    }
                },
                error: function (data) {
                }
            });
            return false;
        },
        findEmail: function (ele) {
            var findEmail = $(ele).val();

            $.ajax({
                url: ajax_url + "/check_user",
                data: {email: findEmail},
                type: 'POST',
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'OK') {
                        $("#user_found .text-info").text(data.user.fullname);
                        $("#com_name").text(data.user.company_name);
                        $("#invite_avatar").attr('src', data.user.avatar);
                        $("#user_found").show();
                        $("#fullname").val(data.user.fullname).attr('readonly', true);
                    } else {
                        $("#user_found").hide();
                        $("#fullname").val('').attr('readonly', false);
                    }
                },
                error: function (data) {
                    $("#user_found").hide();
                }
            });
        },
        invite: function () {
            var postData = $("#invite_user_form").serializeArray();

            if (postData['email'] == '') {
                Portal.alert({text: 'Email filed cannot be empty!', type: "danger"});
                return false;
            }

            $('#ajaxModal .btn').addClass('disabled');
            setTimeout(function () {
                $('#ajaxModal .btn').removeClass('disabled');
            }, 3000);

            $('.ajax_msg').removeClass('text-danger').addClass('text-success').show().html('<i class="fa fa-spinner fa-spin"></i> Sending invitation. Please wait...');

            $.ajax({
                url: ajax_url + "/invite_user",
                data: postData,
                type: 'POST',
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'OK') {
                        $('.ajax_msg').html('<i class="fa fa-check-square"></i> Success! Please wait for page refresh...');
                        // window.location.href = document.URL;
                        window.location.reload();
                    } else {
                        $('.ajax_msg').html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> Request failed! ' + data.msg + '</span>');
                    }
                },
                error: function (data) {
                    $('.ajax_msg').addClass('text-danger').removeClass('text-success').html('<i class="fa fa-warning"></i> Network error! Please try again.');
                    $('#ajaxModal .btn').removeClass('disabled');
                }
            });
            return false;
        },
        Profile: {
            save: function () {
                var postData = $("#profile_form").serializeArray();
                var $submit = $("#profile_form [type='submit']");
                if ($submit.hasClass('disabled')) {
                    return false;
                }

                $("#profile_form .ajax_msg").removeClass('text-danger').show();
                $submit.addClass('disabled');
                setTimeout(function () {
                    $("#profile_form .ajax_msg").html('<i class="fa fa-spinner fa-spin"></i> Please wait...').hide();
                    $submit.removeClass('disabled');
                }, 50000);

                $("#profile_form .ajax_msg").html('<i class="fa fa-spinner fa-spin"></i> Please wait...');
                $.ajax({
                    url: ajax_url + "/profile",
                    data: postData,
                    type: 'POST',
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.status == "OK") {
                            $("#profile_form .ajax_msg").addClass('text-success').removeClass('text-danger').html('<i class="fa fa-check-square"></i> ' + data.msg);
                        } else {
                            $("#profile_form .ajax_msg").addClass('text-danger').removeClass('text-success').html('<i class="fa fa-times"></i> ' + data.msg);
                        }
                        $submit.removeClass('disabled');
                    },
                    error: function (data) {
                    }
                });
                return false;
            },
            saveNew: function () {
                var postData = $("#profile_form").serializeArray();
                var $submit = $("#profile_form [type='submit']");
                $alertBox = $("#profilEditMsg");

                if ($submit.hasClass('disabled')) {
                    return false;
                }
                $.ajax({
                    url: ajax_url + "/update_profile",
                    data: postData,
                    type: 'POST',
                    dataType: 'JSON',
                    beforeSend: function () {
                        $alertBox.addClass('hide').removeClass('alert-success alert-danger');
                        $("#profile_form .ajax-loading").show();
                        $submit.addClass('disabled');
                        setTimeout(function () {
                            $("#profile_form .ajax-loading").hide();
                            $submit.removeClass('disabled');
                        }, 50000);
                    },
                    success: function (data) {
                        if (data.status == "OK") {
                            $alertBox.addClass('alert-success').html('<i class="fa fa-check-square"></i> ' + data.msg);
                        } else {
                            $alertBox.addClass('alert-danger').html('<i class="fa fa-times"></i> ' + data.msg);
                        }
                        $submit.removeClass('disabled');
                        $alertBox.removeClass('hide');
                        $("#profile_form .ajax-loading").hide();
                        window.location.reload();
                    },
                    error: function (data) {
                        //
                    },
                    complete: function (jqXHR, textStatus) {
                        if (textStatus == 'success') {
                            console.log('Ajax Success');
                        } else if (textStatus == 'notmodified') {
                            console.log('notmodified');
                        } else if (textStatus == 'nocontent') {
                            console.log('nocontent');
                        } else if (textStatus === 'error') {
                            console.log('error');
                        } else if (textStatus === 'timeout') {
                            console.log('timeout');
                        } else if (textStatus === 'abort') {
                            console.log('abort');
                        } else if (textStatus === 'parsererror') {
                            console.log('parsererror');
                        } else {
                            console.log(jqXHR.responseText);
                            return ('Uncaught Error.\n' + jqXHR.responseText);
                        }
                    }
                });
                return false;
            }
        },
        Company: {
            save: function () {
                var postData = $("#company_form").serializeArray();
                var $submit = $("#company_form [type='submit']");
                if ($submit.hasClass('disabled')) {
                    return false;
                }

                $("#company_form .ajax_msg").show();
                $submit.addClass('disabled');
                setTimeout(function () {
                    $("#company_form .ajax_msg").html('<i class="fa fa-spinner fa-spin"></i> Please wait...').hide();
                    $submit.removeClass('disabled');
                }, 10000);

                $("#company_form .ajax_msg").html('<i class="fa fa-spinner fa-spin"></i> Please wait...');
                $.ajax({
                    url: ajax_url + "/company",
                    data: postData,
                    type: 'POST',
                    dataType: 'JSON',
                    success: function (data) {
                        $("#company_form .ajax_msg").html('<i class="fa fa-check-square"></i> Saved');
                        $submit.removeClass('disabled');
                    },
                    error: function (data) {
                    }
                });
                return false;
            },
            setActive: function (ele, company_id) {
                if ($(ele).hasClass('disabled')) {
                    return false;
                }
                $(ele).addClass('disabled');
                setTimeout(function () {
                    $(ele).removeClass('disabled');
                }, 10000);

                Portal.wait();
                $.ajax({
                    url: ajax_url + "/change_active_company",
                    data: {id: company_id},
                    type: 'POST',
                    dataType: 'JSON',
                    success: function (data) {
                        window.location.reload();
                    },
                    error: function (data) {
                        $(ele).removeClass('disabled');
                        Portal.removeWait();
                    }
                });
                return false;
            },
            setPermission: function (el) {
                var status = $(el).data('status');
                var action = $(el).data('action');
                var userid = $(el).data('user');

                $.ajax({
                    url: ajax_url + "/set_permission",
                    data: {action: action, user: userid, status: status},
                    type: 'POST',
                    dataType: 'json',
                    success: function (data) {
                        if (data.status == 'OK') {
                            // console.log(data.current_state);
                            $(el).data('status', data.cur_state);
                        }
                    },
                    error: function (data) {
                    }
                });
                return false;
            }
        },
        Settings: {
            saveNotify: function () {
                var postData = $("#notification_settings_form").serializeArray();
                var $submit = $("#notification_settings_form [type='submit']");
                if ($submit.hasClass('disabled')) {
                    return false;
                }

                $("#notification_settings_form .ajax_msg").show();
                $submit.addClass('disabled');
                setTimeout(function () {
                    $("#notification_settings_form .ajax_msg").html('<i class="fa fa-spinner fa-spin"></i> Please wait...').hide();
                    $submit.removeClass('disabled');
                }, 10000);

                $("#notification_settings_form .ajax_msg").html('<i class="fa fa-spinner fa-spin"></i> Please wait...');
                $.ajax({
                    url: ajax_url + "/settings",
                    data: postData,
                    type: 'POST',
                    dataType: 'JSON',
                    success: function (data) {
                        $("#notification_settings_form .ajax_msg").html('<i class="fa fa-check-square"></i> Saved');
                        $submit.removeClass('disabled');
                    },
                    error: function (data) {
                    }
                });
                return false;
            },
            updateNotify: function () {
                $.ajax({
                    url: ajax_url + "/settings",
                    data: postData,
                    type: 'POST',
                    dataType: 'JSON',
                    success: function (data) {
                        $("#notification_settings_form .ajax_msg").html('<i class="fa fa-check-square"></i> Saved');
                        $submit.removeClass('disabled');
                    },
                    error: function (data) {
                    }
                });
                return false;
            }
        }
    },
    Order: {
        addNew: {
            clearCustomSelections: function () {
                $(".shadow_manipulation_options input").each(function () {
                    $(this).prop('checked', false);
                    if ($(this).attr("type") == "hidden") {
                        $(this).val(0);
                    }
                });
            },
            CostCalcNew: function () {
                var formData = $("#orderForm").serializeArray();
                // total_images = 100;

                if (!total_images) {
                    total_images = 0;
                }

                var service_type = 'cutout';
                var service_option = '';
                var total_value = 0;



                $("#costing_box").html('');

                var costItem = '<div class="hbox b-b b-light m-b-xs">\
				                    <span class="pull-left text-info font-bold">Image Quantity</span><span class="pull-right text-info font-bold" id="total_images">' + total_images + '</span>\
				                </div>';
                $("#costing_box").append(costItem);


                $.each(formData, function (index, item) {
                    //console.log(item.name + ':' + item.value);

                    switch (item.name) {
                        case 'return_file_type[]':
                            if (item.value == 'PSD') {
                                total_value += (total_images * 0.05);
                                var costItem = '<div class="hbox b-b b-light m-b-xs"><span class="pull-left">PSD Files: ($0.05)</span><span class="pull-right">$' + Number((total_images * 0.05).toFixed(2)) + '</span></div>';
                                $("#costing_box").append(costItem);
                            }
                            if (item.value == 'TIFF') {
                                total_value += (total_images * 0.05);
                                clog("TIFF:" + item.value);
                                var costItem = '<div class="hbox b-b b-light m-b-xs"><span class="pull-left">TIFF Files: ($0.05)</span><span class="pull-right">$' + Number((total_images * 0.05).toFixed(2)) + '</span></div>';
                                $("#costing_box").append(costItem);
                            }
                            break;
                        case 'cutout_bg_option':
                            if (item.value == 'Transparent BG') {
                                var r_v = $(".o_rft:checked").val();
                                if ((r_v == 'JPG') && $(".o_rft:checked", "#orderForm").length < 2) {
                                    alert("Transparent Background cannot be provided unless you choose “PNG, PSD or TIFF” file format.");
                                    $('.white').prop("checked", true);
                                }
                            }
                            break;
                        case 'image_complexity':
                            var image_complexity_value = item.value;
                            var costItem = '<div class="hbox b-b b-light m-b-xs"><span class="pull-left">' + $('[name="image_complexity"]:checked').data('title') + ': ($' + image_complexity_value + ')</span><span class="pull-right">$' + Number((total_images * image_complexity_value).toFixed(2)) + '</span></div>';
                            total_value += (total_images * image_complexity_value);
                            $("#costing_box").append(costItem);
                            break;
                        case 'shadow_option':
                            var shadowCost = $('input[name=shadow_option_value]').val();
                            if (shadowCost > 0) {
                                total_value += (total_images * shadowCost);
                                var costItem = '<div class="hbox b-b b-light m-b-xs"><span class="pull-left">' + item.value + '</span><span class="pull-right">$' + Number((total_images * shadowCost).toFixed(2)) + '</span></div>';
                                $("#costing_box").append(costItem);
                            }
                            break;
                        case 'mannequin_option':
                            var mannequin_option = $('input[name=mannequin_option]:checked').val();
                            console.log(mannequin_option);
                            if (mannequin_option != 'none') {
                                total_value += (total_images * $mannequinCost);
                                var costItem = '<div class="hbox b-b b-light m-b-xs"><span class="pull-left">' + item.value + '</span><span class="pull-right">$' + Number((total_images * $mannequinCost).toFixed(2)) + '</span></div>';
                                $("#costing_box").append(costItem);
                            }
                            break;
                        case 'retbasic_value':
                            total_value += (total_images * 1.00);
                            var costItem = '<div class="hbox b-b b-light m-b-xs"><span class="pull-left">Photo Retouching: ($1.00)</span><span class="pull-right">$' + Number((total_images * 1.00).toFixed(2)) + '</span></div>';
                            $("#costing_box").append(costItem);

                            break;
                        case 'rethigh_value':
                            total_value += (total_images * 7.00);
                            var costItem = '<div class="hbox b-b b-light m-b-xs"><span class="pull-left">High-End Retouching: ($7.00)</span><span class="pull-right">$' + Number((total_images * 7.00).toFixed(2)) + '</span></div>';
                            $("#costing_box").append(costItem);

                            break;
                        case 'brightness_value':
                            total_value += (total_images * 0.50);
                            var costItem = '<div class="hbox b-b b-light m-b-xs"><span class="pull-left">Fix Imperfection: ($0.50)</span><span class="pull-right">$' + Number((total_images * 0.50).toFixed(2)) + '</span></div>';
                            $("#costing_box").append(costItem);

                            break;
                        case 'staight_value':
                            total_value += (total_images * 0.25);
                            var costItem = '<div class="hbox b-b b-light m-b-xs"><span class="pull-left">Straight & Symm: ($0.25)</span><span class="pull-right">$' + Number((total_images * 0.25).toFixed(2)) + '</span></div>';
                            $("#costing_box").append(costItem);

                            break;
                        case 'crop_resize':
                            if (item.value == 'Variation (Upto 3)') {
                                total_value += (total_images * 0.25);
                                var costItem = '<div class="hbox b-b b-light m-b-xs"><span class="pull-left">Crop & Resize: ($0.25)</span><span class="pull-right">$' + Number((total_images * 0.25).toFixed(2)) + '</span></div>';
                                $("#costing_box").append(costItem);
                            }
                            break;
                        case 'color_fix':
                            if (item.value == 'Basic Adjustment') {
                                total_value += (total_images * 0.5);
                                var costItem = '<div class="hbox b-b b-light m-b-xs"><span class="pull-left">Color Correction: ($0.50)</span><span class="pull-right">$' + Number((total_images * 0.50).toFixed(2)) + '</span></div>';
                                $("#costing_box").append(costItem);
                            }
                            break;
                        case 'payment_option':
                            console.log(item.value);
                            if (item.value == 'Pay Now') {
                                $("#payment_method").removeClass('hide');
                            }
                            if (item.value == 'Pay Later') {
                                $("#payment_method").addClass('hide');
                            }
                            break;

                    } //End Switch

                });
           
                $.each(formData, function (index, item) {
                    switch (item.value) {
                        case '24':
                            var discount = ((15 / 100) * total_value).toFixed(2);
                            total_value += +discount;
                            var discountItem = '<div class="hbox b-b b-light m-b-xs"><span class="pull-left">Priority 24H TAT: +15%</span><span class="pull-right"> $' + Number(discount) + '</span></div>';
                            $("#costing_box").append(discountItem);

                            break;
                        case '72':
                            var discount = ((15 / 100) * total_value).toFixed(2);
                            total_value += -discount;
                            var discountItem = '<div class="hbox b-b b-light m-b-xs"><span class="pull-left">TAT Discount: -15%</span><span class="pull-right"> -$' + Number(discount) + '</span></div>';
                            $("#costing_box").append(discountItem);
                            // $(".extra").remove();
                            break;
                    }
                });


                var costItem = '<div class="hbox b-b b-light m-b-xs"><span class="pull-left text-info font-bold">Estimated Total</span><span class="pull-right text-info font-bold">$' + Number((total_value).toFixed(2)) + '</span></div>';
                $("#costing_box").append(costItem);
                  console.log("Estimated Total: "+total_value);
                clog("Total $" + total_value);
            },
            Validation: function (formData) {
                var errorMsg = '';
                var validate = true;
                var has_file_type = false;
                var has_tat = false;
                var has_payment_option = false;
                var has_payment_method = false;
                var uploading = false;

                $.each(formData, function (index, item) {
                    switch (item.name) {

                        case 'shadow_option_value':
                            if (total_images < 1) {
                                clog('Upload Some Image');
                                errorMsg += '<li>Please Upload Some Image</li>';
                                validate = false;
                            }
                            break;
                        case 'return_file_type[]':
                            has_file_type = true;
                            break;
                        case 'job_title':
                            if (item.value.length < 1) {
                                $("[name=job_title]").addClass('parsley-error');
                                clog('Job Title Required');
                                errorMsg += '<li>Job Title Required</li>';
                                validate = false;
                            }
                            break;
                        case 'tat':
                            if (item.value == '') {
                                clog("Invalid Turnaround Time!");
                                errorMsg += "<li>Invalid Turnaround Time!</li>";
                                validate = false;
                            } else {
                                has_tat = true;
                            }
                            break;
                        case 'payment_option':
                            if (item.value.length < 1) {
                                clog("Select Payment Option");
                                errorMsg += "<li>Select Payment Option</li>";
                                validate = false;
                            } else {
                                has_payment_option = true;
                            }
                            break;


                        case 'payment_method':
                            if (item.value.length < 1) {
                                if ($('#pay_now').is(':checked')) {
                                    clog("Select Payment Method");
                                    errorMsg += "<li>Select Payment Method</li>";
                                    validate = false;
                                }
                            } else {
                                has_payment_method = true;
                            }
                            break;
                        case 'total_progress':
                            if (parseInt(item.value) < 100) {
                                uploading = true;
                                errorMsg += "<li>Upload In Progress! Please Wait Until Uploading Is Finished.</li>";
                                validate = false;
                            }
                            break;
                    } //End Switch
                });
                if (!has_file_type) {
                    clog("File Format Must Be Selected: At Least One (eg. JPG)");
                    errorMsg += "<li>File Format Must Be Selected: At Least One (eg. JPG)</li>";
                    validate = false;
                }
                if (!has_tat) {
                    clog("Choose Turnaround Time");
                    errorMsg += "<li>Choose Turnaround Time</li>";
                    validate = false;
                }
                if (!has_payment_option) {
                    clog("Select Payment Option");
                    errorMsg += "<li>Select Payment Option</li>";
                    validate = false;
                }
                if (!has_payment_method) {
                    clog("Select payment method");
                    errorMsg += "<li>Select Payment Method</li>";
                    validate = false;
                }

                if (validate) {
                    return true;
                } else {
                    var msgHtml = '<ul>' + errorMsg + '</ul>';
                    Portal.alert({text: '<ul>' + errorMsg + '</ul>', type: "danger"});
                    return false;
                }
            },
            ValidationNew: function () {
                var errorMsg = '';
                var validate = true;
                var uploading = false;

                if (total_images < 1) {
                    errorMsg += '<li>Please Upload Some Image</li>';
                    validate = false;
                }

                if ($(".o_rft:checked", "#orderForm").length < 1) {
                    errorMsg += "<li>File Format Must Be Selected: At Least One (eg. JPG)</li>";
                    validate = false;
                }
                if ($("input[name=tat]:checked", "#orderForm").val() == '') {
                    errorMsg += "<li>Choose Turnaround Time</li>";
                    validate = false;
                }
                if (parseInt($("#total_progress").val()) > 0 && parseInt($("#total_progress").val()) < 100) {
                    uploading = true;
                    errorMsg += "<li>Upload In Progress! Please Wait Until Uploading Is Finished.</li>";
                    validate = false;
                }


                if (validate) {
                    return true;
                } else {
                    var msgHtml = '<ul>' + errorMsg + '</ul>';
                    Portal.alert({text: '<ul>' + errorMsg + '</ul>', type: "danger"});
                    return false;
                }
            }
        },
        LoadOrderTable: function (limit) {
            var filters = $("#order_filter_form").serializeArray();
            if (limit != undefined) {
                filters[filters.length] = {name: "limit", value: limit};
            }
            var loading = '<tr>\
							<td colspan="8" align="center"><i class="fa fa-spinner fa-spin"></i> Loading...</td>\
						</tr>';
            $("#orderslist_box").html(loading);

            $.ajax({
                url: ajax_url + '/get_order?_r=' + Math.random(),
                type: 'POST',
                dataType: 'json',
                data: filters,
                success: function (json) {
                    if (json.status == 'OK') {
                        var source = $("#orders").html();
                        var template = Handlebars.compile(source);
                        var html = template(json);
                        $("#orderslist_box").html(html);
                        Portal.PageInit.OrderList();
                    } else {
                        var loading = '<tr>\
							<td colspan="8" align="center">No Records!</td>\
						</tr>';
                        $("#orderslist_box").html(loading);
                    }
                },
                error: function () {
                    /* Act on the event */
                }
            });
        }
    },
    Quotation: {
        AddNew: {
            Validation: function (formData) {
                var errorMsg = '';
                var validate = true;
                var uploading = false;

                if (total_images < 1) {
                    errorMsg += '<li>Please Upload Some Image</li>';
                    validate = false;
                }
                if ($(".s_type:checked", "#quoteForm").length < 1) {
                    errorMsg += "<li>Service Type Must Be Selected: At Least One.</li>";
                    validate = false;
                }
                if ($(".rtf_opt:checked", "#quoteForm").length < 1) {
                     errorMsg += "<li>File Format Must Be Selected: At Least One (eg. JPG)</li>";
                    validate = false;
                }
                if (parseInt($("#total_progress").val()) > 0 && parseInt($("#total_progress").val()) < 100) {
                    uploading = true;
                    errorMsg += "<li>Upload In Progress! Please Wait Until Uploading Is Finished.</li>";
                    validate = false;
                }
                if (validate) {
                    return true;
                } else {
                    var msgHtml = '<ul>' + errorMsg + '</ul>';
                    Portal.alert({text: '<ul>' + errorMsg + '</ul>', type: "danger"});
                    return false;
                }
            }
        },
        LoadQuoteTable: function () {
            var filters = $("#quote_filter_form").serializeArray();
            var loading = '<tr>\
							<td colspan="10" align="center"><i class="fa fa-spinner fa-spin"></i> Loading...</td>\
						</tr>';
            $("#quoteslist_box").html(loading);
            $.ajax({
                url: ajax_url + '/get_quotes?_r=' + Math.random(),
                type: 'POST',
                dataType: 'json',
                data: filters,
                success: function (json) {
                    if (json.status == 'OK') {

                        var source = $("#quotations").html();
                        var template = Handlebars.compile(source);
                        var html = template(json);
                        $("#quoteslist_box").html(html);
                    } else {
                        var loading = '<tr>\
							<td colspan="10" align="center">No Records!</td>\
						</tr>';
                        $("#quoteslist_box").html(loading);
                    }
                },
                error: function () {
                    /* Act on the event */
                }
            });
        },
        accept: function (quote_id, service_id) {
            Portal.wait();
            $.ajax({
                url: ajax_url + '/quote_action',
                type: 'POST',
                dataType: 'json',
                data: {quote_id: quote_id, action: 'accept'},
                success: function (json) {
                    Portal.removeWait();
                    if (json.status == 'OK') {
                        $('#ajaxModal').remove();

                        var remote = ajax_url + '/popup_quote_order/?quote_id=' + quote_id;
                        var modal = $('<div class="modal fade" id="ajaxModal"><div class="modal-body"></div></div>');
                        $('body').append(modal);
                        modal.modal();
                        modal.load(remote);

                        Portal.Quotation.LoadQuoteTable();
                    }
                },
                error: function () {
                    /* Act on the event */
                }
            });
            return false;
        },
        reject: function (quote_id) {
            var result = confirm("Want to reject?");
            if (result) {
                Portal.wait();
                $.ajax({
                    url: ajax_url + '/quote_action',
                    type: 'POST',
                    dataType: 'json',
                    data: {quote_id: quote_id, action: 'reject'},
                    success: function (json) {
                        if (json.status == 'OK') {
                            Portal.Quotation.LoadQuoteTable();
                        }
                        Portal.removeWait();
                    },
                    error: function () {
                        /* Act on the event */
                    }
                });
            }
            return false;
        }
    },
    Invoice: {
        LoadInvoiceTable: function (limit) {
            var filters = $("#invoice_filter_form").serializeArray();
            if (limit != undefined) {
                filters[filters.length] = {name: "limit", value: limit};
            }
            var loading = '<tr>\
							<td colspan="11" align="center"><i class="fa fa-spinner fa-spin"></i> Loading...</td>\
						</tr>';
            $("#invoiceslist_box").html(loading);
            $.ajax({
                url: ajax_url + '/get_invoices?_r=' + Math.random(),
                type: 'POST',
                dataType: 'json',
                data: filters,
                success: function (json) {
                    if (json.status == 'OK') {
                        var source = $("#tpl_invoices").html();
                        var template = Handlebars.compile(source);
                        var html = template(json);
                        $("#invoiceslist_box").html(html);
                        Portal.PageInit.OrderList();
                    } else {
                        var loading = '<tr>\
							<td colspan="8" align="center">No Records!</td>\
						</tr>';
                        $("#invoiceslist_box").html(loading);
                    }
                },
                error: function () {
                    /* Act on the event */
                }
            });
        }
    },
    Message: {
        send: function (action) {
            $(".ajax_msg").removeClass('text-info text-danger');

            if (typeof (tinyMCE) != "undefined") {
                var editorContent = tinyMCE.activeEditor.getContent();
                if (editorContent == '') {
                    // Portal.alert({text: "Message cannot be empty!", type: "danger"});
                    // return false;
                }
            } else {
                if ($("#message").val() == '') {
                    // Portal.alert({text: "Message cannot be empty!", type: "danger"});
                    // return false;
                }
            }

            if (action == 'redirect' || action == 'refresh') {
                Portal.wait();
            } else {
                var icon = '<i class="fa fa-spinner fa-spin"></i>';
                $(".ajax_msg").html(icon + ' ' + $(".ajax_msg").data('wait')).show();
            }

            var text = $("#message_form").serializeArray();

            $.ajax({
                url: ajax_url + "/send_message",
                type: 'POST',
                dataType: 'JSON',
                data: text,
                success: function (json) {
                    alert("not work!");
                    if (json.status == 'OK') {
                        /* Clear Input Values */
                        if (typeof (tinyMCE) != "undefined" && tinyMCE.activeEditor != null) {
                            tinyMCE.activeEditor.setContent('');
                        }
                        $("#subject").val('');
                        $("#message").val('');

                        //var source   = $("#tpl_messages").html();
                        //var template = Handlebars.compile(source);

                        //var html    = template(json);
                        //$("#message_content").html(html);

                        if (action == 'redirect') {
                            window.location.href = site_url + '/message';
                        } else if (action == 'refresh') {
                            location.reload();
                        } else {
                            var icon = '<i class="fa fa-check-square"></i>';
                            $(".ajax_msg").addClass('text-info');
                            $(".ajax_msg").html(icon + ' ' + $(".ajax_msg").data('done')).show();
                            setTimeout(function () {
                                $(".ajax_msg").hide();
                            }, 5000);
                        }

                    } else {
                        var icon = '<i class="fa fa-warning"></i>';
                        $(".ajax_msg").addClass('text-danger');
                        $(".ajax_msg").show().html(icon + ' ' + json.msg);

                        if (action == 'redirect' || action == 'refresh') {
                            Portal.removeWait();
                        } else {
                            setTimeout(function () {
                                $(".ajax_msg").hide();
                            }, 5000);
                        }
                    }

                    $(".timeago").timeago();
                    // Portal.removeWait();
                },
                error: function (data) {
                }
            });
            return false;
        },
        get: function () {
            Portal.wait();
            $.ajax({
                url: ajax_url + "/get_messages",
                type: 'POST',
                dataType: 'JSON',
                data: text,
                success: function (json) {
                    if (json.status == 'OK') {
                        //var tpl_html = ich.tpl_messages(json);
                        //$("#message_content").html(tpl_html);
                        //alert(json.stringify(tpl_html);

                        var source = $("#tpl_messages").html();
                        var template = Handlebars.compile(source);

                        var html = template(json);
                        $("#message_content").html(html);
                    }
                    $("#message").val('');

                    $(".timeago").timeago();
                    Portal.removeWait();
                },
                error: function (data) {
                }
            });
            return false;
        }
    },
    Helpers: {
        localtime: function (prefix) {
            /**
             * #mytime 
             * #remote_time
             */
            var d = new Date();
            if (prefix == 'r') {
                d.setUTCHours(d.getUTCHours() + 6); //+6 for BDT
                var seconds = d.getUTCSeconds();
                $("#" + prefix + "_sec").html((seconds < 10 ? "0" : "") + seconds);
                var minutes = d.getUTCMinutes();
                $("#" + prefix + "_min").html((minutes < 10 ? "0" : "") + minutes);
                var hours = d.getUTCHours();
                // console.log(hours);
            } else {
                var seconds = d.getSeconds();
                $("#" + prefix + "_sec").html((seconds < 10 ? "0" : "") + seconds);
                var minutes = d.getMinutes();
                $("#" + prefix + "_min").html((minutes < 10 ? "0" : "") + minutes);
                var hours = d.getHours();
            }

            var mid = 'AM';
            /* Disable 12hr format
             if(hours==0){ //At 00 hours we need to show 12 am
             hours=12;
             }
             else if(hours>12){
             hours=hours%12;
             mid='PM';
             }
             $("#"+prefix+"_mid").html(mid);
             */
            $("#" + prefix + "_hours").html((hours < 10 ? "0" : "") + hours);
        },
        formatDate: function (value) {
            if (value) {
                Number.prototype.padLeft = function (base, chr) {
                    var len = (String(base || 10).length - String(this).length) + 1;
                    return len > 0 ? new Array(len).join(chr || '0') + this : this;
                }
                var d = new Date(value),
                        dformat = [d.getFullYear(),
                            (d.getMonth() + 1).padLeft(),
                            d.getDate().padLeft()].join('-') +
                        ' ' +
                        [d.getHours().padLeft(),
                            d.getMinutes().padLeft(),
                            d.getSeconds().padLeft()].join(':');
                return dformat; //Y-m-d H:i:s
            }
        },
        quote_details: function (quote_id) {
            var url = ajax_url + '/popup_quote_details/?quote_id=' + quote_id;
            $("#ajaxModal").load(url);
            return true;
        },
        validateLoginForm: function () {

            var login = $("#login").val();
            if (login.length < 1) {
                $(".login").addClass('login_invalid');
                $(".login").removeClass('hide');
                return false;
            }

            var password = $("#password").val();
            if (password.length < 1) {
                $(".password").removeClass('hide');
                return false;
            }
            return true;
        },
        validateRegisterForm: function () {
            var fullname = $("#fullname").val();
            if (fullname.length < 1) {
                $(".fullname").removeClass('hide');
                return false;
            }

            var email = $("#email").val();
            if (email.length < 1) {
                $(".email").addClass('email_invalid');
                $(".email").removeClass('hide');
                return false;
            }

            var password = $("#password").val();
            if (password.length < 1) {
                $(".password").removeClass('hide');
                return false;
            }

            var company = $("#company").val();
            if (company.length < 1) {
                $(".company").removeClass('hide');
                return false;
            }

            var phone = $("#phone").val();
            if (phone.length < 1) {
                $(".phone").removeClass('hide');
                return false;
            }
            return true;
        },
        handlePlaceoderSidebarStyle: function () {
            var windowHeight = $(window).height();
            var boxHeight = $("#sidebar").height();
            if (windowHeight < (boxHeight + 60)) {
                $("#sidebar").css("position", "relative");
                $("#sidebar").css("margin-right", "0");
            } else {
                $("#sidebar").css("position", "fixed");
                $("#sidebar").css("margin-right", "15px");
            }
        }
    },
    alert: function (obj) {
        /**
         * @param text 
         * @param type 	message type: "info/warning/success" 
         * @param confirm boolean "confirm/alert"
         * @param href link to
         *
         */
        $('#ajaxModal').remove();

        var source = $("#alert_box").html();
        var template = Handlebars.compile(source);
        var htmlData = template(obj);

        var $modal = $('<div class="modal fade" id="ajaxModal"><div class="modal-body"></div></div>');
        $('body').append($modal);
        $modal.modal();
        $modal.html(htmlData);
        return false;
    }
}

jQuery(function ($) {
    // Server and local time display
    Portal.Helpers.localtime('l');
    Portal.Helpers.localtime('r');
    setInterval(function () {
        Portal.Helpers.localtime('l');
        Portal.Helpers.localtime('r');
    }, 60000); //60 sec

    pull = setInterval(function () {
        Portal.pull();
    }, 3000);

    $(".change_ac").click(function (event) {
        /* Act on the event */
        Portal.User.Company.setPermission($(this));
    });

    // Portal.alert({text: "Alert Message", type: "danger", confirm: true, href: site_url});

    $(".timeago").timeago();

    var update_location = function (event) {
        document.location.hash = this.getAttribute("href");
    }
    $("[data-toggle=tab]").click(update_location);

    // Javascript to enable link to tab
    var url = document.location.toString();
    if (url.match('#')) {
        $('.nav-tabs a[href=#' + url.split('#')[1] + ']').tab('show');
    }

    // Change hash for page-reload
    $('.nav-tabs a').on('shown', function (e) {
        window.location.hash = e.target.hash;
    });
    //End HASH link

    //$("#rfq")
    $("#ar-pop6").on("mouseup", function () {
        if ($("#rfq").prop('checked')) {
            $(".complexity_option_mask").addClass('hide');
        } else {
            $(".complexity_option_mask").removeClass('hide');
        }
        Portal.Order.addNew.CostCalc();
    });

    $(".order_filter").change(function (event) {
        Portal.Order.LoadOrderTable();
    });

    $("#order_filter_form").submit(function (event) {
        event.preventDefault();
        Portal.Order.LoadOrderTable();
        return false;
    });

    $(".quote_filter").change(function (event) {
        Portal.Quotation.LoadQuoteTable();
    });

    $("#quote_filter_form").submit(function (event) {
        event.preventDefault();
        Portal.Quotation.LoadQuoteTable();
        return false;
    });

    $(".invoice_filter").change(function (event) {
        Portal.Invoice.LoadInvoiceTable();
    });

    $("#invoice_filter_form").submit(function (event) {
        event.preventDefault();
        Portal.Invoice.LoadInvoiceTable();
        return false;
    });

    //Dynamic push data to hidden field
    $(".shadow_options").on("change", "input", function () {
        $("#shadow_option_value").val($(this).attr('data-cost'));
    });

    $(".mannequin_option").on("change", function () {
        $("#mannequin_option_value").val($(this).attr('data-cost'));
    });

    $("#staight").on("change", function () {
        if ($(this).prop("checked")) {
            $("#staight_value").val($(this).attr('data-cost'));
        } else {
            $("#staight_value").val(0);
        }
    });

    $("#brightness").on("change", function () {
        if ($(this).prop("checked")) {
            $("#brightness_value").val($(this).attr('data-cost'));
        } else {
            $("#brightness_value").val(0);
        }
    });
    //End

    $(".clear_shadow_option").on("click", function () {
        Portal.Order.addNew.clearCustomSelections();
        Portal.Order.addNew.CostCalc();
        return false;
    });

    $("#place_order_form").on("change", "input", function (event) {
        Portal.Order.addNew.CostCalc();
    });

    /*
     * Submit new order form.
     */
    $("#place_order_form").on("submit", function (event) {
        event.preventDefault();

        var postData = $(this).serializeArray();

        Portal.Order.addNew.CostCalc();

        if (Portal.Order.addNew.Validation(postData)) {
            Portal.wait();
            $.ajax({
                url: ajax_url + "/post_new_order",
                data: postData,
                type: 'POST',
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == "OK") {
                        if (data.job_type == 'order') {
                            if (data.payment_option == 'paynow') {
                                if (data.payment_method == 'paypal') {
                                    Portal.alert({text: "Please wait. You are redirecting to payment page..", type: "success"});
                                    window.location.href = site_url + 'paypal_payment/' + data.order_id;
                                } else {
                                    Portal.alert({text: "Please wait. You are redirecting to payment page..", type: "success"});
                                    window.location.href = site_url + 'payza_payment/' + data.order_id;
                                }
                            } else {
                                window.location.href = site_url + 'orders/';
                            }
                        } else {
                            window.location.href = site_url + 'quotations/';
                        }
                    } else {
                        Portal.removeWait();
                        if (data.refresh == true) {
                            Portal.alert({text: data.msg, type: "danger", refresh: true});
                        } else {
                            Portal.alert({text: data.msg, type: "danger"});
                        }
                    }
                },
                error: function (data) {
                }
            });
        }
        return false;
    });
    //End

    /*
     * Submit new order from quote.
     */
    $("#quote2order_form").on("submit", function (event) {
        event.preventDefault();

        var quantity = $("#total_images").text();
        if (quantity < 1) {
            Portal.alert({text: 'Please Upload Some Image.', type: "danger"});
            return false;
        }
        var job_title = $('input[name="job_title"]').val();
        if (job_title.length < 1) {
            Portal.alert({text: 'Job Title Required', type: "danger"});
            return false;
        }

        var postData = $(this).serializeArray();

        // Portal.wait();
        $.ajax({
            url: ajax_url + "/post_quote2order",
            data: postData,
            type: 'POST',
            dataType: 'JSON',
            success: function (data) {
                if (data.status == "OK") {
                    if (data.job_type == 'order') {
                        if (data.payment_option == 'paynow') {
                            if (data.payment_method == 'paypal') {
                                Portal.alert({text: "Please wait. You are redirecting to payment page..", type: "success"});
                                window.location.href = site_url + 'paypal_payment/' + data.order_id;
                            } else {
                                Portal.alert({text: "Please wait. You are redirecting to payment page..", type: "success"});
                                window.location.href = site_url + 'payza_payment/' + data.order_id;
                            }
                        } else {
                            window.location.href = site_url + 'orders/';
                        }
                    } else {
                        window.location.href = site_url + 'quotations/';
                    }
                } else {
                    Portal.removeWait();
                    Portal.alert({text: data.msg, type: "danger"});
                }
            },
            error: function (data) {
            }
        });
        return false;
    });
    //End

    /*
     * Service tabs in create new order page
     */
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        // clog('check:' + e.target.hash); // activated tab
        //e.relatedTarget; // previous tab
        var curr_tab = e.target.hash;
        curr_tab = curr_tab.replace("#", "");

        //Clear form
        Portal.Order.addNew.clearCustomSelections();
        Portal.Order.addNew.CostCalc();

        if (curr_tab == 'clipping-path') {
            $(".mannequin_option").prop("disabled", false);
            $(".mannequin_option").parent().removeClass('text-muted');
        } else {
            $(".mannequin_option").prop("disabled", true);
            $(".mannequin_option").parent().addClass('text-muted');
        }

    });

    $(".service_cp").on("click", function () {
        $(".service_retouch").removeClass('active');
        $(".service_mask").removeClass('active');
        $(this).addClass('active');
        $("#o_service").val('cutout');
    });

    $(".service_mask").on("click", function () {
        $(".service_cp").removeClass('active');
        $(".service_retouch").removeClass('active');
        $(this).addClass('active');
        $("#o_service").val('masking');
    });

    $(".service_retouch").on("click", function () {
        $(".service_cp").removeClass('active');
        $(".service_mask").removeClass('active');
        $(this).addClass('active');
        $("#o_service").val('retouch');
    });
    //End service tabs

    /*
     * Instant Logout modalbox
     */
    $(".logout").on("click", function (event) {
        event.preventDefault();
        clearTimeout(pull);
        Portal.User.logout();
        $('#ajaxModal').remove();
        var $this = $(this)
                , $remote = $this.data('remote') || $this.attr('href')
                , $modal = $('<div class="modal fade" id="ajaxModal"><div class="modal-body"></div></div>');
        $('body').append($modal);
        $modal.modal();
        $modal.load($remote);
        return false;
    });
    /*
     * Instant Login (remove modalbox)
     */
    $(document).on("click", "#unlock", function () {
        $('#ajaxModal').modal('hide');
        clog("modal close");
    });


    /*$('#service_type a').click(function (e) {
     // e.preventDefault();
     // $(this).tab('show');
     }*/

    $('input[name=flatness_value]').change(function () {
        if ($(this).is(":checked")) {
            $("#flatness").removeAttr("disabled");
        } else {
            $("#flatness").attr('disabled', true);
            $("#flatness").val(0.5);
        }
    });

}); //end ready

function showOrderQuote(view) {
    $(".ord_view").removeClass('select');
    $(".qt_view").removeClass('select');
    if (view !== undefined) {
        if (view == 'q') {
            $('.order_view').addClass('hide');
            $('.quote_view').removeClass('hide');
            $(".qt_view").addClass('select');
            $(".tabs_shape ul").css("border-bottom-color", "#fcc633");
        } else {
            $('.quote_view').addClass('hide');
            $('.order_view').removeClass('hide');
            $(".ord_view").addClass('select');
            $(".tabs_shape ul").css("border-bottom-color", "#1ccacc");
        }
    } else {
        setTimeout(function () {
            var curr_hash = window.location.hash.substr(1);
            if (curr_hash == 'quote') {
                $('.order_view').addClass('hide');
                $('.quote_view').removeClass('hide');
                $(".qt_view").addClass('select');
                $(".tabs_shape ul").css("border-bottom-color", "#fcc633");
            } else {
                $('.quote_view').addClass('hide');
                $('.order_view').removeClass('hide');
                $(".ord_view").addClass('select');
                $(".tabs_shape ul").css("border-bottom-color", "#1ccacc");
            }
        }, 10);
    }
}

function updateNonify(e, name, value) {
    var res = Portal.User.Settings.saveNotify(name, value);
    if (res) {

    }
}

function uploade_change() {
    var value = $("#tat_value").val();
    sessionStorage.setItem('key', value);
    var data = sessionStorage.getItem('key');
    return data;
}

// $(".dropzone").change(function() {
// 	// var tat_val = $('input[name="tat"]:checked').val();
// 	$("#tat_value").val(1);
// 	var value2 = $("#tat_value").val();
// 	alert(value2);
// });	
// $("#orderForm").change(function() {
// 	var newv = $("#tat_value").val();
// 	alert(newv);
// });







