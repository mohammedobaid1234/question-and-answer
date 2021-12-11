(function($){
    console.log('object');
    $('.votes').on('submit', function(e){
        e.preventDefault();
        $.post($(this).attr('action'), $(this).serialize(),
        function (data){
            // console.log(data);
             vote = Number($('.mainVote').text());
            $('.mainVote').text(`${data.votes}`);
        });
    });
})(jQuery);