$(document).ready(function() {
    $('.like, .dislike').click(function() {
        var postId = $(this).data('post-id');
        var type = $(this).hasClass('like') ? 'like' : 'dislike';
        var $likeCount = $(this).siblings('.like-count');
        var $dislikeCount = $(this).siblings('.dislike-count');

        $.ajax({
            url: 'traitement_like.php',
            type: 'POST',
            data: {
                post_id: postId,
                type: type
            },
            success: function(response) {
                var data = JSON.parse(response);
                if (data.status === 'success') {
                    $likeCount.text(data.likes);
                    $dislikeCount.text(data.dislikes);
                }
            },
            error: function() {
                alert('Erreur lors de la mise à jour du like/dislike.');
            }
        });
    });
});