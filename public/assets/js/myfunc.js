var Currency = {
    rates: {"USD":1.0,"EUR":1.15993,"GBP":1.37197,"CAD":0.80791,"ARS":0.0100909,"AUD":0.741557,"BRL":0.183099,"CLP":0.00121398,"CNY":0.155381,"CYP":0.397899,"CZK":0.0456986,"DKK":0.155878,"EEK":0.0706676,"HKD":0.128571,"HUF":0.00322167,"ISK":0.00775752,"INR":0.0133185,"JMD":0.00670314,"JPY":0.00874635,"LVL":1.57329,"LTL":0.320236,"MTL":0.293496,"MXN":0.0491684,"NZD":0.70689,"NOK":0.118831,"PLN":0.253857,"SGD":0.741641,"SKK":21.5517,"SIT":175.439,"ZAR":0.0684941,"KRW":0.000843375,"SEK":0.115999,"CHF":1.08321,"TWD":0.0357126,"UYU":0.0227672,"MYR":0.240732,"BSD":1.0,"CRC":0.00158836,"RON":0.234378,"PHP":0.0197516,"AED":0.272294,"VEB":2.36027e-09,"IDR":7.08803e-05,"TRY":0.107852,"THB":0.0299187,"TTD":0.147233,"ILS":0.310391,"SYP":0.000795,"XCD":0.370286,"COP":0.000265796,"RUB":0.0141124,"HRK":0.154584,"KZT":0.00234907,"TZS":0.000432492,"XPT":1059.64,"SAR":0.266667,"NIO":0.0284492,"LAK":9.88773e-05,"OMR":2.60078,"AMD":0.00209022,"CDF":0.000503573,"KPW":0.00111111,"SPL":6.0,"KES":0.00901305,"ZWD":0.00276319,"KHR":0.000245732,"MVR":0.0640966,"GTQ":0.129319,"BZD":0.496209,"BYR":4.07332e-05,"LYD":0.219782,"DZD":0.00725309,"BIF":0.000502502,"GIP":1.37197,"BOB":0.144625,"XOF":0.00176831,"STD":4.72887e-05,"NGN":0.00243382,"PGK":0.28471,"ERN":0.0666667,"MWK":0.00122424,"CUP":0.04,"GMD":0.0192312,"CVE":0.010519,"BTN":0.0133185,"XAF":0.00176831,"UGX":0.000277178,"MAD":0.110421,"MNT":0.000350796,"LSL":0.0684941,"XAG":23.3628,"TOP":0.448596,"SHP":1.37197,"RSD":0.00986157,"HTG":0.00986492,"MGA":0.000253176,"MZN":0.0156988,"FKP":1.37197,"BWP":0.0888567,"HNL":0.0414928,"PYG":0.000144249,"JEP":1.37197,"EGP":0.0636401,"LBP":0.00066335,"ANG":0.55944,"WST":0.391498,"TVD":0.741557,"GYD":0.00476707,"GGP":1.37197,"NPR":0.00828524,"KMF":0.00235774,"IRR":2.37952e-05,"XPD":2076.62,"SRD":0.0467526,"TMM":5.72447e-05,"SZL":0.0684941,"MOP":0.124826,"BMD":1.0,"XPF":0.00972025,"ETB":0.0213985,"JOD":1.41044,"MDL":0.0579532,"MRO":0.00275624,"YER":0.00399683,"BAM":0.593065,"AWG":0.558659,"PEN":0.254238,"VEF":2.36027e-06,"SLL":9.4891e-05,"KYD":1.2195,"AOA":0.00167305,"TND":0.354167,"TJS":0.088538,"SCR":0.0672866,"LKR":0.0049785,"DJF":0.00561799,"GNF":0.000103064,"VUV":0.00905708,"SDG":0.00227752,"IMP":1.37197,"GEL":0.318807,"FJD":0.474943,"DOP":0.0177439,"XDR":1.41188,"MUR":0.0232099,"MMK":0.00054257,"LRD":0.00608777,"BBD":0.5,"ZMK":5.89334e-05,"XAU":1767.62,"VND":4.386e-05,"UAH":0.0377942,"TMT":0.286224,"IQD":0.000684965,"BGN":0.593065,"KGS":0.0117925,"RWF":0.000999926,"BHD":2.65957,"UZS":9.34143e-05,"PKR":0.00584399,"MKD":0.0188159,"AFN":0.012511,"NAD":0.0684941,"BDT":0.0116888,"AZN":0.588237,"SOS":0.0017138,"QAR":0.274725,"PAB":1.0,"CUC":1.0,"SVC":0.114286,"SBD":0.12415,"ALL":0.00954099,"BND":0.741641,"KWD":3.30754,"GHS":0.167023,"ZMW":0.0589334,"XBT":61109.4,"NTD":0.0337206,"BYN":0.407332,"CNH":0.155462,"MRU":0.0275624,"STN":0.0472887,"VES":0.236027,"MXV":0.326897,"VED":0.236027},
    convert: function(amount, from, to) {
      return (amount * this.rates[from]) / this.rates[to];
    }
  };
