
function loadPage(pageNum) {
    $.ajax({
        url: '/comments/get',
        method: 'POST',
        data: { page: pageNum },
        datatype: 'json',
        success: function(data) {
            let result = jQuery.parseJSON( data );
            $(".comments__wrap").empty();

            $.each(result.items, function (index, item) {
                newComment = $("<div>").addClass("comments__body");
                newComment.append($("<div>").addClass("comment__body").text(item.body))
                            .append(
                                $("<div>").addClass("comment__autor")
                                .append('<span class="comment__name">'+item.name+'</span>' +
                                    '<span class="comment__mail">(<a href="mailto:'+item.email+'">'+item.email+'</a>)</span>' +
                                    '<span class="comment__date">'+item.dtime+'</span>')
                            );
                $(".comments__wrap").append(newComment);
            });

            pagination = $('<ul>').addClass("pagination justify-content-center");
            pagination.append($('<li>').addClass("page-item disabled").append("<span class='page-link'>Страницы:</span>"));
            for(i = 1; i <= result.pagesCount; i++) {
                isCurrent = (i===pageNum)?'active':'';
                paginationItemA = $('<a>').addClass("page-link").attr("href", "?page=" + i).attr("data-pagenum", i).text(i);
                paginationItemSpan = $('<span>').addClass("page-link").text(i);
                paginationItemEl = (i===pageNum)?paginationItemSpan:paginationItemA;
                paginationItem = $('<li>').addClass("page-item "+isCurrent).append(paginationItemEl);
                pagination.append(paginationItem);
            }
            $("#paginator").empty().append(pagination);
        },
        error: function (jqXHR, exception) {
            console.log(jqXHR);
        }
    });
}

$("#commentForm").submit(function(e) {
    e.preventDefault();
    form = $(this);
    let data = $('form').serializeArray();
    $.ajax({
        type: "POST",
        url: '/comments/store',
        data: data,
        success: function(data)
        {
            console.log(data);
            if (data === 'empty_param') {
                alert('Одно из полей не заполнено или заполнено неверно!');
            } else if (data === 'novalid_email') {
                alert('Поле email заполнено неверно!');
            } else if (data === 'ok') {
                form[0].reset();
                loadPage(1);
            } else {
                alert('Произошла ошибка. Попробуйте позже.');
            }
        }
    });
});

$("#paginator").on('click', 'a.page-link', function (e) {
    e.preventDefault();
    pageNum = $(this).data("pagenum");
    loadPage( pageNum );
});