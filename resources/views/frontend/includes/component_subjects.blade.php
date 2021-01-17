<section class="component__thematic col-md-4">
    <ul class="thematic__list">

        @foreach($subjects as $subject)
            <li class="thematic__item{{ isset($selectedSubject) && $selectedSubject->id == $subject->id ? " js-active" : "" }}">
                <a href="{{ Config::get('app.url') }}rubro/{{ $subject->slug }}">
                    <i style="background-image: url('{{ Config::get('app.url') }}public/uploads/{{ $subject->image }}')"></i>
                    <span>
                        {{ $subject->name }}
                    </span>
                </a>
            </li>
        @endforeach
    </ul>
</section>
