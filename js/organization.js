jQuery.fn.center = function () {
    this.css("position", "absolute");
    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) +
        $(window).scrollTop()) + "px");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) +
        $(window).scrollLeft()) + "px");
    return this;
};


var openPopup = function (url, header) {

    header = header || '';

    var $popup = $("#organization_popup");

    $popup.find('.popup-loader').show();
    $popup.find('.popup-content').empty();

    $popup.find('h2').text(header);

    $.blockUI({
        message: $popup,
        css: {
            top: ($(window).height() - $popup.width() - 20) / 2 + 'px',
            left: ($(window).width() - $popup.height() - 20) / 2 + 'px',
            background: '#ffffff',
            width: $popup.width() + 'px',
            border: 'none',
            cursor: 'auto',
            'border-radius': '10px'
        }
    });

    $.get(url, function (data) {
        $popup.find('.popup-content').html(data);
        $popup.find('.popup-loader').hide();
        $('.blockMsg').center();

        if ($popup.find('form').length) {

            var $form = $popup.find('form');

            $form.on('submit', function () {
                $.ajax({
                    url: $form.attr('action'),
                    data: $form.serialize(),
                    type: 'post',
                    success: function (result) {
                        result = jQuery.parseJSON(result);

                        if (result.success == 1) {
                            if (result.url) {
                                document.location.href = result.url;
                            }
                            else {
                                Department.Update();
                            }
                            $.unblockUI();
                        }
                        else {
                            $.each(result.errors, function (key, val) {
                                $form.find(".errorMessage.error-" + key).text(val).show();
                            });
                        }
                    }
                });
                return false;
            });
        }

    });

    $popup.on('click', '.close-popup', function () {
        $.unblockUI();
        return false;
    });
};

var visiblePopover = '';

function checkVisiblePopover(el) {
    if (el.data('popover').tip().hasClass('in')) {
        if (visiblePopover) {
            visiblePopover.popover('hide');
        }
        visiblePopover = el;
    }
    else {
        visiblePopover = '';
    }
}

var Department = {

    activeId: 0,

    Load: function (departament_id) {
        this.activeId = departament_id;

        $('.department-container').show();
        $('.department-container .department-content').hide();
        $('.department-container .loader').show();

        $.get('/departments/load/' + departament_id, function (html) {
            $('.department-container .department-content').html(html).show();
            $('.department-container .loader').hide();
        });
    },

    Update: function () {
        this.Load(this.activeId);
    }
};