var idLoaded = 0,
    bodyComment = $('.modal-body.comments-post'),
    bodyCommentStars = $('.modal-body.comments-stars'),
    bodyPostStars = $('.modal-body.post-stars'),
    star = '.star',
    selected = '.selected';
    
$( document ).ready(function() {

    
    
    

});
$(".vote-comment").click(function(e){
    e.preventDefault();
    var vote = Number(bodyCommentStars.find('.vote-stars-comment').val());
    var comment_id = Number(bodyCommentStars.find('.id-comment').val());
    bodyCommentStars.next().find('.vote-comment').html('En votent..');
    if(vote == 0){
        alert("S'il vous plait choisissez une étoile!");
        return;
    }
    var data = $.ajaxPost('/vote-comment',{comment_id:comment_id,vote:vote});
    if(!$.isEmptyObject(data)){
        bodyCommentStars.next().find('.vote-comment').html('Voted');
        $(`#btn-vote-comment-${comment_id} .btn-voted`).html('Voted');
        setTimeout(function() {
            $( ".return-to-comment" ).trigger( "click" ); 
        },1000)
        
    }else{
        bodyCommentStars.next().find('.vote-comment').html('Voter');
        alert('Il y avait un problème!'); 
    }
        
});

$(".vote-post").click(function(e){
    e.preventDefault();
    var vote = Number(bodyPostStars.find('.vote-stars-post').val());
    var post_id = Number(bodyPostStars.find('.id-post').val());
    
    if(vote == 0){
        alert("S'il vous plait choisissez une étoile!");
        return;
    }
    bodyPostStars.next().find('.vote-post').html('En votent..');
    var data = $.ajaxPost('/vote-post',{post_id:post_id,vote:vote});
    if(!$.isEmptyObject(data)){
        bodyPostStars.next().find('.vote-post').html('Voted');
        $('#btn-vote-post-'+post_id+' .btn-voted').html('Voted');
        $( ".btn-close" ).trigger( "click" );
    }else{
        bodyPostStars.next().find('.vote-post').html('Voter');
        alert('Il y avait un problème!'); 
    }
    
});

function comments(post_id){
    bodyComment.html('<div class="loading-comments">En chargement...</div>');
    var data = $.ajaxGet('/post-comments',{post_id:post_id});
    if(data){
        putModalComments(data);
        $('.new-comment').val(post_id);
        $('textarea.new-comment').val("");
    }else{
        bodyComment.html('<div class="loading-comments">Il y avait un problème!</div>');
    }
}; 

