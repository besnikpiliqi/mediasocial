
var idLoaded = 0,
    bodyComment = $('.modal-body.comments-post'),
    bodyCommentStars = $('.modal-body.comments-stars'),
    bodyPostStars = $('.modal-body.post-stars'),
    star = '.star',
    selected = '.selected';
    
$( document ).ready(function() {

    
    
    // $('.star').on('click', function(){
    //     $('.selected').each(function(){
    //         $(this).removeClass('selected');
    //     });
    //     var stars = $(this).attr('data-star');

    //     if($(this).parent().parent().hasClass('vote-comment')){
    //         bodyCommentStars.find('input.vote-stars-comment').val(stars);
    //     }else{
    //         bodyPostStars.find('input.vote-stars-post').val(stars);
    //     }
    //     $(this).addClass('selected');
    // });

    
    $(".vote-comment").click(function(e){
        e.preventDefault();
        var vote = Number(bodyCommentStars.find('.vote-stars-comment').val());
        var comment_id = Number(bodyCommentStars.find('.id-comment').val());
        
        if(vote == 0){
            alert("S'il vous plait choisissez une étoile!");
            return;
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/vote-comment',
            dataType : 'json',
            type:'post',
            data:{comment_id:comment_id,vote:vote},
            beforeSend : function(){
                bodyCommentStars.next().find('.vote-comment').html('En votent..');
            },
            success: function(data) {
                console.log(data)
                if(data.user_id){
                    bodyCommentStars.next().find('.vote-comment').html('Voted');
                    $('#btn-vote-comment-'+comment_id+' .btn-voted').html('Voted');
                    setTimeout(function() {
                       $( ".return-to-comment" ).trigger( "click" ); 
                    },1000)
                    
                }else{
                    bodyCommentStars.next().find('.vote-comment').html('Voter');
                    alert('Il y avait un problème!'); 
                }
            },
            error : function(data){
                console.log(data)
                bodyCommentStars.next().find('.vote-comment').html('Voter');
                alert('Il y avait un problème!');
            },

        });
    });
    
    $(".vote-post").click(function(e){
        e.preventDefault();
        var vote = Number(bodyPostStars.find('.vote-stars-post').val());
        var post_id = Number(bodyPostStars.find('.id-post').val());
        
        if(vote == 0){
            alert("S'il vous plait choisissez une étoile!");
            return;
        }
        console.log(vote)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/vote-post',
            dataType : 'json',
            type:'post',
            data:{post_id:post_id,vote:vote},
            beforeSend : function(){
                bodyPostStars.next().find('.vote-post').html('En votent..');
            },
            success: function(data) {
                if(data.post_id){
                    bodyPostStars.next().find('.vote-post').html('Voted');
                    $('#btn-vote-post-'+post_id+' .btn-voted').html('Voted');
                    $( ".btn-close" ).trigger( "click" );
                }else{
                    bodyPostStars.next().find('.vote-post').html('Voter');
                    alert('Il y avait un problème!'); 
                }
            },
            error : function(data){
                console.log(data)
                bodyPostStars.next().find('.vote-post').html('Voter');
                alert('Il y avait un problème!');
            },

        });
        
    });

});

function comments(post_id){
    var _token = $('meta[name="csrf-token"]').attr('content');
    if(idLoaded == post_id){
        return;
    }
    idLoaded = post_id;
    $.ajax({
        url: '/post-comments',
        dataType : 'json',
        type:'get',
        headers: {'X-CSRF-TOKEN': _token},
        data: {post_id:post_id},
        beforeSend : function(){
            bodyComment.html('<div class="loading-comments">Loading...</div>');
        },
        success: function(data) {
            putModalComments(data);
        },
        error : function(data){
            bodyComment.html('<div class="loading-comments">Il y avait un problème!</div>');
        },
    });
}; 


