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

    $('.post-comment').click(function() {
        var postId = $(this).data('post-id');
        var content = $(this).siblings('.comment-input').val();

        if (content.trim() === '') {
            alert('Le commentaire ne peut pas être vide.');
            return;
        }

        $.ajax({
            url: 'traitement_comment.php',
            type: 'POST',
            data: {
                post_id: postId,
                content: content
            },
            success: function(response) {
                var data = JSON.parse(response);
                if (data.status === 'success') {
                    var comment = data.comment;
                    var commentHtml = '<div class="comment">' +
                        '<div class="avatar"></div>' +
                        '<div class="text">' +
                        '<p><strong>' + comment.username + '</strong> ' + comment.content + '</p>' +
                        '<small>' + comment.date + '</small>' +
                        '</div>' +
                        '</div>';
                    $('.comment-section[data-post-id="' + postId + '"] .comments-container').append(commentHtml);
                    $('.comment-input[data-post-id="' + postId + '"]').val('');
                } else {
                    alert('Erreur lors de l\'ajout du commentaire.');
                }
            },
            error: function() {
                alert('Erreur lors de l\'ajout du commentaire.');
            }
        });
    });

    $('.comment-section').each(function() {
        var userId = $(this).data('user-id'); // Récupérer l'identifiant de l'utilisateur associé à ce post
        var $profilePicture = $(this).find('.profile-picture'); // Sélectionner l'élément .profile-picture à l'intérieur de cette section de commentaire

        // Effectuer une requête AJAX pour récupérer la photo de profil de l'utilisateur
        $.ajax({
            url: 'traitement_comment.php',
            type: 'GET',
            data: { user_id: userId }, // Envoyer l'identifiant de l'utilisateur à la requête AJAX
            success: function(response) {
                // Mettre à jour dynamiquement la photo de profil avec l'URL récupérée
                $profilePicture.attr('src', response);
            },
            error: function() {
                console.error('Erreur lors de la récupération de la photo de profil.');
            }
        });
    });
    
});
