<div class="component__sponsors">
    <div class="sponsors__list">
        @foreach($sponsors as $sponsor)
            <div class="sponsors__item">
               @if (!empty($sponsor->link))
                  <a href="{{$sponsor->link}}" target="_blank">
               @endif
                <img src="{{ Config::get('app.url') }}public/uploads/{{ $sponsor->image }}" alt="">
               @if (!empty($sponsor->link))
                  </a>
               @endif
            </div>
        @endforeach
    </div>
</div>