var result;
function putModalComments (data) {
    
    var content = "";
    if($.isEmptyObject(data)){
        bodyComment.html('<div class="loading-comments">Il y avait un problème!</div>');
    }else{
        if(data[0].comments.length){
            for(i = 0;i < data[0].comments.length;i++){
                var comment = data[0].comments[i];
                content += rowComments(comment);
            }
        }else{
            content += "<div class='text-center'>Il n'y a pas de commentaires</div>";
        }
        bodyComment.html(content);
    }

}
function rowComments(comment){
    return '<div class="row d-flex justify-content-center">'+
                '<div class="card mb-3 w-75" id="comment-'+comment.id+'">'+
                    '<div class="card-body">'+
                    '<div class="row">'+
                    '<div class="col-2">'+
                        '<div class="img-profile" >'+
                            '<img src="'+comment.user.photo+'">'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-8">'+
                        '<h5 class="card-title name-profile" style="height:100%;"><a href="/profile/'+comment.user.username+'">'+comment.user.name+'</a></h5>'+
                    '</div>'+
                    (comment.is_commented ? 
                    '<div class="col-1 d-flex justify-content-end">'+
                        '<button type="button" class="btn" onclick="editComment('+comment.id+')" data-bs-target="#modaleditcomment" data-bs-toggle="modal"><i class="bi bi-pencil"></i></button>'+
                        '</div>' : 
                    '')+
                    (comment.is_commented ? 
                    '<div class="col-1 d-flex justify-content-end">'+
                        '<button type="button" class="btn" onclick="removeComment('+comment.id+')"><i class="bi bi-trash"></i></button>'+
                        '</div>' : 
                    '')+
                    '</div>'+
                        '<p class="card-text content">'+comment.content+'</p>'+
                        '<p class="card-text"><small class="text-muted">'+comment.cree_at+'</small></p>'+
                    '</div>'+
                    '<div class="card-body border-top" id="btn-vote-comment-'+comment.id+'">'+
                        '<button type="button" class="btn btn-primary btn-sm" onclick="starsComment('+comment.id+')" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">'+
                            '<span class="badge bg-secondary">'+comment.avg_votes+'</span>'+
                            '<span class="fa fa-star" style="'+(comment.avg_votes >= 1 ? 'color:orange' : '')+'"></span>'+
                            '<span class="fa fa-star" style="'+(comment.avg_votes >= 2 ? 'color:orange' : '')+'"></span>'+
                            '<span class="fa fa-star" style="'+(comment.avg_votes >= 3 ? 'color:orange' : '')+'"></span>'+
                            '<span class="fa fa-star" style="'+(comment.avg_votes >= 4 ? 'color:orange' : '')+'"></span>'+
                            '<span class="fa fa-star" style="'+(comment.avg_votes == 5 ? 'color:orange' : '')+'"></span> Votes'+ 
                            '<span class="badge bg-secondary">'+comment.likes_count+'</span>'+
                        '</button>'+
                        '<span class="btn-voted" style="color: gray;font-weight: bold;font-size: 12px;margin-left: 5px;">'+(comment.is_voted ? 'Voted' : '')+'</span>'+
                    '</div>'+
                '</div>'+
            '</div>';
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
function editComment(comment_id) {
    var bodyComment = $('#comment-'+comment_id);
    var content = bodyComment.find('.card-text.content').html();
    $('#modaleditcomment textarea#edit-comment').val(content);
    $('#modaleditcomment input.edit-comment').val(comment_id);   
}

$("form#new-post").on("submit",function(e){
    e.preventDefault();
    var posts = $('div.posts');
    var _token = $('meta[name="csrf-token"]').attr('content');
    var newContent = $('textarea.new-post').val();
    if(!newContent.trim().length){
        alert("Ecrivez vote publication!");
        return
    }
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
                $('button.new-post').html('Publier');
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
$("form#new-comment").on("submit",function(e){
    e.preventDefault();
    var _token = $('meta[name="csrf-token"]').attr('content');
    var newContent = $('textarea.new-comment').val();
    if(!newContent.trim().length){
        alert("Ecrivez vote commentaire!");
        return
    }
    var post_id = Number($("input.new-comment").val());
    $.ajax({
        url: '/new-comment',
        dataType : 'json',
        type:'post',
        headers: {'X-CSRF-TOKEN': _token},
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        beforeSend : function(){
            $('button.new-comment').html('En publiant..');
        },
        success: function(data) {
            console.log(data)
            if(data.success){
                comments(post_id);
                const numComments = $(`#post-${post_id}`).find('.badge.comment-count');
                numComments.html(Number(numComments.html()) + 1); 
                $('span.return-to-comment').trigger('click');
                $('button.new-comment').html('Publier');
            }else{
                $('button.new-comment').html('Publier');
                alert("Il y avait un problème!");
            }
        },
        error : function(data){
            console.log(data)
            alert("Il y avait un problème!");
        },

    });
});
$("form#edit-comment").on("submit",function(e){
    e.preventDefault();
    $('#modaleditcomment  button.edit-comment').attr('disabled','disabled').html('En modifiant..');
    var posts = $('div.posts');
    var _token = $('meta[name="csrf-token"]').attr('content');
    var newContent = $('#modaleditcomment textarea#edit-comment').val();
    var comment_id = $('#modaleditcomment input.edit-comment').val();
    var bodyComment = $('#comment-'+comment_id);
    
    if(!newContent.trim().length){
        alert("Ecrivez vote commentaire!");
        return
    }
    var data = $.ajaxPost('/edit-comment/'+comment_id,{content:newContent});
    if(data){
        bodyComment.find('.card-text.content').html(newContent);
        $('#modaleditcomment .return-to-comment').trigger('click');
    }else{
        alert("Il y avait un problème!");
    }
    $('#modaleditcomment button.edit-comment').removeAttr('disabled').html('Publier');
});
var offsetmoreNotification = 10;
function moreNotification(cette){
    $(cette).removeAttr('onclick').attr('disabled','disabled').html('<button class="btn btn-primary btn-sm">En chargement...</button>');
    var data = $.ajaxGet('/more-notification',{offset:offsetmoreNotification});
    var content = '';
    if(!$.isEmptyObject(data)){
        offsetmoreNotification += 10;
        $(cette).attr('onclick','moreNotification(this)').html('<button class="btn btn-primary btn-sm">Plus</button>');
        for (let i = 0; i < data.length; i++) {
            const element = data[i];
            content += '<div class="col-12 mb-3 p-4 border border-info rounded d-flex">'+
                            '<div class="col-1 me-1 img-profile"><img src="'+element.useraction.photo+'"></div>'+
                            '<div class="col-10"><a href="/profile/'+element.useraction.username+'"><b>'+element.useraction.name +'</b></a> '+element.action_value+'</div>'+
                            '<div class="col-1 d-flex justify-content-end" style="font-size: 12px;color: #64646a;">'+element.cree_at+'</div>'+
                        '</div>';
            }
        $('.row-notification').append(content);
    }else{
        $(cette).remove();
    }
        
}
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
    body.html('<div class="col-12 text-center">Loading...</div>');
    var data = $.ajaxGet('/following',{id:id});
    var content = "";
    if(!$.isEmptyObject(data)){
        for (var i = 0; i < data.length; i++) {
            content += '<div class="row pb-3"><div class="col-8 name-profile"><a href="/profile/'+data[i].user_following.username+'" class="">'+data[i].user_following.name+'</a></div>';
            content += '<div class="col-4 d-flex justify-content-end"><img src="'+data[i].user_following.photo+'" style="width:40px;height:40px;border-radius: 5px;"></div>';
            content += '</div>';
        }
        body.html(content);
    }else{
        body.html("<div class='col-12 text-center'>Il n'y a pas des abonnementes!</div>"); 
    }
        
}
function searche(){
    var body = $('.body-searche-user');
    body.html('<div class="d-100 text-center">Loading...</div>');
    var _token = $('meta[name="csrf-token"]').attr('content');
    var content = "";
    var data = $.ajaxGet('/searche',{searche : $('input.searche').val()});
    if(!$.isEmptyObject(data)){
        for (var i = 0; i < data.length; i++) {
            content += '<div class="row pb-3">';
            content += '<div class="col-8 name-profile"><a href="/profile/'+data[i].username+'" class="">'+data[i].name+'</a></div>';
            content += '<div class="col-4 d-flex justify-content-end"><img src="'+data[i].photo+'" style="width:40px;height:40px;border-radius: 5px;"></div>';
            content += '</div>';
        }
        body.html(content);
    }else{
        body.html("<div class='col-12 text-center'>N'existe pas aucun utilisateur avec ce nom!</div>"); 
    }
        
}
function followed(id){
    $('.modal-title.abonnes').html("Abonnées");
    var body = $('.modal-body.abonnes');
    body.html('<div class="col-12 text-center">Loading...</div>');
    var data = $.ajaxGet('/followed',{id:id});
    var content = "";
    if(!$.isEmptyObject(data)){
        for (var i = 0; i < data.length; i++) {
            content += '<div class="row pb-3"><div class="col-8 name-profile"><a href="/profile/'+data[i].user_followed.username+'" class="">'+data[i].user_followed.name+'</a></div>';
            content += '<div class="col-4 d-flex justify-content-end"><img src="'+data[i].user_followed.photo+'" style="width:40px;height:40px;border-radius: 5px;"></div>';
            content += '</div>';
        }
        body.html(content);
    }else{
        body.html("<div class='col-12 text-center'>Il n'y a pas des abonnées!</div>"); 
    }
}

function abonnement(id){
    $('.modal-title.abonnes').html("Abonnementes")
}

function follow(cette,id){
    var response = $.ajaxPost('/follow', {follow_id:id});
    if (response) {
        $(cette).attr('onclick',`unfollow(this,${id})`).html('Abonné'); 
            $('#followed').html(Number($('#followed').html()) + 1);
            if($('#btn-cancel-follow').length){
                $('#btn-cancel-follow').remove();
            }
    }else{
        alert('Il y avait un problème!'); 
    }
}
function unfollow(cette,id){
    if (confirm("Voules-vous vraiment retirer des abonnées!")) {
        var response = $.ajaxPost('/unfollow', {follow_id:id});
        if (response) {
            $(cette).attr('onclick',`follow(this,${id})`).html('Abonner');
            $('#followed').html(Number($('#followed').html()) - 1);
        }else{
            alert('Il y avait un problème!'); 
        }
    }
}
$.extend({
    ajaxGet: (url, data) => {
        var result = null;
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: url,
            type: 'GET',
            headers: { 'X-CSRF-TOKEN': _token },
            data: data,
            dataType: "json",
            async: false,
            success: function (data) {
                result = data;
            },
            error: function (data) {
                // result = data;
                console.log(data)
            },
        });
        return result;
    }
});
$.extend({
    ajaxPost: function(url, data) {
        var result = null;
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: url,
            type: 'POST',
            headers: {'X-CSRF-TOKEN': _token},
            data: data,
            // dataType: "json",
            async: false,
            success: function(data) {
                result = data;
            },
            error : function(data){
                // result = data;
                console.log(data)
            },
        });
        return result;
    }
});