$(function () {


    $("body").on("click", "[rel=popover]", function () {
        var el = $(this);

        if (el.hasClass('popover-loaded')) {
            checkVisiblePopover(el);
            return false;
        }


        if (el.attr('href') === '#') {
            el.popover({
                content: el.attr('content'),
                html: true,
                trigger: 'click'
            }).popover('show');
            el.addClass('popover-loaded');
            checkVisiblePopover(el);
            return false;
        }

        $.ajax({
            url: el.attr('href'),
            success: function (d) {
                el.popover({
                    content: d,
                    html: true,
                    trigger: 'click'
                }).popover('show');

                el.addClass('popover-loaded');
                checkVisiblePopover(el);
            }
        });

        return false;
    });

    $('body').on('click', function () {
        $("[rel=popover].popover-loaded").popover('hide');
        visiblePopover = '';
    });


    $('body').on('click', '.btn-popup', function () {
        openPopup($(this).attr('href') ? $(this).attr('href') : $(this).data('action'), $(this).data('header'));
        return false;
    });

    function resizeHeads() {
        var count = $('.heads-row .head-block').length;

        if (count === 0) {
            return;
        }

        var width = Math.floor(100 / count);
        $('.heads-row').find('td').css('width', width + '%');
    }


    $('.head-block').each(function () {
        var $block = $(this);
        var is_ceo = $block.hasClass('ceo-block');
        $block.find('.action-remove').on('click', function () {
            if (!confirm('Вы уверены, что хотите удалить данного директора?')) {
                return false;
            }

            $.get('/jobs/delete/' + $block.data('id'));

            $block.parent().remove();
            resizeHeads();


            return false;
        });
    });
/*
        $block.find('.action-edit').on('click', function () {

            $block.find('.view-mode').hide();
            $block.find('.edit-mode').show();

            return false;
        });

        $block.find('.action-cancel').on('click', function () {

            $block.find('.edit-mode').hide();
            $block.find('.view-mode').show();

            return false;
        });





        $block.find('.action-save').on('click', function () {

            var $job_name = $block.find('.edit-mode .job-name');
            $job_name.removeClass('error');
            if ($job_name.val().length === 0) {
                $job_name.addClass('error');
                return false;
            }

            var $person = $block.find('.edit-mode .person-select option:selected');
            var person_id = $person.val();
            var person_name = $person.text();

            $block.find('.view-mode .person-name').text(person_name);
            $block.find('.view-mode .job-name').text($job_name.val());

            $block.find('.edit-mode').hide();
            $block.find('.view-mode').show();

            if (is_ceo) {
                $.post('/organization/save_ceo', {
                    person: person_id,
                    job: $job_name.val()
                });
            }
            else {
                $.post('/organization/save_head', {
                    person_id: person_id,
                    job_id: $block.data('id'),
                    job_name: $job_name.val()
                });
            }

            return false;
        });

    });
    */

    $('.department').each(function () {
        var $block = $(this);
        var departament_id = $block.data('id');

        $block.find('.btn-set-head').on('click', function () {

            var person_id = 0;

            if ($(this).parents('.no-head').length) {
                $(this).hide();
            }
            else {
                $(this).parents('.person-item').hide();
                person_id = $(this).parents('.person-item').data('id');
            }

            $block.find('.head-form').find('select').val(person_id);
            $block.find('.head-form').show();

            return false;
        });

        $block.find('.btn-save-head').on('click', function () {

            var head_id = $block.find('.head-form select option:selected').val();
            var head_name = $block.find('.head-form select option:selected').html();

            $.post('/departments/save_head', {department_id: departament_id, head_id: head_id});

            $block.find('.head-form').hide();
            if (head_id == 0) {
                $block.find('.person-item').hide();
                $block.find('.no-head').show();
            }
            else {
                $block.find('.person-item').show();

                $block.find('.person-item').data('id', head_id);
                $block.find('.person-item .user-link').attr('href', '/personal/edit/' + head_id).text(head_name);

                $block.find('.no-head').hide();
            }

            return false;
        });


        $block.find('.btn-open').on('click', function () {

            if ($(this).text() === 'Закрыть') {
                $('.department-container').hide();
                $(this).text('Открыть');
                return;
            }

            $('.departments-container .btn-open').text('Открыть');

            Department.Load(departament_id);
            $(this).text('Закрыть');

            return false;
        });

    });

    /*
    $('#btn_new_head').on('click', function () {
        $(this).hide();
        $('.new-head-form').slideDown();
        return false;
    });

    var $new_head_form = $('.new-head-form');

    $new_head_form.find('.btn-close').on('click', function () {
        $('.new-head-form').slideUp(function () {
            $('#btn_new_head').show();
        });
        return false;
    });

    $new_head_form.find('.btn-add').on('click', function () {

        var $person = $new_head_form.find('#new_head_person').find('option:selected');
        var person_id = $person.val();

        var $job = $new_head_form.find('#new_head_job');
        if ($job.val().length === 0) {
            $job.addClass('error');
            return false;
        }

        $new_head_form.find('.row-buttons button').hide();
        $new_head_form.find('.loading').show();

        $.post('/organization/save_head', {
            job_id: 0,
            person_id: person_id,
            job_name: $job.val()
        }, function () {
            document.location = document.location.href;
        });

        return false;
    });
*/

    $('.department-content').
        on('click', '.department-header .icon-remove',function () {

            if (!confirm('Вы уверены что хотите удалить это поздразделение?')) {
                return false;
            }

            $.get('/departments/delete/' + $(this).parents('.department-item').data('id'));
            $(this).parents('.department-item[data-id=' + $(this).parents('.department-item').data('id') + ']').remove();

            return false;
        }).
        on('click', '.job-item > .icon-remove',function () {

            if (!confirm('Вы уверены что хотите удалить эту должность?')) {
                return false;
            }

            $.get('/jobs/delete/' + $(this).parents('.job-item').data('id'));
            $(this).parents('.job-item[data-id=' + $(this).parents('.job-item').data('id') + ']').remove();

            return false;
        });
});