<script>
    $(document).ready(function () {
        $('.close_win img').on('click', function () {
            $(this).parent().parent().addClass('win_hide');
            $('body').css('overflow', 'auto');
        });
        $('.close_win2 img').on('click', function () {
            $(this).parent().parent().parent().addClass('win_hide');
            $('body').css('overflow', 'auto');
        });
        $('body').on('click', '.openFullPage', function () {
            var page = $(this).data('page');
            $('#' + page + '-page').fadeIn(100).removeClass('win_hide').scrollTop(0);
            $('body').css('overflow', 'hidden');
            $('.logo').css('display', 'block'); // Логотип
        });
    });
</script>
