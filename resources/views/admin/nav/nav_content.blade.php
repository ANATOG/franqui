<ul id="nav-mobile" class="side-nav fixed" style="transform: translateX(0%);">
    <li class="logo"><a id="logo-container" href="{{Config::get('app.url').Config::get('app.admin_directory')}}" class="brand-logo"><img class="responsive-logo-img" src="{{ Config::get('app.url') }}/public/admin/img/logo.png" alt=""/></a></li>
    <li class="@if(isset($breadcrumbs[0]) && $breadcrumbs[0] == trans('custom.breadcrumbs_dashboard')){{"pressed active bold blue-grey darken-4"}}@endif" ><a href="{{Config::get('app.url').Config::get('app.admin_directory')}}">{{ trans('custom.breadcrumbs_dashboard') }}</a></li>
    
    <li class="@if(isset($breadcrumbs[1]) && $breadcrumbs[1] == trans('custom.breadcrumbs_franchises')){{"pressed active bold blue-grey darken-4"}}@endif" ><a href="{{Config::get('app.url').Config::get('app.admin_directory').'/franchises/list'}}">{{ trans('custom.breadcrumbs_franchises_profile') }}</a></li>

    <li class="@if(isset($breadcrumbs[0]) && $breadcrumbs[0] == trans('custom.breadcrumbs_users')){{"pressed active bold blue-grey darken-4"}}@endif" ><a href="{{Config::get('app.url').Config::get('app.admin_directory').'/admin/edit/'.$logged_user->id}}">{{ trans('custom.edit_my_profile') }}</a></li>
    <li class="bold"><a href="{{Config::get('app.url')}}" class="waves-effect waves-blue-grey" target="_blank">{{ trans('custom.return_site') }}</a></li>
    <li class="bold"><a href="{{Config::get('app.url').Config::get('app.admin_directory').'/logout'}}" class="waves-effect waves-blue-grey">{{ trans('custom.logout') }}</a></li>
</ul>