@php
    /**@var $testClass \App\Http\View\DocsHelper\TestClass */
@endphp

<div class="card doc-card" data-item="{{ $testClass->getHtmlId() }}" data-title="{{ $testClass->name }}">
    <div class="card-header">
        <h4 id="{{ $testClass->getHtmlId() }}">
            {!! $testClass->name !!}
            @include('macros.card-header-link', ['id' => $testClass->getHtmlId()])
        </h4>

        @if ($testClass->description)
            <div class="card-subtitle">{!! $testClass->description !!}</div>
        @endif
    </div>
    <div class="card-body p-0">
        @if ($testClass->showcaser->isPrototype())
            <div class="is-prototype-container d-flex">
                <div class="prototype-text align-self-center">
                    PROTÓTIPO
                </div>
            </div>
        @endif

        @yield('card-body-content')
    </div>
</div>
