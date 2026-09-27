<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <a class="navbar-brand"
        href="{{ url('admin/dashboard') }}"
        style="float: none; display: flex; align-items: center; height: 50px; line-height: normal; padding: 0 15px; margin: 0;">
            <img src="{{ asset('uploads/settings/' . ($siteSetting->logo_light ?? 'logo.svg')) }}"
                alt="dashboard logo"
                style="width: 200px; max-height: 40px; object-fit: contain; display: block;">
        </a>
    </div>

    @php
        $unreadMessages = \App\Models\Message::where('status', 0)->count();
        $recentMessages = \App\Models\Message::latest()->take(5)->get();
    @endphp

    <ul class="nav navbar-top-links navbar-right">

        <li>
            <a href="{{ url('/') }}" target="_blank" rel="noopener" title="View Site">
                <i class="fa fa-external-link fa-fw"></i> View Site
            </a>
        </li>

        <!-- Clear Cache -->
        <li class="dropdown">
            <a href="#" onclick="document.getElementById('clearCacheModal').style.display='flex'; return false;">
                <i class="fa fa-refresh fa-fw"></i> Clear Cache
            </a>
        </li>

        <!-- Custom Clear Cache Modal -->
        <div id="clearCacheModal" style=" display:none; position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,0.5); z-index:9999; align-items:center; justify-content:center;">
            <div style="background:#fff; color:#333; border-radius:6px; width:90%; max-width:420px; box-shadow:0 5px 25px rgba(0,0,0,0.3); overflow:hidden;">
                <div style="padding:15px 20px; border-bottom:1px solid #eee; display:flex; justify-content:space-between; align-items:center;">
                    <h4 style="margin:0; font-size:18px;">
                        <i class="fa fa-refresh" style="color:#f0ad4e;"></i> Clear Application Cache
                    </h4>
                    <span onclick="document.getElementById('clearCacheModal').style.display='none';" style="cursor:pointer; font-size:22px; line-height:1; color:#999;">&times;</span>
                </div>

                <div style="padding:20px;">
                    Are you sure you want to clear all application caches? This may temporarily slow down the site while the cache rebuilds.
                </div>

                <div style="padding:15px 20px; border-top:1px solid #eee; text-align:right;">
                    <button type="button" onclick="document.getElementById('clearCacheModal').style.display='none';" class="btn btn-default">
                        Cancel
                    </button>
                    <a href="{{ url('/admin/clear-cache') }}" class="btn btn-danger">
                        <i class="fa fa-refresh"></i> Yes, Clear Cache
                    </a>
                </div>
            </div>
        </div>

        <!-- Messages -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-envelope fa-fw"></i>
                @if ($unreadMessages > 0)
                    <span class="badge">{{ $unreadMessages }}</span>
                @endif
                <i class="fa fa-caret-down"></i>
            </a>

            <ul class="dropdown-menu dropdown-messages">

                @forelse ($recentMessages as $message)
                    <li>
                        <a href="{{ route('admin.messages.edit', $message->id) }}">
                            <div>
                                <strong>{{ $message->name }}</strong>
                                <span class="pull-right text-muted">
                                    <em>{{ $message->created_at?->diffForHumans() }}</em>
                                </span>
                            </div>
                            <div>{{ \Illuminate\Support\Str::limit($message->subject, 45) }}</div>
                        </a>
                    </li>

                    @if (!$loop->last)
                        <li class="divider"></li>
                    @endif
                @empty
                    <li>
                        <a href="#">
                            <span class="text-muted">No messages</span>
                        </a>
                    </li>
                @endforelse

                <li class="divider"></li>

                <li>
                    <a class="text-center" href="{{ route('admin.messages.index') }}">
                        <strong>Read All Messages</strong>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>

            </ul>
        </li>

        <!-- User -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">

                @if (Auth::user()->image)
                    <img src="{{ asset('uploads/images/' . Auth::user()->image) }}"
                        class="img-circle"
                        width="28"
                        height="28"
                        style="object-fit: cover;">
                @else
                    <img src="{{ asset('uploads/avatar.png') }}"
                        class="img-circle"
                        width="28"
                        height="28"
                        style="object-fit: cover;">
                @endif

                {{ Auth::user()->name }}
                <i class="fa fa-caret-down"></i>
            </a>

            <ul class="dropdown-menu dropdown-user">

                <li>
                    <a href="{{ url('admin/profile') }}">
                        <i class="fa fa-user fa-fw"></i>
                        {{ Auth::user()->name }}
                    </a>
                </li>

                <li>
                    <a href="{{ url('admin/profile') }}">
                        <i class="fa fa-envelope fa-fw"></i>
                        {{ Auth::user()->email }}
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.messages.index') }}">
                        <i class="fa fa-inbox fa-fw"></i>
                        Messages
                        @if ($unreadMessages > 0)
                            <span class="badge">{{ $unreadMessages }}</span>
                        @endif
                    </a>
                </li>

                <li class="divider"></li>

                <li>
                    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                        @csrf
                        <button type="submit"
                                class="btn btn-link"
                                style="padding: 3px 20px; color: #333; text-decoration: none;">
                            <i class="fa fa-power-off fa-fw"></i>
                            Logout
                        </button>
                    </form>
                </li>

            </ul>
        </li>

    </ul>

    <!-- Sidebar -->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">

                <li>
                    <a href="{{ url('admin/dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="fa fa-dashboard fa-fw"></i> Dashboard
                    </a>
                </li>

                <li>
                    <a href="{{ url('admin/abouts') }}" class="{{ request()->is('admin/abouts*') ? 'active' : '' }}">
                        <i class="fa fa-info-circle fa-fw"></i> About
                    </a>
                </li>

                <li>
                    <a href="{{ url('admin/medias') }}" class="{{ request()->is('admin/medias*') ? 'active' : '' }}">
                        <i class="fa fa-bullhorn fa-fw"></i> Social Medias
                    </a>
                </li>

                <li>
                    <a href="{{ url('admin/services') }}" class="{{ request()->is('admin/services*') ? 'active' : '' }}">
                        <i class="fa fa-briefcase fa-fw"></i> Services
                    </a>
                </li>

                <li>
                    <a href="{{ url('admin/skills') }}" class="{{ request()->is('admin/skills*') ? 'active' : '' }}">
                        <i class="fa fa-cogs fa-fw"></i> Skills
                    </a>
                </li>

                <li>
                    <a href="{{ url('admin/counters') }}" class="{{ request()->is('admin/counters*') ? 'active' : '' }}">
                        <i class="fa fa-bar-chart fa-fw"></i> Counters
                    </a>
                </li>

                <li>
                    <a href="{{ url('admin/certificates') }}" class="{{ request()->is('admin/certificates*') ? 'active' : '' }}">
                        <i class="fa fa-certificate fa-fw"></i> Certificates
                    </a>
                </li>

                <li>
                    <a href="{{ url('admin/educations') }}" class="{{ request()->is('admin/educations*') ? 'active' : '' }}">
                        <i class="fa fa-graduation-cap fa-fw"></i> Educations
                    </a>
                </li>

                <li>
                    <a href="{{ url('admin/experiences') }}" class="{{ request()->is('admin/experiences*') ? 'active' : '' }}">
                        <i class="fa fa-suitcase fa-fw"></i> Experiences
                    </a>
                </li>

                <li>
                    <a href="{{ url('admin/projects') }}" class="{{ request()->is('admin/projects*') ? 'active' : '' }}">
                        <i class="fa fa-folder-open fa-fw"></i> Projects
                    </a>
                </li>

                <li>
                    <a href="{{ url('admin/testimonials') }}" class="{{ request()->is('admin/testimonials*') ? 'active' : '' }}">
                        <i class="fa fa-comments fa-fw"></i> Testimonials
                    </a>
                </li>

                <li>
                    <a href="{{ url('admin/messages') }}" class="{{ request()->is('admin/messages*') ? 'active' : '' }}">
                        <i class="fa fa-envelope fa-fw"></i> Messages
                        @if ($unreadMessages > 0)
                            <span class="badge pull-right">{{ $unreadMessages }}</span>
                        @endif
                    </a>
                </li>

                <li>
                    <a href="{{ url('admin/users') }}" class="{{ request()->is('admin/users*') ? 'active' : '' }}">
                        <i class="fa fa-users fa-fw"></i> Users
                    </a>
                </li>

                <li>
                    <a href="#"><i class="fa fa-android fa-fw"></i> Chatbot<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ url('admin/chatbot/settings') }}">Chatbot Settings</a>
                        </li>
                        <li>
                            <a href="{{ url('admin/chatbot/categories') }}">Categories</a>
                        </li>
                        <li>
                            <a href="{{ url('admin/chatbot/knowledge') }}">Knowledge Base</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>

                <li>
                    <a href="{{ url('admin/settings') }}" class="{{ request()->is('admin/settings*') ? 'active' : '' }}">
                    <i class="fa fa-cog fa-fw"></i> Settings<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ url('admin/profile') }}">My profile</a>
                        </li>
                        <li>
                            <a href="{{ url('admin/settings') }}">Site settings</a>
                        </li>
                        <li>
                            <a href="{{ url('admin/seo') }}">SEO settings</a>
                        </li> 
                        <li>
                            <a href="{{ url('admin/legal/privacy') }}">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="{{ url('admin/legal/terms') }}">Terms of Use</a>
                        </li>
                                               
                    </ul>
                    <!-- /.nav-second-level -->
                </li>

            </ul>
        </div>
    </div>

</nav>






    