function putModalComments (data) {
    
    var content = "";
    if($.isEmptyObject(data)){
        bodyComment.html('<div class="loading-comments">Il y avait un problème!</div>');
    }else{
        if(data.comments.length){
            for(i = 0;i < data.comments.length;i++){
                var comment = data.comments[i];
                var avgLikes = avgComment(comment.likes);
                content += '<div class="row d-flex justify-content-center">'+
                '<div class="card mb-3 w-75" id="comment-'+comment.id+'">'+
                    '<div class="card-body">'+
                    '<div class="row">'+
                    '<div class="col-2">'+
                        '<div class="img-profile" >'+
                            '<img src="'+comment.user.photo+'">'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-7">'+
                        '<h5 class="card-title name-profile" style="height:100%;"><a href="/profile/'+comment.user.id+'">'+comment.user.name+'</a></h5>'+
                    '</div>'+
                    (comment.user.id == user.id ? 
                    '<div class="col-3">'+
                        '<button type="button" class="btn" onclick="removeComment('+comment.id+')"><i class="bi bi-trash"></i></button>'+
                        '</div>' : 
                    '')+
                    '</div>'+
                        '<p class="card-text">'+comment.content+'</p>'+
                        '<p class="card-text"><small class="text-muted">'+comment.cree_at+'</small></p>'+
                    '</div>'+
                    '<div class="card-body border-top" id="btn-vote-comment-'+comment.id+'">'+
                        '<button type="button" class="btn btn-primary btn-sm" onclick="starsComment('+comment.id+')" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">'+
                            '<span class="badge bg-secondary">'+avgLikes+'</span>'+
                            '<span class="fa fa-star" style="'+(avgLikes >= 1 ? 'color:orange' : '')+'"></span>'+
                            '<span class="fa fa-star" style="'+(avgLikes >= 2 ? 'color:orange' : '')+'"></span>'+
                            '<span class="fa fa-star" style="'+(avgLikes >= 3 ? 'color:orange' : '')+'"></span>'+
                            '<span class="fa fa-star" style="'+(avgLikes >= 4 ? 'color:orange' : '')+'"></span>'+
                            '<span class="fa fa-star" style="'+(avgLikes == 5 ? 'color:orange' : '')+'"></span> Votes'+ 
                            '<span class="badge bg-secondary">'+comment.likes_count+'</span>'+
                        '</button>'+
                        '<span class="btn-voted" style="color: gray;font-weight: bold;font-size: 12px;margin-left: 5px;">'+(checkIfVoted(comment.likes) ? 'Voted' : '')+'</span>'+
                    '</div>'+
                '</div>'+
            '</div>';
            }
        }else{
            content += "<div class='text-center'>Il n'y a pas de commentaires</div>";
        }
        bodyComment.html(content);
    }

}
function checkIfVoted(likes) {
    for (let i = 0; i < likes.length; i++) {
        if(likes[i].user_id == user.id){
            return true;
        }
        
    }
    return false;
}
function stars(cette){
    $('.selected').removeClass('selected');
    
        var stars = $(cette).attr('data-star');

        if($(cette).parent().parent().hasClass('comments-stars')){
            bodyCommentStars.find('input.vote-stars-comment').val(stars);
        }else{
            bodyPostStars.find('input.vote-stars-post').val(stars);
        }
        $(cette).addClass('selected');
    
}
function editPost(post_id) {
    var bodyPost = $('#post-'+post_id);
    var content =  bodyPost.find('.card-text.content').html();
    var imgPost = bodyPost.find('.card-body.photo-post');
    $('#modalmodifiercomment .post-edit-id').val(post_id);
    $('input.edit-post').val('');
    $('.image-modal-post').addClass('d-none').find("src",'');
    if(!imgPost.hasClass('d-none')){
        $('.image-modal-post').removeClass("d-none").find('img').attr('src',imgPost.find('img').attr('src'));
        $('label.edit-post').parent().removeClass("col-md-12").addClass('col-md-9');
        $('label.edit-post').html('Modifier');
    }else{
        $('.image-modal-post').addClass("d-none").find('img').attr('src','');
        $('label.edit-post').parent().removeClass("col-md-9").addClass('col-md-12');
        $('label.edit-post').html('Ajouter une photo?');
    }
    $('textarea.edit-post').val(content);
    
}
$("form#new-post").on("submit",function(e){
    e.preventDefault();
    var posts = $('div.posts');
    // var bodyPost = $('#post-'+post_id);
    // var contentPost =  bodyPost.find('.card-text.content');
    // var imgPost = bodyPost.find('.card-body.photo-post');
    // var imgPostEdited = $('.image-modal-post img');
    var _token = $('meta[name="csrf-token"]').attr('content');
    // var newContent = $('textarea.edit-post').val();
   
    $.ajax({
        url: '/new-post',
        dataType : 'json',
        type:'post',
        headers: {'X-CSRF-TOKEN': _token},
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        beforeSend : function(){
            $('button.new-post').html('En publiant..');
        },
        success: function(data) {
            console.log(data)
            if(data.success){
                // contentPost.html(newContent)
                // imgPost.find('img').attr('src',imgPostEdited.attr('src'));
                $('button.btn-close').trigger('click');
            }else{
                alert("Il y avait un problème!");
            }
        },
        error : function(data){
            console.log(data)
            alert("Il y avait un problème!");
        },

    });
});
$("form#edit-post").on("submit",function(e){
    e.preventDefault();
    var post_id = $('#modalmodifiercomment').find('.post-edit-id').val();
    var bodyPost = $('#post-'+post_id);
    var contentPost =  bodyPost.find('.card-text.content');
    var imgPost = bodyPost.find('.card-body.photo-post');
    var imgPostEdited = $('.image-modal-post img');
    var _token = $('meta[name="csrf-token"]').attr('content');
    var newContent = $('textarea.edit-post').val();
   
    $.ajax({
        url: '/edit-post/'+post_id,
        dataType : 'json',
        type:'post',
        headers: {'X-CSRF-TOKEN': _token},
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        beforeSend : function(){
            $('button.update-post').html('En modifiant..');
        },
        success: function(data) {
            console.log(data)
            if(data.success){
                contentPost.html(newContent)
                imgPost.find('img').attr('src',imgPostEdited.attr('src'));
                $('button.btn-close').trigger('click');
            }else{
                alert("Il y avait un problème!");
            }
        },
        error : function(data){
            console.log(data)
            alert("Il y avait un problème!");
        },

    });
});
function removePost(id){
    if(confirm("Voulez-vous supprimer ?")){
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/delete-post/'+id,
            dataType : 'json',
            type:'post',
            headers: {'X-CSRF-TOKEN': _token},
            beforeSend : function(){

            },
            success: function(data) {
                console.log(data)
                if(data.success){
                    $('#post-'+id).fadeOut(500,function(){
                        $(this).delete();
                        // alert("Votre commantaire a été bien supprimé");
                    })
                }else{
                    alert("Il y avait un problème!");
                }
            },
            error : function(data){
                console.log(data)
                alert("Il y avait un problème!");
            },

        });
    }
}
function removeComment(id){
    if(confirm("Voulez-vous supprimer ?")){
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/delete-comment/'+id,
            dataType : 'json',
            type:'post',
            headers: {'X-CSRF-TOKEN': _token},
            beforeSend : function(){

            },
            success: function(data) {
                console.log(data)
                if(data.success){
                    $('#comment-'+id).fadeOut(500,function(){
                        $(this).delete();
                        // alert("Votre commantaire a été bien supprimé");
                    })
                }else{
                    alert("Il y avait un problème!");
                }
            },
            error : function(data){
                console.log(data)
                alert("Il y avait un problème!");
            },

        });
    }
}

