<ul id="nav-mobile" class="side-nav fixed" style="transform: translateX(0%);">
    <li class="logo"><a id="logo-container" href="{{Config::get('app.url').Config::get('app.admin_directory')}}" class="brand-logo"><img class="responsive-logo-img" src="{{ Config::get('app.url') }}public/admin/img/logo.png" alt=""/></a></li>
    <li class="@if(isset($breadcrumbs[0]) && $breadcrumbs[0] == trans('custom.breadcrumbs_dashboard')){{"pressed active bold blue-grey darken-4"}}@endif" ><a href="{{Config::get('app.url').Config::get('app.admin_directory')}}">{{ trans('custom.breadcrumbs_dashboard') }}</a></li>
    <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
            <li class="bold @if($breadcrumbs[0] == trans('custom.breadcrumbs_web_content')){{"active"}}@endif"><a class="@if($breadcrumbs[0] == trans('custom.breadcrumbs_web_content')){{"active"}}@endif collapsible-header waves-effect waves-blue-grey">{{ trans('custom.breadcrumbs_web_content') }}<i class="material-icons right">arrow_drop_down</i></a>
                <div class="collapsible-body">
                    <ul>
                        <li class="@if(isset($breadcrumbs[1]) && $breadcrumbs[1] == trans('custom.breadcrumbs_subjects')){{"active blue-grey darken-4"}}@endif" ><a href="{{Config::get('app.url').Config::get('app.admin_directory').'/subjects/list'}}">{{ trans('custom.breadcrumbs_subjects') }}</a></li>
                        <li class="@if(isset($breadcrumbs[1]) && $breadcrumbs[1] == trans('custom.breadcrumbs_thematics')){{"active blue-grey darken-4"}}@endif" ><a href="{{Config::get('app.url').Config::get('app.admin_directory').'/thematics/list'}}">{{ trans('custom.breadcrumbs_thematics') }}</a></li>
                        <li class="@if(isset($breadcrumbs[1]) && $breadcrumbs[1] == trans('custom.breadcrumbs_franchises')){{"active blue-grey darken-4"}}@endif" ><a href="{{Config::get('app.url').Config::get('app.admin_directory').'/franchises/list'}}">{{ trans('custom.breadcrumbs_franchises') }}</a></li>
                        <li class="@if(isset($breadcrumbs[1]) && $breadcrumbs[1] == trans('custom.breadcrumbs_banners')){{"active blue-grey darken-4"}}@endif" ><a href="{{Config::get('app.url').Config::get('app.admin_directory').'/banners/list'}}">{{ trans('custom.breadcrumbs_banners') }}</a></li>
                        <li class="@if(isset($breadcrumbs[1]) && $breadcrumbs[1] == trans('custom.breadcrumbs_news')){{"active blue-grey darken-4"}}@endif" ><a href="{{Config::get('app.url').Config::get('app.admin_directory').'/news/list'}}">{{ trans('custom.breadcrumbs_news') }}</a></li>
                        <li class="@if(isset($breadcrumbs[1]) && $breadcrumbs[1] == trans('custom.breadcrumbs_videos')){{"active blue-grey darken-4"}}@endif" ><a href="{{Config::get('app.url').Config::get('app.admin_directory').'/videos/list'}}">{{ trans('custom.breadcrumbs_videos') }}</a></li>
                        <li class="@if(isset($breadcrumbs[1]) && $breadcrumbs[1] == trans('custom.breadcrumbs_sponsors')){{"active blue-grey darken-4"}}@endif" ><a href="{{Config::get('app.url').Config::get('app.admin_directory').'/sponsors/list'}}">{{ trans('custom.breadcrumbs_sponsors') }}</a></li>
                        <li class="@if(isset($breadcrumbs[1]) && $breadcrumbs[1] == trans('custom.breadcrumbs_surveys')){{"active blue-grey darken-4"}}@endif" ><a href="{{Config::get('app.url').Config::get('app.admin_directory').'/surveys/list'}}">{{ trans('custom.breadcrumbs_surveys') }}</a></li>
                        <li class="@if(isset($breadcrumbs[1]) && $breadcrumbs[1] == trans('custom.breadcrumbs_consultants')){{"active blue-grey darken-4"}}@endif" ><a href="{{Config::get('app.url').Config::get('app.admin_directory').'/consultants/list'}}">{{ trans('custom.breadcrumbs_consultants') }}</a></li>
                        <li class="@if(isset($breadcrumbs[1]) && $breadcrumbs[1] == trans('custom.breadcrumbs_newsletters')){{"active blue-grey darken-4"}}@endif" ><a href="{{Config::get('app.url').Config::get('app.admin_directory').'/newsletters/list'}}">{{ trans('custom.breadcrumbs_newsletters') }}</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </li>
    <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
            <li class="bold @if($breadcrumbs[0] == trans('custom.breadcrumbs_users')){{"active"}}@endif"><a class="@if($breadcrumbs[0] == trans('custom.breadcrumbs_users')){{"active"}}@endif collapsible-header waves-effect waves-blue-grey">Usuarios<i class="material-icons right">arrow_drop_down</i></a>
                <div class="collapsible-body">
                    <ul>
                        <li class="@if(isset($breadcrumbs[1]) && $breadcrumbs[1] == trans('custom.breadcrumbs_registered')){{"active blue-grey darken-4"}}@endif" ><a href="{{Config::get('app.url').Config::get('app.admin_directory').'/user/list'}}">{{ trans('custom.breadcrumbs_registered') }}</a></li>
                        <li class="@if(isset($breadcrumbs[1]) && $breadcrumbs[1] == trans('custom.breadcrumbs_admin')){{"active blue-grey darken-4"}}@endif" ><a href="{{Config::get('app.url').Config::get('app.admin_directory').'/admin/list'}}">{{ trans('custom.breadcrumbs_admin') }}</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </li>
    <li class="bold"><a href="{{Config::get('app.url')}}" class="waves-effect waves-blue-grey" target="_blank">{{ trans('custom.return_site') }}</a></li>
    <li class="bold"><a href="{{Config::get('app.url').Config::get('app.admin_directory').'/logout'}}" class="waves-effect waves-blue-grey">{{ trans('custom.logout') }}</a></li>
</ul>