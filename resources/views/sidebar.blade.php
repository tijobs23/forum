<aside class="bg-grey-lightest p-6 pr-10 border-l border-r w-64">
    @yield('sidebar-top')

    <div class="widget border-b-0">
        @if (auth()->check())
            @if(auth()->user()->confirmed)
                <button class="btn is-green w-full" @click="$modal.show('new-thread')">Nouvelle discussion</button>
            @else
                <p class="text-xs text-grey-dark font-bold border border-dashed border-grey-dark p-3">Veuillez confirmer votre email pour participer.</p>
            @endif
        @else
            <button class="btn is-green w-full tracking-wide" @click="$modal.show('login')">S'identifier pour poster</button>
        @endif
    </div>

    <div class="widget">
        <h4 class="widget-heading">Parcourir</h4>

        <ul class="mb-2 list-reset text-sm">
            <li class="pb-3">
                <a href="/threads" class="flex items-center text-grey-darkest hover:text-blue hover:font-bold {{ Request::is('threads') && ! Request::query() ? 'text-blue font-bold' : '' }}">
                    @include ('svgs.icons.all-threads', ['class' => 'mr-3 text-grey'])
                    Toutes les Rubriques
                </a>
            </li>

            @if (auth()->check())
                <li class="pb-3">
                    <a href="/threads?by={{ auth()->user()->username }}"
                       class="flex items-center text-grey-darkest hover:text-blue hover:font-bold  {{ Request::query('by') ? 'text-blue font-bold' : '' }}"
                    >
                        <img src="{{ auth()->user()->avatar_path }}"
                             alt="{{ auth()->user()->username }}"
                             class="w-4 h-4 mr-3 bg-grey text-grey-darkest rounded-full p-1">

                        Mes Rubriques
                    </a>
                </li>
            @endif

            <li class="pb-3">
                <a href="/threads?popular=1" class="flex items-center text-grey-darkest hover:text-blue hover:font-bold {{ Request::query('popular') ? 'text-blue font-bold' : '' }}">
                    @include ('svgs.icons.star', ['class' => 'mr-3 text-grey'])
                    Rubriques Populaires
                </a>
            </li>

            <li class="pb-3">
                <a href="/threads?unanswered=1" class="flex items-center text-grey-darkest hover:text-blue hover:font-bold {{ Request::query('unanswered') ? 'text-blue font-bold' : '' }}">
                    @include ('svgs.icons.question', ['class' => 'mr-3 text-grey'])
                    Fils sans Réponses
                </a>
            </li>

            <li>
                <a href="/leaderboard" class="flex items-center text-grey-darkest hover:text-blue hover:font-bold {{ request()->getPathInfo() === '/leaderboard' ? 'text-blue font-bold' : '' }}">
                    @include ('svgs.icons.leaderboard')
                    Classement
                </a>
            </li>

        </ul>

    </div>

    @if (count($trending))
        <div class="widget">
            <h4 class="widget-heading">Tendance</h4>

            <ul class="list-reset">
                @foreach ($trending as $thread)
                    <li class="pb-3 text-sm">
                        <a href="{{ url($thread->path) }}" class="link text-blue">
                            {{ $thread->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</aside>