function following(id){
    $('.modal-title.abonnes').html("Abonnementes");
    var body = $('.modal-body.abonnes');
    var _token = $('meta[name="csrf-token"]').attr('content');
    var content = "";
    $.ajax({
        url: '/following/'+id,
        dataType : 'json',
        type:'get',
        headers: {'X-CSRF-TOKEN': _token},
        beforeSend : function(){
            body.html('<div class="col-12 text-center">Loading...</div>');
        },
        success: function(data) {
            if(data.length){
                for (var i = 0; i < data.length; i++) {
                    // var if_follow = (data[i].user_id == user.id ?? true); // this is to know if this user i have make follow or not
                    content += '<div class="row pb-3"><div class="col-8 name-profile"><a href="/profile/'+data[i].follow_id+'" class="">'+data[i].user_following.name+'</a></div>';
                    content += '<div class="col-4 d-flex justify-content-end"><img src="'+data[i].user_following.photo+'" style="width:40px;height:40px;border-radius: 5px;"></div>';
                    // if(if_follow){
                    //     content += '<div class="col-4 d-flex justify-content-end"><button type="button" class="btn btn-primary btn-sm" onclick="unfollow(this,'+data[i].follow_id+')">Abonné</button></div>';
                    // }else{
                    //     content += '<div class="col-4 d-flex justify-content-end"><button type="button" class="btn btn-primary btn-sm" onclick="follow(this,'+data[i].follow_id+')">Abonner</button></div>';
                    // }
                    content += '</div>';
                }
                body.html(content);
            }else{
                body.html("<div class='col-12 text-center'>Il n'y a pas des abonnementes!</div>"); 
            }
        },
        error : function(data){
            body.html('<div class="col-12 text-center">Il y avait un problème!</div>');
        },

    });
}

