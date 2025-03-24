<section>


    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            @include('shared.input',['type'=>'password','label'=>'Password actuel','name'=>'current_password','required'=>true])

        </div>

        <div>
            @include('shared.input',['type'=>'password','label'=>'Nouveau Password','name'=>'password','required'=>true])

        </div>

        <div>
            @include('shared.input',['type'=>'password','label'=>'Confirmation Password','name'=>'password_confirmation','required'=>true])

        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="btn btn-success">Enregistrer</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Password modifié.') }}</p>
            @endif
        </div>
    </form>
</section>
