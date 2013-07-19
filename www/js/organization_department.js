jQuery(function ($) {



    $('.department-content').
        on('click', '.department-item > .icon-remove',function () {

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