function followed(id){
    $('.modal-title.abonnes').html("Abonnées");
    var body = $('.modal-body.abonnes');
    var _token = $('meta[name="csrf-token"]').attr('content');
    var content = "";
    $.ajax({
        url: '/followed/'+id,
        dataType : 'json',
        type:'get',
        headers: {'X-CSRF-TOKEN': _token},
        beforeSend : function(){
            body.html('<div class="col-12 text-center">Loading...</div>');
        },
        success: function(data) {
            if(data.length){
                for (var i = 0; i < data.length; i++) {
                    // var if_follow = (data[i].follow_id == user.id ?? true); // this is to know if this user i have make follow or not
                    content += '<div class="row pb-3"><div class="col-8 name-profile"><a href="/profile/'+data[i].user_id+'" class="">'+data[i].user_followed.name+'</a></div>';
                    content += '<div class="col-4 d-flex justify-content-end"><img src="'+data[i].user_followed.photo+'" style="width:40px;height:40px;border-radius: 5px;"></div>';
                    // if(if_follow){
                    //     content += '<div class="col-4 d-flex justify-content-end"><button type="button" class="btn btn-primary btn-sm" onclick="unfollow(this,'+data[i].user_id+')">Abonné</button></div>';
                    // }else{
                    //     // content += '<div class="col-4 d-flex justify-content-end"><button type="button" class="btn btn-primary btn-sm" onclick="follow(this,'+data[i].user_id+')">Abonner</button></div>';
                        
                    // }
                    content += '</div>';
                }
                body.html(content);
            }else{
                body.html("<div class='col-12 text-center'>Il n'y a pas des abonnées!</div>"); 
            }
        },
        error : function(data){
            body.html('<div class="col-12 text-center">Il y avait un problème!</div>');
        },

    });
}

function abonnement(id){
    $('.modal-title.abonnes').html("Abonnementes")
}

function follow(cette,id){
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/follow',
        dataType : 'json',
        type:'post',
        data: {follow_id : id},
        success: function(data) {
            console.log(data)
            if(data.success){
                $(cette).attr('onclick',"unfollow(this,"+id+")").html('Abonné');
                $('#followed').html(Number($('#followed').html()) + 1);
                if($('#btn-cancel-follow').length){
                    $('#btn-cancel-follow').remove();
                }
            }else{
                alert('Il y avait un problème!'); 
            }
        },
        error : function(data){
            alert('Il y avait un problème!');
        },

    });
}
function unfollow(cette,id){
    if(confirm("Voulez-vous vraiment vous desabonner!")){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/unfollow',
            dataType : 'json',
            type:'post',
            data:{follow_id:id},
            success: function(data) {
                console.log(data)
                if(data.success){
                    $(cette).attr('onclick',"follow(this,"+id+")").html('Abonner');
                    $('#followed').html(Number($('#followed').html()) - 1);
                }else{
                    alert('Il y avait un problème!'); 
                }
            },
            error : function(data){
                alert('Il y avait un problème!');
            },

        });
    }
}

function cancelfollow(id){
    if(confirm("Voules-vous vraiment retirer des abonnées!")){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/cancelfollow',
            dataType : 'json',
            type:'post',
            data:{follow_id:id},
            success: function(data) {
                console.log(data)
                if(data.success){
                    $('#btn-back-follow').attr('onclick',"follow("+id+")").html('Abonner');
                    $('#btn-cancel-follow').remove();
                    $('#following').html(Number($('#following').html()) - 1);
                }else{
                    alert('Il y avait un problème!'); 
                }
            },
            error : function(data){
                alert('Il y avait un problème!');
            },

        });
    }
}

function avgComment(likes){
    var stars = 0;
    for (var i = 0; i < likes.length; i++) {
        stars = stars + likes[i].stars;
    }
    var stars = stars > 0 ? stars/likes.length : 0; 
    return stars.toFixed();
}

