
   <!--  <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Insira seu CEP</h4>
                </div>
                <div class="modal-body">
                    <form class="contact" name="contact">
                        <label class="label" for="name">Your Name</label><br>
                        <input type="text" name="name" class="input-xlarge" placeholder="Digite aqui seu CEP"><br>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Buscar Restaurantes</button>
                </div>
            </div>
        </div>
    </div> -->

<!--     <div id="form-content" class="modal hide fade in" style="display: none;">
        <div class="modal-header">
            <a class="close" data-dismiss="modal">×</a>
            <h3>Send me a message</h3>
        </div>
        <div class="modal-body">
            <form class="contact" name="contact">
                <label class="label" for="name">Your Name</label><br>
                <input type="text" name="name" class="input-xlarge"><br>
                <label class="label" for="email">Your E-mail</label><br>
                <input type="email" name="email" class="input-xlarge"><br>
                <label class="label" for="message">Enter a Message</label><br>
                <textarea name="message" class="input-xlarge"></textarea>
            </form>
        </div>
        <div class="modal-footer">
            <input class="btn btn-success" type="submit" value="Send!" id="submit">
            <a href="#" class="btn" data-dismiss="modal">Nah.</a>
        </div>
    </div>
    <div id="thanks"><p><a data-toggle="modal" href="#form-content" class="btn btn-primary btn-large">Modal powers, activate!</a></p></div> -->

<!--     @if(count($articles)>0)
        <div class="row">
            <h2>News</h2>
            @foreach ($articles as $post)
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>
                                <strong><a href="{{URL::to('news/'.$post->id.'')}}">{!!
                                        $post->title !!}</a></strong>
                            </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <a href="{{URL::to('news/'.$post->id.'')}}" class="thumbnail"><img
                                        src="http://placehold.it/260x180" alt=""></a>
                        </div>
                        <div class="col-md-10">
                            <p>{!! $post->introduction !!}</p>

                            <p>
                                <a class="btn btn-mini btn-default"
                                   href="{{URL::to('news/'.$post->id.'')}}">Leia Mais</a>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p></p>

                            <p>
                                <span class="glyphicon glyphicon-user"></span> by <span
                                        class="muted">{!! $post->author->name !!}</span> | <span
                                        class="glyphicon glyphicon-calendar"></span> {!! $post->created_at !!}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if(count($photoAlbums)>0)
        <div class="row">
            <h2>Photos</h2>
            @foreach($photoAlbums as $item)
                <div class="col-sm-3">
                    <div class="row">
                        <a href="{{URL::to('photo/'.$item->id.'')}}"
                           class="hover-effect"> @if($item->album_image!="")
                                <img class="col-sm-12"
                                        src="{!!'appfiles/photoalbum/'.$item->folder_id.'/thumbs/'.$item->album_image !!}">
                            @elseif($item->album_image_first!="")
                                <img class="col-sm-12"
                                     src="{!!'appfiles/photoalbum/'.$item->folder_id.'/thumbs/'.$item->album_image_first !!}">
                            @else
                                <img class="col-sm-12" src="{!!'img/default-image.jpg' !!}">
                            @endif
                        </a>

                        <div class=" col-sm-12">{!!$item->name!!}</div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if(count($videoAlbums)>0)
        <div class="row">
            <h2>Videos</h2>
            @foreach($videoAlbums as $item)
                <div class="col-sm-3">
                    <div class="row">
                        <a href="{{URL::to('video/'.$item->id.'')}}">
                            @if($item->album_image!="")
                                <img class="col-sm-12"
                                     src="{{{'http://img.youtube.com/vi/'.$item->album_image.'/hqdefault.jpg' }}}">
                            @elseif($item->album_image_first!="")
                                <img class="col-sm-12"
                                     src="{{{'http://img.youtube.com/vi/'.$item->album_image_first.'/hqdefault.jpg' }}}">
                            @else
                                <img class="col-sm-12" src="{{'img/default-image.jpg' }}">
                            @endif
                        </a>

                        <div class=" col-sm-12">{!!$item->name!!}</div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif -->