<!-- Modal abonnés-->
<div class="modal fade" id="modalabonnes" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelabonnes" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title abonnes" id="staticBackdropLabelabonnes">{{ __('Abonnées') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body abonnes">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary abonnes" data-bs-dismiss="modal">{{ __('Fermer') }}</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal post étoiles-->
<div class="modal fade" id="modaletoilespost" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">{{ __('Votez le post') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body post-stars d-flex justify-content-center">
          <input type="hidden" name="vote-post" value="0" class="vote-stars-post">
          <input type="hidden" name="id-post" value="" class="id-post">
          <ul class="ratings">
            <li class="star" onclick="stars(this)" data-star="5"></li>
            <li class="star" onclick="stars(this)" data-star="4"></li>
            <li class="star" onclick="stars(this)" data-star="3"></li>
            <li class="star" onclick="stars(this)" data-star="2"></li>
            <li class="star" onclick="stars(this)" data-star="1"></li>
          </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary vote-post">{{ __('Voter') }}</button>
      </div>
      
    </div>
  </div>
</div>

<!-- Modal post comment-->
<div class="modal fade" id="modalmakecomment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">{{ __('Créér un post')}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      {!! Form::open(['url'=>'new-post','class'=>'form-inline','id'=>'new-post']) !!}
      <div class="modal-body">
        <div class="mb-3">
          <label for="exampleFormControlTextareaModifier" class="form-label">{{ __('Entrer votre post')}}</label>
          <textarea name="content" class="form-control new-post" id="exampleFormControlTextareaModifier" pattern="[A-Za-z0-9]{1,255}" required rows="3" placeholder="{{ __('Ecrivez votre message') }}"> Ceci est un message exemple!</textarea>
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="col-sm-3 col-md-3 image-modal-post d-none">
                    <img src="" class="rounded w-100">
                </div>
                <div class="col-sm-12 col-md-12">
                    <label class="input-group-text new-post" for="file-post">{{ __('Choisir une photo. Optionelle!') }}</label>
                    <input type="file" class="form-control new-post" name="file" id="file-post">
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Annuler')}}</button>
        <button type="submit" class="btn btn-primary new-post">{{ __('Publier') }}</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

<!-- Modal commentes-->

<div class="modal fade" id="modalcommentes" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalToggleLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title d-flex justify-content-between" id="staticBackdropLabel">
          <h5>Commentaires</h5>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body comments-post">
        
        
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary"  data-bs-dismiss="modal" aria-label="Close">{{ __('Fermer')}}</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModalToggle2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalToggleLabel2" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel2">{{ __('Votez le commantaire') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body comments-stars d-flex justify-content-center">
          <input type="hidden" name="vote-comment" value="0" class="vote-stars-comment">
          <input type="hidden" name="id-comment" value="" class="id-comment">
          <ul class="ratings">
            <li class="star" onclick="stars(this)" data-star="5"></li>
            <li class="star" onclick="stars(this)" data-star="4"></li>
            <li class="star" onclick="stars(this)" data-star="3"></li>
            <li class="star" onclick="stars(this)" data-star="2"></li>
            <li class="star" onclick="stars(this)" data-star="1"></li>
          </ul>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary return-to-comment" data-bs-target="#modalcommentes" data-bs-toggle="modal">{{ __('Retourner aux commentaires')}}</button>
        <button type="button" class="btn btn-primary vote-comment">{{ __('Voter') }}</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal post modifier-->
<div class="modal fade" id="modalmodifiercomment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelmodifier" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabelmodifier">{{ __('Modifier votre post')}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      {!! Form::open(['url'=>'edit-post','class'=>'form-inline','id'=>'edit-post']) !!}
      <div class="modal-body">
        <div class="mb-3">
          <label for="exampleFormControlTextareaModifier" class="form-label">{{ __('Entrer votre post')}}</label>
          <textarea name="content" class="form-control edit-post" id="exampleFormControlTextareaModifier" pattern="[A-Za-z0-9]{1,255}" required rows="3" placeholder="{{ __('Ecrivez votre message') }}"> Ceci est un message exemple!</textarea>
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="col-sm-3 col-md-3 image-modal-post d-none">
                    <img src="" class="rounded w-100">
                </div>
                <div class="col-sm-9 col-md-9">
                    <label class="input-group-text edit-post" for="file-post">Modifier</label>
                    <input type="file" class="form-control edit-post" name="file" id="file-post" accept="image/gif" title="dfdf">
                </div>
            </div>
        </div>
      </div>
      <input type="hidden" name="post_id" value="" class="post-edit-id">
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Annuler')}}</button>
        <button type="submit" class="btn btn-primary update-post">{{ __('Modifier') }}</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>