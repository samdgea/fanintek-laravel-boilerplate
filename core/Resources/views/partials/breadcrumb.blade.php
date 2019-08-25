<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ isset($title) ? $title : 'Default Page' }}
        {!! isset($sub_title) ? "<small>{$sub_title}</small>" : null !!}
    </h1>

    @if (isset($breadcrumbs))
    <ol class="breadcrumb">
        @foreach($breadcrumbs as $breadcrumb)
            <li class="{{ (isset($breadcrumb['active']) && !empty($breadcrumb['active'])) ? 'active' : null }}">
                <a {{ (isset($breadcrumb['route'])) ? "href=". route($breadcrumb['route']) ."" : null  }} >
                    @if (isset($breadcrumb['icon']) && !empty($breadcrumb['icon']))
                        <i class="{{ $breadcrumb['icon'] }}"></i>
                    @endif
                    {{ $breadcrumb['title'] }}
                </a>
            </li>
        @endforeach
    </ol>
    @endif
</section>