// set ajax response in var

// function cncFoll(id){
//     var result = false;
//     var _token = $('meta[name="csrf-token"]').attr('content');
//     $.ajax({
//         url: '/cancelfollow',
//         dataType : 'json',
//         type:'post',
//         headers: {'X-CSRF-TOKEN': _token},
//         data:{follow_id:id},
//         success: function(data) {
//             console.log(data)
//             if(data){ result = true;}
//         },
//         error : function(data){
//             console.log(data)
//         },
//     });
//     return result;
    
// }

function cancelfollProf(id) {
    if (confirm("Voules-vous vraiment retirer des abonnées!")) {
        var response = $.ajaxPost('/unfollow', {follow_id:id});
        if (response) {
            $('#btn-back-follow').attr('onclick', `follow(${id})`).html('Abonner');
            $('#btn-cancel-follow').remove();
            $('#following').html(Number($('#following').html()) - 1);
        }else {
            alert('Il y avait un problème!');
        }
    }
}
function cancelfollowingReq(id) {
    if (confirm("Voules-vous vraiment retirer des abonnées!")) {
        var response = $.ajaxPost('/unfollow', {follow_id:id});
        console.log(response);
        if (response) {
            $(`#btn-${id} button`).attr('onclick', `sendFollowingReq(${id})`).html('Abonner');
        } else {
            alert('Il y avait un problème!');
        }
    }
}
function cancelfollowedReq(id) {
    if (confirm("Voules-vous vraiment retirer des abonnées!")) {
        var response = $.ajaxPost('/unfollow', {follow_id:id});
        console.log(response);
        if (response) {
            $(`#btn-${id} button#btn-cancel-follow`).attr('onclick', `sendFollowingReq(${id})`).html('Abonner');
            $(`#btn-${id} button#btn-back-follow`).remove();
        } else {
            alert('Il y avait un problème!');
        }
    }
}
function sendFollowingReq(id) {
    var response = $.ajaxPost('/follow',{follow_id:id});
    console.log(id);
    if (response) {
        $(`#btn-${id} button`).attr('onclick', `cancelfollowingReq(${id})`).html('Retirer');
    } else {
        alert('Il y avait un problème!');
    }
}
function acceptfollowedReq(id) {
    var response = $.ajaxPost('/follow',{follow_id:id});
    console.log(id);
    if (response) {
        const onclick = 'onclick';
        $(`#btn-${id} button#btn-back-follow`).addClass('pull-right').attr(onclick, `deletefollowed(${id})`).html('Abonné');
        $(`#btn-${id} button#btn-cancel-follow`).remove();
    } else {
        alert('Il y avait un problème!');
    }
}
function deletefollowed(id) {
    var response = $.ajaxPost('/unfollow',{follow_id:id});
    console.log(id);
    if (response) {
        const onclick = 'onclick';
        $(`#btn-${id} button`).attr(onclick, `sendFollowingReq(${id})`).html('Abonner');
    } else {
        alert('Il y avait un problème!');
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
            var bodyImg = $('.image-modal-post');
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