function starsPost(post_id){
    bodyPostStars.find('.id-post').val(post_id);
    bodyPostStars.find('.vote-stars-post').val(0);
    bodyPostStars.find('ul.ratings li.star').removeClass('selected');
    bodyPostStars.next().find('.vote-post').html('Voter');
    var bodyVote = $(".modal-body.post-stars");
    $.ajax({
        url: '/check-vote-post/'+post_id,
        dataType : 'json',
        type:'get',
        data:{post_id:post_id},
        success: function(data) {
            console.log(data.stars)
            if(!$.isEmptyObject(data)){
                var content = '<input type="hidden" name="vote-post" value="'+data.stars+'" class="vote-stars-post">'+
                                '<input type="hidden" name="id-post" value="'+post_id+'" class="id-post"></input>'+
                                '<ul class="ratings">'+
                                    '<li class="star '+(data.stars == 5 ? 'selected': '')+'" onclick="stars(this)" data-star="5"></li>'+
                                    '<li class="star '+(data.stars == 4 ? 'selected': '')+'" onclick="stars(this)" data-star="4"></li>'+
                                    '<li class="star '+(data.stars == 3 ? 'selected': '')+'" onclick="stars(this)" data-star="3"></li>'+
                                    '<li class="star '+(data.stars == 2 ? 'selected': '')+'" onclick="stars(this)" data-star="2"></li>'+
                                    '<li class="star '+(data.stars == 1 ? 'selected': '')+'" onclick="stars(this)" data-star="1"></li>'+
                                '</ul>';
                            
                bodyVote.html(content);
                bodyPostStars.next().find('.vote-post').html('Voted');
            }
        },
        error : function(data){
            alert('Il y avait un problème!');
        },

    });

    
    console.log(post_id)
}

function starsComment(comment_id){
    bodyCommentStars.find('.id-comment').val(comment_id);
    bodyCommentStars.find('.vote-stars-comment').val(0);
    bodyCommentStars.find('ul.ratings li.star').removeClass('selected');

    bodyCommentStars.next().find('.vote-comment').html('Voter');
    var bodyVoteComment = $(".modal-body.comments-stars");
    $.ajax({
        url: '/check-vote-comment/'+comment_id,
        dataType : 'json',
        type:'get',
        data:{comment_id:comment_id},
        success: function(data) {
            console.log(data.stars)
            if(!$.isEmptyObject(data)){
                var content =   '<input type="hidden" name="vote-comment" value="'+data.stars+'" class="vote-stars-comment">'+
                                '<input type="hidden" name="id-comment" value="'+data.comment_id+'" class="id-comment"></input>'+
                                '<input type="hidden" name="id-id" value="'+data.post_id+'" class="id-post"></input>'+
                                '<ul class="ratings">'+
                                    '<li class="star '+(data.stars == 5 ? 'selected': '')+'" onclick="stars(this)" data-star="5"></li>'+
                                    '<li class="star '+(data.stars == 4 ? 'selected': '')+'" onclick="stars(this)" data-star="4"></li>'+
                                    '<li class="star '+(data.stars == 3 ? 'selected': '')+'" onclick="stars(this)" data-star="3"></li>'+
                                    '<li class="star '+(data.stars == 2 ? 'selected': '')+'" onclick="stars(this)" data-star="2"></li>'+
                                    '<li class="star '+(data.stars == 1 ? 'selected': '')+'" onclick="stars(this)" data-star="1"></li>'+
                                '</ul>';
                            
                bodyVoteComment.html(content);
                bodyCommentStars.next().find('.vote-comment').html('Voted');
            }
        },
        error : function(data){
            alert('Il y avait un problème!');
        },

    });
    console.log(comment_id)
}
$("select.form-select.country").change(getCity);
function getCity(e){
    console.log(e.target.value)
    var citys = $('select.form-select.city');
    var content = '<option value="">Sélectez une ville</option>';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/get-citys',
        dataType : 'json',
        type:'get',
        data:{id:Number(e.target.value)},
        success: function(data) {
            console.log(data.citys)
            if(!$.isEmptyObject(data)){
                for (let i = 0; i < data.citys.length; i++) {
                    content += '<option value="'+data.citys[i].id+'">'+data.citys[i].city+'</option>';
                    
                }
                citys.html(content);
            }else{
                alert('Il y avait un problème!');
            }
        },
        error : function(data){
            alert('Il y avait un problème!');
        },

    });

}

$("#file-post").change(showImgage);
$("#file-edit-profile").change(showImgage);
function showImgage(e) {
    if (window.File && window.FileList && window.FileReader) {
        var $input = $(this);
        var inputFiles = this.files;
        if(inputFiles == undefined || inputFiles.length == 0) return;
        var inputFile = inputFiles[0];
        var reader = new FileReader();
        reader.onload = function(event) {
            var bodyImg = $('.image-post');
            bodyImg.find('img').attr("src", event.target.result);
            if(bodyImg.hasClass('d-none')){
                bodyImg.removeClass('d-none');
                bodyImg.next().removeClass('col-sm-12 col-md-12').addClass('col-sm-9 col-md-9');
            }
        };
        reader.onerror = function(event) {
            alert("ERROR: " + event.target.error.code);
        };
        reader.readAsDataURL(inputFile);
    }else{
        alert("Votre navigateur ne support pas");
    }
}